<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kampanye - PohonUntukEsok</title>
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
        
        /* Progress bar animation */
        .progress-bar {
            transition: width 0.5s ease-in-out;
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
                   class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-user-friends mr-3"></i>
                    Kelola User
                </a>
                <a href="{{ route('admin.kampanye') }}" 
                   class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
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
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-user-friends mr-3"></i>
                        Kelola User
                    </a>
                    <a href="{{ route('admin.kampanye') }}" 
                       class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
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
                <h1 class="text-2xl md:text-3xl font-bold text-primary">Kelola Kampanye</h1>
                <p class="text-gray-600 mt-1">Manajemen kampanye penanaman pohon</p>
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

            <!-- Statistik Kampanye -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-seedling text-blue-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $campaigns->count() }}</div>
                            <div class="text-sm md:text-base text-gray-600">Total Kampanye</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-play-circle text-green-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $campaigns->where('status', 'active')->count() }}</div>
                            <div class="text-sm md:text-base text-gray-600">Kampanye Aktif</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-clock text-yellow-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $campaigns->where('status', 'pending')->count() }}</div>
                            <div class="text-sm md:text-base text-gray-600">Menunggu</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md card-hover p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-check-circle text-purple-600 text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl md:text-2xl font-bold text-gray-900">{{ $campaigns->where('status', 'completed')->count() }}</div>
                            <div class="text-sm md:text-base text-gray-600">Selesai</div>
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
                    <input type="text" id="search-input" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-primary focus:border-primary" placeholder="Cari kampanye...">
                </div>
                <div class="flex space-x-2">
                    <select id="status-filter" class="block w-full sm:w-auto px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-primary focus:border-primary text-sm">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="pending">Menunggu</option>
                        <option value="completed">Selesai</option>
                    </select>
                </div>
            </div>

            <!-- Daftar Kampanye -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 md:px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-primary">
                        <i class="fas fa-seedling mr-2"></i>
                        Daftar Kampanye
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kampanye</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Pembuat</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Target</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden xl:table-cell">Dibuat</th>
                                <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($campaigns as $campaign)
                                <tr class="table-row">
                                    <td class="px-4 md:px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-primary text-white rounded-lg flex items-center justify-center">
                                                <i class="fas fa-seedling"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 max-w-xs truncate">{{ $campaign->title }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $campaign->id }}</div>
                                                <div class="text-sm text-gray-500 lg:hidden">Oleh: {{ $campaign->user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                        <div class="text-sm text-gray-900">{{ $campaign->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $campaign->user->email }}</div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                        <div class="text-sm font-medium text-gray-900">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</div>
                                        @php
                                            $percentage = $campaign->target_amount > 0 ? min(100, ($campaign->current_amount / $campaign->target_amount) * 100) : 0;
                                        @endphp
                                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                            <div class="bg-green-600 h-2 rounded-full progress-bar" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">{{ number_format($percentage, 1) }}%</div>
                                        <div class="text-xs text-gray-500 md:hidden">Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                        @if($campaign->status === 'active')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-play-circle mr-1"></i> Aktif
                                            </span>
                                        @elseif($campaign->status === 'completed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-check-circle mr-1"></i> Selesai
                                            </span>
                                        @elseif($campaign->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> Menunggu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden xl:table-cell">
                                        <div class="text-sm text-gray-900">{{ $campaign->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $campaign->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex flex-col sm:flex-row space-y-1 sm:space-y-0 sm:space-x-1">
                                            <a href="{{ route('kampanye.show', $campaign->id) }}" 
                                               class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-primary hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                                <i class="fas fa-eye mr-1"></i> <span class="hidden sm:inline">Detail</span>
                                            </a>
                                            @if($campaign->status === 'pending')
                                            <form action="{{ route('admin.kampanye.approve', $campaign->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                    class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                    <i class="fas fa-check mr-1"></i> <span class="hidden sm:inline">Setujui</span>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($campaigns instanceof \Illuminate\Pagination\LengthAwarePaginator && $campaigns->hasPages())
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                <div class="text-sm text-gray-700">
                    @if($campaigns->total() > 0)
                        Menampilkan {{ $campaigns->firstItem() }} hingga {{ $campaigns->lastItem() }} dari {{ $campaigns->total() }} hasil
                    @else
                        Tidak ada data yang ditemukan
                    @endif
                </div>
                <div class="flex space-x-2">
                    {{-- Previous Page Link --}}
                    @if($campaigns->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed text-sm">
                            <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $campaigns->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                            <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($campaigns->hasMorePages())
                        <a href="{{ $campaigns->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
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
                @if($campaigns->count() > 0)
                <div class="mt-6 text-sm text-gray-700">
                    Menampilkan semua {{ $campaigns->count() }} kampanye
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
            const statusFilter = document.getElementById('status-filter');
            const tableRows = document.querySelectorAll('tbody tr');
            
            function filterCampaigns() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                
                tableRows.forEach(row => {
                    const title = row.querySelector('.text-sm.font-medium').textContent.toLowerCase();
                    const creator = row.querySelector('.text-sm.text-gray-900')?.textContent.toLowerCase() || '';
                    const statusBadge = row.querySelector('td:nth-child(5) span').textContent.toLowerCase();
                    
                    const matchesSearch = title.includes(searchTerm) || creator.includes(searchTerm);
                    const matchesStatus = !statusValue || 
                        (statusValue === 'active' && statusBadge.includes('aktif')) ||
                        (statusValue === 'pending' && statusBadge.includes('menunggu')) ||
                        (statusValue === 'completed' && statusBadge.includes('selesai'));
                    
                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            searchInput.addEventListener('input', filterCampaigns);
            statusFilter.addEventListener('change', filterCampaigns);
            
            // Animate progress bars on page load
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>
</body>
</html>