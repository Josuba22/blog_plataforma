<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'categorias', 'tags')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('user', 'categorias', 'tags', 'comentarios.user');
        return view('posts.show', compact('post'));
    }

    // Outros métodos como store, update, delete, etc.
}
