<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tolak Post - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .primary { color: #2D4F2B; }
        .bg-primary { background-color: #2D4F2B; }
        .accent { color: #FFAB00; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Admin (sama seperti sebelumnya) -->
    <nav class="bg-primary shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-tree text-white text-2xl mr-3"></i>
                    <span class="text-white font-bold text-xl">PohonUntukEsok - Admin</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white">Halo, {{ Auth::user()->name }}</span>
                    <a href="{{ route('home') }}" class="text-white hover:text-accent transition-colors">
                        <i class="fas fa-home mr-1"></i> Site
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-accent transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="text-center mb-8">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Tolak Post</h1>
                    <p class="text-gray-600">Berikan alasan penolakan untuk post ini</p>
                </div>

                <!-- Post Info -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Post yang akan ditolak:</h3>
                    <div class="flex items-start space-x-4">
                        @if($blog->featured_image)
                            <img src="{{ Storage::url($blog->featured_image) }}" 
                                 alt="{{ $blog->title }}" 
                                 class="w-16 h-16 rounded-lg object-cover">
                        @endif
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">{{ $blog->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($blog->excerpt, 100) }}</p>
                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                <span>Oleh: {{ $blog->author_name }}</span>
                                <span>Kategori: {{ $blog->category }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rejection Form -->
                <form action="{{ route('admin.blog.reject', $blog) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Alasan Penolakan *
                        </label>
                        <textarea id="rejection_reason" 
                                  name="rejection_reason" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                  placeholder="Berikan alasan yang jelas dan konstruktif mengapa post ini ditolak..."
                                  required></textarea>
                        <p class="text-sm text-gray-500 mt-1">Alasan ini akan dikirimkan kepada penulis post</p>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.blog.pending') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold">
                            <i class="fas fa-times mr-2"></i> Tolak Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>