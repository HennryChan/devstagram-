<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //Validación
    public function store(Request $request, User $user ,Post $post ){
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        //Almacena el resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //Imprime un mensaje y regresa donde se envio
        return back()->with('mensaje', 'Comentario Realizado Correctamente');
    }
}
