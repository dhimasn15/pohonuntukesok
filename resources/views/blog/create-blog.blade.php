<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Post Baru - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
        .primary { color: #2D4F2B; }
        .bg-primary { background-color: #2D4F2B; }
        .accent { color: #FFAB00; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Admin -->
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

    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <nav class="mt-6">
                <div class="px-6 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.petani') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-users mr-3"></i>
                        Kelola Petani
                    </a>
                    <a href="{{ route('admin.users') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-user-friends mr-3"></i>
                        Kelola User
                    </a>
                    <a href="{{ route('admin.kampanye') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-seedling mr-3"></i>
                        Kelola Kampanye
                    </a>
                    <a href="{{ route('admin.blog.index') }}" 
                       class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
                        <i class="fas fa-blog mr-3"></i>
                        Kelola Blog
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-primary">Buat Post Baru</h1>
                <p class="text-gray-600">Buat artikel baru untuk blog</p>
            </div>

            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Post</label>
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                       placeholder="Masukkan judul post..."
                                       required>
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div>
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan</label>
                                <textarea id="excerpt" 
                                          name="excerpt" 
                                          rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                          placeholder="Ringkasan singkat tentang post ini..."
                                          required>{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select id="category" 
                                        name="category" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                        required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Author Info -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Author</label>
                                    <input type="text" 
                                           id="author_name" 
                                           name="author_name" 
                                           value="{{ old('author_name', Auth::user()->name) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           required>
                                    @error('author_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="reading_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Baca (menit)</label>
                                    <input type="number" 
                                           id="reading_time" 
                                           name="reading_time" 
                                           value="{{ old('reading_time') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           placeholder="5">
                                    @error('reading_time')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tags -->
                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                <input type="text" 
                                       id="tags" 
                                       name="tags" 
                                       value="{{ old('tags') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                       placeholder="pisahkan dengan koma, contoh: lingkungan, tips, pohon">
                                @error('tags')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Featured Image -->
                            <div>
                                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                                <input type="file" 
                                       id="featured_image" 
                                       name="featured_image" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                       accept="image/*">
                                @error('featured_image')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Author Avatar -->
                            <div>
                                <label for="author_avatar" class="block text-sm font-medium text-gray-700 mb-2">Avatar Author</label>
                                <input type="file" 
                                       id="author_avatar" 
                                       name="author_avatar" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                       accept="image/*">
                                @error('author_avatar')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status & Featured -->
                            <div class="space-y-4">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select id="status" 
                                            name="status" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                            required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="is_featured" 
                                           name="is_featured" 
                                           value="1"
                                           {{ old('is_featured') ? 'checked' : '' }}
                                           class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                    <label for="is_featured" class="ml-2 text-sm text-gray-700">Jadikan sebagai featured post</label>
                                </div>
                            </div>

                            <!-- Preview Image -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                                <p class="text-sm text-gray-500">Preview gambar akan muncul di sini</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Editor -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                    <textarea id="content" 
                              name="content" 
                              rows="20"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="Tulis konten post di sini..."
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.blog.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-green-800 transition-colors font-semibold">
                        <i class="fas fa-save mr-2"></i> Simpan Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize CKEditor
        CKEDITOR.replace('content', {
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Image', 'Table'] },
                { name: 'tools', items: ['Maximize'] },
                '/',
                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'document', items: ['Source'] }
            ],
            height: 400
        });

        // Preview image upload
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector('.border-dashed');
                    preview.innerHTML = `<img src="${e.target.result}" class="max-h-48 mx-auto rounded-lg" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>