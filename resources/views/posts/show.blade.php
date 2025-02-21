@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mx-auto max-w-3xl bg-white p-6 rounded shadow-lg">
        <h1 class="text-3xl font-semibold mb-4 text-center">{{ $post->title }}</h1>
        <p class="text-gray-600 text-center">Yazar: {{ $post->user->name }}</p>
        <p class="text-gray-500 text-center text-sm">Yayınlanma Tarihi: {{ $post->created_at->format('d.m.Y H:i') }}</p>

        <div class="mt-6 border-t border-gray-300 pt-4">
            <p class="text-gray-700 leading-relaxed">{{ $post->content }}</p>
        </div>
    </div>
@endsection
