<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Sarana Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">Pengaduan Sarana</h1>
                    @if(auth()->user()->isSiswa())
                        <div class="ml-6 flex space-x-4">
                            <a href="{{ route('siswa.aspirasi.index') }}"
                               class="text-sm font-medium {{ request()->routeIs('siswa.aspirasi.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Aspirasi Saya
                            </a>
                            <a href="{{ route('siswa.semua-aspirasi') }}"
                               class="text-sm font-medium {{ request()->routeIs('siswa.semua-aspirasi') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Semua Aspirasi
                            </a>
                            <a href="{{ route('siswa.kritik-saran.index') }}"
                               class="text-sm font-medium {{ request()->routeIs('siswa.kritik-saran.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Kritik & Saran
                            </a>
                        </div>
                    @elseif(auth()->user()->isAdmin())
                        <div class="ml-6 flex space-x-4">
                            <a href="{{ route('admin.aspirasi.index') }}"
                               class="text-sm font-medium {{ request()->routeIs('admin.aspirasi.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Daftar Aspirasi
                            </a>
                            <a href="{{ route('admin.kritik-saran.index') }}"
                               class="text-sm font-medium {{ request()->routeIs('admin.kritik-saran.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Kritik & Saran
                            </a>
                            <a href="{{ route('admin.kategori.index') }}"
                               class="text-sm font-medium {{ request()->routeIs('admin.kategori.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Kelola Kategori
                            </a>
                        </div>
                    @endif
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                    @if(auth()->user()->isSiswa())
                        <span class="text-xs text-gray-500">NIS: {{ auth()->user()->nis ?? '-' }}</span>
                    @endif
                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                        {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
