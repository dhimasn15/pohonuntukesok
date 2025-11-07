<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - PohonUntukEsok</title>
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
    @include('layouts.navigation')
    @include('components.auth-modal')

    <section class="pt-32 pb-12 bg-gradient-to-br from-primary to-green-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Edit Post</h1>
                <p class="text-xl text-white/90">Perbarui artikel dan tulisan Anda</p>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Status Info -->
                @if($blog->approval_status === 'pending' && $blog->status === 'published')
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-clock text-yellow-600 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-yellow-800">Post sedang menunggu persetujuan admin</p>
                            <p class="text-sm text-yellow-700 mt-1">Post Anda akan ditinjau terlebih dahulu sebelum dipublikasikan</p>
                        </div>
                    </div>
                </div>
                @elseif($blog->approval_status === 'rejected')
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-times-circle text-red-600 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-red-800">Post ditolak oleh admin</p>
                            @if($blog->rejection_reason)
                                <p class="text-sm text-red-700 mt-1">Alasan: {{ $blog->rejection_reason }}</p>
                            @endif
                            <p class="text-sm text-red-700 mt-1">Silakan perbaiki post Anda dan kirim ulang untuk review</p>
                        </div>
                    </div>
                </div>
                @elseif($blog->approval_status === 'approved' && $blog->status === 'published')
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-green-800">Post telah disetujui dan dipublikasikan</p>
                            <p class="text-sm text-green-700 mt-1">Post Anda sudah live dan dapat dilihat oleh publik</p>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('user.blog.update', $blog) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Title -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Post *</label>
                                    <input type="text" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $blog->title) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           placeholder="Masukkan judul yang menarik..."
                                           required>
                                </div>

                                <!-- Excerpt -->
                                <div>
                                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan *</label>
                                    <textarea id="excerpt" 
                                              name="excerpt" 
                                              rows="3"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                              placeholder="Ringkasan singkat tentang post ini..."
                                              required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                                    <p class="text-sm text-gray-500 mt-1">Maksimal 500 karakter</p>
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                                    <select id="category" 
                                            name="category" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                            required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ old('category', $blog->category) == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Author Info -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Penulis *</label>
                                        <input type="text" 
                                               id="author_name" 
                                               name="author_name" 
                                               value="{{ old('author_name', $blog->author_name) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                               required>
                                    </div>
                                    <div>
                                        <label for="reading_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Baca (menit)</label>
                                        <input type="number" 
                                               id="reading_time" 
                                               name="reading_time" 
                                               value="{{ old('reading_time', $blog->reading_time) }}"
                                               min="1"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                               placeholder="5">
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div>
                                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                    <input type="text" 
                                           id="tags" 
                                           name="tags" 
                                           value="{{ old('tags', $blog->tags ? implode(', ', $blog->tags) : '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           placeholder="pisahkan dengan koma, contoh: lingkungan, tips, pohon">
                                    <p class="text-sm text-gray-500 mt-1">Gunakan koma untuk memisahkan tag</p>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Current Images -->
                                <div class="grid grid-cols-2 gap-4">
                                    @if($blog->featured_image)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image Saat Ini</label>
                                        <img src="{{ Storage::url($blog->featured_image) }}" 
                                             alt="Current Featured Image" 
                                             class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                    @endif
                                    @if($blog->author_avatar)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Avatar Saat Ini</label>
                                        <img src="{{ Storage::url($blog->author_avatar) }}" 
                                             alt="Current Author Avatar" 
                                             class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                    @endif
                                </div>

                                <!-- Featured Image -->
                                <div>
                                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Ganti Featured Image</label>
                                    <input type="file" 
                                           id="featured_image" 
                                           name="featured_image" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           accept="image/*">
                                    <p class="text-sm text-gray-500 mt-1">Ukuran maksimal 2MB</p>
                                </div>

                                <!-- Author Avatar -->
                                <div>
                                    <label for="author_avatar" class="block text-sm font-medium text-gray-700 mb-2">Ganti Avatar Penulis</label>
                                    <input type="file" 
                                           id="author_avatar" 
                                           name="author_avatar" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           accept="image/*">
                                    <p class="text-sm text-gray-500 mt-1">Ukuran maksimal 1MB</p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                                    <select id="status" 
                                            name="status" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                            required>
                                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Publish (Butuh Approval Admin)</option>
                                    </select>
                                    <div id="publish-warning" class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
                                        <div class="flex items-start">
                                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-2"></i>
                                            <div>
                                                <p class="text-sm text-yellow-800 font-medium">Post akan dikirim untuk persetujuan admin</p>
                                                <p class="text-sm text-yellow-700">Post Anda akan ditinjau terlebih dahulu sebelum dipublikasikan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Editor -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten *</label>
                        <textarea id="content" 
                                  name="content" 
                                  rows="20"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                  placeholder="Tulis konten post di sini..."
                                  required>{{ old('content', $blog->content) }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('user.blog.index') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                        <div class="flex space-x-4">
                            <button type="submit" 
                                    name="status" 
                                    value="draft"
                                    class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors font-semibold">
                                <i class="fas fa-save mr-2"></i> Simpan Draft
                            </button>
                            <button type="submit" 
                                    name="status" 
                                    value="published"
                                    class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-green-800 transition-colors font-semibold">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim untuk Review
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('layouts.footer')

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

        // Show/hide publish warning
        const statusSelect = document.getElementById('status');
        const publishWarning = document.getElementById('publish-warning');

        statusSelect.addEventListener('change', function() {
            if (this.value === 'published') {
                publishWarning.classList.remove('hidden');
            } else {
                publishWarning.classList.add('hidden');
            }
        });

        // Trigger on page load
        if (statusSelect.value === 'published') {
            publishWarning.classList.remove('hidden');
        }

        // Auto calculate reading time
        function calculateReadingTime() {
            const content = CKEDITOR.instances.content.getData();
            const textContent = content.replace(/<[^>]*>/g, '');
            const wordCount = textContent.split(/\s+/).length;
            const readingTime = Math.max(1, Math.ceil(wordCount / 200));
            
            document.getElementById('reading_time').value = readingTime;
        }

        // Update reading time when content changes
        CKEDITOR.instances.content.on('change', function() {
            calculateReadingTime();
        });
    </script>
</body>
</html>