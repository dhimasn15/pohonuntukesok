<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kampanye - PohonUntukEsok</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-tittle.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-tittle.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Responsive Fix CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive-fix.css') }}">
    <script>
        tailwind.config = { 
            theme: {
                extend: {
                    colors: {
                        primary: '#2D4F2B',
                        secondary: '#81C784',
                        accent: '#FFAB00',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }

        .card-modern {
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
            white-space: nowrap;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .shape:nth-child(1) { left: max(5%, -50px); animation-delay: 0s; }
        .shape:nth-child(2) { left: max(20%, -50px); animation-delay: -3s; }
        .shape:nth-child(3) { left: max(35%, -50px); animation-delay: -6s; }
        .shape:nth-child(4) { left: max(50%, -50px); animation-delay: -9s; }
        .shape:nth-child(5) { left: max(65%, -50px); animation-delay: -12s; }
        
        @media (max-width: 768px) {
            .shape {
                display: none;
            }
        }

        /* Tambahkan di bagian CSS */
.progress-animated {
    transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.progress-animated::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Animasi untuk update realtime */
@keyframes pulseUpdate {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.updated {
    animation: pulseUpdate 0.5s ease-in-out;
}

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-completed {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-upcoming {
            background: #fef3c7;
            color: #92400e;
        }

        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background: #2D4F2B;
            color: white;
        }

        .campaign-card {
            transition: all 0.3s ease;
        }

        .campaign-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Mobile Menu Styles */
        #mobile-menu {
            transform: translateY(-100%);
            transition: all 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
        }

        #mobile-menu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        #mobile-dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        #mobile-dropdown-menu.show {
            max-height: 300px;
        }

        /* Burger Button Animation */
        #burger-button span {
            transition: all 0.3s ease-in-out;
        }

        #burger-button.active span:first-child {
            transform: translateY(8px) rotate(45deg);
        }

        #burger-button.active span:nth-child(2) {
            opacity: 0;
        }

        #burger-button.active span:last-child {
            transform: translateY(-8px) rotate(-45deg);
        }

        .search-modern {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .search-modern:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #FFAB00;
        }

        /* New Styles for Better Card Layout */
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        .category-badge {
            background: linear-gradient(135deg, #81C784, #2D4F2B);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .enhanced-glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Progress bar styles */
        .progress-bar {
            width: 100%;
            height: 10px;
            background: linear-gradient(90deg, rgba(16,185,129,0.12), rgba(34,197,94,0.06));
            border-radius: 999px;
            overflow: hidden;
            border: 1px solid rgba(34,197,94,0.08);
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #34D399, #059669);
            border-radius: 999px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: inset 0 -2px 6px rgba(0,0,0,0.08);
        }

        .progress-fill.updated {
            transform: scaleY(1.02);
            transition: transform 0.25s ease;
        }
    </style>
    <!-- CSRF untuk fetch/ajax -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50">
    <!-- Navigation -->
    @include('layouts.navigation')
    
    <!-- Include Auth Modal -->
    @include('components.auth-modal')

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 hero-gradient overflow-hidden">
        <div class="floating-shapes">
            <i class="shape fas fa-leaf text-white text-6xl"></i>
            <i class="shape fas fa-seedling text-white text-5xl"></i>
            <i class="shape fas fa-tree text-white text-7xl"></i>
            <i class="shape fas fa-leaf text-white text-4xl"></i>
            <i class="shape fas fa-seedling text-white text-6xl"></i>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                    <i class="fas fa-list-ul text-accent"></i>
                    <span class="text-white font-semibold">Semua Kampanye Penanaman Pohon</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Daftar Kampanye
                    <span class="block text-accent">Penanaman Pohon</span>
                </h1>
                
                <p class="text-xl text-white/90 mb-12 leading-relaxed">
                    Telusuri semua kampanye penanaman pohon yang sedang berlangsung dan telah selesai. 
                    Temukan kampanye yang sesuai dengan passion Anda untuk berkontribusi.
                </p>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari kampanye penanaman pohon..." 
                               class="search-modern w-full px-6 py-4 rounded-2xl text-gray-800 placeholder-gray-500 focus:outline-none text-lg">
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 bg-gradient-to-r from-primary to-green-700 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="url(#paint0_linear)" fill-opacity="0.2"/>
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f9fafb"/>
                <defs>
                    <linearGradient id="paint0_linear" x1="720" y1="30" x2="720" y2="120" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white" stop-opacity="0.3"/>
                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </section>

    <!-- Campaign Filters -->
    <section class="py-8 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                <div class="flex flex-wrap gap-2">
                    <button class="filter-btn active px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold" data-filter="all">
                        Semua Kampanye
                    </button>
                    <button class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200" data-filter="active">
                        Sedang Berlangsung
                    </button>
                    <button class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200" data-filter="completed">
                        Selesai
                    </button>
                    <button class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200" data-filter="upcoming">
                        Akan Datang
                    </button>
                </div>
                
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm">
                        <option>Urutkan Terbaru</option>
                        <option>Urutkan Terlama</option>
                        <option>Paling Banyak Donasi</option>
                        <option>Deadline Terdekat</option>
                    </select>
                    
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">24</span> dari <span class="font-semibold">56</span> kampanye
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campaign List -->
    <!-- Campaign List Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" data-aos="fade-up">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($campaigns as $campaign)
            <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="{{ $campaign->status }}" data-aos="fade-up" data-campaign-id="{{ $campaign->id }}">
                <div class="relative h-48">
                    @if($campaign->image)
                        <img src="{{ asset('storage/' . $campaign->image) }}" 
                             alt="{{ $campaign->title }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                            <i class="fas fa-tree text-6xl text-green-300"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="status-badge status-{{ $campaign->status }}">
                            <i class="fas fa-circle mr-1 text-xs"></i>
                            {{ $campaign->status_badge['text'] }}
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="category-badge">
                            {{ ucfirst($campaign->category) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Judul Kampanye -->
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors line-clamp-1">
                        {{ $campaign->title }}
                    </h3>
                    
                    <!-- Deskripsi -->
                    <p class="text-gray-600 mb-4 text-sm line-clamp-2">
                        {{ Str::limit($campaign->description, 120) }}
                    </p>
                    
                    <!-- Info Waktu dan Lokasi -->
                    <div class="flex flex-col gap-1 mb-4">
                        <!-- Waktu Tersisa -->
                        <div class="flex items-center text-gray-600 text-xs">
                            <i class="fas fa-clock mr-2 text-gray-400 text-xs"></i>
                            <span class="font-medium">
                                @php
                                    // Format days_left untuk menghilangkan desimal
                                    $days_left = is_numeric($campaign->days_left) ? max(0, floor($campaign->days_left)) : 0;
                                @endphp
                                {{ $days_left }}
                                <span class="font-normal">Hari Lagi</span>
                            </span>
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="flex items-start text-gray-600 text-xs">
                            <i class="fas fa-map-marker-alt mr-2 mt-0.5 text-gray-400 text-xs"></i>
                            <span class="line-clamp-2 leading-tight">
                                {{ $campaign->location }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Progress Bar Real-Time -->
                    @php
                        // Hitung total donasi dari database (tidak memfilter status agar konsisten dengan kampanye-detail)
                        $totalDonations = DB::table('donations')
                            ->where('campaign_id', $campaign->id)
                            ->sum('amount');

                        // Harga per pohon (fallback)
                        $treePrice = $campaign->tree_price ?? 100000;

                        // Hitung target funding
                        $fundingGoal = ($campaign->target_trees ?? 0) * $treePrice;

                        // Hitung persentase progress (2 desimal untuk presisi)
                        $progressPercentage = $fundingGoal > 0 ? min(100, round(($totalDonations / $fundingGoal) * 100, 2)) : 0;

                        // Fungsi format Rupiah (jaga agar tidak redeclare)
                        if (!function_exists('formatRupiah')) {
                            function formatRupiah($amount) {
                                return 'Rp ' . number_format($amount, 0, ',', '.');
                            }
                        }

                        // Hitung jumlah pohon berdasarkan donasi
                        $calculatedCurrentTrees = $treePrice > 0 ? floor($totalDonations / $treePrice) : 0;

                        // Hitung jumlah donatur (distinct user_id, tanpa filter status)
                        $totalDonors = DB::table('donations')
                            ->where('campaign_id', $campaign->id)
                            ->distinct('user_id')
                            ->count('user_id');
                    @endphp

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span id="progressPercentage-{{ $campaign->id }}" class="font-bold text-green-700">
                                {{ $progressPercentage }}% Terkumpul
                            </span>
                            <span id="progressAmount-{{ $campaign->id }}" class="text-gray-600">
                                {{ formatRupiah($totalDonations) }} / {{ formatRupiah($fundingGoal) }}
                            </span>
                        </div>
                        
                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $progressPercentage }}">
                            <div id="progressBar-{{ $campaign->id }}" 
                                 class="progress-fill progress-animated" 
                                 style="width: {{ $progressPercentage }}%;"
                                 data-percentage="{{ $progressPercentage }}">
                            </div>
                        </div>
                        
                        <div class="mt-2 text-xs text-gray-600 flex justify-between">
                            <span>
                                <span id="currentTrees-{{ $campaign->id }}">{{ number_format($calculatedCurrentTrees) }} pohon terkumpul</span> 
                            </span>
                            <span>
                                Target: 
                                <span id="targetTrees-{{ $campaign->id }}">{{ number_format($campaign->target_trees ?? 0) }}</span> 
                                pohon
                            </span>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="flex justify-between items-center text-xs text-gray-500 mt-2">
                        <span>
                            <i class="fas fa-users mr-1 text-gray-400"></i> 
                            <span id="totalDonors-{{ $campaign->id }}">
                                {{ number_format($totalDonors) }}
                            </span> 
                            Donatur
                        </span>
                        <span>
                            <i class="fas fa-tree mr-1 text-gray-400"></i> 
                            <span id="plantedTrees-{{ $campaign->id }}">
                                {{ number_format($calculatedCurrentTrees) }}
                            </span> 
                            Tertanam
                        </span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-6 flex gap-3">
                        @if($campaign->status === 'active')
                            <a href="{{ route('kampanye.show', $campaign) }}" 
                               class="flex-1 px-4 py-3 bg-gradient-to-r from-primary to-green-700 text-white rounded-lg hover:shadow-md transition-all text-center text-sm font-semibold flex items-center justify-center">
                                <i class="fas fa-donate mr-2"></i> Donasi Sekarang
                            </a>
                            <a href="{{ route('kampanye.show', $campaign) }}" 
                               class="px-4 py-3 border border-primary text-primary rounded-lg hover:bg-green-50 transition-colors text-center flex items-center justify-center">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        @else
                            <button class="w-full px-4 py-3 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold cursor-not-allowed" disabled>
                                @if($campaign->status === 'completed')
                                    <i class="fas fa-check-circle mr-2"></i> Kampanye Selesai
                                @else
                                    <i class="fas fa-clock mr-2"></i> Segera Hadir
                                @endif
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            @if($campaigns->isEmpty())
            <div class="col-span-full text-center py-12" data-aos="fade-up">
                <i class="fas fa-tree text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum ada kampanye</h3>
                <p class="text-gray-500 mb-6">Jadilah yang pertama membuat kampanye penanaman pohon!</p>
                <a href="{{ route('buat') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors">
                    Buat Kampanye Pertama
                </a>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($campaigns->hasPages())
        <div class="mt-12 flex justify-center" data-aos="fade-up">
            <div class="flex space-x-2">
                @if($campaigns->onFirstPage())
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $campaigns->previousPageUrl() }}" class="px-4 py-2 bg-white text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                @foreach($campaigns->getUrlRange(1, $campaigns->lastPage()) as $page => $url)
                    @if($page == $campaigns->currentPage())
                        <span class="px-4 py-2 bg-primary text-white rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-white text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors">{{ $page }}</a>
                    @endif
                @endforeach

                @if($campaigns->hasMorePages())
                    <a href="{{ $campaigns->nextPageUrl() }}" class="px-4 py-2 bg-white text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>

    <!-- Stats Section -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="enhanced-glass rounded-2xl p-6 text-center" data-aos="zoom-in">
                    <div class="text-3xl md:text-4xl font-bold text-accent mb-2">56</div>
                    <div class="text-lg">Total Kampanye</div>
                </div>
                <div class="enhanced-glass rounded-2xl p-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="text-3xl md:text-4xl font-bold text-accent mb-2">24</div>
                    <div class="text-lg">Sedang Berlangsung</div>
                </div>
                <div class="enhanced-glass rounded-2xl p-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="text-3xl md:text-4xl font-bold text-accent mb-2">28</div>
                    <div class="text-lg">Selesai</div>
                </div>
                <div class="enhanced-glass rounded-2xl p-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="text-3xl md:text-4xl font-bold text-accent mb-2">4</div>
                    <div class="text-lg">Akan Datang</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-green-50 to-emerald-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary mb-6">Ingin Membuat Kampanye Anda Sendiri?</h2>
                <p class="text-xl text-gray-600 mb-8">
                    Bergabunglah dengan komunitas kami dan mulai kampanye penanaman pohon untuk membuat dampak positif bagi lingkungan.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{route('buat')}}" 
                       class="px-8 py-4 bg-primary text-white font-semibold rounded-xl hover:bg-green-700 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-plus-circle mr-3"></i> Buat Kampanye Baru
                    </a>
                    <a href="{{route('donasi')}}" 
                       class="px-8 py-4 border-2 border-primary text-primary font-semibold rounded-xl hover:bg-primary hover:text-white transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-hand-holding-heart mr-3"></i> Donasi ke Kampanye
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true,
            offset: 50
        });

        // Mobile Menu Functionality
        const burgerButton = document.getElementById('burger-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
        const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');

        // Toggle mobile menu
        function toggleMobileMenu() {
            const isActive = mobileMenu.classList.contains('active');
            
            mobileMenu.classList.toggle('active');
            burgerButton.classList.toggle('active');
            
            document.body.style.overflow = isActive ? '' : 'hidden';
            
            if (!mobileMenu.classList.contains('active')) {
                mobileDropdownMenu.classList.remove('show');
            }
        }

        // Toggle mobile dropdown menu
        function toggleMobileDropdown() {
            mobileDropdownMenu.classList.toggle('show');
        }

        // Event Listeners
        if (burgerButton) {
            burgerButton.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        if (mobileDropdownBtn) {
            mobileDropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleMobileDropdown();
            });
        }

        // Close mobile menu when clicking on a link
        const mobileLinks = document.querySelectorAll('#mobile-menu a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                burgerButton.classList.remove('active');
                mobileDropdownMenu.classList.remove('show');
                document.body.style.overflow = '';
            });
        });

        // Campaign Filter Functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const campaignCards = document.querySelectorAll('.campaign-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                
                campaignCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        if (card.getAttribute('data-status') === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-modern');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                campaignCards.forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();
                    const location = card.querySelector('.fa-map-marker-alt').parentElement.textContent.toLowerCase();
                    
                    if (title.includes(searchTerm) || description.includes(searchTerm) || location.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar scroll effect
        let lastScroll = 0;
        const navbar = document.getElementById('main-nav');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll <= 0) {
                navbar.classList.remove('shadow-lg');
            } else {
                navbar.classList.add('shadow-lg');
            }

            lastScroll = currentScroll;
        });


        // Tambahkan di bagian JavaScript sebelum penutup  
