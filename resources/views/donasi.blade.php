<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Pohon - PohonUntukEsok</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
                        'fade-in': 'fadeIn 0.5s ease-in',
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
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

        .read-more-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .read-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(45, 79, 43, 0.2);
        }

        /* Mobile Menu Styles - Simplified */
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

        /* Progress Bar */
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

        /* Impact Calculator */
        .impact-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .impact-card:hover {
            transform: translateY(-2px);
        }

        /* Donation Form Styling */
        .donation-option {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .donation-option:hover {
            border-color: #81C784;
        }

        .donation-option.selected {
            border-color: #2D4F2B;
            background-color: #f9fafb;
        }

        /* Optimized animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Loading states */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 via-white to-green-50 font-sans antialiased text-gray-800 overflow-x-hidden">
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
            <div class="text-center max-w-4xl mx-auto fade-in-up">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                    <i class="fas fa-hand-holding-heart text-accent"></i>
                    <span class="text-white font-semibold">Donasi Pohon Untuk Masa Depan</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Donasi Pohon
                    <span class="block text-accent">Untuk Masa Depan</span>
                </h1>
                
                <p class="text-xl text-white/90 mb-12 leading-relaxed">
                    Setiap donasi Anda membantu menanam pohon dan memulihkan ekosistem di seluruh Indonesia. 
                    Bersama-sama kita bisa menciptakan perubahan nyata untuk bumi yang lebih sehat.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#donation-form"
                        class="read-more-btn px-8 py-4 bg-gradient-to-r from-accent to-yellow-600 text-white rounded-xl font-semibold flex items-center justify-center">
                        <i class="fas fa-seedling mr-3"></i>
                        Donasi Sekarang
                    </a>
                    <a href="#impact"
                        class="px-8 py-4 border-2 border-white text-white rounded-xl font-semibold hover:bg-white hover:text-primary transition-all flex items-center justify-center">
                        <i class="fas fa-chart-line mr-3"></i>
                        Lihat Dampak
                    </a>
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

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-5xl mx-auto">
                <div class="card-modern bg-white rounded-2xl shadow-lg p-8 text-center" data-aos="fade-up">
                    <div class="text-4xl font-bold text-accent mb-2" id="total-trees">125,847</div>
                    <div class="text-gray-600">Pohon Tertanam</div>
                </div>
                <div class="card-modern bg-white rounded-2xl shadow-lg p-8 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl font-bold text-accent mb-2">12</div>
                    <div class="text-gray-600">Provinsi</div>
                </div>
                <div class="card-modern bg-white rounded-2xl shadow-lg p-8 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl font-bold text-accent mb-2">5,000+</div>
                    <div class="text-gray-600">Donatur</div>
                </div>
                <div class="card-modern bg-white rounded-2xl shadow-lg p-8 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl font-bold text-accent mb-2">50+</div>
                    <div class="text-gray-600">Kampanye</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Calculator -->
    <section id="impact" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary mb-4 relative inline-block">
                    Hitung Dampak Donasi Anda
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-accent mt-2"></span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Setiap pohon yang Anda tanam memberikan manfaat nyata bagi lingkungan dan masyarakat
                </p>
            </div>

            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="card-modern bg-white rounded-2xl shadow-lg p-8" data-aos="fade-right">
                    <h3 class="text-2xl font-bold text-primary mb-6">Kalkulator Dampak</h3>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Jumlah Pohon yang Ingin Didonasikan</label>
                        <div class="flex items-center">
                            <button id="decrease-trees" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-l-lg hover:bg-gray-300">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="tree-count" value="10" min="1" max="1000" 
                                   class="w-full text-center py-2 border-y border-gray-300">
                            <button id="increase-trees" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-r-lg hover:bg-gray-300">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Jenis Pohon</label>
                        <select id="tree-type" class="w-full p-3 border border-gray-300 rounded-lg">
                            <option value="mangrove">Mangrove (Rp 25.000/pohon)</option>
                            <option value="fruit">Pohon Buah (Rp 15.000/pohon)</option>
                            <option value="hardwood">Pohon Kayu Keras (Rp 20.000/pohon)</option>
                            <option value="bamboo">Bambu (Rp 10.000/pohon)</option>
                        </select>
                    </div>

                    <div class="bg-lightbg p-6 rounded-xl mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold">Total Donasi:</span>
                            <span id="total-donation" class="text-2xl font-bold text-primary">Rp 250.000</span>
                        </div>
                        <div class="text-sm text-gray-600">*Harga sudah termasuk perawatan 1 tahun</div>
                    </div>

                    <button class="w-full read-more-btn px-6 py-4 bg-gradient-to-r from-primary to-green-700 text-white rounded-xl font-semibold">
                        <i class="fas fa-seedling mr-2"></i> Lanjutkan Donasi
                    </button>
                </div>

                <div class="card-modern bg-white rounded-2xl shadow-lg p-8" data-aos="fade-left">
                    <h3 class="text-2xl font-bold text-primary mb-6">Dampak Lingkungan</h3>
                    
                    <div class="space-y-6">
                        <div class="impact-card">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-wind text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-lg" id="co2-absorption">250 kg</div>
                                    <div class="text-gray-600">Penyerapan CO2/tahun</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">Setara dengan emisi kendaraan 1.000 km</div>
                        </div>

                        <div class="impact-card">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-tint text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-lg" id="water-retention">5.000 liter</div>
                                    <div class="text-gray-600">Penyimpanan Air/tahun</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">Mencegah banjir & kekeringan</div>
                        </div>

                        <div class="impact-card">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-paw text-yellow-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-lg" id="habitat-creation">3</div>
                                    <div class="text-gray-600">Habitat Baru Terbentuk</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">Untuk satwa lokal</div>
                        </div>

                        <div class="impact-card">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-users text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-lg" id="jobs-created">2</div>
                                    <div class="text-gray-600">Lapangan Kerja</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">Untuk masyarakat lokal</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Options -->
    <section id="donation-form" class="py-20 bg-gradient-to-br from-green-50 to-emerald-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary mb-4 relative inline-block">
                    Pilih Paket Donasi
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-accent mt-2"></span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pilih paket donasi yang sesuai dengan keinginan Anda atau tentukan jumlah sendiri
                </p>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="card-modern bg-white rounded-2xl shadow-lg p-8" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-seedling text-3xl text-primary"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-primary mb-2">Paket Pemula</h3>
                            <div class="text-3xl font-bold text-accent mb-2">Rp 100.000</div>
                            <div class="text-gray-600">5 Pohon Tertanam</div>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Sertifikat Digital</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Update Progress 6 Bulan</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Lokasi Penanaman</span>
                            </li>
                        </ul>
                        <button class="w-full px-6 py-3 bg-primary text-white rounded-xl hover:bg-green-700 transition-colors">
                            Pilih Paket Ini
                        </button>
                    </div>

                    <div class="card-modern bg-white rounded-2xl shadow-lg p-8 border-2 border-accent" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-tree text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-primary mb-2">Paket Peduli</h3>
                            <div class="text-3xl font-bold text-accent mb-2">Rp 250.000</div>
                            <div class="text-gray-600">10 Pohon Tertanam</div>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Semua manfaat Paket Pemula</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Update Progress Bulanan</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Foto Pohon Berkala</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Laporan Dampak Lengkap</span>
                            </li>
                        </ul>
                        <button class="w-full read-more-btn px-6 py-3 bg-gradient-to-r from-accent to-yellow-600 text-white rounded-xl font-semibold">
                            Paket Terpopuler
                        </button>
                    </div>

                    <div class="card-modern bg-white rounded-2xl shadow-lg p-8" data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-forest text-3xl text-primary"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-primary mb-2">Paket Spesial</h3>
                            <div class="text-3xl font-bold text-accent mb-2">Rp 500.000</div>
                            <div class="text-gray-600">25 Pohon Tertanam</div>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Semua manfaat Paket Peduli</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Sertifikat Premium</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Video Progress Khusus</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Nama di Wall of Fame</span>
                            </li>
                        </ul>
                        <button class="w-full px-6 py-3 bg-primary text-white rounded-xl hover:bg-green-700 transition-colors">
                            Pilih Paket Ini
                        </button>
                    </div>
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

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS with faster settings
        AOS.init({
            duration: 600,
            once: true,
            offset: 50,
            delay: 0
        });

        // Show content immediately
        document.addEventListener('DOMContentLoaded', function() {
            // Make hero section visible immediately
            const heroSection = document.querySelector('.fade-in-up');
            if (heroSection) {
                heroSection.classList.add('visible');
            }

            // Load other sections progressively
            setTimeout(() => {
                const sections = document.querySelectorAll('section');
                sections.forEach((section, index) => {
                    setTimeout(() => {
                        section.style.opacity = '1';
                        section.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            }, 100);
        });

        // Mobile Menu Toggle - Simplified
        const burgerButton = document.getElementById('burger-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
        const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');

        if (burgerButton) {
            burgerButton.addEventListener('click', () => {
                burgerButton.classList.toggle('active');
                mobileMenu.classList.toggle('active');
                document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
            });
        }

        if (mobileDropdownBtn) {
            mobileDropdownBtn.addEventListener('click', () => {
                mobileDropdownMenu.classList.toggle('show');
            });
        }

        // Close mobile menu when clicking on links
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                burgerButton.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        // Impact Calculator - Optimized
        const treeCountInput = document.getElementById('tree-count');
        const decreaseTreesBtn = document.getElementById('decrease-trees');
        const increaseTreesBtn = document.getElementById('increase-trees');
        const treeTypeSelect = document.getElementById('tree-type');
        const totalDonationElement = document.getElementById('total-donation');
        const co2AbsorptionElement = document.getElementById('co2-absorption');
        const waterRetentionElement = document.getElementById('water-retention');
        const habitatCreationElement = document.getElementById('habitat-creation');
        const jobsCreatedElement = document.getElementById('jobs-created');

        const treePrices = {
            mangrove: 25000,
            fruit: 15000,
            hardwood: 20000,
            bamboo: 10000
        };

        function updateImpactCalculator() {
            const treeCount = parseInt(treeCountInput.value);
            const treeType = treeTypeSelect.value;
            const pricePerTree = treePrices[treeType];
            const totalDonation = treeCount * pricePerTree;
            
            // Format currency
            totalDonationElement.textContent = `Rp ${totalDonation.toLocaleString('id-ID')}`;
            
            // Update impact metrics
            co2AbsorptionElement.textContent = `${(treeCount * 25).toLocaleString('id-ID')} kg`;
            waterRetentionElement.textContent = `${(treeCount * 500).toLocaleString('id-ID')} liter`;
            habitatCreationElement.textContent = Math.max(1, Math.floor(treeCount / 10));
            jobsCreatedElement.textContent = Math.max(1, Math.floor(treeCount / 15));
        }

        if (decreaseTreesBtn && increaseTreesBtn) {
            decreaseTreesBtn.addEventListener('click', () => {
                let currentValue = parseInt(treeCountInput.value);
                if (currentValue > 1) {
                    treeCountInput.value = currentValue - 1;
                    updateImpactCalculator();
                }
            });

            increaseTreesBtn.addEventListener('click', () => {
                let currentValue = parseInt(treeCountInput.value);
                if (currentValue < 1000) {
                    treeCountInput.value = currentValue + 1;
                    updateImpactCalculator();
                }
            });

            treeCountInput.addEventListener('input', updateImpactCalculator);
            treeTypeSelect.addEventListener('change', updateImpactCalculator);
            
            // Initialize calculator
            updateImpactCalculator();
        }

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

        // Smooth scrolling for anchor links
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

        // Optimized intersection observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -10px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe only critical elements
        document.querySelectorAll('.card-modern').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>