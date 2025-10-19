<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PohonUntukEsok - Donasi Penanaman Pohon</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- GSAP for advanced animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2D4F2B',
                        secondary: '#81C784',
                        accent: '#FFAB00',
                        lightbg: '#FFF1CA',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'fade-in': 'fadeIn 1s ease-in',
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                        'slide-in': 'slideIn 1s ease-out',
                        'scale': 'scale 0.5s ease-in-out',
                        'leaf-fall': 'leafFall 10s linear infinite',
                        'ripple': 'ripple 2s linear infinite',
                        'shine': 'shine 3s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-3deg)' },
                            '50%': { transform: 'rotate(3deg)' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        scale: {
                            '0%': { transform: 'scale(0.8)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        leafFall: {
                            '0%': { transform: 'translateY(-100px) rotate(0deg)', opacity: '0' },
                            '10%': { opacity: '1' },
                            '90%': { opacity: '0.8' },
                            '100%': { transform: 'translateY(100vh) rotate(360deg)', opacity: '0' },
                        },
                        ripple: {
                            '0%': { transform: 'scale(0.8)', opacity: '1' },
                            '100%': { transform: 'scale(2.5)', opacity: '0' },
                        },
                        shine: {
                            '0%': { transform: 'translateX(-100%) skewX(-15deg)' },
                            '100%': { transform: 'translateX(200%) skewX(-15deg)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/css">
       @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

         /* Alert Styles */
    .alert {
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 10000;
        max-width: 400px;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        transform: translateX(400px);
        transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .alert.show {
        transform: translateX(0);
    }

    .alert-success {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        border-left: 4px solid #047857;
    }

    .alert-error {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        border-left: 4px solid #B91C1C;
    }

    .alert-warning {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        color: white;
        border-left: 4px solid #B45309;
    }

    .alert-info {
        background: linear-gradient(135deg, #3B82F6, #2563EB);
        color: white;
        border-left: 4px solid #1D4ED8;
    }

    .alert-icon {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .alert-content {
        flex: 1;
    }

    .alert-title {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 2px;
    }

    .alert-message {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .alert-close {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: background-color 0.2s;
        flex-shrink: 0;
    }

    .alert-close:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    @media (max-width: 640px) {
        .alert {
            top: 80px;
            right: 10px;
            left: 10px;
            max-width: none;
            transform: translateY(-100px);
        }

        .alert.show {
            transform: translateY(0);
        }
    }

        /* Hero Section Styles */
        .hero-home {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
            min-height: 130vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            line-height: 1.1;
        }

        .floating-shapes {
            top: 80px;
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            top: 80px;
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

        .cta-button {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(45, 79, 43, 0.3);
        }

        .cta-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .cta-button:hover::after {
            left: 100%;
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

        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            background-color: #e5e7eb;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, #2D4F2B, #3d6b3a);
            transition: width 1s ease-in-out;
        }

        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background: #2D4F2B;
        }

        /* Enhanced glass effect */
        .enhanced-glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Shimmer effect for buttons */
        .shimmer-btn {
            position: relative;
            overflow: hidden;
        }
        
        .shimmer-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transform: translateX(-100%);
        }
        
        .shimmer-btn:hover::after {
            animation: shine 1.5s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(200%) skewX(-15deg); }
        }

        /* Ripple effect for buttons */
        .ripple-btn {
            position: relative;
            overflow: hidden;
        }
        
        .ripple-btn span.ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        /* Organic shapes */
        .organic-shape {
            position: absolute;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: rgba(129, 199, 132, 0.1);
            animation: morphing 15s ease-in-out infinite;
        }

        @keyframes morphing {
            0% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }
            25% {
                border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
            }
            50% {
                border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
            }
            75% {
                border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
            }
            100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }
        }

        /* Hover zoom effect */
        .hover-zoom {
            transition: transform 0.5s ease;
        }
        
        .hover-zoom:hover {
            transform: scale(1.05);
        }

        /* Pulse animation for important elements */
        @keyframes pulse-glow {
            0% {
                box-shadow: 0 0 0 0 rgba(45, 79, 43, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(45, 79, 43, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(45, 79, 43, 0);
            }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }
       

        /* Typewriter effect */
        .typewriter {
            overflow: hidden;
            border-right: 0.15em solid #2D4F2B;
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #2D4F2B }
        }

        /* FLOATING SHAPES - PERBAIKAN UTAMA */
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 2;
        }

        .shape {
            position: absolute;
            opacity: 0.3;
            animation: floatShape 20s infinite ease-in-out;
            z-index: 2;
        }

        @keyframes floatShape {
            0%, 100% { 
                transform: translateY(0) rotate(0deg) scale(1);
            }
            25% { 
                transform: translateY(-40px) rotate(90deg) scale(1.1);
            }
            50% { 
                transform: translateY(-80px) rotate(180deg) scale(1);
            }
            75% { 
                transform: translateY(-40px) rotate(270deg) scale(0.9);
            }
        }

        /* Individual shape positioning and delays */
        .shape-1 { 
            top: 20%; 
            left: 10%; 
            animation-delay: 0s; 
            font-size: 3rem;
        }
        .shape-2 { 
            top: 60%; 
            left: 30%; 
            animation-delay: -5s; 
            font-size: 2.5rem;
        }
        .shape-3 { 
            top: 40%; 
            left: 50%; 
            animation-delay: -10s; 
            font-size: 4rem;
        }
        .shape-4 { 
            top: 80%; 
            left: 70%; 
            animation-delay: -15s; 
            font-size: 2rem;
        }
        .shape-5 { 
            top: 30%; 
            left: 90%; 
            animation-delay: -20s; 
            font-size: 3.5rem;
        }

        /* Additional shapes for better coverage */
        .shape-6 { 
            top: 70%; 
            left: 15%; 
            animation-delay: -2s; 
            font-size: 2.8rem;
        }
        .shape-7 { 
            top: 25%; 
            left: 75%; 
            animation-delay: -8s; 
            font-size: 3.2rem;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 overflow-x-hidden">

<!-- Alert Container -->
    <div id="alertContainer"></div>
   <!-- Include Navigation -->
    @include('layouts.navigation')
    
    <!-- Include Auth Modal -->
    @include('components.auth-modal')

    <!-- Hero Section -->
    <section class="hero-home pt-20">
        <div class="floating-shapes">
            <i class="shape fas fa-leaf text-white text-6xl"></i>
            <i class="shape fas fa-seedling text-white text-5xl"></i>
            <i class="shape fas fa-tree text-white text-7xl"></i>
            <i class="shape fas fa-leaf text-white text-4xl"></i>
            <i class="shape fas fa-seedling text-white text-6xl"></i>
        </div>

        <!-- Organic Shapes Background -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="organic-shape w-96 h-96 opacity-20 -top-48 -left-24"></div>
            <div class="organic-shape w-[600px] h-[600px] opacity-10 -bottom-48 -right-24" style="animation-delay: -7s;"></div>
            <div class="organic-shape w-72 h-72 opacity-15 top-1/3 left-1/4" style="animation-delay: -3s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="hero-content flex flex-col lg:flex-row items-center justify-between">
                <!-- Text Content -->
                <div class="lg:w-1/2 text-white mb-12 lg:mb-0" data-aos="fade-right">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                        <i class="fas fa-seedling text-accent"></i>
                        <span class="font-semibold">#HijauUntukMasaDepan</span>
                    </div>
                    
                    <h1 class="hero-title font-bold mb-6 leading-tight">
                        Tanam Pohon
                        <span class="block text-accent">Untuk Masa Depan</span>
                        <span class="block">Yang Lebih Baik</span>
                    </h1>
                    
                    <p class="text-xl text-white/90 mb-8 leading-relaxed max-w-2xl">
                        Bergabunglah dalam misi kami untuk melestarikan lingkungan dan menciptakan masa depan yang lebih hijau melalui donasi penanaman pohon.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="#donate" class="cta-button px-8 py-4 rounded-xl text-white font-semibold flex items-center group">
                            <i class="fas fa-seedling mr-2 group-hover:animate-bounce"></i>
                            Donasi Sekarang
                        </a>
                        <a href="#learn-more" class="px-8 py-4 border-2 border-white rounded-xl text-white font-semibold hover:bg-white hover:text-primary transition-all duration-300 flex items-center group">
                            <i class="fas fa-info-circle mr-2"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                
                <!-- Hero Image -->
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="relative hover-zoom">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800" 
                             alt="Tree Planting" 
                             class="rounded-2xl shadow-2xl w-full max-w-lg mx-auto">
                        <div class="absolute -bottom-6 -right-6 bg-accent text-primary px-6 py-4 rounded-xl shadow-lg">
                            <div class="text-2xl font-bold">10.000+</div>
                            <div class="text-sm">Pohon Tertanam</div>
                        </div>
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

        <!-- Campaign Highlights with Enhanced Design -->
        <!-- Campaign Highlights with Enhanced Design -->
<section class="py-16 subtle-pattern relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute inset-0 opacity-50">
        <div class="organic-shape w-[800px] h-[800px] opacity-5 -top-1/4 -right-1/4" style="animation-delay: -5s;"></div>
        <div class="organic-shape w-[600px] h-[600px] opacity-5 -bottom-1/4 -left-1/4" style="animation-delay: -2s;"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <h2 data-aos="fade-up" class="text-3xl md:text-4xl font-extrabold text-center text-primary mb-12 relative">
            Kampanye Terpopuler
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-accent mt-4"></span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($popularCampaigns as $campaign)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="relative overflow-hidden h-48">
                    @if($campaign->image)
                        <img src="{{ asset('storage/' . $campaign->image) }}" 
                             alt="{{ $campaign->title }}" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                            <i class="fas fa-tree text-6xl text-green-300"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                        {{ $campaign->status_badge['text'] }}
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ $campaign->days_left }} Hari Lagi
                        </span>
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $campaign->location }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">{{ $campaign->title }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ Str::limit($campaign->description, 100) }}
                    </p>
                    
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-bold text-green-700">{{ $campaign->progress_percentage }}% Terkumpul</span>
                            <span>{{ number_format($campaign->current_trees) }}/{{ number_format($campaign->target_trees) }} pohon</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full progress-bar" style="width: {{ $campaign->progress_percentage }}%"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center text-sm text-gray-600">
                        <span><i class="fas fa-users mr-1"></i> {{ number_format($campaign->total_donors) }} Donatur</span>
                        @if($campaign->status === 'active')
                            <a href="{{ route('kampanye.show', $campaign) }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors shimmer-btn">
                                Donasi
                            </a>
                        @else
                            <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed" disabled>
                                {{ $campaign->status === 'completed' ? 'Selesai' : 'Menunggu' }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            @if($popularCampaigns->isEmpty())
            <!-- Fallback jika tidak ada kampanye -->
            <div class="col-span-full text-center py-12">
                <i class="fas fa-tree text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum ada kampanye</h3>
                <p class="text-gray-500 mb-6">Jadilah yang pertama membuat kampanye penanaman pohon!</p>
                <a href="{{ route('buat') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors">
                    Buat Kampanye Pertama
                </a>
            </div>
            @endif
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('kampanye') }}" class="group inline-block px-8 py-3 bg-primary text-white font-bold rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:bg-green-700 shimmer-btn">
                <span class="inline-block group-hover:animate-bounce-slow">
                    Lihat Semua Kampanye
                    <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-2"></i>
                </span>
            </a>
        </div>
    </div>
</section>

        <!-- How It Works -->
        <section class="py-16 bg-gray-50 relative overflow-hidden">
            <!-- Background elements -->
            <div class="absolute inset-0 opacity-50">
                <div class="organic-shape w-[600px] h-[600px] opacity-5 -top-1/3 -left-1/4" style="animation-delay: -3s;"></div>
                <div class="organic-shape w-[500px] h-[500px] opacity-5 -bottom-1/3 -right-1/4" style="animation-delay: -6s;"></div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-center text-primary mb-12 relative" data-aos="fade-up">
                    Cara Berdonasi
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-accent mt-4"></span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold text-primary shadow-lg group-hover:bg-primary group-hover:text-white transition-colors duration-300 hover-zoom">
                            1
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">Pilih Kampanye</h3>
                        <p class="text-gray-600">
                            Temukan kampanye penanaman pohon yang ingin Anda dukung sesuai dengan minat Anda.
                        </p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold text-primary shadow-lg group-hover:bg-primary group-hover:text-white transition-colors duration-300 hover-zoom">
                            2
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">Tentukan Donasi</h3>
                        <p class="text-gray-600">
                            Pilih jumlah donasi atau jumlah pohon yang ingin Anda tanam sesuai kemampuan.
                        </p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold text-primary shadow-lg group-hover:bg-primary group-hover:text-white transition-colors duration-300 hover-zoom">
                            3
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">Konfirmasi Donasi</h3>
                        <p class="text-gray-600">
                            Selesaikan pembayaran dan dapatkan laporan perkembangan pohon secara berkala.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Impact Stats -->
        <section class="py-16 bg-primary text-white relative overflow-hidden">
            <!-- Background pattern -->
            <div class="absolute">
                <div class="leaf-pattern absolute inset-0"></div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="enhanced-glass rounded-2xl p-4 text-center hover:scale-105 transition-transform duration-300" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-4xl md:text-5xl font-bold text-accent mb-2 counter" data-count="12500">0</div>
                        <div class="text-lg">Pohon Tertanam</div>
                    </div>
                    <div class="enhanced-glass rounded-2xl p-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-4xl md:text-5xl font-bold text-accent mb-2 counter" data-count="3200">0</div>
                        <div class="text-lg">Donatur</div>
                    </div>
                    <div class="enhanced-glass rounded-2xl p-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-4xl md:text-5xl font-bold text-accent mb-2 counter" data-count="45">0</div>
                        <div class="text-lg">Kampanye</div>
                    </div>
                    <div class="enhanced-glass rounded-2xl p-4" data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-4xl md:text-5xl font-bold text-accent mb-2 counter" data-count="12">0</div>
                        <div class="text-lg">Lokasi</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-16 bg-lightbg text-primary relative overflow-hidden">
            <!-- Background elements -->
            <div class="absolute inset-0 opacity-50">
                <div class="organic-shape w-[400px] h-[400px] opacity-5 top-1/4 -left-20" style="animation-delay: -2s;"></div>
                <div class="organic-shape w-[300px] h-[300px] opacity-5 bottom-1/4 -right-10" style="animation-delay: -5s;"></div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-2/3 mb-8 md:mb-0" data-aos="fade-right">
                        <h2 class="text-3xl font-bold mb-4">Siap Berkontribusi untuk Lingkungan yang Lebih Baik?</h2>
                        <p class="text-xl">
                            Bergabunglah dengan ribuan orang lainnya dalam upaya pelestarian lingkungan melalui penanaman pohon.
                        </p>
                    </div>
                    <div class="md:w-1/3 text-center md:text-right" data-aos="fade-left">
                        <a href="#" class="inline-block px-8 py-3 bg-primary text-white font-bold rounded-lg hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1 shimmer-btn pulse-glow">
                            Mulai Donasi Sekarang
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
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Beranda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Kampanye</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
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
                            <a href="#" class="group flex items-center text-gray-400 hover:text-accent transition-colors">
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
                        <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Terms of
                            Service</a>
                        <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

       <!-- Back to Top Button -->
        <button id="back-to-top"
            class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 z-40 hover:bg-green-700 hover-zoom">
            <i class="fas fa-arrow-up"></i>
        </button>

        <!-- Scripts -->
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

        <!-- Script untuk Alert System -->
    <script>
    // Alert System
    function showAlert(type, title, message, duration = 5000) {
        const alertContainer = document.getElementById('alertContainer');
        
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.innerHTML = `
            <div class="alert-icon">
                ${getAlertIcon(type)}
            </div>
            <div class="alert-content">
                <div class="alert-title">${title}</div>
                <div class="alert-message">${message}</div>
            </div>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;

        alertContainer.appendChild(alert);

        // Trigger animation
        setTimeout(() => {
            alert.classList.add('show');
        }, 100);

        // Auto remove after duration
        if (duration > 0) {
            setTimeout(() => {
                if (alert.parentElement) {
                    alert.classList.remove('show');
                    setTimeout(() => {
                        if (alert.parentElement) {
                            alert.remove();
                        }
                    }, 400);
                }
            }, duration);
        }

        return alert;
    }

    function getAlertIcon(type) {
        const icons = {
            success: '<i class="fas fa-check-circle"></i>',
            error: '<i class="fas fa-exclamation-circle"></i>',
            warning: '<i class="fas fa-exclamation-triangle"></i>',
            info: '<i class="fas fa-info-circle"></i>'
        };
        return icons[type] || icons.info;
    }

    // Check for session messages and show alerts
    document.addEventListener('DOMContentLoaded', function() {
        // Check for success message
        @if(session('success'))
            showAlert('success', 'Berhasil!', '{{ session('success') }}');
        @endif

        // Check for error message
        @if(session('error'))
            showAlert('error', 'Error!', '{{ session('error') }}');
        @endif

        // Check for warning message
        @if(session('warning'))
            showAlert('warning', 'Peringatan!', '{{ session('warning') }}');
        @endif

        // Check for info message
        @if(session('info'))
            showAlert('info', 'Informasi', '{{ session('info') }}');
        @endif

        // Auto open auth modal if requested
        @if(session('open_modal'))
            const modalType = '{{ session('open_modal') }}';
            setTimeout(() => {
                openAuthModal(modalType);
            }, 500);
        @endif

        // Handle form errors in modal
        @if($errors->any())
            @if($errors->has('email') || $errors->has('password'))
                setTimeout(() => {
                    openAuthModal('login');
                }, 500);
            @elseif($errors->has('name') || $errors->has('email') || $errors->has('password'))
                setTimeout(() => {
                    openAuthModal('register');
                }, 500);
            @endif
        @endif
    });

    // Enhanced form submission with loading states
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.querySelector('#loginForm form');
        const registerForm = document.querySelector('#registerForm form');

        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = `
                    <i class="fas fa-spinner fa-spin"></i>
                    <span>Memproses...</span>
                `;
                submitBtn.disabled = true;

                // Re-enable after 5 seconds in case of error
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            });
        }

        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = `
                    <i class="fas fa-spinner fa-spin"></i>
                    <span>Membuat Akun...</span>
                `;
                submitBtn.disabled = true;

                // Re-enable after 5 seconds in case of error
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            });
        }
    });
    </script>
        <script>
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });

            // Initialize GSAP with ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);

            // Animate elements on scroll with GSAP
            gsap.utils.toArray('.parallax-element').forEach(element => {
                gsap.to(element, {
                    yPercent: -20,
                    ease: "none",
                    scrollTrigger: {
                        trigger: element,
                        start: "top bottom",
                        end: "bottom top",
                        scrub: true
                    }
                });
            });

            // Mobile menu functionality
            document.addEventListener('DOMContentLoaded', function() {
                const burgerButton = document.getElementById('burger-button');
                const mobileMenu = document.getElementById('mobile-menu');
                const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
                const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');
                
                // Toggle mobile menu
                burgerButton?.addEventListener('click', function(e) {
                    e.stopPropagation();
                    this.classList.toggle('active');
                    mobileMenu.classList.toggle('active');
                    
                    // Toggle burger animation
                    const spans = this.getElementsByTagName('span');
                    if (this.classList.contains('active')) {
                        spans[0].style.transform = 'translateY(8px) rotate(45deg)';
                        spans[1].style.opacity = '0';
                        spans[2].style.transform = 'translateY(-8px) rotate(-45deg)';
                    } else {
                        closeMobileMenu();
                    }
                });

                // Toggle dropdown
                mobileDropdownBtn?.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileDropdownMenu.classList.toggle('show');
                    const chevron = this.querySelector('.fa-chevron-down');
                    chevron.style.transform = mobileDropdownMenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0)';
                });            
                
                // Function to close mobile menu
                function closeMobileMenu() {
                    mobileMenu.classList.remove('active');
                    burgerButton.classList.remove('active');
                    
                    // Reset burger button
                    const spans = burgerButton.getElementsByTagName('span');
                    spans[0].style.transform = 'none';
                    spans[1].style.opacity = '1';
                    spans[2].style.transform = 'none';

                    // Reset dropdown
                    mobileDropdownMenu.classList.remove('show');
                    const chevron = mobileDropdownBtn.querySelector('.fa-chevron-down');
                    if (chevron) {
                        chevron.style.transform = 'rotate(0)';
                    }
                }

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

                // Prevent menu from closing when clicking inside dropdown
                mobileDropdownMenu?.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // Ripple effect for buttons
                const rippleButtons = document.querySelectorAll('.ripple-btn');
                rippleButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        const x = e.clientX - e.target.getBoundingClientRect().left;
                        const y = e.clientY - e.target.getBoundingClientRect().top;
                        
                        const ripple = document.createElement('span');
                        ripple.classList.add('ripple');
                        ripple.style.left = `${x}px`;
                        ripple.style.top = `${y}px`;
                        
                        this.appendChild(ripple);
                        
                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    });
                });
            });

            // Back to top button functionality
            const backToTopButton = document.getElementById('back-to-top');
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.remove('opacity-100', 'visible');
                    backToTopButton.classList.add('opacity-0', 'invisible');
                }
            });

            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Smooth scrolling for all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Enhanced counter animation with formatting
            function animateCounters() {
                const counters = document.querySelectorAll('.counter');
                const speed = 200;
                
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-count');
                    const count = +counter.innerText.replace(/,/g, '');
                    const increment = target / speed;
                    
                    if (count < target) {
                        const nextCount = Math.ceil(count + increment);
                        counter.innerText = nextCount.toLocaleString();
                        setTimeout(animateCounters, 1);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                });
            }

            // Start counter animation when in viewport
            const counterSection = document.querySelector('section.py-16.bg-primary');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            if (counterSection) {
                observer.observe(counterSection);
            }

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const nav = document.getElementById('main-nav');
                if (window.scrollY > 50) {
                    nav.classList.add('shadow-lg', 'py-2');
                    nav.classList.remove('py-3');
                } else {
                    nav.classList.remove('shadow-lg', 'py-2');
                    nav.classList.add('py-3');
                }
            });

            // Animate progress bars when in view
            const progressBars = document.querySelectorAll('.progress-bar');
            const progressObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const width = entry.target.style.width;
                        entry.target.style.width = '0';
                        setTimeout(() => {
                            entry.target.style.width = width;
                        }, 100);
                        progressObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            progressBars.forEach(bar => {
                progressObserver.observe(bar);
            });

            // Add subtle cursor follower
            document.addEventListener('mousemove', function(e) {
                const follower = document.getElementById('cursor-follower');
                if (follower) {
                    gsap.to(follower, {
                        x: e.clientX,
                        y: e.clientY,
                        duration: 1,
                        ease: "power2.out"
                    });
                }
            });
        </script>
    </body>
</html>