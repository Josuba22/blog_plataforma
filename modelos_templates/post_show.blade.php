@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->titulo }}</h1>
                
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span>By {{ $post->user->nome }}</span>
                    <span class="mx-2">&bull;</span>
                    <span>{{ $post->data_post->format('M d, Y') }}</span>
                </div>

                @if($post->foto)
                    <img src="{{ asset('storage/' . $post->foto) }}" alt="{{ $post->titulo }}" class="w-full h-64 object-cover mb-6">
                @endif

                <div class="prose max-w-none">
                    {!! $post->conteudo !!}
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Categories:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->categorias as $categoria)
                            <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">{{ $categoria->nome }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Tags:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ $tag->nome }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </article>

        <section class="mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Comments</h2>

            @foreach($post->comentarios as $comentario)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold">{{ $comentario->user->nome }}</span>
                            <span class="text-sm text-gray-500">{{ $comentario->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <p>{{ $comentario->conteudo }}</p>
                    </div>
                </div>
            @endforeach

            @auth
                <form action="{{ route('comentarios.store') }}" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="conteudo" rows="3" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" placeholder="Add a comment..."></textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Comment</button>
                </form>
            @else
                <p class="mt-6 text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to leave a comment.</p>
            @endauth
        </section>
    </div>
@endsection