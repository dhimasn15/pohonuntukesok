<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2D4F2B;
            --primary-light: #3a6438;
            --accent: #FFAB00;
            --accent-light: #ffc046;
        }
        .primary { color: var(--primary); }
        .bg-primary { background-color: var(--primary); }
        .bg-primary-light { background-color: var(--primary-light); }
        .accent { color: var(--accent); }
        .bg-accent { background-color: var(--accent); }
        
        /* Sidebar mobile animation */
        .sidebar-mobile {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-mobile.open {
            transform: translateX(0);
        }
        
        /* Card hover effects */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Table row animation */
        .table-row {
            transition: all 0.2s ease;
        }
        .table-row:hover {
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Admin -->
    <nav class="bg-primary shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-tree text-white text-2xl mr-3"></i>
                    <span class="text-white font-bold text-xl">PohonUntukEsok - Admin</span>
                </div>
                
                <!-- Mobile menu button -->
                <button id="mobileMenuButton" class="md:hidden text-white text-xl">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="hidden md:flex items-center space-x-4">
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

    <!-- Mobile menu overlay -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Sidebar Mobile -->
    <div id="sidebarMobile" class="sidebar-mobile fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-50 md:hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <span class="text-lg font-bold primary">Menu Admin</span>
            <button id="closeMobileMenu" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="mt-4">
            <div class="px-4 space-y-2">
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
                <a href="{{ route('admin.blog.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-blog mr-3"></i>
                    Kelola Blog
                </a>
            </div>
        </nav>
        <div class="absolute bottom-0 w-full p-4 border-t">
            <div class="text-center text-gray-600 text-sm">
                <p>Halo, {{ Auth::user()->name }}</p>
                <div class="flex justify-center space-x-4 mt-2">
                    <a href="{{ route('home') }}" class="text-primary hover:text-accent">
                        <i class="fas fa-home"></i>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-primary hover:text-accent">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex">
        <!-- Sidebar Desktop -->
        <div class="hidden md:block w-64 bg-white shadow-lg min-h-screen">
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
                    <a href="{{ route('admin.blog.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-blog mr-3"></i>
                        Kelola Blog
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-8">
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-primary">Kelola Pengguna</h1>
                <p class="text-gray-600 mt-1">Manajemen semua pengguna sistem</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Statistik Pengguna -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-users text-blue-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $users->count() }}</div>
                            <div class="text-sm md:text-base text-gray-600">Total Pengguna</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-user-tie text-green-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $users->where('role', 'admin')->count() }}</div>
                            <div class="text-sm md:text-base text-gray-600">Admin</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-seedling text-purple-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            @php
                                $farmersCount = $users->filter(function($user) {
                                    return $user->farmer !== null;
                                })->count();
                            @endphp
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $farmersCount }}</div>
                            <div class="text-sm md:text-base text-gray-600">Petani</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-user text-yellow-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $users->where('role', 'user')->count() }}</div>
                            <div class="text-sm md:text-base text-gray-600">Pengguna Biasa</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="mb-6 flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search-input" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-primary focus:border-primary" placeholder="Cari pengguna...">
                </div>
                <div class="flex space-x-2">
                    <select id="role-filter" class="block w-full sm:w-auto px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-primary focus:border-primary text-sm">
                        <option value="">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="petani">Petani</option>
                        <option value="user">Pengguna Biasa</option>
                    </select>
                    <select id="status-filter" class="block w-full sm:w-auto px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-primary focus:border-primary text-sm">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- Daftar Pengguna -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 md:px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-primary">
                        <i class="fas fa-user-friends mr-2"></i>
                        Daftar Pengguna
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Status</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Bergabung</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="table-row">
                                    <td class="px-4 md:px-6 py-4">
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
                                                <div class="text-sm text-gray-500 sm:hidden">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
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
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden md:table-cell">
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
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                        <div class="text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($user->role !== 'admin')
                                            <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                    class="toggle-status-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white {{ $user->is_active ? 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500' : 'bg-green-600 hover:bg-green-700 focus:ring-green-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors">
                                                    @if($user->is_active)
                                                        <i class="fas fa-pause mr-1"></i> <span class="hidden sm:inline">Nonaktifkan</span>
                                                    @else
                                                        <i class="fas fa-play mr-1"></i> <span class="hidden sm:inline">Aktifkan</span>
                                                    @endif
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-500">-</span>
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
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
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
                        <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed text-sm">
                            <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                            <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                            <span class="hidden sm:inline">Selanjutnya</span> <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed text-sm">
                            <span class="hidden sm:inline">Selanjutnya</span> <i class="fas fa-chevron-right ml-1"></i>
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
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const sidebarMobile = document.getElementById('sidebarMobile');
        
        function openMobileMenu() {
            sidebarMobile.classList.add('open');
            mobileMenuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenuFunc() {
            sidebarMobile.classList.remove('open');
            mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        mobileMenuButton.addEventListener('click', openMobileMenu);
        closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
        
        // Close mobile menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMobileMenuFunc();
            }
        });

        // Search and filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const roleFilter = document.getElementById('role-filter');
            const statusFilter = document.getElementById('status-filter');
            const tableRows = document.querySelectorAll('tbody tr');
            
            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const roleValue = roleFilter.value;
                const statusValue = statusFilter.value;
                
                tableRows.forEach(row => {
                    const name = row.querySelector('.text-sm.font-medium').textContent.toLowerCase();
                    const email = row.querySelector('.text-sm.text-gray-900')?.textContent.toLowerCase() || '';
                    const roleBadge = row.querySelector('td:nth-child(3) span').textContent.toLowerCase();
                    const statusBadge = row.querySelector('td:nth-child(4) span')?.textContent.toLowerCase() || '';
                    
                    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                    const matchesRole = !roleValue || 
                        (roleValue === 'admin' && roleBadge.includes('admin')) ||
                        (roleValue === 'petani' && roleBadge.includes('petani')) ||
                        (roleValue === 'user' && roleBadge.includes('pengguna'));
                    const matchesStatus = !statusValue || 
                        (statusValue === 'active' && statusBadge.includes('aktif')) ||
                        (statusValue === 'inactive' && statusBadge.includes('nonaktif'));
                    
                    if (matchesSearch && matchesRole && matchesStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            searchInput.addEventListener('input', filterUsers);
            roleFilter.addEventListener('change', filterUsers);
            statusFilter.addEventListener('change', filterUsers);
            
            // Konfirmasi sebelum mengubah status pengguna
            const toggleButtons = document.querySelectorAll('.toggle-status-btn');
            
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