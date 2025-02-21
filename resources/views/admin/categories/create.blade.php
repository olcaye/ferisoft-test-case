@extends('layouts.admin')

@section('title', 'Yeni Kategori Ekle')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Yeni Kategori Ekle</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-white p-6 rounded shadow">
        @csrf

        <label>Kategori Adı:</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 mb-4">

        <label>Kategori Durumu:</label>
        <select name="is_active" class="w-full border p-2 mb-4">
            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Pasif</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kaydet</button>
    </form>
@endsection
