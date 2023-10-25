<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use App\Models\User;

class TiendaController extends Controller
{

    public function viewSaveShop()
    {
        $user = Auth::user();
        $tiendas = Tienda::where('user_id', $user->id)->get(['location']);        
        return view('admin.editShop', compact('user', 'tiendas'));
    }

    public function saveShop(Request $request)
    {
        $user = Auth::user();

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

        return redirect('/profile');
    }
}
