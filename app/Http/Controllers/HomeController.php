<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TiendaController;


class HomeController extends Controller
{
    public function index(){
        $authenticated_user = Auth::user();
        $tiendas = Tienda::all();  
        return View('admin.home', compact('tiendas'))->with(['user' => $authenticated_user, 'tiendas' => $tiendas]);
    }
}
