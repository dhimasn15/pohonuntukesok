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
    <nav class="fixed w-full bg-primary text-white shadow-md z-50 transition-all duration-300" id="main-nav">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{route('home')}}" class="flex items-center text-2xl font-bold">
                <i class="fas fa-tree mr-2"></i>
                <span>PohonUntukEsok</span>
            </a>
            <!-- Burger Button -->
            <button id="burger-button" class="lg:hidden flex flex-col justify-center items-center w-10 h-10" aria-label="Toggle Menu">
                <span class="block w-7 h-1 bg-white rounded transition-all duration-300 mb-1"></span>
                <span class="block w-7 h-1 bg-white rounded transition-all duration-300 mb-1"></span>
                <span class="block w-7 h-1 bg-white rounded transition-all duration-300"></span>
            </button>
            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{route('home')}}" class="hover:text-accent transition-colors flex items-center">
                    <i class="fas fa-home mr-2"></i> Beranda
                </a>
                <div class="relative group">
                    <button class="hover:text-accent transition-colors flex items-center">
                        <i class="fas fa-seedling mr-2"></i> Mulai Dari Kamu
                        <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-2 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{route('buat')}}" class="block px-4 py-2 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors">
                            <i class="fas fa-plus-circle text-primary mr-2"></i>Buat Kampanye
                        </a>
                        <div class="border-t my-1"></div>
                        <a href="{{route('donasi')}}" class="block px-4 py-2 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors">
                            <i class="fas fa-hand-holding-heart text-primary mr-2"></i>Donasi Pohon
                        </a>
                        <div class="border-t my-1"></div>
                        <a href="{{route('kampanye')}}" class="block px-4 py-2 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors">
                            <i class="fas fa-list-ul text-primary mr-2"></i>Daftar Kampanye
                        </a>
                    </div>
                </div>
                <a href="{{ route('about')}}" class="hover:text-accent transition-colors flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Tentang Kami
                </a>
                <a href="{{ route('blog')}}" class="hover:text-accent transition-colors flex items-center">
                    <i class="fas fa-newspaper mr-2"></i> Blog
                </a>
                <div class="flex space-x-4 ml-8">
                    <a href="#" class="px-4 py-2 border border-white rounded-lg hover:bg-white hover:text-primary transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </a>
                    <a href="#" class="px-4 py-2 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i> Daftar
                    </a>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="fixed inset-0 bg-primary bg-opacity-95 z-40">
            <div class="container mx-auto px-4 h-full overflow-y-auto pt-20 pb-8">
                <div class="flex flex-col items-center space-y-6 text-xl font-semibold text-white">
                    <a href="{{route('home')}}" class="w-full text-center py-2 hover:text-accent transition-colors">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </a>
                    <div class="w-full">
                        <button id="mobile-dropdown-btn" class="w-full text-center py-2 flex items-center justify-center hover:text-accent transition-colors">
                            <i class="fas fa-seedling mr-2"></i> 
                            Mulai Dari Kamu 
                            <i class="fas fa-chevron-down ml-2 transition-transform duration-300"></i>
                        </button>
                        <div id="mobile-dropdown-menu" class="w-full flex flex-col items-center space-y-4 mt-4">
                            <a href="{{route('buat')}}" class="py-2 hover:text-accent transition-colors w-full text-center">
                                <i class="fas fa-plus-circle mr-2"></i>Buat Kampanye
                            </a>
                            <a href="{{route('donasi')}}" class="py-2 hover:text-accent transition-colors w-full text-center">
                                <i class="fas fa-hand-holding-heart mr-2"></i>Donasi Pohon
                            </a>
                            <a href="{{route('kampanye')}}" class="py-2 hover:text-accent transition-colors w-full text-center">
                                <i class="fas fa-list-ul mr-2"></i>Daftar Kampanye
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('about')}}" class="w-full text-center py-2 hover:text-accent transition-colors">
                        <i class="fas fa-info-circle mr-2"></i> Tentang Kami
                    </a>
                    <a href="{{ route('blog')}}" class="w-full text-center py-2 hover:text-accent transition-colors">
                        <i class="fas fa-newspaper mr-2"></i> Blog
                    </a>
                    <div class="flex flex-col sm:flex-row gap-4 w-full sm:justify-center pt-4">
                        <a href="#" class="px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-primary transition-colors text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </a>
                        <a href="#" class="px-6 py-3 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition-colors text-center">
                            <i class="fas fa-user-plus mr-2"></i> Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Campaign Card 1 -->
                <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="active" data-aos="fade-up">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1574263867128-39eaed201e1c?w=600" 
                             alt="Hutan Mangrove Bali" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="status-badge status-active">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                Aktif
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="category-badge px-3 py-1 rounded-full text-white text-xs font-semibold">
                                Mangrove
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span>30 Hari Lagi</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>Bali</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                            Hutan Mangrove Bali
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Bantu kami menanam 10.000 pohon mangrove untuk mencegah abrasi pantai dan menjaga ekosistem pesisir Bali.
                        </p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-green-700">75% Terkumpul</span>
                                <span>7,500/10,000 pohon</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span><i class="fas fa-users mr-1"></i> 1,234 Donatur</span>
                            <span><i class="fas fa-tree mr-1"></i> 7,500 Tertanam</span>
                        </div>
                        
                        <div class="mt-6 flex gap-3">
                            <a href="#" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors text-center text-sm font-semibold">
                                Donasi
                            </a>
                            <a href="#" class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-green-50 transition-colors text-center">
                                <i class="fas fa-info"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 2 -->
                <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="active" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=600" 
                             alt="Reboisasi Kalimantan" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="status-badge status-active">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                Aktif
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="category-badge px-3 py-1 rounded-full text-white text-xs font-semibold">
                                Reboisasi
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span>45 Hari Lagi</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>Kalimantan</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                            Reboisasi Lahan Kritis Kalimantan
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Dukung penanaman 5.000 pohon di lahan kritis Kalimantan untuk restorasi ekosistem dan pencegahan erosi.
                        </p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-green-700">50% Terkumpul</span>
                                <span>2,500/5,000 pohon</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 50%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span><i class="fas fa-users mr-1"></i> 876 Donatur</span>
                            <span><i class="fas fa-tree mr-1"></i> 2,500 Tertanam</span>
                        </div>
                        
                        <div class="mt-6 flex gap-3">
                            <a href="#" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors text-center text-sm font-semibold">
                                Donasi
                            </a>
                            <a href="#" class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-green-50 transition-colors text-center">
                                <i class="fas fa-info"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 3 -->
                <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="completed" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1518837695005-2083093ee35b?w=600" 
                             alt="Kebun Rakyat Jawa" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="status-badge status-completed">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                Selesai
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="category-badge px-3 py-1 rounded-full text-white text-xs font-semibold">
                                Produktif
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span>Selesai</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>Jawa Barat</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                            Kebun Rakyat Jawa Barat
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Wujudkan kebun produktif untuk masyarakat desa dengan tanaman buah yang memberikan manfaat ekonomi dan lingkungan.
                        </p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-green-700">100% Terkumpul</span>
                                <span>5,000/5,000 pohon</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span><i class="fas fa-users mr-1"></i> 543 Donatur</span>
                            <span><i class="fas fa-tree mr-1"></i> 5,000 Tertanam</span>
                        </div>
                        
                        <div class="mt-6">
                            <button class="w-full px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold cursor-not-allowed" disabled>
                                Kampanye Selesai
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 4 -->
                <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="active" data-aos="fade-up">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600" 
                             alt="Penghijauan Kota" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="status-badge status-active">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                Aktif
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="category-badge px-3 py-1 rounded-full text-white text-xs font-semibold">
                                Perkotaan
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span>60 Hari Lagi</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>Jakarta</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                            Penghijauan Ibu Kota
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Program penghijauan area perkotaan dengan penanaman 3.000 pohon peneduh untuk meningkatkan kualitas udara.
                        </p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-green-700">30% Terkumpul</span>
                                <span>900/3,000 pohon</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 30%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span><i class="fas fa-users mr-1"></i> 321 Donatur</span>
                            <span><i class="fas fa-tree mr-1"></i> 900 Tertanam</span>
                        </div>
                        
                        <div class="mt-6 flex gap-3">
                            <a href="#" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors text-center text-sm font-semibold">
                                Donasi
                            </a>
                            <a href="#" class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-green-50 transition-colors text-center">
                                <i class="fas fa-info"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 5 -->
                <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="upcoming" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1464822759844-d2dd4c82b8e9?w=600" 
                             alt="Konservasi Hutan Sumatra" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="status-badge status-upcoming">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                Akan Datang
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="category-badge px-3 py-1 rounded-full text-white text-xs font-semibold">
                                Konservasi
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span>Mulai 15 Des 2023</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>Sumatra</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                            Konservasi Hutan Sumatra
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Program konservasi hutan hujan tropis Sumatra dengan penanaman 8.000 pohon endemik untuk melestarikan habitat orangutan.
                        </p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-yellow-600">0% Terkumpul</span>
                                <span>0/8,000 pohon</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span><i class="fas fa-users mr-1"></i> 0 Donatur</span>
                            <span><i class="fas fa-tree mr-1"></i> 0 Tertanam</span>
                        </div>
                        
                        <div class="mt-6">
                            <button class="w-full px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold cursor-not-allowed" disabled>
                                Segera Hadir
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 6 -->
                <div class="campaign-card bg-white rounded-2xl shadow-lg overflow-hidden" data-status="completed" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1500534623283-312aade485b7?w=600" 
                             alt="Bakau Sulawesi" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="status-badge status-completed">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                Selesai
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="category-badge px-3 py-1 rounded-full text-white text-xs font-semibold">
                                Bakau
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span>Selesai</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>Sulawesi</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                            Rehabilitasi Bakau Sulawesi
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Sukses menanam 15.000 bibit bakau untuk melindungi garis pantai dan ekosistem laut di pesisir Sulawesi.
                        </p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-green-700">100% Terkumpul</span>
                                <span>15,000/15,000 pohon</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span><i class="fas fa-users mr-1"></i> 2,156 Donatur</span>
                            <span><i class="fas fa-tree mr-1"></i> 15,000 Tertanam</span>
                        </div>
                        
                        <div class="mt-6">
                            <button class="w-full px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold cursor-not-allowed" disabled>
                                Kampanye Selesai
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12" data-aos="fade-up">
                <button class="px-8 py-3 bg-white text-primary font-semibold rounded-lg border-2 border-primary hover:bg-primary hover:text-white transition-all duration-300">
                    <i class="fas fa-redo mr-2"></i>
                    Muat Lebih Banyak Kampanye
                </button>
            </div>
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