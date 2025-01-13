<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // validar
        $this->validate($request, [
            'comentario' => 'required|max:255',
        ]);


        // Almacenar el resultado
        Comentario::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);


        // Imprimir un mensaje
        return back()->with('mensaje', 'Comentario creado');

    }
}
