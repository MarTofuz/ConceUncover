<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TiendaController;


class HomeController extends Controller
{
    public function index(){
        $authenticated_user = Auth::user();
        $tiendas = Tienda::all();
        $sucursales = Sucursal::all();
        $favoritos = auth()->user() ? auth()->user()->favoritos : [];
        return View('admin.home', compact('tiendas', 'sucursales'))->with(['user' => $authenticated_user, 'tiendas' => $tiendas, 'sucursales' => $sucursales, 'favoritos' => $favoritos]);
    }
}
