<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kampanye Baru - PohonUntukEsok</title>
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
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
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

        /* Hero Gradient */
        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }

        /* Card Modern */
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
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(45, 79, 43, 0.25);
        }

        /* Floating Shapes */
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

        .shape-1 { top: 20%; left: 10%; animation-delay: 0s; font-size: 3rem; }
        .shape-2 { top: 60%; left: 30%; animation-delay: -5s; font-size: 2.5rem; }
        .shape-3 { top: 40%; left: 50%; animation-delay: -10s; font-size: 4rem; }
        .shape-4 { top: 80%; left: 70%; animation-delay: -15s; font-size: 2rem; }
        .shape-5 { top: 30%; left: 90%; animation-delay: -20s; font-size: 3.5rem; }

        /* Organic shapes */
        .organic-shape {
            position: absolute;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: rgba(129, 199, 132, 0.1);
            animation: morphing 15s ease-in-out infinite;
        }

        @keyframes morphing {
            0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
            100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        }

        /* Enhanced glass effect */
        .enhanced-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
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

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2D4F2B;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            background-color: white;
            font-size: 0.95rem;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #81C784;
            box-shadow: 0 0 0 3px rgba(129, 199, 132, 0.2);
            transform: translateY(-2px);
        }
        
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23374151' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-upload-btn {
            display: block;
            padding: 1rem;
            background-color: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload-btn:hover {
            border-color: #81C784;
            background-color: #f0f9f0;
            transform: translateY(-2px);
        }
        
        .file-upload input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 200px;
            margin-top: 1rem;
            border-radius: 0.75rem;
            display: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        /* Step Indicator */
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin: 2rem auto 3rem;
            position: relative;
            padding: 0 2rem;
            max-width: 600px;
        }
        
        .step-container {
            position: relative;
            flex: 1;
            text-align: center;
        }
        
        .step-container:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            left: calc(50% + 25px);
            right: calc(-50% + 25px);
            height: 3px;
            background: linear-gradient(90deg, #81C784, #e5e7eb);
            z-index: 1;
            transition: all 0.3s ease;
        }
        
        .step-container.completed:not(:last-child)::after {
            background: linear-gradient(90deg, #81C784, #2D4F2B);
        }
        
        .step {
            position: relative;
            z-index: 2;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e5e7eb;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .step.active {
            background: linear-gradient(135deg, #2D4F2B, #3d6b3a);
            border-color: #2D4F2B;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(45, 79, 43, 0.3);
        }
        
        .step.completed {
            background: linear-gradient(135deg, #81C784, #4CAF50);
            border-color: #81C784;
            color: white;
        }
        
        .step-label {
            position: absolute;
            width: 100%;
            left: 0;
            top: calc(100% + 12px);
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            text-align: center;
            transition: all 0.3s ease;
            padding: 0 0.5rem;
        }
        
        .step.active .step-label {
            color: #2D4F2B;
            font-weight: 600;
            transform: scale(1.05);
        }
        
        .step.completed .step-label {
            color: #81C784;
        }
        
        .step-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .step-content.active {
            display: block;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.875rem 1.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            font-size: 0.95rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #2D4F2B, #3d6b3a);
            color: white;
            box-shadow: 0 4px 15px rgba(45, 79, 43, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 79, 43, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #374151;
            border: 2px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #2D4F2B;
            transform: translateY(-2px);
        }
        
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        
        .form-help {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }
        
        .required::after {
            content: '*';
            color: #ef4444;
            margin-left: 0.25rem;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }
        
        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .form-input.error + .error-message {
            display: block;
        }

        /* Category Badge */
        .category-badge {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            box-shadow: 0 4px 15px rgba(45, 79, 43, 0.3);
        }

        /* Hover Effects */
        .hover-zoom {
            transition: transform 0.5s ease;
        }
        
        .hover-zoom:hover {
            transform: scale(1.05);
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

        @media (max-width: 768px) {
            .step-indicator {
                padding: 0 1rem;
                margin: 1rem auto 2.5rem;
            }
            
            .step {
                width: 36px;
                height: 36px;
                font-size: 0.875rem;
            }
            
            .step-container:not(:last-child)::after {
                top: 18px;
                left: calc(50% + 18px);
                right: calc(-50% + 18px);
            }
            
            .step-label {
                font-size: 0.75rem;
                line-height: 1.2;
                top: calc(100% + 8px);
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50 min-h-screen">
    <!-- Navigation -->
    <!-- Include Navigation -->
    @include('layouts.navigation')
    
    <!-- Include Auth Modal -->
    @include('components.auth-modal')

    <!-- Main Content -->
    <main class="overflow-x-hidden">
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 hero-gradient overflow-hidden">
            <!-- Floating Shapes -->
            <div class="floating-shapes">
                <i class="shape shape-1 fas fa-leaf text-white"></i>
                <i class="shape shape-2 fas fa-seedling text-white"></i>
                <i class="shape shape-3 fas fa-tree text-white"></i>
                <i class="shape shape-4 fas fa-leaf text-white"></i>
                <i class="shape shape-5 fas fa-seedling text-white"></i>
            </div>

            <!-- Organic Shapes Background -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="organic-shape w-96 h-96 opacity-20 -top-48 -left-24"></div>
                <div class="organic-shape w-[600px] h-[600px] opacity-10 -bottom-48 -right-24" style="animation-delay: -7s;"></div>
                <div class="organic-shape w-72 h-72 opacity-15 top-1/3 left-1/4" style="animation-delay: -3s;"></div>
            </div>
            
            <!-- Hero Content -->
            <div class="relative container mx-auto px-4 z-10">
                <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                        <i class="fas fa-plus-circle text-accent"></i>
                        <span class="text-white font-semibold">Mulai Kampanye Baru</span>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                        Buat Kampanye
                        <span class="block text-accent">Penanaman Pohon</span>
                    </h1>
                    
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        Mulai perjalanan hijau Anda dan ajak komunitas untuk bersama-sama menciptakan perubahan lingkungan yang berkelanjutan
                    </p>
                </div>
            </div>

            <!-- Wave Divider -->
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

        <!-- Campaign Creation Form -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <!-- Form Container -->
                    <div class="card-modern bg-white rounded-3xl shadow-xl overflow-hidden">
                        <!-- Step Indicator -->
                        <div class="p-8 border-b border-gray-100">
                            <div class="step-indicator">
                                <!-- Step 1 -->
                                <div class="step-container">
                                    <div class="step active" data-step="1">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <span class="step-label">Informasi Dasar</span>
                                </div>
                                
                                <!-- Step 2 -->
                                <div class="step-container">
                                    <div class="step" data-step="2">
                                        <i class="fas fa-seedling"></i>
                                    </div>
                                    <span class="step-label">Detail Kampanye</span>
                                </div>
                                
                                <!-- Step 3 -->
                                <div class="step-container">
                                    <div class="step" data-step="3">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <span class="step-label">Target & Timeline</span>
                                </div>
                                
                                <!-- Step 4 -->
                                <div class="step-container">
                                    <div class="step" data-step="4">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="step-label">Pratinjau</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Content -->
                        <div class="p-8">
                            <form id="campaign-form">
                                <!-- Step 1: Basic Information -->
                                <div class="step-content active" data-step="1">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Informasi Dasar Kampanye</h2>
                                    
                                    <div class="space-y-6">
                                        <div class="form-group">
                                            <label for="campaign-title" class="form-label required">Judul Kampanye</label>
                                            <input type="text" id="campaign-title" class="form-input" placeholder="Contoh: Penanaman 1000 Pohon Mangrove di Bali" required>
                                            <div class="error-message">Judul kampanye harus diisi</div>
                                            <div class="form-help">Buat judul yang menarik dan jelas untuk kampanye Anda</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="campaign-category" class="form-label required">Kategori</label>
                                            <select id="campaign-category" class="form-input form-select" required>
                                                <option value="">Pilih Kategori</option>
                                                <option value="reboisasi">Reboisasi Hutan</option>
                                                <option value="mangrove">Penanaman Mangrove</option>
                                                <option value="perkotaan">Hijaukan Perkotaan</option>
                                                <option value="edukasi">Edukasi Lingkungan</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <div class="error-message">Pilih kategori kampanye</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="campaign-location" class="form-label required">Lokasi Penanaman</label>
                                            <input type="text" id="campaign-location" class="form-input" placeholder="Contoh: Pantai Sanur, Denpasar, Bali" required>
                                            <div class="error-message">Lokasi penanaman harus diisi</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="campaign-image" class="form-label required">Gambar Kampanye</label>
                                            <div class="file-upload">
                                                <div class="file-upload-btn">
                                                    <i class="fas fa-cloud-upload-alt text-2xl mb-2 text-gray-400"></i>
                                                    <p class="font-semibold text-gray-600">Klik untuk mengunggah gambar</p>
                                                    <p class="text-sm text-gray-500">Format: JPG, PNG (Maks. 5MB)</p>
                                                    <input type="file" id="campaign-image" accept="image/*" required>
                                                </div>
                                            </div>
                                            <img id="image-preview" class="preview-image" alt="Pratinjau Gambar">
                                            <div class="error-message">Gambar kampanye harus diunggah</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Step 2: Campaign Details -->
                                <div class="step-content" data-step="2">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Detail Kampanye</h2>
                                    
                                    <div class="space-y-6">
                                        <div class="form-group">
                                            <label for="campaign-description" class="form-label required">Deskripsi Kampanye</label>
                                            <textarea id="campaign-description" class="form-input form-textarea" placeholder="Jelaskan secara detail tentang kampanye Anda, tujuan, dan manfaatnya bagi lingkungan..." required></textarea>
                                            <div class="error-message">Deskripsi kampanye harus diisi</div>
                                            <div class="form-help">Minimal 200 karakter. Jelaskan dengan jelas dan menarik</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="campaign-benefits" class="form-label">Manfaat Kampanye</label>
                                            <textarea id="campaign-benefits" class="form-input form-textarea" placeholder="Jelaskan manfaat yang akan didapat dari kampanye ini, seperti mengurangi erosi, menyediakan oksigen, dll..."></textarea>
                                            <div class="form-help">Sebutkan manfaat lingkungan dan sosial dari kampanye ini</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="tree-type" class="form-label required">Jenis Pohon</label>
                                            <input type="text" id="tree-type" class="form-input" placeholder="Contoh: Mangrove Rhizophora, Pohon Trembesi, dll" required>
                                            <div class="error-message">Jenis pohon harus diisi</div>
                                            <div class="form-help">Sebutkan jenis pohon yang akan ditanam</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Metode Penanaman</label>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                                                <label class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-colors">
                                                    <input type="radio" name="planting-method" value="volunteer" class="hidden" checked>
                                                    <i class="fas fa-users text-3xl text-gray-400 mb-2"></i>
                                                    <span class="font-semibold text-center">Relawan</span>
                                                    <span class="text-sm text-gray-500 text-center mt-1">Penanaman oleh relawan</span>
                                                </label>
                                                <label class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-colors">
                                                    <input type="radio" name="planting-method" value="professional" class="hidden">
                                                    <i class="fas fa-user-tie text-3xl text-gray-400 mb-2"></i>
                                                    <span class="font-semibold text-center">Profesional</span>
                                                    <span class="text-sm text-gray-500 text-center mt-1">Tim profesional</span>
                                                </label>
                                                <label class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-colors">
                                                    <input type="radio" name="planting-method" value="community" class="hidden">
                                                    <i class="fas fa-hands-helping text-3xl text-gray-400 mb-2"></i>
                                                    <span class="font-semibold text-center">Komunitas</span>
                                                    <span class="text-sm text-gray-500 text-center mt-1">Komunitas lokal</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Step 3: Target & Timeline -->
                                <div class="step-content" data-step="3">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Target & Timeline</h2>
                                    
                                    <div class="space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="form-group">
                                                <label for="target-trees" class="form-label required">Target Jumlah Pohon</label>
                                                <input type="number" id="target-trees" class="form-input" placeholder="Contoh: 1000" min="10" required>
                                                <div class="error-message">Target pohon harus diisi (minimal 10 pohon)</div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="tree-price" class="form-label required">Biaya per Pohon (Rp)</label>
                                                <input type="number" id="tree-price" class="form-input" placeholder="Contoh: 25000" min="5000" required>
                                                <div class="error-message">Biaya per pohon harus diisi (minimal Rp 5.000)</div>
                                                <div class="form-help">Termasuk biaya bibit, penanaman, dan perawatan</div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="campaign-duration" class="form-label required">Durasi Kampanye (hari)</label>
                                            <input type="number" id="campaign-duration" class="form-input" placeholder="Contoh: 30" min="7" max="365" required>
                                            <div class="error-message">Durasi kampanye harus diisi (7-365 hari)</div>
                                            <div class="form-help">Kampanye dapat berlangsung 7 hari hingga 1 tahun</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="planting-date" class="form-label required">Perkiraan Tanggal Penanaman</label>
                                            <input type="date" id="planting-date" class="form-input" required>
                                            <div class="error-message">Tanggal penanaman harus diisi</div>
                                            <div class="form-help">Penanaman akan dilakukan setelah kampanye berakhir</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Update untuk Donatur</label>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                                                    <input type="checkbox" name="updates" value="progress" class="mr-3" checked>
                                                    <span>Update progres</span>
                                                </label>
                                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                                                    <input type="checkbox" name="updates" value="photos" class="mr-3" checked>
                                                    <span>Foto lokasi</span>
                                                </label>
                                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                                                    <input type="checkbox" name="updates" value="impact" class="mr-3">
                                                    <span>Laporan dampak</span>
                                                </label>
                                            </div>
                                            <div class="form-help">Donatur akan menerima update sesuai pilihan Anda</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Step 4: Preview -->
                                <div class="step-content" data-step="4">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Pratinjau Kampanye</h2>
                                    
                                    <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                                        <div id="preview-content">
                                            <div class="text-center py-8 text-gray-500">
                                                <i class="fas fa-spinner fa-spin text-4xl mb-4"></i>
                                                <p>Memuat pratinjau...</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-green-50 transition-colors">
                                            <input type="checkbox" id="terms-agreement" class="mr-3 mt-1" required>
                                            <span>Saya menyetujui <a href="#" class="text-secondary hover:underline font-semibold">Syarat dan Ketentuan</a> serta <a href="#" class="text-secondary hover:underline font-semibold">Kebijakan Privasi</a> PohonUntukEsok</span>
                                        </label>
                                        <div class="error-message">Anda harus menyetujui syarat dan ketentuan</div>
                                    </div>
                                </div>
                                
                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <button type="button" id="prev-btn" class="btn btn-secondary" disabled>
                                        <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                                    </button>
                                    <button type="button" id="next-btn" class="btn btn-primary shimmer-btn">
                                        Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                    <button type="submit" id="submit-btn" class="btn btn-primary shimmer-btn">
                                        <i class="fas fa-paper-plane mr-2"></i> Kirim Kampanye
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-br from-primary to-green-700 text-white">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-2xl mx-auto">
                    <h2 class="text-4xl font-bold mb-6">Butuh Bantuan?</h2>
                    <p class="text-xl mb-8 opacity-90">
                        Tim kami siap membantu Anda dalam membuat kampanye yang sukses dan berdampak bagi lingkungan.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="#" class="px-8 py-4 bg-white text-primary font-bold rounded-xl hover:bg-gray-100 transition-all hover-zoom shimmer-btn">
                            <i class="fas fa-envelope mr-2"></i> Hubungi Kami
                        </a>
                        <a href="#" class="px-8 py-4 border-2 border-white rounded-xl hover:bg-white hover:text-primary transition-all hover-zoom">
                            <i class="fas fa-question-circle mr-2"></i> Panduan Kampanye
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- About -->
                <div data-aos="fade-up" data-aos-delay="100">
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
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="200">
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
                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-lg font-bold mb-4">Program Kami</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Donasi Pohon</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Relawan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                    class="fas fa-chevron-right text-xs mr-2"></i> Edukasi Lingkungan</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div data-aos="fade-up" data-aos-delay="400">
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

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });

        // Mobile Menu Toggle
        const burgerButton = document.getElementById('burger-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
        const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');

        burgerButton.addEventListener('click', () => {
            burgerButton.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        mobileDropdownBtn.addEventListener('click', () => {
            mobileDropdownMenu.classList.toggle('show');
            const icon = mobileDropdownBtn.querySelector('i.fa-chevron-down');
            icon.classList.toggle('rotate-180');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                burgerButton.classList.remove('active');
                mobileMenu.classList.remove('active');
                mobileDropdownMenu.classList.remove('show');
                const icon = mobileDropdownBtn.querySelector('i.fa-chevron-down');
                icon.classList.remove('rotate-180');
            });
        });

        // Campaign Form Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('campaign-form');
            const steps = document.querySelectorAll('.step');
            const stepContents = document.querySelectorAll('.step-content');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            let currentStep = 1;

            // Image Preview
            const campaignImage = document.getElementById('campaign-image');
            const imagePreview = document.getElementById('image-preview');
            
            campaignImage.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Update Steps
            function updateSteps() {
                const stepContainers = document.querySelectorAll('.step-container');
                
                stepContainers.forEach((container, index) => {
                    const step = container.querySelector('.step');
                    const stepLabel = container.querySelector('.step-label');
                    
                    if (index + 1 < currentStep) {
                        step.classList.add('completed');
                        step.classList.remove('active');
                        stepLabel.classList.add('completed');
                        stepLabel.classList.remove('active');
                    } else if (index + 1 === currentStep) {
                        step.classList.add('active');
                        step.classList.remove('completed');
                        stepLabel.classList.add('active');
                        stepLabel.classList.remove('completed');
                    } else {
                        step.classList.remove('active', 'completed');
                        stepLabel.classList.remove('active', 'completed');
                    }
                });

                stepContents.forEach(content => {
                    if (parseInt(content.dataset.step) === currentStep) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });

                // Update buttons
                prevBtn.disabled = currentStep === 1;
                
                if (currentStep === stepContainers.length) {
                    nextBtn.classList.add('hidden');
                    submitBtn.classList.remove('hidden');
                    generatePreview();
                } else {
                    nextBtn.classList.remove('hidden');
                    submitBtn.classList.add('hidden');
                }
            }

            // Navigation
            nextBtn.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    updateSteps();
                }
            });

            prevBtn.addEventListener('click', function() {
                currentStep--;
                updateSteps();
            });

            // Form Validation
            function validateStep(step) {
                let isValid = true;
                
                // Basic validation for required fields in current step
                const currentStepContent = document.querySelector(`.step-content[data-step="${step}"]`);
                const requiredFields = currentStepContent.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('error');
                    } else {
                        field.classList.remove('error');
                    }
                    
                    // Special validation for file inputs
                    if (field.type === 'file' && field.files.length === 0) {
                        isValid = false;
                        field.classList.add('error');
                    }
                });
                
                return isValid;
            }

            // Generate Preview
            function generatePreview() {
                const previewContent = document.getElementById('preview-content');
                
                // Get form values
                const title = document.getElementById('campaign-title').value;
                const category = document.getElementById('campaign-category').value;
                const location = document.getElementById('campaign-location').value;
                const description = document.getElementById('campaign-description').value;
                const treeType = document.getElementById('tree-type').value;
                const targetTrees = document.getElementById('target-trees').value;
                const treePrice = document.getElementById('tree-price').value;
                const duration = document.getElementById('campaign-duration').value;
                const plantingDate = document.getElementById('planting-date').value;
                
                // Format date
                const formattedDate = new Date(plantingDate).toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                
                // Calculate total funding
                const totalFunding = (targetTrees * treePrice).toLocaleString('id-ID');
                
                // Generate preview HTML
                previewContent.innerHTML = `
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                        ${imagePreview.style.display !== 'none' ? 
                            `<img src="${imagePreview.src}" alt="${title}" class="w-full h-48 object-cover">` : 
                            '<div class="w-full h-48 bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center"><i class="fas fa-tree text-6xl text-green-300"></i></div>'
                        }
                        <div class="p-6">
                            <span class="inline-block category-badge text-white text-xs px-3 py-1 rounded-full mb-3">${getCategoryName(category)}</span>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">${title}</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">${description.substring(0, 150)}...</p>
                            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                                    <span>${location}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-tree text-green-600 mr-2"></i>
                                    <span>${treeType}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-bullseye text-green-600 mr-2"></i>
                                    <span>${targetTrees} pohon</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-clock text-green-600 mr-2"></i>
                                    <span>${duration} hari</span>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xl font-bold text-green-700">Rp ${totalFunding}</span>
                                    <span class="text-sm text-gray-500">Total dana dibutuhkan</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i> Perkiraan penanaman: ${formattedDate}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Helper function to get category name
            function getCategoryName(categoryValue) {
                const categories = {
                    'reboisasi': 'Reboisasi Hutan',
                    'mangrove': 'Penanaman Mangrove',
                    'perkotaan': 'Hijaukan Perkotaan',
                    'edukasi': 'Edukasi Lingkungan',
                    'lainnya': 'Lainnya'
                };
                return categories[categoryValue] || 'Lainnya';
            }

            // Form Submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (validateStep(currentStep)) {
                    // Show loading state
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
                    submitBtn.disabled = true;
                    
                    // Simulate API call
                    setTimeout(() => {
                        // Show success message
                        alert('Kampanye berhasil dibuat! Tim kami akan meninjau kampanye Anda dalam 1-2 hari kerja.');
                        
                        // Reset form
                        form.reset();
                        currentStep = 1;
                        updateSteps();
                        imagePreview.style.display = 'none';
                        
                        // Reset button
                        submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim Kampanye';
                        submitBtn.disabled = false;
                    }, 2000);
                }
            });

            // Initialize steps
            updateSteps();
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('main-nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
                nav.style.backgroundColor = 'rgba(45, 79, 43, 0.95)';
            } else {
                nav.classList.remove('shadow-lg');
                nav.style.backgroundColor = '';
            }
        });

        // Ripple effect for buttons
        document.querySelectorAll('.ripple-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Initialize GSAP
        gsap.registerPlugin(ScrollTrigger);
    </script>
</body>
</html>