<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GestionUsuarioController extends Controller
{
    public function registro()
    {
        return view('gestion_usuario.registro');
    }

    public function login()
    {        
        return view('gestion_usuario.login');
    }

    public function inicio_sesion(Request $request)
    {
        Auth::loginUsingId($request->id);
        return redirect()->route('orders.index');
    }

    public function cierre_sesion(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function index()
    {
        return view('gestion_usuario.index');
    }
}
