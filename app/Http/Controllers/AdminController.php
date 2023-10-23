<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;
use App\Models\User;
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

    // Resto del código para actualizar la tienda si es necesario
    // Asegúrate de que el usuario tenga una relación de tiendas antes de acceder a ella
    if ($user->tiendas) {
        foreach ($user->tiendas as $tienda) {
            $tienda->description = $request->input('description');
            $tienda->assistant = $request->input('assistant');
            $tienda->schedule = $request->input('schedule');
            $tienda->location = $request->input('location');
            $tienda->save();
        }
    }

    // Redireccionar o mostrar una vista de confirmación
    $tienda = $user->tiendas;
    return view('admin.profile', compact('user', 'tienda'));
}

public function adminPanel(){
    return View('admin.adminPanel');
}

public function adminAccount(){
    return View('admin.adminAccount');
}

public function adminStore(){
    return View('admin.adminStore');
}

}
