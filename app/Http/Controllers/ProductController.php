<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productView($tiendaId)
    {
        $user = Auth::user();
        $tienda = Tienda::findOrFail($tiendaId);

        // Obtén los productos relacionados con esta tienda
        $productos = $tienda->productos;
    
        // Pasa los productos y la tienda a la vista
        return view('admin.topProduct', compact('user', 'tienda','productos'));
    }
    public function saveProduct(Request $request)
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        $producto = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'tienda_id' => $tienda->id
        ]);
        $producto->save();
        return redirect()->route('productView', ['tiendaId' => $tienda->id])->with('success', 'Producto agregado exitosamente.');
    }
    
    
}
