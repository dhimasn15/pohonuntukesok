<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kampanye - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
            overflow: hidden;
        }

        .card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(45, 79, 43, 0.15);
        }

        .category-badge {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            box-shadow: 0 4px 15px rgba(45, 79, 43, 0.3);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .shape:nth-child(1) { left: 10%; animation-delay: 0s; }
        .shape:nth-child(2) { left: 30%; animation-delay: -3s; }
        .shape:nth-child(3) { left: 50%; animation-delay: -6s; }
        .shape:nth-child(4) { left: 70%; animation-delay: -9s; }
        .shape:nth-child(5) { left: 90%; animation-delay: -12s; }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background: #e5e7eb;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #81C784, #2D4F2B);
            transition: width 0.5s ease;
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
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50">
    <!-- Navigation -->
    <!-- Include Navigation -->
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
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if(session('success'))
                <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" data-aos="fade-up">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($campaigns as $campaign)
                <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="{{ $campaign->status }}" data-aos="fade-up">
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
                            <span class="category-badge px-3 py-1 rounded-full text-white text-xs font-semibold">
                                {{ ucfirst($campaign->category) }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span>{{ $campaign->days_left }} Hari Lagi</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>{{ $campaign->location }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                            {{ $campaign->title }}
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            {{ Str::limit($campaign->description, 120) }}
                        </p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-green-700">{{ $campaign->progress_percentage }}% Terkumpul</span>
                                <span>{{ number_format($campaign->current_trees) }}/{{ number_format($campaign->target_trees) }} pohon</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $campaign->progress_percentage }}%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span><i class="fas fa-users mr-1"></i> {{ number_format($campaign->total_donors) }} Donatur</span>
                            <span><i class="fas fa-tree mr-1"></i> {{ number_format($campaign->current_trees) }} Tertanam</span>
                        </div>
                        
                        <div class="mt-6 flex gap-3">
                            @if($campaign->status === 'active')
                                <a href="{{ route('kampanye.show', $campaign) }}" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors text-center text-sm font-semibold">
                                    Donasi
                                </a>
                                <a href="{{ route('kampanye.show', $campaign) }}" class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-green-50 transition-colors text-center">
                                    <i class="fas fa-info"></i>
                                </a>
                            @else
                                <button class="w-full px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold cursor-not-allowed" disabled>
                                    {{ $campaign->status === 'completed' ? 'Kampanye Selesai' : 'Segera Hadir' }}
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
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- About -->
                <div>
                    <div class="flex items-center text-2xl font-bold mb-4">
                        <i class="fas fa-tree mr-2"></i>
                        <span>PohonUntukEsok</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Platform donasi pohon untuk menghijaukan Indonesia. Bersama kita bisa menciptakan perubahan
                        untuk masa depan yang lebih baik.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{route('home')}}" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Beranda</a></li>
                        <li><a href="{{ route('about')}}" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Tentang Kami</a></li>
                        <li><a href="{{route('kampanye')}}" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Kampanye</a></li>
                        <li><a href="{{ route('blog')}}" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> FAQ</a></li>
                    </ul>
                </div>

                <!-- Programs -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Program Kami</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{route('donasi')}}" class="group flex items-center text-gray-400 hover:text-accent transition-colors">
                                <span class="w-8 h-8 mr-3 flex items-center justify-center bg-primary/20 rounded-lg group-hover:bg-accent/20 transition-colors">
                                    <i class="fas fa-seedling"></i>
                                </span>
                                Donasi Pohon
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group flex items-center text-gray-400 hover:text-accent transition-colors">
                                <span class="w-8 h-8 mr-3 flex items-center justify-center bg-primary/20 rounded-lg group-hover:bg-accent/20 transition-colors">
                                    <i class="fas fa-hands-helping"></i>
                                </span>
                                Relawan
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group flex items-center text-gray-400 hover:text-accent transition-colors">
                                <span class="w-8 h-8 mr-3 flex items-center justify-center bg-primary/20 rounded-lg group-hover:bg-accent/20 transition-colors">
                                    <i class="fas fa-book-reader"></i>
                                </span>
                                Edukasi Lingkungan
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-accent mt-1 mr-3"></i>
                            <span class="text-gray-400">Jl. Hijau Lestari No. 42, Jakarta Selatan, Indonesia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-accent mr-3"></i>
                            <span class="text-gray-400">+62 21 1234 5678</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-accent mr-3"></i>
                            <span class="text-gray-400">info@pohonuntukesok.org</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">
                        &copy; 2023 PohonUntukEsok. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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
    </script>
</body>
</html>