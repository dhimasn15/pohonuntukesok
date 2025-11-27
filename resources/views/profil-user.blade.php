<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50">
    @include('layouts.navigation')
    @include('components.auth-modal')

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 hero-gradient overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                    <i class="fas fa-user-circle text-accent"></i>
                    <span class="font-semibold">Profil Pengguna</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Profil Saya
                </h1>
                
                <p class="text-xl text-white/90 leading-relaxed">
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
    <section class="py-12">
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

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Sidebar Profil -->
                    <div class="lg:col-span-1" data-aos="fade-right">
                        <div class="bg-white rounded-2xl shadow-lg p-6 card-hover sticky top-24">
                            <!-- Avatar & Info -->
                            <div class="text-center mb-6">
                                <div class="relative inline-block mb-4">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ Storage::url(auth()->user()->avatar) }}" 
                                             alt="{{ auth()->user()->name }}" 
                                             class="profile-avatar w-24 h-24 rounded-full mx-auto">
                                    @else
                                        <div class="profile-avatar w-24 h-24 bg-primary text-white rounded-full flex items-center justify-center mx-auto text-2xl font-bold">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 mb-1">{{ auth()->user()->name }}</h2>
                                <p class="text-gray-600 text-sm mb-3">{{ auth()->user()->email }}</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary text-white">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </div>

                            <!-- Stats -->
                            <div class="space-y-4 border-t border-gray-200 pt-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Bergabung</span>
                                    <span class="font-semibold text-gray-800">{{ auth()->user()->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Postingan</span>
                                    <span class="font-semibold text-primary">{{ $userPosts->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Dilihat</span>
                                    <span class="font-semibold text-primary">{{ number_format($totalViews) }}</span>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="border-t border-gray-200 pt-6 mt-6">
                                <h3 class="font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                                <div class="space-y-2">
                                    <a href="{{ route('user.blog.create') }}" 
                                       class="w-full flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                        <i class="fas fa-plus text-primary"></i>
                                        <span>Buat Post Baru</span>
                                    </a>
                                    <a href="{{ route('user.blog.index') }}" 
                                       class="w-full flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                        <i class="fas fa-newspaper text-primary"></i>
                                        <span>Postingan Saya</span>
                                    </a>
                                    <button onclick="openEditModal()" 
                                            class="w-full flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                        <i class="fas fa-edit text-primary"></i>
                                        <span>Edit Profil</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="lg:col-span-3" data-aos="fade-left">
                        <!-- Tab Navigation -->
                        <div class="bg-white rounded-2xl shadow-lg mb-8">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-8 px-6">
                                    <button id="overview-tab" class="tab-active py-4 px-1 font-medium text-sm whitespace-nowrap">
                                        <i class="fas fa-chart-pie mr-2"></i>Overview
                                    </button>
                                    <button id="posts-tab" class="py-4 px-1 font-medium text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">
                                        <i class="fas fa-newspaper mr-2"></i>Postingan Saya
                                    </button>
                                    <button id="activity-tab" class="py-4 px-1 font-medium text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">
                                        <i class="fas fa-history mr-2"></i>Aktivitas
                                    </button>
                                </nav>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div id="overview-content" class="tab-content">
                            <!-- Stat Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                <div class="stat-card rounded-2xl p-6 card-hover">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Total Postingan</p>
                                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $userPosts->count() }}</p>
                                        </div>
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex items-center text-sm text-gray-600">
                                        <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                        <span>{{ $publishedPosts }} dipublikasikan</span>
                                    </div>
                                </div>

                                <div class="stat-card rounded-2xl p-6 card-hover">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Total Dilihat</p>
                                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($totalViews) }}</p>
                                        </div>
                                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-eye text-green-600 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex items-center text-sm text-gray-600">
                                        <i class="fas fa-users mr-1"></i>
                                        <span>Dibaca oleh banyak orang</span>
                                    </div>
                                </div>

                                <div class="stat-card rounded-2xl p-6 card-hover">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Rating Rata-rata</p>
                                            <p class="text-3xl font-bold text-gray-800 mt-2">4.8</p>
                                        </div>
                                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-star text-yellow-600 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex items-center text-sm text-yellow-600">
                                        <i class="fas fa-star mr-1"></i>
                                        <i class="fas fa-star mr-1"></i>
                                        <i class="fas fa-star mr-1"></i>
                                        <i class="fas fa-star mr-1"></i>
                                        <i class="fas fa-star-half-alt mr-1"></i>
                                        <span class="text-gray-600 ml-1">(42 reviews)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activity & Popular Posts -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Recent Activity -->
                                <div class="bg-white rounded-2xl shadow-lg p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-history text-primary mr-3"></i>
                                        Aktivitas Terbaru
                                    </h3>
                                    <div class="space-y-4">
                                        @foreach($recentActivities as $activity)
                                        <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-edit text-primary text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm text-gray-800 mb-1">{{ $activity->description }}</p>
                                                <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <a href="#" class="block text-center mt-4 text-sm text-primary font-semibold hover:text-green-800 transition-colors">
                                        Lihat Semua Aktivitas
                                    </a>
                                </div>

                                <!-- Popular Posts -->
                                <div class="bg-white rounded-2xl shadow-lg p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-fire text-orange-500 mr-3"></i>
                                        Postingan Populer
                                    </h3>
                                    <div class="space-y-4">
                                        @foreach($popularUserPosts as $post)
                                        <a href="{{ route('blog.show', $post->slug) }}" class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                            @if($post->featured_image)
                                                <img src="{{ Storage::url($post->featured_image) }}" 
                                                     alt="{{ $post->title }}" 
                                                     class="w-12 h-12 rounded-lg object-cover flex-shrink-0 group-hover:scale-105 transition-transform">
                                            @else
                                                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                                                    <i class="fas fa-seedling text-primary"></i>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-medium text-gray-800 group-hover:text-primary transition-colors line-clamp-2 mb-1">
                                                    {{ $post->title }}
                                                </h4>
                                                <div class="flex items-center space-x-2 text-xs text-gray-500">
                                                    <span>{{ $post->view_count }} dilihat</span>
                                                    <span>•</span>
                                                    <span>{{ $post->published_at->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Posts Tab Content -->
                        <div id="posts-content" class="tab-content hidden">
                            <div class="bg-white rounded-2xl shadow-lg p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-xl font-bold text-gray-800">Postingan Saya</h3>
                                    <a href="{{ route('user.blog.create') }}" 
                                       class="edit-btn text-white px-4 py-2 rounded-lg font-semibold flex items-center space-x-2">
                                        <i class="fas fa-plus"></i>
                                        <span>Buat Baru</span>
                                    </a>
                                </div>

                                @if($userPosts->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dilihat</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach($userPosts as $post)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div class="font-medium text-gray-900 max-w-xs truncate">{{ $post->title }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if($post->status === 'published')
                                                        @if($post->approval_status === 'approved')
                                                            <span class="badge-success px-2 py-1 text-xs text-white rounded-full">Published</span>
                                                        @elseif($post->approval_status === 'pending')
                                                            <span class="badge-warning px-2 py-1 text-xs text-white rounded-full">Pending</span>
                                                        @else
                                                            <span class="bg-red-500 px-2 py-1 text-xs text-white rounded-full">Ditolak</span>
                                                        @endif
                                                    @else
                                                        <span class="badge-secondary px-2 py-1 text-xs text-white rounded-full">Draft</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($post->view_count) }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</td>
                                                <td class="px-6 py-4">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('blog.show', $post->slug) }}" 
                                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('user.blog.edit', $post) }}" 
                                                           class="text-green-600 hover:text-green-800 text-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="text-center py-12">
                                    <i class="fas fa-newspaper text-gray-300 text-5xl mb-4"></i>
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada postingan</h4>
                                    <p class="text-gray-500 mb-6">Mulai berbagi pengetahuan Anda dengan membuat postingan pertama</p>
                                    <a href="{{ route('user.blog.create') }}" 
                                       class="edit-btn text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center space-x-2">
                                        <i class="fas fa-plus"></i>
                                        <span>Buat Postingan Pertama</span>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Activity Tab Content -->
                        <div id="activity-content" class="tab-content hidden">
                            <div class="bg-white rounded-2xl shadow-lg p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Riwayat Aktivitas</h3>
                                <div class="space-y-6">
                                    <!-- Activity Timeline -->
                                    <div class="relative">
                                        @foreach($recentActivities as $activity)
                                        <div class="flex items-start space-x-4 mb-6">
                                            <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                                <i class="fas fa-edit text-primary"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-gray-800 mb-1">{{ $activity->description }}</p>
                                                <p class="text-sm text-gray-500">{{ $activity->created_at->format('d M Y H:i') }}</p>
                                            </div>
                                        </div>
                                        @endforeach
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

        // Tab functionality
        const tabs = {
            'overview-tab': 'overview-content',
            'posts-tab': 'posts-content',
            'activity-tab': 'activity-content'
        };

        Object.keys(tabs).forEach(tabId => {
            document.getElementById(tabId).addEventListener('click', function() {
                // Hide all tab contents
                Object.values(tabs).forEach(contentId => {
                    document.getElementById(contentId).classList.add('hidden');
                });
                
                // Remove active state from all tabs
                Object.keys(tabs).forEach(tab => {
                    document.getElementById(tab).classList.remove('tab-active', 'text-primary');
                    document.getElementById(tab).classList.add('text-gray-500', 'hover:text-gray-700');
                });
                
                // Show selected tab content
                document.getElementById(tabs[tabId]).classList.remove('hidden');
                
                // Set active state for selected tab
                this.classList.add('tab-active', 'text-primary');
                this.classList.remove('text-gray-500', 'hover:text-gray-700');
            });
        });

        // Modal functionality
        function openEditModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editProfileModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
</body>
</html>