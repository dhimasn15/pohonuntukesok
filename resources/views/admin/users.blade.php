<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .primary { color: #2D4F2B; }
        .bg-primary { background-color: #2D4F2B; }
        .accent { color: #FFAB00; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Admin -->
    <nav class="bg-primary shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-tree text-white text-2xl mr-3"></i>
                    <span class="text-white font-bold text-xl">PohonUntukEsok - Admin</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white">Halo, {{ Auth::user()->name }}</span>
                    <a href="{{ route('home') }}" class="text-white hover:text-accent transition-colors">
                        <i class="fas fa-home mr-1"></i> Site
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-accent transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <nav class="mt-6">
                <div class="px-6 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.petani') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-users mr-3"></i>
                        Kelola Petani
                    </a>
                    <a href="{{ route('admin.users') }}" 
                       class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
                        <i class="fas fa-user-friends mr-3"></i>
                        Kelola User
                    </a>
                    <a href="{{ route('admin.kampanye') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-seedling mr-3"></i>
                        Kelola Kampanye
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-primary">Kelola Pengguna</h1>
                <p class="text-gray-600">Manajemen semua pengguna sistem</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Statistik Pengguna -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ $users->count() }}</div>
                            <div class="text-gray-600">Total Pengguna</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-user-tie text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ $users->where('role', 'admin')->count() }}</div>
                            <div class="text-gray-600">Admin</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-seedling text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            @php
                                $farmersCount = $users->filter(function($user) {
                                    return $user->farmer !== null;
                                })->count();
                            @endphp
                            <div class="text-2xl font-bold text-gray-900">{{ $farmersCount }}</div>
                            <div class="text-gray-600">Petani</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-user text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ $users->where('role', 'user')->count() }}</div>
                            <div class="text-gray-600">Pengguna Biasa</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Pengguna -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-primary">
                        <i class="fas fa-user-friends mr-2"></i>
                        Daftar Pengguna
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-semibold">
                                                @if($user->avatar && filter_var($user->avatar, FILTER_VALIDATE_URL))
                                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full">
                                                @else
                                                    {{ substr($user->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->role === 'admin')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-crown mr-1"></i> Admin
                                            </span>
                                        @elseif($user->farmer)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-seedling mr-1"></i> Petani
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-user mr-1"></i> Pengguna
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($user->role !== 'admin')
                                            <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white {{ $user->is_active ? 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500' : 'bg-green-600 hover:bg-green-700 focus:ring-green-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors">
                                                    @if($user->is_active)
                                                        <i class="fas fa-pause mr-1"></i> Nonaktifkan
                                                    @else
                                                        <i class="fas fa-play mr-1"></i> Aktifkan
                                                    @endif
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-500">Tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    @if($users->total() > 0)
                        Menampilkan {{ $users->firstItem() }} hingga {{ $users->lastItem() }} dari {{ $users->total() }} hasil
                    @else
                        Tidak ada data yang ditemukan
                    @endif
                </div>
                <div class="flex space-x-2">
                    {{-- Previous Page Link --}}
                    @if($users->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                            Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                        </span>
                    @endif
                </div>
            </div>
            @else
                @if($users->count() > 0)
                <div class="mt-6 text-sm text-gray-700">
                    Menampilkan semua {{ $users->count() }} pengguna
                </div>
                @endif
            @endif
        </div>
    </div>

    <script>
        // Konfirmasi sebelum mengubah status pengguna
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('form button[type="submit"]');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const userRow = this.closest('tr');
                    const userName = userRow.querySelector('.text-sm.font-medium').textContent;
                    const action = this.textContent.trim();
                    
                    if (!confirm(`Apakah Anda yakin ingin ${action.toLowerCase()} pengguna "${userName}"?`)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>