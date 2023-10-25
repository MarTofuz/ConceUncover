<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;

class LandingController extends Controller
{
    public function index(){
        
        $tiendas = Tienda::all(); 
        return View('auth.landing', compact('tiendas'))->with(['tiendas' => $tiendas]);
    }
}
