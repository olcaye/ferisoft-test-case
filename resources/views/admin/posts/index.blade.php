@extends('layouts.admin')

@section('title', 'Post Yönetimi')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Post Yönetimi</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::user()->hasRole('admin'))
        <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Yeni Post Ekle</a>
    @endif

    <div class="mt-6 bg-white p-6 rounded shadow">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-3">Başlık</th>
                    <th class="border p-3">Yazar</th>
                    <th class="border p-3">Kategoriler</th>
                    <th class="border p-3">Durum</th>
                    <th class="border p-3">Görünürlük</th>
                    <th class="border p-3">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr class="border">
                        <td class="border p-3">{{ $post->title }}</td>
                        <td class="border p-3">{{ $post->user->name }}</td>
                        <td class="border p-3">
                            @foreach($post->categories as $category)
                                <span class="bg-gray-200 px-2 py-1 rounded text-sm">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td class="border p-3">{{ $post->isActive() ? 'Yayında' : 'Taslak' }}</td>
                        <td class="border p-3">{{ $post->isRegisteredOnly() ? 'Sadece Kayıtlı Kullanıcılar' : 'Herkese Açık' }}</td>
                        <td class="border p-3 flex gap-2">
{{--                            <a href="{{ route('post.show', $post->slug) }}" class="text-green-500">Görüntüle</a>--}}
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-500">Düzenle</a>

                            @if(Auth::user()->hasRole('admin'))
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Sil</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
