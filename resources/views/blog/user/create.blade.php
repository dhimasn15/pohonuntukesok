<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Post Baru - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <!-- Gunakan CKEditor 4 versi gratis terakhir -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
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
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Buat Post Baru</h1>
                <p class="text-xl text-white/90">Bagikan pengetahuan dan pengalaman Anda tentang lingkungan</p>
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

                <form action="{{ route('user.blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
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
                                           value="{{ old('title') }}"
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
                                              required>{{ old('excerpt') }}</textarea>
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
                                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
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
                                               value="{{ old('author_name', auth()->user()->name) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                               required>
                                    </div>
                                    <div>
                                        <label for="reading_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Baca (menit)</label>
                                        <input type="number" 
                                               id="reading_time" 
                                               name="reading_time" 
                                               value="{{ old('reading_time') }}"
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
                                           value="{{ old('tags') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           placeholder="pisahkan dengan koma, contoh: lingkungan, tips, pohon">
                                    <p class="text-sm text-gray-500 mt-1">Gunakan koma untuk memisahkan tag</p>
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
                                    <p class="text-sm text-gray-500 mt-1">Ukuran maksimal 2MB (JPEG, PNG, JPG, GIF)</p>
                                </div>

                                <!-- Author Avatar -->
                                <div>
                                    <label for="author_avatar" class="block text-sm font-medium text-gray-700 mb-2">Avatar Penulis</label>
                                    <input type="file" 
                                           id="author_avatar" 
                                           name="author_avatar" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                           accept="image/*">
                                    <p class="text-sm text-gray-500 mt-1">Ukuran maksimal 1MB (JPEG, PNG, JPG, GIF)</p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                                    <select id="status" 
                                            name="status" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                            required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publish (Butuh Approval Admin)</option>
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

                                <!-- Preview Image -->
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center h-48 flex items-center justify-center">
                                    <div id="image-preview" class="text-center">
                                        <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                                        <p class="text-sm text-gray-500">Preview gambar akan muncul di sini</p>
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
                                  required>{{ old('content') }}</textarea>
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
        // Initialize CKEditor 4
        CKEDITOR.replace('content', {
            toolbar: [
                { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
                { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
                '/',
                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
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
    </script>
</body>
</html>     