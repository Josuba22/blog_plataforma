@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Blog Posts</h1>

        <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
            @foreach ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:text-indigo-900">
                                {{ $post->titulo }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->conteudo, 100) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>By {{ $post->user->nome }}</span>
                            <span>{{ $post->data_post->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection