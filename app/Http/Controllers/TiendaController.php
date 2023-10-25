<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;

class TiendaController extends Controller
{
    public function viewSaveShop()
    {
        $user = Auth::user();
        $tiendas = $user->tiendas;
        return view('admin.editShop', compact('user', 'tiendas'));
    }

    public function saveShop(Request $request)
    {
        $user = Auth::user();

        // Verificar si el usuario ya tiene una tienda relacionada
        /** @var \App\Models\Tienda $user */
        if ($user->tiendas()->exists()) {
            return redirect('/profile')->with('error', 'No puedes agregar más de una tienda.');
        }

        $tienda = new Tienda([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'assistant' => $request->input('assistant'),
            'schedule' => $request->input('schedule'),
            'location' => $request->input('location')
        ]);
        /** @var \App\Models\Tienda $user */
        $user->tiendas()->save($tienda);

        return redirect('/profile')->with('success', 'Tienda agregada exitosamente.');
    }

    public function viewupdateshop()
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        return view('admin.editLocal', compact('user', 'tienda'));
    }

    public function updateShop(Request $request)
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        if (!$tienda) {
            return redirect('/profileShop')->with('error', 'No tienes una tienda para editar.');
        }

        $tienda->name = $request->input('name');
        $tienda->address = $request->input('address');
        $tienda->description = $request->input('description');
        $tienda->assistant = $request->input('assistant');
        $tienda->schedule = $request->input('schedule');
        $tienda->location = $request->input('location');
        $tienda->save();

        return redirect('/profileShop')->with('success', 'Tienda actualizada exitosamente.');
    }

    public function viewProfileShop()
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        $sucursales = $tienda->sucursales;
        return view('admin.profileShop', compact('user', 'tienda', 'sucursales'));
    }
}
