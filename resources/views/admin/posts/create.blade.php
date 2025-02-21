
@extends('layouts.admin')

@section('title', 'Yeni Post Ekle')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Yeni Post Ekle</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.store') }}" class="bg-white p-6 rounded shadow">
        @csrf

        <label>Başlık:</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full border p-2 mb-4">

        <label>İçerik:</label>
        <textarea name="content" class="w-full border p-2 mb-4">{{ old('content') }}</textarea>

{{--        <label>Slug:</label>
        <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border p-2 mb-4">--}}

        <label>Durum:</label>
        <select name="status" class="w-full border p-2 mb-4">
            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Yayında</option>
            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Taslak</option>
        </select>

        <label>Sadece Kayıtlı Kullanıcılar Görebilsin mi?</label>
        <select name="registered_only" class="w-full border p-2 mb-4">
            <option value="0">Herkese Açık</option>
            <option value="1">Sadece Kayıtlı Kullanıcılar</option>
        </select>

        <label>Kategoriler:</label>
        <select name="categories[]" multiple class="w-full border p-2 mb-4">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kaydet</button>
    </form>
@endsection
