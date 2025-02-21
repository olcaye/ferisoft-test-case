@extends('layouts.admin')

@section('title', 'Post Düzenle')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Post Düzenle</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <label>Başlık:</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border p-2 mb-4">

        <label>İçerik:</label>
        <textarea name="content" class="w-full border p-2 mb-4">{{ old('content', $post->content) }}</textarea>

       {{-- <label>Slug:</label>
        <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border p-2 mb-4">--}}

        <label>Durum:</label>
        <select name="status" class="w-full border p-2 mb-4">
            <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Yayında</option>
            <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Taslak</option>
        </select>

        <label>Sadece Kayıtlı Kullanıcılar Görebilsin mi?</label>
        <select name="registered_only" class="w-full border p-2 mb-4">
            <option value="0" {{ old('registered_only', $post->registered_only) == 0 ? 'selected' : '' }}>Herkese Açık
            </option>
            <option value="1" {{ old('registered_only', $post->registered_only) == 1 ? 'selected' : '' }}>Sadece Kayıtlı
                Kullanıcılar
            </option>
        </select>

        <label>Kategoriler:</label>
        <select name="categories[]" multiple class="w-full border p-2 mb-4">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Güncelle</button>
    </form>
@endsection
