<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class VerifyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $roles = DB::table('roles')->where('name','admin')->first();
       $hasroles = DB::table('model_has_roles')->where('role_id',$roles->id ?? null )->where('model_id', Auth::user()->id ?? null )
       ->where('model_type', 'App\Models\User')->exists();
        if($hasroles){
            return $next($request);
        }else{
            return new RedirectResponse(route('showDelayPage'));
        }
       dd($roles);
       dd(Auth::user());
    }
    
}

