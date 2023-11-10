<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Vista productos
    public function productView($tiendaId)
    {
        $user = Auth::user();
        $tienda = Tienda::findOrFail($tiendaId);

        // Obtén los productos relacionados con esta tienda
        $productos = $tienda->productos;

        // Pasa los productos y la tienda a la vista
        return view('admin.topProduct', compact('user', 'tienda', 'productos'));
    }
    //Ver vista edicion producto
    public function editProduct($productId)
    {
        $user = Auth::user();        
        $tienda = $user->tiendas;
        $producto = Product::findOrFail($productId);
        return view('admin.editProduct', compact('producto'));
    }
    //Guardar producto segun la
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
    //Eliminar producto por id
    public function deleteProduct($productId)
    {
        $producto = Product::findOrFail($productId);
        $producto->delete();
        return redirect()->back()->with('success', 'Producto eliminado exitosamente.');
    }
    
    //Editar producto (update)
    public function updateProduct(Request $request, $productId)
    {
        $producto = Product::findOrFail($productId);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:80',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $producto->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('productView', ['tiendaId' => $producto->tienda_id])->with('success', 'Producto actualizado exitosamente.');
    }
}
