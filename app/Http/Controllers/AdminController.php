<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function profile()
    {
        $authenticated_user = Auth::user();
        $tienda = $authenticated_user->tiendas; // Obtener las tiendas del usuario
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return View('admin.profile')->with(['user' => $authenticated_user, 'tienda' => $tienda, 'favoritos' => $favoritos]);
    }

    public function edit()
    {
        $user = Auth::user();
        $tiendas = $user->tiendas;
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.edit', compact('user', 'tiendas', 'favoritos'));
    }

    public function update(Request $request)

    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Reglas para la imagen
        ]);

        $user = Auth::user();

        if ($user) {
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->email = $request->input('email');

            if ($request->has('delete_photo') && $request->input('delete_photo')) {
                // Eliminar la imagen actual del almacenamiento
                $filePath = 'profile_photos/' . $user->profile_photo_path;

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                // Establecer la ruta de la foto de perfil como null
                $user->profile_photo_path = null;
            }
            // Manejar la carga de la imagen si está presente
        if ($request->hasFile('profile_photo')) {
            // Obtener el nombre único de la imagen utilizando el ID del usuario
            $photoName = $user->id . '.' . $request->file('profile_photo')->getClientOriginalExtension();

            // Almacenar la imagen en el directorio 'profile_photos' con el nombre único
            $photoPath = $request->file('profile_photo')->storeAs('profile_photos', $photoName, 'public');

            // Guardar el nombre único de la imagen en la base de datos
            $user->profile_photo_path = $photoPath;
        }
            /** @var \App\Models\User $user **/
            $user->save();
        } else {
            // Manejar el caso en el que el usuario no esté autenticado
            return redirect('/login')->with('error', 'Debes estar autenticado para editar tu perfil.');
        }

        $authenticated_user = Auth::user();
        $tienda = $authenticated_user->tiendas;
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.profile', compact('user', 'tienda', 'favoritos'));
    }

    public function adminPanel()
    {
        $tiendas = Tienda::where('status', 0)->get();
        $sucursales = Sucursal::where('status', 0)->get();
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return View('admin.adminPanel', compact('sucursales', 'tiendas', 'favoritos'));
    }

    public function adminAccount()
    {
        $users = DB::table('users')->get();
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return View('admin.adminAccount', compact('users', 'favoritos'));
    }

    public function eliminarUsuario($id)
    {
        $users = User::find($id);

        if ($id == 1) {
            return redirect()->route('adminAccount')->with('error', 'No puedes eliminar al administrador.');
        }

        if (!$users) {
            return redirect()->route('adminAccount')->with('error', 'Usuario no encontrado.');
        }

        $users->delete();

        return redirect()->route('adminAccount')->with('success', 'Usuario eliminado correctamente.');
    }

    public function eliminarTienda($id)
    {
        $tiendas = Tienda::find($id);

        if (!$tiendas) {
            return redirect()->route('adminStore')->with('error', 'Tienda no encontrada.');
        }

        $tiendas->delete();
        $tiendas->sucursales()->delete();

        return redirect()->route('adminStore')->with('success', 'Tienda eliminada correctamente.');
    }

    public function eliminarSucursal($id)
    {
        $sucursales = Sucursal::find($id);

        if (!$sucursales) {
            return redirect()->route('adminStore')->with('error', 'Sucursal no encontrado.');
        }

        $sucursales->delete();

        return redirect()->route('adminStore')->with('success', 'Sucursal eliminada correctamente.');
    }

    public function adminStore()
    {
        $tiendas = Tienda::all();
        $sucursales = Tienda::all();
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return view('admin.adminStore', compact('sucursales', 'tiendas', 'favoritos'));
    }

    public function buscarUsuario()
    {
        $users = User::orderBy('created_at', 'ASC');

        if (request()->has('search')) {
            $searchTerm = '%' . request()->get('search', '') . '%';
            $users = $users->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        }

        $users = $users->get(); // Ejecutar la consulta y obtener los resultados
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];

        return view('admin.adminAccount', compact('users', 'favoritos'));
    }

    public function buscarTienda()
    {
        $tiendas = Tienda::orderBy('created_at', 'ASC');

        if (request()->has('search')) {
            $searchTerm = '%' . request()->get('search', '') . '%';
            $tiendas = $tiendas->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm);
            });
        }

        $tiendas = $tiendas->get(); // Ejecutar la consulta y obtener los resultados
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];

        return view('admin.adminStore', compact('tiendas', 'favoritos'));
    }

    public function statusTienda(Request $request, $id)
    {
        $tienda = Tienda::find($id);

        if ($tienda) {
            if ($tienda->status) {
                $tienda->status = 0;
            } else {
                $tienda->status = 1;
            }
            $tienda->save();
            return back();
        }
    }

    public function statusSucursal(Request $request, $id)
    {
        $sucursal = Sucursal::find($id);

        if ($sucursal) {
            if ($sucursal->status) {
                $sucursal->status = 0;
            } else {
                $sucursal->status = 1;
            }
            $sucursal->save();
            return back();
        }
    }

    public function viewsucursal($id)
    {
        $user = Auth::user();
        $sucursal = Sucursal::find($id);
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        if (!$sucursal) {
            // Manejar el caso en el que la sucursal no se encuentre
            return redirect()->route('home')->with('error', 'Sucursal no encontrada');
        } else {
            return view('admin.profileSucursal', compact('sucursal', 'user', 'favoritos'));
        }
    }

    public function viewStoreClient()
    {
        $user = Auth::user();
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];

        return view('admin.storeClient', compact('user', 'favoritos'));
    }
}
