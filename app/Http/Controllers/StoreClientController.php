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

    public function viewClientSucursal($id)
    {
        $user = Auth::user();
        $sucursal = Sucursal::find($id);        
        $productos = $sucursal->productos;
        return view('admin.storeClientSucursal', compact('user', 'sucursal','productos'));
    }
}
