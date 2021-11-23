<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        if (User::create($request->all())) 
        {
            return response()->json([
                'message' => 'Usuario creado exitosamente'],201);
        }
        else
        {
            return response()->json([
                'message' => 'Ha ocurrido un error, por favor intente mas tarde.'
            ], 500);
        }  

    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $acceso = $request->only('email', 'password');

        if (!Auth::attempt($acceso)) 
        {
            return response()->json(['error' => 'Usuario o contraseña incorrectos'], 401);
        }

        $user = Auth::user(); 

        $response = [
            'user_id' => $user->id,
        ];
        
        return response()->json($response,201);
    }
}
