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

        /* Tree Type Selection */
        .tree-type-option {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .tree-type-option:hover {
            border-color: #81C784;
            transform: translateY(-2px);
        }

        .tree-type-option.selected {
            border-color: #2D4F2B;
            background: linear-gradient(135deg, #f8fff8 0%, #f0f9f0 100%);
            box-shadow: 0 4px 15px rgba(45, 79, 43, 0.1);
        }

        .tree-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 1.5rem;
        }

        .mangrove-icon { background: #dcfce7; color: #16a34a; }
        .fruit-icon { background: #fef3c7; color: #d97706; }
        .hardwood-icon { background: #ddd6fe; color: #7c3aed; }
        .bamboo-icon { background: #bbf7d0; color: #15803d; }

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
                    <a href="#tree-selection"
                        class="read-more-btn px-8 py-4 bg-gradient-to-r from-accent to-yellow-600 text-white rounded-xl font-semibold flex items-center justify-center">
                        <i class="fas fa-seedling mr-3"></i>
                        Pilih Jenis Pohon
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

    <!-- Tree Selection Section -->
    <section id="tree-selection" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary mb-4 relative inline-block">
                    Pilih Jenis Pohon
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-accent mt-2"></span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pilih jenis pohon yang ingin Anda donasikan, lalu temukan kampanye yang sesuai
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <!-- Mangrove Option -->
                    <div class="tree-type-option" data-tree-type="mangrove" data-aos="fade-up" data-aos-delay="100">
                        <div class="tree-icon mangrove-icon">
                            <i class="fas fa-water"></i>
                        </div>
                        <h3 class="text-lg font-bold text-primary mb-2">Mangrove</h3>
                        <p class="text-sm text-gray-600 mb-3">Pelindung pantai & ekosistem laut</p>
                        <div class="text-accent font-bold">Rp 25.000/pohon</div>
                    </div>

                    <!-- Fruit Tree Option -->
                    <div class="tree-type-option" data-tree-type="fruit" data-aos="fade-up" data-aos-delay="200">
                        <div class="tree-icon fruit-icon">
                            <i class="fas fa-apple-alt"></i>
                        </div>
                        <h3 class="text-lg font-bold text-primary mb-2">Pohon Buah</h3>
                        <p class="text-sm text-gray-600 mb-3">Sumber makanan & ekonomi</p>
                        <div class="text-accent font-bold">Rp 15.000/pohon</div>
                    </div>

                    <!-- Hardwood Option -->
                    <div class="tree-type-option" data-tree-type="hardwood" data-aos="fade-up" data-aos-delay="300">
                        <div class="tree-icon hardwood-icon">
                            <i class="fas fa-tree"></i>
                        </div>
                        <h3 class="text-lg font-bold text-primary mb-2">Kayu Keras</h3>
                        <p class="text-sm text-gray-600 mb-3">Konservasi hutan & biodiversitas</p>
                        <div class="text-accent font-bold">Rp 20.000/pohon</div>
                    </div>

                    <!-- Bamboo Option -->
                    <div class="tree-type-option" data-tree-type="bamboo" data-aos="fade-up" data-aos-delay="400">
                        <div class="tree-icon bamboo-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="text-lg font-bold text-primary mb-2">Bambu</h3>
                        <p class="text-sm text-gray-600 mb-3">Pertumbuhan cepat & multifungsi</p>
                        <div class="text-accent font-bold">Rp 10.000/pohon</div>
                    </div>
                </div>

                <!-- Selected Tree Info -->
                <div id="selected-tree-info" class="hidden card-modern bg-white rounded-2xl shadow-lg p-8" data-aos="fade-up">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-primary mb-4">Anda Memilih: <span id="selected-tree-name">Mangrove</span></h3>
                        <p class="text-gray-600 mb-6" id="selected-tree-description">
                            Pohon mangrove membantu melindungi garis pantai dari abrasi dan menjadi habitat penting bagi biota laut.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <button id="view-campaigns-btn" 
                                    class="read-more-btn px-8 py-4 bg-gradient-to-r from-primary to-green-700 text-white rounded-xl font-semibold flex items-center justify-center">
                                <i class="fas fa-list mr-3"></i>
                                Lihat Kampanye Tersedia
                            </button>
                            <button id="change-selection" 
                                    class="px-6 py-4 border-2 border-primary text-primary rounded-xl font-semibold hover:bg-primary hover:text-white transition-all">
                                <i class="fas fa-redo mr-2"></i>
                                Ganti Pilihan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Calculator -->
    <section id="impact" class="py-20 bg-gradient-to-br from-green-50 to-emerald-50">
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

                    <button id="calculate-impact-btn" class="w-full read-more-btn px-6 py-4 bg-gradient-to-r from-primary to-green-700 text-white rounded-xl font-semibold">
                        <i class="fas fa-calculator mr-2"></i> Hitung Dampak
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

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

        // Tree Type Selection System
        let selectedTreeType = null;

        const treeData = {
            mangrove: {
                name: 'Mangrove',
                description: 'Pohon mangrove membantu melindungi garis pantai dari abrasi dan menjadi habitat penting bagi biota laut. Cocok untuk kampanye konservasi pesisir.',
                price: 25000,
                route: '{{ route("kampanye") }}?type=mangrove'
            },
            fruit: {
                name: 'Pohon Buah',
                description: 'Pohon buah memberikan manfaat ganda: konservasi lingkungan dan sumber makanan bagi masyarakat. Cocok untuk kampanye agroforestry.',
                price: 15000,
                route: '{{ route("kampanye") }}?type=fruit'
            },
            hardwood: {
                name: 'Pohon Kayu Keras',
                description: 'Pohon kayu keras penting untuk restorasi hutan dan konservasi biodiversitas. Cocok untuk kampanye reboisasi hutan.',
                price: 20000,
                route: '{{ route("kampanye") }}?type=hardwood'
            },
            bamboo: {
                name: 'Bambu',
                description: 'Bambu tumbuh cepat dan multifungsi, cocok untuk konservasi tanah dan ekonomi berkelanjutan. Cocok untuk kampanye penghijauan cepat.',
                price: 10000,
                route: '{{ route("kampanye") }}?type=bamboo'
            }
        };

        // Tree Type Selection
        document.querySelectorAll('.tree-type-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                document.querySelectorAll('.tree-type-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Get selected tree type
                selectedTreeType = this.dataset.treeType;
                
                // Update selected tree info
                const treeInfo = treeData[selectedTreeType];
                document.getElementById('selected-tree-name').textContent = treeInfo.name;
                document.getElementById('selected-tree-description').textContent = treeInfo.description;
                
                // Show selected tree info section
                document.getElementById('selected-tree-info').classList.remove('hidden');
                
                // Scroll to selected tree info
                document.getElementById('selected-tree-info').scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        });

        // Change Selection Button
        document.getElementById('change-selection').addEventListener('click', function() {
            document.getElementById('selected-tree-info').classList.add('hidden');
            document.querySelectorAll('.tree-type-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            selectedTreeType = null;
        });

        // View Campaigns Button
        document.getElementById('view-campaigns-btn').addEventListener('click', function() {
            if (selectedTreeType) {
                const treeInfo = treeData[selectedTreeType];
                // Redirect to campaigns page with tree type filter
                window.location.href = treeInfo.route;
            }
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

        // Calculate Impact Button
        document.getElementById('calculate-impact-btn').addEventListener('click', function() {
            updateImpactCalculator();
            // Show impact section
            document.getElementById('impact').scrollIntoView({ 
                behavior: 'smooth',
                block: 'center'
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