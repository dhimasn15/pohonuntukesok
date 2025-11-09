<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postingan Saya - PohonUntukEsok</title>
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
        
        /* Card hover effects */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Table row animation */
        .table-row {
            transition: all 0.2s ease;
        }
        .table-row:hover {
            background-color: #f9fafb;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
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
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50">
    @include('layouts.navigation')
    @include('components.auth-modal')

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 hero-gradient overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                    <i class="fas fa-newspaper text-accent"></i>
                    <span class="text-white font-semibold">Kelola Konten Anda</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Postingan Saya
                </h1>
                
                <p class="text-xl text-white/90 leading-relaxed">
                    Kelola artikel dan tulisan Anda dengan mudah
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
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center" data-aos="fade-up">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Header dengan Statistik -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4" data-aos="fade-up">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Daftar Postingan</h2>
                    <p class="text-gray-600">Total {{ $posts->total() }} postingan</p>
                </div>
                <a href="{{ route('user.blog.create') }}" 
                   class="create-post-btn text-white px-6 py-3 rounded-xl font-semibold flex items-center space-x-2">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Post Baru</span>
                </a>
            </div>

            @if($posts->count() > 0)
            <!-- Tabel Postingan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up">
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
                            @foreach($posts as $post)
                            <tr class="table-row">
                                <td class="px-4 md:px-6 py-4">
                                    <div class="font-medium text-gray-900 max-w-xs truncate">{{ $post->title }}</div>
                                    <div class="text-sm text-gray-500 md:hidden mt-1">
                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                            {{ $post->category }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4 hidden md:table-cell">
                                    <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        {{ $post->category }}
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
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0" data-aos="fade-up">
                <div class="text-sm text-gray-700">
                    @if($posts->total() > 0)
                        Menampilkan {{ $posts->firstItem() }} hingga {{ $posts->lastItem() }} dari {{ $posts->total() }} hasil
                    @else
                        Tidak ada data yang ditemukan
                    @endif
                </div>
                <div class="flex space-x-2">
                    {{-- Previous Page Link --}}
                    @if($posts->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed text-sm">
                            <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                            <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
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
            <div class="text-center py-16 bg-white rounded-2xl shadow-lg" data-aos="fade-up">
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