<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin(){
        return View('auth.login');
    }

    public function attemptLogin(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if(Auth::attempt($credentials, $request?->remember)){
            $user = Auth::user();
            return redirect()->route('home')->with('user', $user);
        }else{
            return redirect()->back()->withErrors(['error' => 'Correo o Contraseña incorrectas']);
        }
    }

    public function showRegister(){
        return View('auth.register');
    }

    public function storeAccount(Request $request){
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);
        return redirect()->route('home');
    }

    // Cerrar session
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    ///////////////////////////


    // Recuperar Contraseña
    public function restpass(){
        return view('auth.restpass');
    }

    public function sendPasswordResetLink(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function restcode() {
        return view('auth.restcode');
    }

    public function verifyPasswordResetCode(Request $request) {
        return view('auth.verifycode');
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
                $user->setRememberToken(Str::random(60));
                Auth::login($user);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('home')->with('status', __($response))
            : back()->withInput($request->only('email'))->withErrors(['email' => [__($response)]]);
    }
    ////////////////////////

    // El home (NO DEL USER)
    public function landing(){
        return View('auth.landing');
    }
    ////////////////////////////
}