// Real-time progress update with WebSocket/Polling
class CampaignProgressUpdater {
    constructor() {
        this.campaigns = [];
        this.pollingInterval = 30000; // 30 detik
        this.initialize();
    }

    initialize() {
        // Kumpulkan semua campaign yang ada di halaman
        document.querySelectorAll('[data-campaign-id]').forEach(card => {
            const campaignId = card.getAttribute('data-campaign-id');
            this.campaigns.push(campaignId);
        });

        if (this.campaigns.length > 0) {
            this.startPolling();
            this.setupEventListeners();
        }
    }

    setupEventListeners() {
        // Update progress ketika ada interaksi donasi di halaman yang sama
        document.addEventListener('donationSuccess', (event) => {
            if (event.detail && event.detail.campaignId) {
                this.updateCampaignProgress(event.detail.campaignId);
            }
        });

        // Juga update progress secara manual jika diperlukan
        const donationButtons = document.querySelectorAll('[href*="kampanye"]');
        donationButtons.forEach(button => {
            button.addEventListener('click', () => {
                const url = button.getAttribute('href');
                const campaignId = this.extractCampaignIdFromUrl(url);
                if (campaignId) {
                    // Simulasikan update setelah donasi
                    setTimeout(() => {
                        this.updateCampaignProgress(campaignId);
                    }, 2000);
                }
            });
        });
    }

