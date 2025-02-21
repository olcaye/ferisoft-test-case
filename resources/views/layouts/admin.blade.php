<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Laravel Breeze Tailwind --}}
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 text-white py-4 px-6 flex justify-between items-center">
        <a href="{{ route('admin.dashboard') }}" class="text-lg font-semibold">Admin Paneli</a>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-sm hover:underline">Kullanıcı Paneli</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 px-3 py-1 rounded text-sm">Çıkış Yap</button>
            </form>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen p-5">
            <h3 class="text-lg font-semibold mb-4">Menü</h3>
            <ul class="space-y-3">
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a></li>
                 <li><a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Kategoriler</a></li>
                <li><a href="{{ route('admin.posts.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Blog Yazıları</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
