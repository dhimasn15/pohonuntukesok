<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Post Baru - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
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
        
        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }

        .publish-btn {
            background: linear-gradient(135deg, #FFAB00 0%, #FF9800 100%);
            box-shadow: 0 4px 15px rgba(255, 171, 0, 0.3);
            transition: all 0.3s ease;
        }

        .publish-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 171, 0, 0.4);
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
        }

        .draft-btn {
            background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            transition: all 0.3s ease;
        }

        .draft-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 114, 128, 0.4);
            background: linear-gradient(135deg, #4B5563 0%, #374151 100%);
        }

        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(45, 79, 43, 0.1);
        }

        .file-upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--primary);
            background-color: #f9fafb;
        }

        .file-upload-area.dragover {
            border-color: var(--primary);
            background-color: #f0fdf4;
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
                    <i class="fas fa-edit text-accent"></i>
                    <span class="text-white font-semibold">Buat Konten Baru</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Buat Post Baru
                </h1>
                
                <p class="text-xl text-white/90 leading-relaxed">
                    Bagikan pengetahuan dan pengalaman Anda tentang lingkungan
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
            <div class="max-w-4xl mx-auto">
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

                <form action="{{ route('user.blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Basic Information Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover" data-aos="fade-up">
                        <h3 class="text-xl font-semibold text-primary mb-6 flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            Informasi Dasar
                        </h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Title -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Post *</label>
                                    <input type="text" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}"
                                           class="form-input w-full px-4 py-3 rounded-lg"
                                           placeholder="Masukkan judul yang menarik..."
                                           required>
                                </div>

                                <!-- Excerpt -->
                                <div>
                                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan *</label>
                                    <textarea id="excerpt" 
                                              name="excerpt" 
                                              rows="3"
                                              class="form-input w-full px-4 py-3 rounded-lg"
                                              placeholder="Ringkasan singkat tentang post ini..."
                                              required>{{ old('excerpt') }}</textarea>
                                    <p class="text-sm text-gray-500 mt-1">Maksimal 500 karakter</p>
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                                    <select id="category" 
                                            name="category" 
                                            class="form-input w-full px-4 py-3 rounded-lg"
                                            required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Author Info -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Penulis *</label>
                                        <input type="text" 
                                               id="author_name" 
                                               name="author_name" 
                                               value="{{ old('author_name', auth()->user()->name) }}"
                                               class="form-input w-full px-4 py-3 rounded-lg"
                                               required>
                                    </div>
                                    <div>
                                        <label for="reading_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Baca (menit)</label>
                                        <input type="number" 
                                               id="reading_time" 
                                               name="reading_time" 
                                               value="{{ old('reading_time', 5) }}"
                                               min="1"
                                               class="form-input w-full px-4 py-3 rounded-lg"
                                               placeholder="5">
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div>
                                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                    <input type="text" 
                                           id="tags" 
                                           name="tags" 
                                           value="{{ old('tags') }}"
                                           class="form-input w-full px-4 py-3 rounded-lg"
                                           placeholder="lingkungan, tips, pohon, hijau">
                                    <p class="text-sm text-gray-500 mt-1">Pisahkan dengan koma</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media & Settings Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-xl font-semibold text-primary mb-6 flex items-center">
                            <i class="fas fa-images mr-3"></i>
                            Media & Pengaturan
                        </h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Left Column - Media Upload -->
                            <div class="space-y-6">
                                <!-- Featured Image -->
                                <div>
                                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                                    <div class="file-upload-area rounded-lg p-6 text-center" 
                                         onclick="document.getElementById('featured_image').click()">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                        <p class="text-sm text-gray-600 mb-2">Klik untuk upload gambar utama</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (Max. 2MB)</p>
                                    </div>
                                    <input type="file" 
                                           id="featured_image" 
                                           name="featured_image" 
                                           class="hidden"
                                           accept="image/*">
                                </div>

                                <!-- Author Avatar -->
                                <div>
                                    <label for="author_avatar" class="block text-sm font-medium text-gray-700 mb-2">Avatar Penulis</label>
                                    <input type="file" 
                                           id="author_avatar" 
                                           name="author_avatar" 
                                           class="form-input w-full px-4 py-3 rounded-lg"
                                           accept="image/*">
                                    <p class="text-sm text-gray-500 mt-1">Ukuran maksimal 1MB</p>
                                </div>
                            </div>

                            <!-- Right Column - Settings & Preview -->
                            <div class="space-y-6">
                                <!-- Status Warning -->
                                <div id="publish-warning" class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
                                    <div class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                                        <div>
                                            <p class="text-sm text-yellow-800 font-medium mb-1">Post akan dikirim untuk persetujuan admin</p>
                                            <p class="text-sm text-yellow-700">Post Anda akan ditinjau terlebih dahulu sebelum dipublikasikan</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Area -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Preview Gambar</h4>
                                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <div id="image-preview" class="text-center p-4">
                                            <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                            <p class="text-xs text-gray-500">Gambar akan muncul di sini setelah diupload</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Editor Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-xl font-semibold text-primary mb-6 flex items-center">
                            <i class="fas fa-edit mr-3"></i>
                            Konten Artikel
                        </h3>
                        
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten *</label>
                        <textarea id="content" 
                                  name="content" 
                                  rows="20"
                                  class="form-input w-full px-4 py-3 rounded-lg"
                                  placeholder="Tulis konten post di sini..."
                                  required>{{ old('content') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('user.blog.index') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Kembali ke Postingan Saya</span>
                        </a>
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <button type="submit" 
                                    name="status" 
                                    value="draft"
                                    class="draft-btn px-8 py-3 text-white rounded-lg font-semibold flex items-center justify-center space-x-2">
                                <i class="fas fa-save"></i>
                                <span>Simpan Draft</span>
                            </button>
                            <button type="submit" 
                                    name="status" 
                                    value="published"
                                    class="publish-btn px-8 py-3 text-white rounded-lg font-semibold flex items-center justify-center space-x-2">
                                <i class="fas fa-paper-plane"></i>
                                <span>Kirim untuk Review</span>
                            </button>
                        </div>
                    </div>
                </form>
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

        // Initialize CKEditor 4
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
            height: 400,
            // Remove unnecessary buttons for security
            removeButtons: 'Save,NewPage,Preview,Print,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,SpecialChar,PageBreak,Iframe,About',
            // Basic security settings
            allowedContent: true,
            disallowedContent: 'script;*[on*]',
            // File upload
            filebrowserUploadUrl: "{{ route('ckeditor.upload') }}",
            filebrowserUploadMethod: 'form'
        });

        // File upload preview
        const featuredImageInput = document.getElementById('featured_image');
        const fileUploadArea = document.querySelector('.file-upload-area');
        const imagePreview = document.getElementById('image-preview');

        featuredImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fileUploadArea.innerHTML = `
                        <div class="text-center">
                            <img src="${e.target.result}" class="max-h-32 mx-auto rounded-lg mb-2" alt="Preview">
                            <p class="text-sm text-green-600">Gambar berhasil diupload</p>
                            <p class="text-xs text-gray-500">Klik untuk mengganti gambar</p>
                        </div>
                    `;
                    
                    imagePreview.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" alt="Preview">
                    `;
                }
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop functionality
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                featuredImageInput.files = files;
                featuredImageInput.dispatchEvent(new Event('change'));
            }
        });

        // Show warning when publish button is focused/hovered
        const publishButton = document.querySelector('button[value="published"]');
        const publishWarning = document.getElementById('publish-warning');

        publishButton.addEventListener('mouseenter', function() {
            publishWarning.classList.remove('hidden');
        });

        publishButton.addEventListener('mouseleave', function() {
            publishWarning.classList.add('hidden');
        });

        publishButton.addEventListener('focus', function() {
            publishWarning.classList.remove('hidden');
        });

        publishButton.addEventListener('blur', function() {
            publishWarning.classList.add('hidden');
        });
    </script>
</body>
</html>