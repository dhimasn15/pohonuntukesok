<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tanaman - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .primary { color: #2D4F2B; }
        .bg-primary { background-color: #2D4F2B; }
        .accent { color: #FFAB00; }
    </style>
</head>
<body class="bg-gray-50">
    @include('layouts.navigation')

    <div class="min-h-screen pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-primary">Kelola Tanaman</h1>
                <p class="text-gray-600">Kelola stok dan informasi tanaman Anda</p>
            </div>

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

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <nav class="space-y-2">
                            <a href="{{ route('petani.dashboard') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('petani.tanaman') }}" 
                               class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
                                <i class="fas fa-seedling mr-3"></i>
                                Kelola Tanaman
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Form Tambah Tanaman -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                        <h3 class="text-xl font-bold text-primary mb-6">Tambah Tanaman Baru</h3>
                        
                        <form action="{{ route('petani.tanaman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Tanaman *</label>
                                    <input type="text" name="jenis_tanaman" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                           placeholder="Contoh: Mangrove, Trembesi, dll" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Stok *</label>
                                    <input type="number" name="stok" min="1" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                           placeholder="Jumlah pohon" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Pohon (Rp) *</label>
                                    <input type="number" name="harga_per_pohon" min="1000" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                           placeholder="Contoh: 25000" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Tanaman</label>
                                    <input type="file" name="foto_tanaman" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                           accept="image/*">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="deskripsi" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                          placeholder="Deskripsi singkat tentang tanaman..."></textarea>
                            </div>

                            <div class="text-right">
                                <button type="submit" 
                                        class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Tambah Tanaman
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Daftar Tanaman -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-primary mb-6">Daftar Tanaman Anda</h3>
                        
                        @if($plants->count() > 0)
                            <div class="space-y-4">
                                @foreach($plants as $plant)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                        <div class="flex items-center">
                                            @if($plant->foto_tanaman)
                                                <img src="{{ Storage::url($plant->foto_tanaman) }}" 
                                                     alt="{{ $plant->jenis_tanaman }}" 
                                                     class="w-16 h-16 object-cover rounded-lg mr-4">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                                    <i class="fas fa-seedling text-gray-400 text-2xl"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h4 class="font-semibold text-lg">{{ $plant->jenis_tanaman }}</h4>
                                                <p class="text-gray-600">{{ $plant->deskripsi }}</p>
                                                <div class="flex items-center space-x-4 mt-2">
                                                    <span class="text-sm text-gray-500">
                                                        <i class="fas fa-box mr-1"></i> Stok: {{ $plant->stok }}
                                                    </span>
                                                    <span class="text-sm text-gray-500">
                                                        <i class="fas fa-money-bill-wave mr-1"></i> Rp {{ number_format($plant->harga_per_pohon, 0, ',', '.') }}/pohon
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="px-3 py-1 text-sm rounded-full 
                                                {{ $plant->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $plant->status === 'tersedia' ? 'Tersedia' : 'Habis' }}
                                            </span>
                                            <div class="mt-2 space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('petani.tanaman.delete', $plant->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" 
                                                            onclick="return confirm('Hapus tanaman ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-seedling text-4xl mb-4"></i>
                                <p>Belum ada tanaman yang ditambahkan</p>
                                <p class="text-sm">Tambahkan tanaman pertama Anda menggunakan form di atas</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>