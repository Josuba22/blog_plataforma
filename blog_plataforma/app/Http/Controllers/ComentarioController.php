<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Post $post)
    {
        $comentarios = $post->comentarios()->with('user')->latest()->get();
        return response()->json($comentarios);
    }

    public function show(Comentario $comentario)
    {
        return response()->json($comentario->load('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'conteudo' => 'required|string|max:1000'
        ]);

        $comentario = Comentario::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'conteudo' => $request->conteudo
        ]);

        return response()->json($comentario->load('user'), 201);
    }

    public function update(Request $request, Comentario $comentario)
    {
        $this->authorize('update', $comentario);

        $request->validate([
            'conteudo' => 'required|string|max:1000'
        ]);

        $comentario->update([
            'conteudo' => $request->conteudo
        ]);

        return response()->json($comentario->fresh());
    }

    public function destroy(Comentario $comentario)
    {
        $this->authorize('delete', $comentario);

        $comentario->delete();

        return response()->json(null, 204);
    }
}
