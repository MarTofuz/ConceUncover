<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use App\Models\Sucursal;

class LandingController extends Controller
{
    public function index(){

        $tiendas = Tienda::all();
        $sucursales = Sucursal::all();
        return View('auth.landing', compact('tiendas', 'sucursales'))->with(['tiendas' => $tiendas, 'sucursales' => $sucursales]);
    }
}