    extractCampaignIdFromUrl(url) {
        const match = url.match(/kampanye\/(\d+)/);
        return match ? match[1] : null;
    }

    startPolling() {
        // Polling untuk update real-time
        setInterval(() => {
            this.updateAllCampaignsProgress();
        }, this.pollingInterval);

        // Update pertama saat halaman dimuat
        setTimeout(() => {
            this.updateAllCampaignsProgress();
        }, 5000);
    }

    async updateAllCampaignsProgress() {
        try {
            const response = await fetch('/api/campaigns/progress', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    campaign_ids: this.campaigns
                })
            });

            if (response.ok) {
                const data = await response.json();
                this.updateProgressData(data);
            }
        } catch (error) {
            console.error('Error updating progress:', error);
        }
    }

    async updateCampaignProgress(campaignId) {
        try {
            const response = await fetch(`/api/campaigns/${campaignId}/progress`);
            if (response.ok) {
                const data = await response.json();
                this.updateSingleCampaign(campaignId, data);
            }
        } catch (error) {
            console.error('Error updating campaign progress:', error);
        }
    }

    updateProgressData(data) {
        data.forEach(campaign => {
            this.updateSingleCampaign(campaign.id, campaign);
        });
    }

    updateSingleCampaign(campaignId, campaignData) {
        const elements = {
            percentage: document.getElementById(`progressPercentage-${campaignId}`),
            amount: document.getElementById(`progressAmount-${campaignId}`),
            bar: document.getElementById(`progressBar-${campaignId}`),
            trees: document.getElementById(`currentTrees-${campaignId}`),
            target: document.getElementById(`targetTrees-${campaignId}`),
            donors: document.getElementById(`totalDonors-${campaignId}`),
            planted: document.getElementById(`plantedTrees-${campaignId}`)
        };

        // Animate progress bar
        if (elements.bar) {
            const currentWidth = parseFloat(elements.bar.style.width) || 0;
            const newWidth = campaignData.progress_percentage;
            
            // Animate width change
            elements.bar.style.width = `${newWidth}%`;
            elements.bar.setAttribute('data-percentage', newWidth);
            
            // Add pulse animation
            elements.bar.classList.add('updated');
            setTimeout(() => {
                elements.bar.classList.remove('updated');
            }, 500);
        }

        // Update text with animation
        this.animateValueChange(elements.percentage, `${campaignData.progress_percentage}% Terkumpul`);
        this.animateValueChange(elements.amount, `${campaignData.formatted_amount} / ${campaignData.formatted_goal}`);
        this.animateValueChange(elements.trees, campaignData.current_trees_formatted);
        this.animateValueChange(elements.planted, campaignData.current_trees_formatted);
        this.animateValueChange(elements.donors, campaignData.total_donors_formatted);
    }

    animateValueChange(element, newValue) {
        if (element && element.textContent !== newValue) {
            element.classList.add('updated');
            element.textContent = newValue;
            setTimeout(() => {
                element.classList.remove('updated');
            }, 500);
        }
    }
}

// Inisialisasi ketika halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    new CampaignProgressUpdater();
});

// Event dispatcher untuk donasi sukses (dipanggil dari halaman donasi)
function triggerDonationSuccess(campaignId, amount) {
    const event = new CustomEvent('donationSuccess', {
        detail: { campaignId, amount }
    });
    document.dispatchEvent(event);
}

// Format Rupiah helper
function formatRupiah(amount) {
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
} 
    </script>
</body>
</html>