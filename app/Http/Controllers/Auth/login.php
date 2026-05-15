<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('alumnos.index'))->with('success', 'Bienvenid@');
        }
        return back()
            ->withErrors(['usuario' => 'Usuario o contraseña incorrectos'])
            ->onlyInput('usuario');
    }
}
