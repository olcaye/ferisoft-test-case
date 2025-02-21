@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <h1 class="text-3xl mb-4 text-blue-500">Admin Panel</h1>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Users</h3>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Posts</h3>
            <p class="text-3xl font-bold">{{ $totalPosts }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Toplam Kategori</h3>
            <p class="text-3xl font-bold">{{ $totalCategories }}</p>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">Recently Added Posts</h3>
    </div>
@endsection


