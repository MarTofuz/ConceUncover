<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function profile()
    {
        $authenticated_user = Auth::user();
        $tienda = $authenticated_user->tiendas; // Obtener las tiendas del usuario
        return View('admin.profile')->with(['user' => $authenticated_user, 'tienda' => $tienda]);
    }


    public function edit()
    {
        $user = Auth::user();
        $tiendas = $user->tiendas;
        return view('admin.edit', compact('user', 'tiendas'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->email = $request->input('email');
            /** @var \App\Models\User $user **/
            $user->save();
        } else {
            // Manejar el caso en el que el usuario no esté autenticado
            return redirect('/login')->with('error', 'Debes estar autenticado para editar tu perfil.');
        }

        $authenticated_user = Auth::user();
        $tienda = $authenticated_user->tiendas;
        return view('admin.profile', compact('user', 'tienda'));
    }

    public function adminPanel()
    {
        $tiendas = Tienda::where('status', 0)->get();
        $sucursales = Sucursal::where('status', 0)->get();
        return View('admin.adminPanel', compact('sucursales', 'tiendas'));
    }

    public function adminAccount()
    {
        $users = DB::table('users')->get();
        return View('admin.adminAccount', compact('users'));
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
        $sucursales = Tienda::with('sucursales')->get();
        return view('admin.adminStore', compact('sucursales', 'tiendas'));
    }

    public function buscarUsuario(){
        $users = User::orderBy('created_at', 'ASC');

        if(request()->has('search')){
            $searchTerm = '%' . request()->get('search', '') . '%';
            $users = $users->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('email', 'like', $searchTerm);
            });
        }

        $users = $users->get(); // Ejecutar la consulta y obtener los resultados

        return view('admin.adminAccount', compact('users'));
    }

    public function buscarTienda(){
        $tiendas = Tienda::orderBy('created_at', 'ASC');

        if(request()->has('search')){
            $searchTerm = '%' . request()->get('search', '') . '%';
            $tiendas = $tiendas->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('address', 'like', $searchTerm);
            });
        }

        $tiendas = $tiendas->get(); // Ejecutar la consulta y obtener los resultados

        return view('admin.adminStore', compact('tiendas'));
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
}
