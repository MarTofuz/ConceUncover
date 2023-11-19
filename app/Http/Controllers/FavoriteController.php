<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favoritosTienda(Request $request)
    {
        // Validación de datos
        $request->validate([
            'user_id' => 'required|integer',
            'tienda_id' => 'required|integer',
        ]);

        // Buscar si ya existe un favorito con los mismos datos
        $favoritoExistente = Favorite::where('user_id', $request->input('user_id'))
            ->where('tienda_id', $request->input('tienda_id'))
            ->first();

        // Verificar si ya existe un favorito
        if ($favoritoExistente) {
            // Si ya existe, elimina el favorito existente
            $favoritoExistente->delete();
            return redirect()->back();
        }

        // Si no existe, crea un nuevo favorito
        $favorito = Favorite::create([
            'user_id' => $request->input('user_id'),
            'tienda_id' => $request->input('tienda_id'),
        ]);

        return redirect()->back();
    }

    public function favoritosSucursal(Request $request)
    {
        // Validación de datos
        $request->validate([
            'user_id' => 'required|integer',
            'sucursal_id' => 'required|integer',
        ]);

        // Buscar si ya existe un favorito con los mismos datos
        $favoritoExistente = Favorite::where('user_id', $request->input('user_id'))
            ->where('sucursal_id', $request->input('sucursal_id'))
            ->first();

        // Verificar si ya existe un favorito
        if ($favoritoExistente) {
            // Si ya existe, elimina el favorito existente
            $favoritoExistente->delete();
            return redirect()->back();
        }

        // Si no existe, crea un nuevo favorito
        $favorito = Favorite::create([
            'user_id' => $request->input('user_id'),
            'sucursal_id' => $request->input('sucursal_id'),
        ]);

        return redirect()->back();
    }
}
