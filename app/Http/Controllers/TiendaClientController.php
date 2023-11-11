<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;

class TiendaClientController extends Controller
{
    public function viewClientTienda($id)
    {
        $user = Auth::user();
        $tienda = Tienda::find($id);
        return view('admin.storeClientTienda', compact('user', 'tienda'));
    }

    public function viewClientSucursal($id)
    {
        $user = Auth::user();
        $sucursal = Sucursal::find($id);
        return view('admin.storeClientSucursal', compact('user', 'sucursal'));
    }
}
