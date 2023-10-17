<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        //modificar el Request, no se recomienda realizarlo, solo cuando no hay de otra
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validaciones
        $this->validate($request, [
            'name' => 'required|max:50',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //Crea los registros en la BD
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenficar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //Otra manera de autentificar el usuario
        auth()->attempt($request->only('email', 'password'));


        //Redireccionar
        return redirect()->route('posts.index');
    }
}
