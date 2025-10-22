<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - PohonUntukEsok | Artikel & Berita Lingkungan</title>
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

        /* Mobile Menu Styles */
        #mobile-menu {
            transform: translateY(-100%);
            transition: all 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
            height: 100vh;
            overflow-y: auto;
        }

        #mobile-menu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        /* Mobile Dropdown Menu */
        #mobile-dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            opacity: 0;
        }

        #mobile-dropdown-menu.show {
            max-height: 300px;
            opacity: 1;
        }

        /* Burger Button Animation */
        #mobile-menu-button span {
            transition: all 0.3s ease-in-out;
        }

        #mobile-menu-button.active span:first-child {
            transform: translateY(8px) rotate(45deg);
        }

        #mobile-menu-button.active span:nth-child(2) {
            opacity: 0;
        }

        #mobile-menu-button.active span:last-child {
            transform: translateY(-8px) rotate(-45deg);
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }

        .card-modern {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .card-modern:hover::before {
            left: 100%;
        }

        .card-modern:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(45, 79, 43, 0.25);
        }

        .featured-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,1) 100%);
            backdrop-filter: blur(10px);
        }

        .category-badge {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            box-shadow: 0 4px 15px rgba(45, 79, 43, 0.3);
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
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
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
            animation: float 20s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-30px) rotate(90deg); }
            50% { transform: translateY(-60px) rotate(180deg); }
            75% { transform: translateY(-30px) rotate(270deg); }
        }

        .shape:nth-child(1) { left: 10%; animation-delay: 0s; }
        .shape:nth-child(2) { left: 30%; animation-delay: -5s; }
        .shape:nth-child(3) { left: 50%; animation-delay: -10s; }
        .shape:nth-child(4) { left: 70%; animation-delay: -15s; }
        .shape:nth-child(5) { left: 90%; animation-delay: -20s; }

        .sidebar-modern {
            position: sticky;
            top: 100px;
        }

        .tag-modern {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            transition: all 0.3s ease;
        }

        .tag-modern:hover {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 79, 43, 0.3);
        }

        .pagination-modern {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-btn {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: white;
            color: #2D4F2B;
            border: 2px solid transparent;
        }

        .page-btn:hover {
            background: #f0fdf4;
            border-color: #2D4F2B;
            transform: translateY(-2px);
        }

        .page-btn.active {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(45, 79, 43, 0.4);
        }

        .author-badge {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,1) 100%);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(45, 79, 43, 0.1);
        }

        .read-more-btn {
            position: relative;
            overflow: hidden;
        }

        .read-more-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 171, 0, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .read-more-btn:hover::after {
            width: 300px;
            height: 300px;
        }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        .image-overlay {
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.7) 100%);
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50">
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
                    <i class="fas fa-newspaper text-accent"></i>
                    <span class="text-white font-semibold">Artikel & Berita Terbaru</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Blog & Inspirasi
                    <span class="block text-accent">Lingkungan</span>
                </h1>
                
                <p class="text-xl text-white/90 mb-12 leading-relaxed">
                    Temukan informasi terbaru, tips berkebun, dan cerita inspiratif untuk masa depan yang lebih hijau
                </p>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari artikel tentang lingkungan..." 
                               class="search-modern w-full px-6 py-5 rounded-2xl text-gray-800 placeholder-gray-500 focus:outline-none text-lg">
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

    <!-- Main Content -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Main Content Area -->
                <div class="lg:w-2/3">
                    <!-- Featured Article -->
                    <div class="featured-card card-modern rounded-3xl shadow-xl overflow-hidden mb-16" data-aos="fade-up">
                        <div class="relative h-96">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800" 
                                 alt="Featured" 
                                 class="w-full h-full object-cover">
                            <div class="image-overlay absolute inset-0"></div>
                            <div class="category-badge absolute top-6 left-6 px-5 py-2 rounded-full text-white font-semibold text-sm">
                                <i class="fas fa-star mr-2"></i>Featured
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                                <div class="flex items-center space-x-4 mb-4">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100" 
                                         alt="Author" 
                                         class="w-12 h-12 rounded-full border-2 border-white">
                                    <div>
                                        <p class="font-semibold">Ahmad Fauzi</p>
                                        <p class="text-sm text-white/80">15 Juli 2023 • 5 min</p>
                                    </div>
                                </div>
                                <h2 class="text-3xl font-bold mb-3">5 Cara Mudah Menanam Pohon di Pekarangan Rumah</h2>
                                <p class="text-white/90 text-lg">Panduan lengkap untuk memulai menanam pohon di rumah Anda dengan mudah dan menyenangkan</p>
                            </div>
                        </div>
                        <div class="p-8">
                            <button class="read-more-btn relative px-8 py-4 bg-gradient-to-r from-primary to-green-700 text-white rounded-xl font-semibold hover:shadow-xl transition-all">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Latest Articles -->
                    <div class="mb-12">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-bold text-gray-800">Artikel Terbaru</h2>
                            <div class="flex items-center space-x-2">
                                <button class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold">Semua</button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200">Tips</button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200">Berita</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Article Card 1 -->
                            <div class="card-modern bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                                <div class="relative h-56">
                                    <img src="https://images.unsplash.com/photo-1574263867128-39eaed201e1c?w=600" 
                                         alt="Article" 
                                         class="w-full h-full object-cover">
                                    <div class="category-badge absolute top-4 left-4 px-4 py-1.5 rounded-full text-white text-xs font-semibold">
                                        Kampanye
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center text-gray-500 text-sm mb-3">
                                        <i class="far fa-calendar mr-2"></i>
                                        <span>12 Juli 2023</span>
                                        <span class="mx-2">•</span>
                                        <i class="far fa-clock mr-1"></i>
                                        <span>3 min</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                                        Kampanye 10.000 Mangrove di Bali Sukses!
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        Kolaborasi luar biasa dari komunitas berhasil menanam ribuan pohon mangrove...
                                    </p>
                                    <a href="#" class="inline-flex items-center text-primary font-semibold hover:gap-2 transition-all">
                                        Selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Article Card 2 -->
                            <div class="card-modern bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                                <div class="relative h-56">
                                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=600" 
                                         alt="Article" 
                                         class="w-full h-full object-cover">
                                    <div class="category-badge absolute top-4 left-4 px-4 py-1.5 rounded-full text-white text-xs font-semibold">
                                        Tips
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center text-gray-500 text-sm mb-3">
                                        <i class="far fa-calendar mr-2"></i>
                                        <span>10 Juli 2023</span>
                                        <span class="mx-2">•</span>
                                        <i class="far fa-clock mr-1"></i>
                                        <span>4 min</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                                        10 Tanaman Hias Mudah Dirawat
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        Pilihan tanaman hias yang sempurna untuk pemula dan mudah perawatannya...
                                    </p>
                                    <a href="#" class="inline-flex items-center text-primary font-semibold hover:gap-2 transition-all">
                                        Selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Article Card 3 -->
                            <div class="card-modern bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                                <div class="relative h-56">
                                    <img src="https://images.unsplash.com/photo-1518837695005-2083093ee35b?w=600" 
                                         alt="Article" 
                                         class="w-full h-full object-cover">
                                    <div class="category-badge absolute top-4 left-4 px-4 py-1.5 rounded-full text-white text-xs font-semibold">
                                        Berita
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center text-gray-500 text-sm mb-3">
                                        <i class="far fa-calendar mr-2"></i>
                                        <span>8 Juli 2023</span>
                                        <span class="mx-2">•</span>
                                        <i class="far fa-clock mr-1"></i>
                                        <span>2 min</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                                        Penghargaan Lingkungan 2023
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        PohonUntukEsok menerima apresiasi atas dedikasi dalam pelestarian alam...
                                    </p>
                                    <a href="#" class="inline-flex items-center text-primary font-semibold hover:gap-2 transition-all">
                                        Selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Article Card 4 -->
                            <div class="card-modern bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                                <div class="relative h-56">
                                    <img src="https://images.unsplash.com/photo-1500534623283-312aade485b7?w=600" 
                                         alt="Article" 
                                         class="w-full h-full object-cover">
                                    <div class="category-badge absolute top-4 left-4 px-4 py-1.5 rounded-full text-white text-xs font-semibold">
                                        Edukasi
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center text-gray-500 text-sm mb-3">
                                        <i class="far fa-calendar mr-2"></i>
                                        <span>5 Juli 2023</span>
                                        <span class="mx-2">•</span>
                                        <i class="far fa-clock mr-1"></i>
                                        <span>6 min</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-primary transition-colors">
                                        Panduan Komposting di Rumah
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        Cara membuat pupuk organik sendiri dari sampah dapur dengan mudah...
                                    </p>
                                    <a href="#" class="inline-flex items-center text-primary font-semibold hover:gap-2 transition-all">
                                        Selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center" data-aos="fade-up">
                        <div class="pagination-modern">
                            <button class="page-btn">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <span class="text-gray-400">...</span>
                            <button class="page-btn">10</button>
                            <button class="page-btn">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <div class="sidebar-modern space-y-8">
                        <!-- Popular Posts -->
                        <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-fire text-orange-500 mr-3"></i>
                                Populer
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4 group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1518837695005-2083093ee35b?w=100" 
                                         alt="Popular" 
                                         class="w-20 h-20 rounded-xl object-cover group-hover:scale-105 transition-transform">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors mb-1">
                                            Penghargaan Lingkungan 2023
                                        </h4>
                                        <p class="text-sm text-gray-500">8 Juli 2023</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4 group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1500534623283-312aade485b7?w=100" 
                                         alt="Popular" 
                                         class="w-20 h-20 rounded-xl object-cover group-hover:scale-105 transition-transform">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors mb-1">
                                            Panduan Komposting di Rumah
                                        </h4>
                                        <p class="text-sm text-gray-500">5 Juli 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-folder-open text-primary mr-3"></i>
                                Kategori
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                <button class="tag-modern px-4 py-2 rounded-xl text-sm font-semibold text-primary">
                                    Tips & Edukasi
                                </button>
                                <button class="tag-modern px-4 py-2 rounded-xl text-sm font-semibold text-primary">
                                    Kampanye
                                </button>
                                <button class="tag-modern px-4 py-2 rounded-xl text-sm font-semibold text-primary">
                                    Berita
                                </button>
                                <button class="tag-modern px-4 py-2 rounded-xl text-sm font-semibold text-primary">
                                    Lingkungan
                                </button>
                                <button class="tag-modern px-4 py-2 rounded-xl text-sm font-semibold text-primary">
                                    Komunitas
                                </button>
                                <button class="tag-modern px-4 py-2 rounded-xl text-sm font-semibold text-primary">
                                    Teknologi
                                </button>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="bg-gradient-to-br from-primary to-green-700 rounded-2xl shadow-xl p-8 text-white" data-aos="fade-up" data-aos-delay="200">
                            <div class="text-center mb-6">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-envelope-open-text text-3xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-2">Newsletter</h3>
                                <p class="text-white/90">Dapatkan artikel terbaru langsung ke email Anda</p>
                            </div>
                            <div class="space-y-3">
                                <input type="email" 
                                       placeholder="Email Anda" 
                                       class="w-full px-4 py-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50">
                                <button class="w-full px-6 py-3 bg-white text-primary rounded-xl font-semibold hover:bg-gray-100 transition-all">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Berlangganan
                                </button>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-share-alt text-primary mr-3"></i>
                                Ikuti Kami
                            </h3>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="#" class="flex items-center justify-center space-x-2 bg-blue-600 text-white px-4 py-3 rounded-xl hover:bg-blue-700 transition-all">
                                    <i class="fab fa-facebook-f"></i>
                                    <span class="font-semibold">Facebook</span>
                                </a>
                                <a href="#" class="flex items-center justify-center space-x-2 bg-sky-500 text-white px-4 py-3 rounded-xl hover:bg-sky-600 transition-all">
                                    <i class="fab fa-twitter"></i>
                                    <span class="font-semibold">Twitter</span>
                                </a>
                                <a href="#" class="flex items-center justify-center space-x-2 bg-pink-600 text-white px-4 py-3 rounded-xl hover:bg-pink-700 transition-all">
                                    <i class="fab fa-instagram"></i>
                                    <span class="font-semibold">Instagram</span>
                                </a>
                                <a href="#" class="flex items-center justify-center space-x-2 bg-red-600 text-white px-4 py-3 rounded-xl hover:bg-red-700 transition-all">
                                    <i class="fab fa-youtube"></i>
                                    <span class="font-semibold">YouTube</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

   <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Mobile Menu Functionality
    const burgerButton = document.getElementById('burger-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
    const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');

    // Toggle mobile menu
    function toggleMobileMenu() {
        const isActive = mobileMenu.classList.contains('active');
        
        // Toggle menu visibility
        mobileMenu.classList.toggle('active');
        burgerButton.classList.toggle('active');
        
        // Toggle body overflow
        document.body.style.overflow = isActive ? '' : 'hidden';
        
        // Reset dropdown menu when closing main menu
        if (!mobileMenu.classList.contains('active')) {
            mobileDropdownMenu.classList.remove('show');
            const icon = mobileDropdownBtn.querySelector('i.fa-chevron-down');
            icon.style.transform = '';
        }
    }

    // Toggle mobile dropdown menu
    function toggleMobileDropdown() {
        mobileDropdownMenu.classList.toggle('show');
        const icon = mobileDropdownBtn.querySelector('i.fa-chevron-down');
        
        if (mobileDropdownMenu.classList.contains('show')) {
            icon.style.transform = 'rotate(180deg)';
        } else {
            icon.style.transform = '';
        }
    }

    // Close mobile menu
    function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        burgerButton.classList.remove('active');
        mobileDropdownMenu.classList.remove('show');
        document.body.style.overflow = '';
        
        // Reset dropdown icon
        const icon = mobileDropdownBtn.querySelector('i.fa-chevron-down');
        icon.style.transform = '';
        
        // Reset burger animation
        const spans = burgerButton.getElementsByTagName('span');
        spans[0].style.transform = '';
        spans[1].style.opacity = '';
        spans[2].style.transform = '';
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
            closeMobileMenu();
        });
    });

    // Close menu when clicking anywhere
            document.addEventListener('click', function(e) {
                if (mobileMenu.classList.contains('active')) {
                    // Only prevent closing if clicking the burger button itself
                    if (burgerButton.contains(e.target)) {
                        return;
                    }
                    closeMobileMenu();
                }
            });

    // Close mobile menu on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });

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

    // Search functionality placeholder
    const searchInputs = document.querySelectorAll('input[type="text"]');
    searchInputs.forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Searching for:', input.value);
                // Add your search functionality here
            }
        });
    });

    // Add loading states for buttons
    document.querySelectorAll('button, a').forEach(element => {
        element.addEventListener('click', function(e) {
            if (this.classList.contains('shimmer-btn') || this.classList.contains('ripple-btn')) {
                // Add loading animation
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
                
                setTimeout(() => {
                    this.innerHTML = originalContent;
                }, 2000);
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            closeMobileMenu();
        }
    });

    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements for scroll animations
    document.querySelectorAll('.card-modern').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
</script>
</body>
</html>