<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - PohonUntukEsok</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-tittle.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-tittle.png') }}">
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
                        lightbg: '#FFF1CA',
                    }
                }
            }
        }
    </script>
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
        
        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
        }

        .profile-avatar {
            border: 4px solid white;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .tab-active {
            border-bottom: 3px solid var(--primary);
            color: var(--primary);
            font-weight: 600;
        }

        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .badge-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        }

        .edit-btn {
            background: linear-gradient(135deg, #FFAB00 0%, #FF9800 100%);
            box-shadow: 0 4px 15px rgba(255, 171, 0, 0.3);
            transition: all 0.3s ease;
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 171, 0, 0.4);
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
        }

        /* Table row animation */
        .table-row {
            transition: all 0.2s ease;
        }
        .table-row:hover {
            background-color: #f9fafb;
        }

        .create-post-btn {
            background: linear-gradient(135deg, #FFAB00 0%, #FF9800 100%);
            box-shadow: 0 4px 15px rgba(255, 171, 0, 0.3);
            transition: all 0.3s ease;
        }

        .create-post-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 171, 0, 0.4);
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
        }

        /* Mobile responsive improvements */
        @media (max-width: 768px) {
            .mobile-stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .mobile-table-container {
                overflow-x: auto;
            }
            .mobile-tab-grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 0;
            }
            .mobile-tab-item {
                text-align: center;
                padding: 1rem 0.5rem;
                border-bottom: 3px solid transparent;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .mobile-tab-item:hover {
                background-color: #f9fafb;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50">
    @include('layouts.navigation')
    @include('components.auth-modal')

    @php
        $user = auth()->user();

        // Ensure we always compute authoritative numbers from the DB so the view
        // matches what's stored (don't rely solely on a controller-provided collection).
        try {
            // All posts by the user (for listing) - FIX: Use proper pagination
            if (!isset($userPosts)) {
                // Use pagination for the posts tab so the view shows pages and real data
                $userPostsPaginated = \App\Models\BlogPost::where('user_id', $user->id)->latest()->paginate(10);
                
                // For other parts of the page, use simple collection
                $userPosts = \App\Models\BlogPost::where('user_id', $user->id)->latest()->get();
            } else {
                // If $userPosts is already set from controller, create paginated version
                $userPostsPaginated = \App\Models\BlogPost::where('user_id', $user->id)->latest()->paginate(10);
            }

            // Total posts (any status)
            $totalPosts = \App\Models\BlogPost::where('user_id', $user->id)->count();

            // Total published posts (use scopePublished to require approval & published_at)
            $publishedPosts = \App\Models\BlogPost::where('user_id', $user->id)->published()->count();

            // Total views across published posts (only published content should count toward public views)
            $totalViews = \App\Models\BlogPost::where('user_id', $user->id)->published()->sum('view_count');

            // Popular posts — only published ones
            $popularUserPosts = \App\Models\BlogPost::where('user_id', $user->id)->published()->orderByDesc('view_count')->take(5)->get();

            // Recent activities: combine created & updated post events, newest first
            $createdEvents = \App\Models\BlogPost::where('user_id', $user->id)
                                ->select('title', 'created_at')
                                ->orderByDesc('created_at')
                                ->take(8)
                                ->get()
                                ->map(function($p){
                                    return (object)[
                                        'description' => 'Membuat posting: '.($p->title ?? '—'),
                                        'created_at' => $p->created_at,
                                    ];
                                });

            $updatedEvents = \App\Models\BlogPost::where('user_id', $user->id)
                                ->select('title', 'updated_at')
                                ->whereColumn('updated_at', '!=', 'created_at')
                                ->orderByDesc('updated_at')
                                ->take(8)
                                ->get()
                                ->map(function($p){
                                    return (object)[
                                        'description' => 'Memperbarui posting: '.($p->title ?? '—'),
                                        'created_at' => $p->updated_at,
                                    ];
                                });

            // Merge and sort by date, then take the latest 8
            $recentActivities = $createdEvents->concat($updatedEvents)
                                ->sortByDesc('created_at')
                                ->values()
                                ->take(8);

        } catch (\Throwable $e) {
            // Fallbacks in case DB access fails for some reason
            if (!isset($userPosts)) {
                $userPosts = collect();
                $userPostsPaginated = collect();
            }
            $totalPosts = $userPosts->count();
            $publishedPosts = $userPosts->where('status', 'published')->count();
            $totalViews = $userPosts->sum('view_count');
            $popularUserPosts = $userPosts->sortByDesc('view_count')->take(5);
            $recentActivities = collect();
        }

        // Avatar source helper: check storage first, then raw value
        if (!isset($avatarSrc)) {
            try {
                $avatarUrl = $user->avatar ?? null;
                if ($avatarUrl && $avatarUrl !== 'null') {
                    if (filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
                        $avatarSrc = $avatarUrl;
                    } elseif (\Illuminate\Support\Facades\Storage::exists($avatarUrl)) {
                        $avatarSrc = \Illuminate\Support\Facades\Storage::url($avatarUrl);
                    } else {
                        $avatarSrc = $avatarUrl;
                    }
                } else {
                    $avatarSrc = null;
                }
            } catch (\Throwable $e) {
                $avatarSrc = null;
            }
        }
    @endphp

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 hero-gradient overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                    <i class="fas fa-user-circle text-accent"></i>
                    <span class="font-semibold">Profil Pengguna</span>
                </div>
                
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                    Profil Saya
                </h1>
                
                <p class="text-lg md:text-xl text-white/90 leading-relaxed">
                    Kelola informasi dan aktivitas akun Anda
                </p>
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
    <section class="py-8 md:py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center" data-aos="fade-up">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" data-aos="fade-up">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-semibold">Terjadi kesalahan:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 md:gap-8">
                    <!-- Sidebar Profil -->
                    <div class="lg:col-span-1" data-aos="fade-right">
                        <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 card-hover lg:sticky lg:top-24">
                            <!-- Avatar & Info -->
                            <div class="text-center mb-6">
                                <div class="relative inline-block mb-4">
                                    @php
                                        $avatarUrl = auth()->user()->avatar;
                                        if (!empty($avatarUrl) && $avatarUrl !== 'null') {
                                            if (filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
                                                $avatarSrc = $avatarUrl;
                                            } 
                                            elseif (strpos($avatarUrl, 'http') === false) {
                                                $avatarSrc = Storage::exists($avatarUrl) ? Storage::url($avatarUrl) : null;
                                            } else {
                                                $avatarSrc = $avatarUrl;
                                            }
                                        } else {
                                            $avatarSrc = null;
                                        }
                                    @endphp

                                    @if($avatarSrc)
                                        <img src="{{ $avatarSrc }}" 
                                             alt="{{ auth()->user()->name }}" 
                                             class="profile-avatar w-20 h-20 md:w-24 md:h-24 rounded-full mx-auto object-cover"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="profile-avatar w-20 h-20 md:w-24 md:h-24 bg-primary text-white rounded-full flex items-center justify-center mx-auto text-xl md:text-2xl font-bold hidden">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                    @else
                                        <div class="profile-avatar w-20 h-20 md:w-24 md:h-24 bg-primary text-white rounded-full flex items-center justify-center mx-auto text-xl md:text-2xl font-bold">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="absolute bottom-1 right-1 md:bottom-2 md:right-2 w-4 h-4 md:w-6 md:h-6 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-1">{{ auth()->user()->name }}</h2>
                                <p class="text-gray-600 text-xs md:text-sm mb-3 break-words">{{ auth()->user()->email }}</p>
                                <span class="inline-flex items-center px-2 md:px-3 py-1 rounded-full text-xs font-medium bg-primary text-white">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </div>

                            <!-- Stats -->
                            <div class="space-y-3 md:space-y-4 border-t border-gray-200 pt-4 md:pt-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm md:text-base">Bergabung</span>
                                    <span class="font-semibold text-gray-800 text-sm md:text-base">{{ auth()->user()->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm md:text-base">Postingan</span>
                                    <span class="font-semibold text-primary text-sm md:text-base">{{ $totalPosts ?? ($userPosts->count() ?? 0) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-sm md:text-base">Total Dilihat</span>
                                    <span class="font-semibold text-primary text-sm md:text-base">{{ number_format($totalViews ?? 0) }}</span>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="border-t border-gray-200 pt-4 md:pt-6 mt-4 md:mt-6">
                                <h3 class="font-semibold text-gray-800 mb-3 md:mb-4 text-sm md:text-base">Aksi Cepat</h3>
                                <div class="space-y-1 md:space-y-2">
                                    <a href="{{ route('user.blog.create') }}" 
                                       class="w-full flex items-center space-x-2 px-3 py-2 text-xs md:text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                        <i class="fas fa-plus text-primary text-xs md:text-sm"></i>
                                        <span>Buat Post Baru</span>
                                    </a>
                                    <a href="{{ route('user.blog.index') }}" 
                                       class="w-full flex items-center space-x-2 px-3 py-2 text-xs md:text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                        <i class="fas fa-newspaper text-primary text-xs md:text-sm"></i>
                                        <span>Postingan Saya</span>
                                    </a>
                                    <button onclick="openEditModal()" 
                                            class="w-full flex items-center space-x-2 px-3 py-2 text-xs md:text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                        <i class="fas fa-edit text-primary text-xs md:text-sm"></i>
                                        <span>Edit Profil</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="lg:col-span-3" data-aos="fade-left">
                        <!-- Mobile Friendly Tab Navigation - TANPA SLIDE -->
                        <div class="bg-white rounded-2xl shadow-lg mb-6 md:mb-8">
                            <div class="border-b border-gray-200">
                                <!-- Desktop Tabs -->
                                <nav class="hidden md:flex space-x-8 px-6">
                                    <button id="overview-tab-desktop" class="tab-active py-4 px-1 font-medium text-sm whitespace-nowrap">
                                        <i class="fas fa-chart-pie mr-2"></i>Overview
                                    </button>
                                    <button id="posts-tab-desktop" class="py-4 px-1 font-medium text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">
                                        <i class="fas fa-newspaper mr-2"></i>Postingan Saya
                                    </button>
                                    <button id="activity-tab-desktop" class="py-4 px-1 font-medium text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">
                                        <i class="fas fa-history mr-2"></i>Aktivitas
                                    </button>
                                </nav>

                                <!-- Mobile Tabs - Grid Layout -->
                                <nav class="md:hidden mobile-tab-grid">
                                    <button id="overview-tab-mobile" class="mobile-tab-item tab-active py-3 font-medium text-xs whitespace-nowrap">
                                        <i class="fas fa-chart-pie mr-1"></i><br>
                                        <span class="mt-1">Overview</span>
                                    </button>
                                    <button id="posts-tab-mobile" class="mobile-tab-item py-3 font-medium text-xs text-gray-500 whitespace-nowrap">
                                        <i class="fas fa-newspaper mr-1"></i><br>
                                        <span class="mt-1">Postingan</span>
                                    </button>
                                    <button id="activity-tab-mobile" class="mobile-tab-item py-3 font-medium text-xs text-gray-500 whitespace-nowrap">
                                        <i class="fas fa-history mr-1"></i><br>
                                        <span class="mt-1">Aktivitas</span>
                                    </button>
                                </nav>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div id="overview-content" class="tab-content">
                            <!-- Stat Cards - Mobile Responsive -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8 mobile-stats-grid">
                                <div class="stat-card rounded-2xl p-4 md:p-6 card-hover">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs md:text-sm font-medium text-gray-600">Total Postingan</p>
                                            <p class="text-xl md:text-3xl font-bold text-gray-800 mt-1 md:mt-2">{{ $totalPosts ?? ($userPosts->count() ?? 0) }}</p>
                                        </div>
                                        <div class="w-8 h-8 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-newspaper text-blue-600 text-sm md:text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="mt-2 md:mt-4 flex items-center text-xs md:text-sm text-gray-600">
                                        <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                        <span>{{ $publishedPosts ?? 0 }} dipublikasikan</span>
                                    </div>
                                </div>

                                <div class="stat-card rounded-2xl p-4 md:p-6 card-hover">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs md:text-sm font-medium text-gray-600">Total Dilihat</p>
                                            <p class="text-xl md:text-3xl font-bold text-gray-800 mt-1 md:mt-2">{{ number_format($totalViews ?? 0) }}</p>
                                        </div>
                                        <div class="w-8 h-8 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-eye text-green-600 text-sm md:text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="mt-2 md:mt-4 flex items-center text-xs md:text-sm text-gray-600">
                                        <i class="fas fa-users mr-1"></i>
                                        <span>Dibaca oleh banyak orang</span>
                                    </div>
                                </div>

                                <div class="stat-card rounded-2xl p-4 md:p-6 card-hover">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs md:text-sm font-medium text-gray-600">Rating Rata-rata</p>
                                            <p class="text-xl md:text-3xl font-bold text-gray-800 mt-1 md:mt-2">4.8</p>
                                        </div>
                                        <div class="w-8 h-8 md:w-12 md:h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-star text-yellow-600 text-sm md:text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="mt-2 md:mt-4 flex items-center text-xs md:text-sm text-yellow-600">
                                        <i class="fas fa-star mr-1 text-xs"></i>
                                        <i class="fas fa-star mr-1 text-xs"></i>
                                        <i class="fas fa-star mr-1 text-xs"></i>
                                        <i class="fas fa-star mr-1 text-xs"></i>
                                        <i class="fas fa-star-half-alt mr-1 text-xs"></i>
                                        <span class="text-gray-600 ml-1 text-xs">(42 reviews)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activity & Popular Posts - Mobile Stack -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
                                <!-- Recent Activity -->
                                <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6">
                                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4 md:mb-6 flex items-center">
                                        <i class="fas fa-history text-primary mr-2 md:mr-3"></i>
                                        Aktivitas Terbaru
                                    </h3>
                                    <div class="space-y-3 md:space-y-4">
                                        @forelse($recentActivities ?? [] as $activity)
                                        <div class="flex items-start space-x-3 p-2 md:p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="w-6 h-6 md:w-8 md:h-8 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <i class="fas fa-edit text-primary text-xs md:text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs md:text-sm text-gray-800 mb-1 line-clamp-2">{{ $activity->description ?? 'Aktivitas pengguna' }}</p>
                                                <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() ?? 'Baru saja' }}</p>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="text-center py-4">
                                            <i class="fas fa-inbox text-gray-300 text-2xl mb-2"></i>
                                            <p class="text-gray-500 text-sm">Belum ada aktivitas</p>
                                        </div>
                                        @endforelse
                                    </div>
                                    <a href="#" class="block text-center mt-3 md:mt-4 text-xs md:text-sm text-primary font-semibold hover:text-green-800 transition-colors">
                                        Lihat Semua Aktivitas
                                    </a>
                                </div>

                                <!-- Popular Posts -->
                                <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6">
                                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4 md:mb-6 flex items-center">
                                        <i class="fas fa-fire text-orange-500 mr-2 md:mr-3"></i>
                                        Postingan Populer
                                    </h3>
                                    <div class="space-y-3 md:space-y-4">
                                        @forelse($popularUserPosts ?? [] as $post)
                                        <a href="{{ route('blog.show', $post->slug) }}" class="flex items-start space-x-3 p-2 md:p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                            @if($post->featured_image && Storage::exists($post->featured_image))
                                                <img src="{{ Storage::url($post->featured_image) }}" 
                                                     alt="{{ $post->title }}" 
                                                     class="w-10 h-10 md:w-12 md:h-12 rounded-lg object-cover flex-shrink-0 group-hover:scale-105 transition-transform">
                                            @else
                                                <div class="w-10 h-10 md:w-12 md:h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                                                    <i class="fas fa-seedling text-primary text-sm md:text-base"></i>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-xs md:text-sm font-medium text-gray-800 group-hover:text-primary transition-colors line-clamp-2 mb-1">
                                                    {{ $post->title ?? 'Judul Postingan' }}
                                                </h4>
                                                <div class="flex items-center space-x-2 text-xs text-gray-500">
                                                    <span>{{ ($post->view_count ?? 0) }} dilihat</span>
                                                    <span>•</span>
                                                    <span>{{ $post->published_at->format('d M Y') ?? 'Tanggal' }}</span>
                                                </div>
                                            </div>
                                        </a>
                                        @empty
                                        <div class="text-center py-4">
                                            <i class="fas fa-newspaper text-gray-300 text-2xl mb-2"></i>
                                            <p class="text-gray-500 text-sm">Belum ada postingan populer</p>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Posts Tab Content - FIXED PAGINATION ISSUE -->
                        <div id="posts-content" class="tab-content hidden">
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up">
                                <!-- Header dengan Statistik -->
                                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center p-6 border-b border-gray-200 gap-4">
                                    <div>
                                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Daftar Postingan</h2>
                                        <p class="text-gray-600">Total {{ $totalPosts ?? 0 }} postingan</p>
                                    </div>
                                    <a href="{{ route('user.blog.create') }}" 
                                       class="create-post-btn text-white px-6 py-3 rounded-xl font-semibold flex items-center space-x-2">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Buat Post Baru</span>
                                    </a>
                                </div>

                                @if(($userPostsPaginated ?? $userPosts)->count() > 0)
                                <!-- Tabel Postingan -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 md:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                                <th class="px-4 md:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Kategori</th>
                                                <th class="px-4 md:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th class="px-4 md:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Tanggal</th>
                                                <th class="px-4 md:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach(($userPostsPaginated ?? $userPosts) as $post)
                                            <tr class="table-row">
                                                <td class="px-4 md:px-6 py-4">
                                                    <div class="font-medium text-gray-900 max-w-xs truncate">{{ $post->title }}</div>
                                                    <div class="text-sm text-gray-500 md:hidden mt-1">
                                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                                            {{ $post->category ?? 'Umum' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-4 md:px-6 py-4 hidden md:table-cell">
                                                    <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                        {{ $post->category ?? 'Umum' }}
                                                    </span>
                                                </td>
                                                <td class="px-4 md:px-6 py-4">
                                                    <div class="flex flex-col space-y-1">
                                                        @if($post->status === 'published')
                                                            @if($post->approval_status === 'approved')
                                                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                                    <i class="fas fa-check mr-1"></i> Published
                                                                </span>
                                                            @elseif($post->approval_status === 'pending')
                                                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                                    <i class="fas fa-clock mr-1"></i> Menunggu
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                                    <i class="fas fa-times mr-1"></i> Ditolak
                                                                </span>
                                                                @if($post->rejection_reason)
                                                                    <span class="text-xs text-gray-500 mt-1" title="{{ $post->rejection_reason }}">
                                                                        {{ Str::limit($post->rejection_reason, 30) }}
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                                                <i class="fas fa-pencil-alt mr-1"></i> Draft
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-4 md:px-6 py-4 text-sm text-gray-500 hidden lg:table-cell">
                                                    {{ $post->created_at->format('d M Y') }}
                                                </td>
                                                <td class="px-4 md:px-6 py-4">
                                                    <div class="flex flex-col sm:flex-row space-y-1 sm:space-y-0 sm:space-x-2">
                                                        @if($post->status === 'published' && $post->approval_status === 'approved')
                                                            <a href="{{ route('blog.show', $post->slug) }}" 
                                                               target="_blank"
                                                               class="inline-flex items-center justify-center px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                                                <i class="fas fa-eye mr-1"></i> Lihat
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('user.blog.edit', $post) }}" 
                                                           class="inline-flex items-center justify-center px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                                                            <i class="fas fa-edit mr-1"></i> Edit
                                                        </a>
                                                        <form action="{{ route('user.blog.destroy', $post) }}" method="POST" 
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?')"
                                                              class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="inline-flex items-center justify-center px-3 py-1 text-xs bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors w-full sm:w-auto">
                                                                <i class="fas fa-trash mr-1"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination - ONLY SHOW IF USING PAGINATION -->
                                @if(isset($userPostsPaginated) && $userPostsPaginated->hasPages())
                                <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                                    <div class="text-sm text-gray-700">
                                        @if($userPostsPaginated->total() > 0)
                                            Menampilkan {{ $userPostsPaginated->firstItem() }} hingga {{ $userPostsPaginated->lastItem() }} dari {{ $userPostsPaginated->total() }} hasil
                                        @else
                                            Tidak ada data yang ditemukan
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        {{-- Previous Page Link --}}
                                        @if($userPostsPaginated->onFirstPage())
                                            <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed text-sm">
                                                <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                                            </span>
                                        @else
                                            <a href="{{ $userPostsPaginated->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                                                <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                                            </a>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if($userPostsPaginated->hasMorePages())
                                            <a href="{{ $userPostsPaginated->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                                                <span class="hidden sm:inline">Selanjutnya</span> <i class="fas fa-chevron-right ml-1"></i>
                                            </a>
                                        @else
                                            <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed text-sm">
                                                <span class="hidden sm:inline">Selanjutnya</span> <i class="fas fa-chevron-right ml-1"></i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @else
                                <!-- Empty State -->
                                <div class="text-center py-16">
                                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum ada postingan</h3>
                                    <p class="text-gray-600 mb-8 max-w-md mx-auto">Mulai berbagi pengetahuan dan pengalaman Anda tentang lingkungan dengan membuat postingan pertama</p>
                                    <a href="{{ route('user.blog.create') }}" 
                                       class="create-post-btn text-white px-8 py-4 rounded-xl font-semibold text-lg inline-flex items-center space-x-3">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Buat Post Pertama</span>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Activity Tab Content -->
                        <div id="activity-content" class="tab-content hidden">
                            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6">
                                <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4 md:mb-6">Riwayat Aktivitas</h3>
                                <div class="space-y-4 md:space-y-6">
                                    <!-- Activity Timeline -->
                                    <div class="relative">
                                        @forelse($recentActivities ?? [] as $activity)
                                        <div class="flex items-start space-x-3 md:space-x-4 mb-4 md:mb-6">
                                            <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-primary/10 rounded-full flex items-center justify-center mt-0.5">
                                                <i class="fas fa-edit text-primary text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm md:text-base text-gray-800 mb-1">{{ $activity->description ?? 'Aktivitas pengguna' }}</p>
                                                <p class="text-xs md:text-sm text-gray-500">{{ $activity->created_at->format('d M Y H:i') ?? 'Tanggal' }}</p>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="text-center py-8">
                                            <i class="fas fa-history text-gray-300 text-4xl mb-3"></i>
                                            <p class="text-gray-500">Belum ada aktivitas</p>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
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

        // Simple Tab Functionality - FIXED VERSION
        function switchTab(tabName) {
            // Hide all tab contents
            document.getElementById('overview-content').classList.add('hidden');
            document.getElementById('posts-content').classList.add('hidden');
            document.getElementById('activity-content').classList.add('hidden');
            
            // Remove active state from all tabs
            const allTabs = [
                'overview-tab-desktop', 'posts-tab-desktop', 'activity-tab-desktop',
                'overview-tab-mobile', 'posts-tab-mobile', 'activity-tab-mobile'
            ];
            
            allTabs.forEach(tabId => {
                const tab = document.getElementById(tabId);
                if (tab) {
                    tab.classList.remove('tab-active', 'text-primary');
                    tab.classList.add('text-gray-500');
                }
            });
            
            // Show selected tab content
            document.getElementById(tabName + '-content').classList.remove('hidden');
            
            // Set active state for selected tabs
            const desktopTab = document.getElementById(tabName + '-tab-desktop');
            const mobileTab = document.getElementById(tabName + '-tab-mobile');
            
            if (desktopTab) {
                desktopTab.classList.add('tab-active', 'text-primary');
                desktopTab.classList.remove('text-gray-500');
            }
            
            if (mobileTab) {
                mobileTab.classList.add('tab-active', 'text-primary');
                mobileTab.classList.remove('text-gray-500');
            }
        }

        // Initialize tab event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Desktop tabs
            document.getElementById('overview-tab-desktop')?.addEventListener('click', () => switchTab('overview'));
            document.getElementById('posts-tab-desktop')?.addEventListener('click', () => switchTab('posts'));
            document.getElementById('activity-tab-desktop')?.addEventListener('click', () => switchTab('activity'));
            
            // Mobile tabs
            document.getElementById('overview-tab-mobile')?.addEventListener('click', () => switchTab('overview'));
            document.getElementById('posts-tab-mobile')?.addEventListener('click', () => switchTab('posts'));
            document.getElementById('activity-tab-mobile')?.addEventListener('click', () => switchTab('activity'));
        });

        // Modal functionality
        function openEditModal() {
            const modal = document.getElementById('editProfileModal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeEditModal() {
            const modal = document.getElementById('editProfileModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('editProfileModal');
            if (modal && e.target === modal) {
                closeEditModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });

        // Konfirmasi sebelum menghapus
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[onsubmit]');
            
            deleteForms.forEach(form => {
                const button = form.querySelector('button[type="submit"]');
                button.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus post ini?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>