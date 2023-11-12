<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;

class StoreClientController extends Controller
{
    public function viewClientTienda($id)
    {
        $user = Auth::user();
        $tienda = Tienda::find($id);
        $productos = $tienda->productos;
        return view('admin.storeClientTienda', compact('user', 'tienda','productos'));
    }

    public function commentSave(Request $request, Tienda $tienda)
    {
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        $comment_id = $request->input('comment_id');


        $tienda->comment()->create([
            'content' => $content,
            'user_id' => $user_id,
            'comment_id' => $comment_id // Asegurarse de asignar el ID del usuario
        ]);

        return redirect()->back();
    }

    public function viewClientSucursal($id)
    {
        $user = Auth::user();
        $sucursal = Sucursal::find($id);
        $productos = $sucursal->productos;
        return view('admin.storeClientSucursal', compact('user', 'sucursal','productos'));
    }

    public function commentSaveSucursal(Request $request, Sucursal $sucursal)
    {
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        $comment_id = $request->input('comment_id');


        $sucursal->comment()->create([
            'content' => $content,
            'user_id' => $user_id,
            'comment_id' => $comment_id // Asegurarse de asignar el ID del usuario
        ]);

        return redirect()->back();
    }

}
