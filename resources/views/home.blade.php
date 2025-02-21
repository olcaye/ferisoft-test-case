@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('content')
    <div class="container mx-auto">
        <div class="mt-10 m-auto w-10/12">
            <h1 class="text-2xl font-semibold mb-6">Son Yazılar</h1>

            <!-- Kategori Filtreleme -->
            <form method="GET" action="" class="mb-6">
                <label for="category" class="block text-lg">Kategori Seç:</label>
                <select id="category" class="w-full border p-2 mb-4" onchange="changeCategory(this)">
                    <option value="{{ route('home') }}">Tüm Kategoriler</option>
                    @foreach($categories as $category)
                        <option value="{{ route('category.show', $category->slug) }}"
                            {{ request()->is("category/{$category->slug}") ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            <script>
                function changeCategory(select) {
                    window.location.href = select.value;
                }
            </script>
            <!-- Blog Yazıları -->
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

            @if($posts->isEmpty())
                <p class="mt-6 text-center text-gray-500">Bu kategoride henüz yazı bulunmuyor.</p>
            @endif
        </div>
    </div>

@endsection
