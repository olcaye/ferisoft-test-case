@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="container mx-auto max-w-3xl bg-white p-6 rounded shadow-lg">
        <h1 class="text-3xl font-semibold mb-4 text-center">{{ $category->name }}</h1>

        @if($posts->isEmpty())
            <p class="text-center text-gray-500">Bu kategoride henüz yazı bulunmuyor.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <div class="bg-white p-6 rounded shadow">
                        <h2 class="text-xl font-semibold">
                            <a href="{{ route('post.show', $post->slug) }}" class="text-blue-500 hover:underline">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 text-sm">Yazar: {{ $post->user->name }}</p>
                        <p class="mt-2 text-sm text-gray-800">
                            {{ Str::limit($post->content, 100) }}
                        </p>
                        <p class="mt-2 text-sm font-semibold">
                            {{ $post->isRegisteredOnly() ? '🔒 Sadece Kayıtlı Kullanıcılar' : '🌍 Herkese Açık' }}
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
