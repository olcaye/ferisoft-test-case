@extends('layouts.admin')

@section('title', 'Kategoriler')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Kategoriler</h1>

    @if(Auth::user()->hasRole('admin'))
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Yeni Kategori Ekle</a>
    @endif

    <div class="mt-6 bg-white p-6 rounded shadow">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-3">ID</th>
                    <th class="border p-3">Kategori Adı</th>
                    <th class="border p-3">Durum</th>
                    @if(Auth::user()->hasRole('admin'))
                        <th class="border p-3">İşlemler</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="border">
                        <td class="border p-3">{{ $category->id }}</td>
                        <td class="border p-3">{{ $category->name }}</td>
                        <td class="border p-3">{{ $category->isActive() ? 'Aktif' : 'Pasif' }}</td>
                        @if(Auth::user()->hasRole('admin'))
                            <td class="border p-3 flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-500">Düzenle</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Sil</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
