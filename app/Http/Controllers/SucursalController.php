<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use App\Models\User;


class SucursalController extends Controller
{

    public function viewSaveSucursal($id)
    {
        $user = Auth::user();
        $tienda = Tienda::find($id);
        return view('admin.saveSucursal', compact('user', 'tienda'));
    }

    public function saveSucursal(Request $request)
    {
        $user = Auth::user();

        // Verificar si el usuario ya tiene una tienda relacionada
        /** @var \App\Models\Tienda $user */
        if (!$user->tiendas()->exists()) {
            return redirect('/profileShop')->with('error', 'Debes tener al menos una tienda para agregar sucursales.');
        }

        $tienda = $user->tiendas; // Obtener la primera tienda del usuario

        $sucursal = new Sucursal([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'assistant' => $request->input('assistant'),
            'schedule' => $request->input('schedule'),
            'location' => $request->input('location'),
            'tienda_id' => $tienda->id // Asociar la sucursal a la tienda
        ]);

        $sucursal->save();

        return redirect('/profileShop')->with('success', 'Sucursal agregada exitosamente.');
    }

    public function deletedSucursal($id)
    {
        $sucursal = Sucursal::find($id);
        $sucursal->delete();
        return redirect('/profileShop')->with('success', 'Sucursal eliminada');
    }

    public function viewUpdateSucursal($id)
    {
        $user = Auth::user();
        $sucursal = Sucursal::find($id);
        return view('admin.editSucursal', compact('user', 'sucursal'));
    }

    public function updateSucursal(Request $request, $id)
    {
        $sucursal = Sucursal::find($id);

        $sucursal->name = $request->input('name');
        $sucursal->address = $request->input('address');
        $sucursal->description = $request->input('description');
        $sucursal->assistant = $request->input('assistant');
        $sucursal->schedule = $request->input('schedule');
        $sucursal->location = $request->input('location');

        $sucursal->save();

        return redirect('/profileShop')->with('success', 'Sucursal actualizada exitosamente.');
    }


}
