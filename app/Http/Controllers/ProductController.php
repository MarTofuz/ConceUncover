<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sucursal;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /* ------ PRODUCTOS TIENDAS ------ */
    public function productView($tiendaId) //Vista productos
    {
        $user = Auth::user();
        $tienda = Tienda::findOrFail($tiendaId);

        if ($user->id !== $tienda->user_id) {
            abort(403, 'No tienes permisos para acceder a esta tienda.');
        }

        $productos = $tienda->productos;
        return view('admin.topProduct', compact('user', 'tienda', 'productos'));
    }
    public function editProduct($productId) //Ver vista edicion producto
    {
        $user = Auth::user();
        $tienda = $user->tiendas;
        $producto = Product::findOrFail($productId);
        return view('admin.editProduct', compact('producto'));
    }
    public function saveProduct(Request $request)
{
    $user = Auth::user();
    $tienda = $user->tiendas;

    $productosCount = $tienda->productos->count();
    $limiteProductos = 12;

    if ($productosCount >= $limiteProductos) {
        $mensajeError = 'No puedes agregar más de 12 productos a esta tienda.';
        return redirect()->route('productView', ['tiendaId' => $tienda->id])->with('error', $mensajeError);
    }

    $producto = new Product([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'tienda_id' => $tienda->id
    ]);

    // Manejo de la subida de la imagen
    if ($request->hasFile('image')) {
        $request->validate(['image' => 'required|image']);
        $path = $request->file('image')->store('products', 'public');
        $producto->image = $path;
    }

    $producto->save();

    return redirect()->route('productView', ['tiendaId' => $tienda->id])
                     ->with('success', 'Producto agregado exitosamente.');
}

    public function deleteProduct($productId) //Eliminar producto por id
    {
        $producto = Product::findOrFail($productId);
        $producto->delete();
        return redirect()->back()->with('success', 'Producto eliminado exitosamente.');
    }
    public function updateProduct(Request $request, $productId)
{
    $producto = Product::findOrFail($productId);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:80',
        'description' => 'required|string',
        'image' => 'sometimes|image', // Regla opcional para la imagen
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Datos a actualizar
    $dataToUpdate = [
        'name' => $request->input('name'),
        'description' => $request->input('description'),
    ];
    if ($request->has('delete_photo') && $request->input('delete_photo')) {
        // Eliminar la imagen actual del almacenamiento
        $filePath = 'profile_photos/' . $producto->image;
    
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    
        // Establecer la ruta de la foto de perfil como null
        $producto->image = null;
    }

    // Manejo de la subida de la imagen
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $dataToUpdate['image'] = $path;
    }

    // Actualizar el producto
    $producto->update($dataToUpdate);

    return redirect()->route('productView', ['tiendaId' => $producto->tienda_id])
                     ->with('success', 'Producto actualizado exitosamente.');
}

    /* ------ FIN PRODUCTO TIENDAS ------ */

    /* ------ PRODUCTOS SUCURSALES ------ */

    public function productSucursalView($sucursalId) //Vista productos
    {
        $user = Auth::user();
        $sucursal = Sucursal::findOrFail($sucursalId);
        if ($user->id !== $sucursal->tienda->user_id) {
            abort(403, 'No tienes permisos para acceder a esta sucursal.');
        }
        $productos = $sucursal->productos;
        return view('admin.topProductSucursal', compact('user', 'sucursal', 'productos'));
    }
    public function saveSucursalProduct(Request $request, $sucursalId)
{
    $sucursal = Sucursal::findOrFail($sucursalId);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:80',
        'description' => 'required|string',
        'image' => 'image', // Añade esta línea
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $productosCount = $sucursal->productos->count();
    $limiteProductos = 12;

    if ($productosCount >= $limiteProductos) {
        $mensajeError = 'No puedes agregar más de 12 productos a esta sucursal.';
        return redirect()->route('producto-sucursal', ['sucursalId' => $sucursal->id])->with('error', $mensajeError);
    }

    $producto = new Product([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'sucursal_id' => $sucursal->id,
    ]);

    // Manejo de la subida de la imagen
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $producto->image = $path;
    }

    $producto->save();

    return redirect()->route('producto-sucursal', ['sucursalId' => $sucursal->id])
                     ->with('success', 'Producto agregado exitosamente.');
}

    /* ------ FIN PRODUCTOS SUCURSALES ------ */
}
