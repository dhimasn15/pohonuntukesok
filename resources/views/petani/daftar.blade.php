<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sebagai Petani - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .primary { color: #2D4F2B; }
        .bg-primary { background-color: #2D4F2B; }
        .accent { color: #FFAB00; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    @include('layouts.navigation')

    <div class="min-h-screen pt-20 pb-12">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-primary mb-4">Daftar Sebagai Petani</h1>
                <p class="text-xl text-gray-600">Bergabunglah dengan komunitas petani kami dan berkontribusi untuk penghijauan Indonesia</p>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
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

                <form action="{{ route('petani.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Data Pribadi -->
                    <div class="border-b border-gray-200 pb-8">
                        <h2 class="text-2xl font-bold text-primary mb-6">Data Pribadi</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" required>
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                                <input type="text" name="nik" value="{{ old('nik') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                       placeholder="16 digit NIK" required>
                                @error('nik')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon *</label>
                                <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" required>
                                @error('no_telepon')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="border-b border-gray-200 pb-8">
                        <h2 class="text-2xl font-bold text-primary mb-6">Alamat Lengkap</h2>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                                <textarea name="alamat_lengkap" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                          required>{{ old('alamat_lengkap') }}</textarea>
                                @error('alamat_lengkap')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan *</label>
                                    <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" required>
                                    @error('kecamatan')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten *</label>
                                    <input type="text" name="kabupaten" value="{{ old('kabupaten') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" required>
                                    @error('kabupaten')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                                    <input type="text" name="provinsi" value="{{ old('provinsi') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" required>
                                    @error('provinsi')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Dokumen -->
                    <div class="border-b border-gray-200 pb-8">
                        <h2 class="text-2xl font-bold text-primary mb-6">Dokumen Pendukung</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto KTP *</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <input type="file" name="foto_ktp" class="hidden" id="foto_ktp" accept="image/*" required>
                                    <label for="foto_ktp" class="cursor-pointer">
                                        <i class="fas fa-id-card text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-600">Klik untuk upload foto KTP</p>
                                        <p class="text-xs text-gray-500">Format: JPG, PNG (Maks. 2MB)</p>
                                    </label>
                                </div>
                                <div id="ktp-preview" class="mt-3 hidden">
                                    <img class="w-32 h-20 object-cover rounded-lg border">
                                </div>
                                @error('foto_ktp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Diri dengan KTP *</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <input type="file" name="foto_diri" class="hidden" id="foto_diri" accept="image/*" required>
                                    <label for="foto_diri" class="cursor-pointer">
                                        <i class="fas fa-user text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-600">Klik untuk upload foto diri + KTP</p>
                                        <p class="text-xs text-gray-500">Format: JPG, PNG (Maks. 2MB)</p>
                                    </label>
                                </div>
                                <div id="diri-preview" class="mt-3 hidden">
                                    <img class="w-32 h-20 object-cover rounded-lg border">
                                </div>
                                @error('foto_diri')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pengalaman -->
                    <div class="border-b border-gray-200 pb-8">
                        <h2 class="text-2xl font-bold text-primary mb-6">Pengalaman Bertani</h2>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Bertani *</label>
                                <textarea name="pengalaman_bertani" rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                          placeholder="Ceritakan pengalaman Anda dalam bertani, berapa lama, jenis tanaman yang pernah ditanam, dll." 
                                          required>{{ old('pengalaman_bertani') }}</textarea>
                                @error('pengalaman_bertani')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Minimal 50 karakter</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Tanaman yang Dikuasai *</label>
                                <textarea name="jenis_tanaman_dikuasai" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                          placeholder="Sebutkan jenis-jenis tanaman yang Anda kuasai penanamannya" 
                                          required>{{ old('jenis_tanaman_dikuasai') }}</textarea>
                                @error('jenis_tanaman_dikuasai')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" 
                                class="px-8 py-4 bg-primary text-white font-bold rounded-lg hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pendaftaran
                        </button>
                        <p class="text-sm text-gray-500 mt-3">
                            * Data Anda akan diverifikasi oleh admin dalam 1-3 hari kerja
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <script>
        // Preview image upload
        document.getElementById('foto_ktp').addEventListener('change', function(e) {
            const preview = document.getElementById('ktp-preview');
            const img = preview.querySelector('img');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('foto_diri').addEventListener('change', function(e) {
            const preview = document.getElementById('diri-preview');
            const img = preview.querySelector('img');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>