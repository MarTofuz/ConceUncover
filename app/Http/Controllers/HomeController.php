<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        $authenticated_user = Auth::user();
        return View('admin.home')->with(['user' => $authenticated_user]);
    }
}
