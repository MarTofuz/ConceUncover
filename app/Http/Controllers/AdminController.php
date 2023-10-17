<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function profile()
    {

        $authenticated_user = Auth::user();
        $tiendas = $authenticated_user->tiendas;

        return View('admin.profile')->with([
            'user' => $authenticated_user,
            'tiendas' => $tiendas
        ]);

    }

    public function edit()
    {
        $user = Auth::user();
        $tiendas = $user->tiendas;
        return view('admin.edit', compact('user', 'tiendas'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->save();

        return view('admin.profile', compact('user'));
    }
}
