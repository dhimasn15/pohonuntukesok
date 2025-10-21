<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - PohonUntukEsok</title>
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

        /* Hero Section */
        .hero-about {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
            min-height: 50vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 10;
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

        /* Section Styling */
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
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

        .section-title.center::after {
            left: 50%;
            transform: translateX(-50%);
        }

        /* Card Styling */
        .feature-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #2D4F2B, #3d6b3a);
        }

        /* Team Card */
        .team-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        /* Timeline */
        .timeline-item {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #2D4F2B;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #81C784;
        }

        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 1.5rem;
            height: calc(100% - 1rem);
            width: 2px;
            background: #81C784;
        }

        /* Stats */
        .stats-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        /* CTA Button */
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

        /* Background Patterns */
        .leaf-pattern {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232d4f2b' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

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
    </style>
</head>

<body class="font-sans antialiased text-gray-800 overflow-x-hidden">
    <!-- Include Navigation -->
    @include('layouts.navigation')
    
    <!-- Include Auth Modal -->
    @include('components.auth-modal')

    <!-- Hero Section -->
    <section class="hero-about pt-20">
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
            <div class="hero-content max-w-4xl mx-auto text-center text-white">
                <div data-aos="fade-down" class="mb-8">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Tentang <span class="text-accent">PohonUntukEsok</span>
                    </h1>
                    <p class="text-xl md:text-2xl opacity-95 leading-relaxed">
                        Menghijaukan Indonesia melalui gerakan penanaman pohon dan edukasi lingkungan untuk masa depan yang berkelanjutan
                    </p>
                </div>
                
                <div data-aos="fade-up" data-aos-delay="300" class="flex flex-wrap justify-center gap-4">
                    <a href="#our-story" class="cta-button px-8 py-4 rounded-xl text-white font-semibold flex items-center">
                        <i class="fas fa-book-reader mr-2"></i>
                        Cerita Kami
                    </a>
                    <a href="#our-mission" class="px-8 py-4 border-2 border-white rounded-xl text-white font-semibold hover:bg-white hover:text-primary transition-all duration-300 flex items-center">
                        <i class="fas fa-bullseye mr-2"></i>
                        Misi & Visi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl md:text-4xl font-bold text-primary mb-2">...+</div>
                    <div class="text-gray-600">Pohon Tertanam</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl md:text-4xl font-bold text-primary mb-2">..</div>
                    <div class="text-gray-600">Provinsi</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl md:text-4xl font-bold text-primary mb-2">..+</div>
                    <div class="text-gray-600">Relawan</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-3xl md:text-4xl font-bold text-primary mb-2">..+</div>
                    <div class="text-gray-600">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section id="our-story" class="py-20 bg-gray-50 leaf-pattern">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <h2 class="section-title text-3xl md:text-4xl font-bold text-primary">
                        Cerita Kami
                    </h2>
                    <div class="space-y-6 text-lg text-gray-600">
                        <p>
                            <strong>PohonUntukEsok</strong> lahir dari keprihatinan mendalam akan dampak perubahan iklim dan deforestasi di Indonesia. 
                            Didirikan pada tahun 2025, kami memulai perjalanan dengan tekad untuk menciptakan perubahan nyata melalui gerakan penanaman pohon 
                            yang melibatkan seluruh lapisan masyarakat.
                        </p>
                        <p>
                            Proyek <strong>PohonUntukEsok</strong> diharapkan memberikan berbagai manfaat nyata bagi lingkungan dan masyarakat. Secara ekologis, proyek ini dapat membantu menambah ruang hijau dan mengurangi polusi udara di wilayah perkotaan. Dari sisi sosial, proyek ini mendorong partisipasi aktif masyarakat dalam pelestarian lingkungan serta meningkatkan kesadaran akan pentingnya penghijauan.
                        </p>
                        <div class="bg-lightbg p-6 rounded-xl border-l-4 border-accent">
                            <p class="text-primary font-medium italic">
                                <i class="fas fa-quote-left text-2xl opacity-50 mr-2"></i>
                                Setiap pohon yang ditanam adalah investasi untuk masa depan. Kami percaya bahwa perubahan
                                besar dimulai dari langkah kecil.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800" 
                             alt="Kegiatan Konservasi" 
                             class="rounded-2xl shadow-xl w-full">
                        <div class="absolute -bottom-6 -right-6 bg-accent text-primary px-6 py-4 rounded-xl shadow-lg">
                            <div class="text-2xl font-bold">125K+</div>
                            <div class="text-sm">Pohon Tertanam</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section id="our-mission" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="section-title center text-3xl md:text-4xl font-bold text-primary">
                    Misi & Visi Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami berkomitmen untuk menciptakan dampak nyata bagi lingkungan dan masyarakat melalui aksi nyata
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission -->
                <div class="feature-card p-8" data-aos="fade-right">
                    <div class="flex items-center mb-6">
                        <div class="bg-primary text-white p-3 rounded-full mr-4">
                            <i class="fas fa-bullseye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary">Misi Kami</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Mengembangkan platform digital yang transparan, mudah diakses, dan mendukung kegiatan penghijauan kota.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Menghubungkan donatur, petani bibit, pengelola lahan, dan komunitas dalam sistem kolaboratif berbasis teknologi.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Menyediakan fitur pemantauan dan pelaporan digital agar setiap aksi tanam dapat dipantau secara publik.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Mendorong partisipasi masyarakat melalui donasi, aksi lapangan, dan kampanye lingkungan yang berkelanjutan.</span>
                        </li>
                    </ul>
                </div>

                <!-- Vision -->
                <div class="feature-card p-8" data-aos="fade-left">
                    <div class="flex items-center mb-6">
                        <div class="bg-accent text-primary p-3 rounded-full mr-4">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary">Visi Kami</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                            <span>Mewujudkan kota hijau yang berkelanjutan melalui kolaborasi digital dan aksi nyata masyarakat.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                            <span>Menjadi platform donasi dan penghijauan terpercaya yang menghubungkan semua pihak dalam satu ekosistem hijau.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                            <span>Menumbuhkan kesadaran lingkungan dengan menghadirkan solusi teknologi yang transparan dan berdampak.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                            <span>Menjadikan gerakan menanam pohon sebagai gaya hidup positif dan edukatif bagi generasi masa depan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="section-title center text-3xl md:text-4xl font-bold text-primary">
                    Nilai-Nilai Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Prinsip-prinsip yang menjadi pedoman dalam setiap langkah kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card p-8 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-hand-holding-heart text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-4">Integritas</h3>
                    <p class="text-gray-600">
                        Kami menjaga transparansi dalam setiap kegiatan dan penggunaan dana donasi. Setiap pohon yang ditanam dilaporkan dengan akurat.
                    </p>
                </div>

                <div class="feature-card p-8 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-4">Kolaborasi</h3>
                    <p class="text-gray-600">
                        Kami percaya bahwa perubahan besar hanya bisa dicapai melalui kerjasama dengan semua pihak - masyarakat, pemerintah, dan swasta.
                    </p>
                </div>

                <div class="feature-card p-8 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-seedling text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-4">Keberlanjutan</h3>
                    <p class="text-gray-600">
                        Setiap program dirancang untuk memberikan dampak jangka panjang, dengan pemantauan dan perawatan yang berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="section-title center text-3xl md:text-4xl font-bold text-primary">
                    Tim Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kenali orang-orang berdedikasi di balik PohonUntukEsok
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="team-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/10.png') }}" 
                             alt="Founder" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">Firah Dzahabiyyah</h3>
                        <p class="text-accent mb-4">CEO</p>
                        <p class="text-gray-600 text-sm mb-4">
                            NIM: 2023081050
                        </p>
                        <div class="flex space-x-3">
                           <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                                <i class="fab fa-instagram text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/11.png') }}"
                             alt="Program Manager" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">Dhimas Nurhidayat</h3>
                        <p class="text-accent mb-4">Tech Lead</p>
                        <p class="text-gray-600 text-sm mb-4">
                            NIM: 2023071066
                        </p>
                        <div class="flex space-x-3">
                           
                            <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                                <i class="fab fa-instagram text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/12.png') }}"
                             alt="Tech Lead" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">Leonardo</h3>
                        <p class="text-accent mb-4">CMO</p>
                        <p class="text-gray-600 text-sm mb-4">
                            NIM: 2023071078
                        </p>
                        <div class="flex space-x-3">
                           <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                                <i class="fab fa-instagram text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-primary text-white">
        <div class="container mx-auto px-4 text-center">
            <div data-aos="zoom-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Membuat Perubahan?</h2>
                <p class="text-xl mb-8 max-w-3xl mx-auto">
                    Bergabunglah dengan kami dalam misi menghijaukan Indonesia. Setiap tindakan kecil Anda membuat
                    perbedaan besar.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#"
                        class="cta-button px-8 py-4 rounded-xl text-white font-semibold inline-flex items-center">
                        <i class="fas fa-hand-holding-heart mr-2"></i>
                        Donasi Sekarang
                    </a>
                    <a href="#"
                        class="px-8 py-4 border-2 border-white rounded-xl text-white font-semibold hover:bg-white hover:text-primary transition-all duration-300 inline-flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        Hubungi Kami
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
        class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 z-40 hover:bg-green-700">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });

            // Mobile menu functionality
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
                const chevron = mobileDropdownBtn?.querySelector('.fa-chevron-down');
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
        });
    </script>
</body>
</html>