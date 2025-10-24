<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petani - PohonUntukEsok</title>
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
                <h1 class="text-3xl font-bold text-primary">Dashboard Petani</h1>
                <p class="text-gray-600">Kelola profil dan tanaman Anda</p>
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

            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded-lg">
                    {{ session('info') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <!-- Status Petani -->
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-user text-2xl text-white"></i>
                            </div>
                            <h3 class="font-bold text-lg">{{ $farmer->nama_lengkap }}</h3>
                            <div class="mt-2">
                                @if($farmer->status === 'approved')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-check-circle mr-1"></i> Disetujui
                                    </span>
                                @elseif($farmer->status === 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-clock mr-1"></i> Menunggu Persetujuan
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Menu -->
                        <nav class="space-y-2">
                            <a href="{{ route('petani.dashboard') }}" 
                               class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            @if($farmer->isApproved())
                                <a href="{{ route('petani.tanaman') }}" 
                                   class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-seedling mr-3"></i>
                                    Kelola Tanaman
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($farmer->isApproved())
                        <!-- Statistik -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                                <div class="text-3xl font-bold text-primary mb-2">{{ $plants->count() }}</div>
                                <div class="text-gray-600">Jenis Tanaman</div>
                            </div>
                            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                                <div class="text-3xl font-bold text-primary mb-2">
                                    {{ $plants->sum('stok') }}
                                </div>
                                <div class="text-gray-600">Total Stok</div>
                            </div>
                            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                                <div class="text-3xl font-bold text-primary mb-2">
                                    {{ $plants->where('status', 'tersedia')->count() }}
                                </div>
                                <div class="text-gray-600">Tanaman Tersedia</div>
                            </div>
                        </div>

                        <!-- Tanaman Terbaru -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-bold text-primary">Tanaman Terbaru</h3>
                                <a href="{{ route('petani.tanaman') }}" 
                                   class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Tambah Tanaman
                                </a>
                            </div>

                            @if($plants->count() > 0)
                                <div class="space-y-4">
                                    @foreach($plants->take(3) as $plant)
                                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                            <div class="flex items-center">
                                                @if($plant->foto_tanaman)
                                                    <img src="{{ Storage::url($plant->foto_tanaman) }}" 
                                                         alt="{{ $plant->jenis_tanaman }}" 
                                                         class="w-12 h-12 object-cover rounded-lg mr-4">
                                                @else
                                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                                        <i class="fas fa-seedling text-gray-400"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h4 class="font-semibold">{{ $plant->jenis_tanaman }}</h4>
                                                    <p class="text-sm text-gray-600">Stok: {{ $plant->stok }} pohon</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="font-bold text-primary">Rp {{ number_format($plant->harga_per_pohon, 0, ',', '.') }}</div>
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $plant->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $plant->status === 'tersedia' ? 'Tersedia' : 'Habis' }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-seedling text-4xl mb-4"></i>
                                    <p>Belum ada tanaman yang ditambahkan</p>
                                    <a href="{{ route('petani.tanaman') }}" class="text-primary hover:underline mt-2 inline-block">
                                        Tambah tanaman pertama Anda
                                    </a>
                                </div>
                            @endif
                        </div>
                    @elseif($farmer->isPending())
                        <!-- Status Pending -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                            <i class="fas fa-clock text-6xl text-yellow-500 mb-4"></i>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Menunggu Persetujuan</h3>
                            <p class="text-gray-600 mb-6">
                                Pendaftaran Anda sebagai petani sedang dalam proses verifikasi oleh tim admin. 
                                Proses ini biasanya memakan waktu 1-3 hari kerja.
                            </p>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-sm text-yellow-800">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Anda akan mendapatkan notifikasi via email ketika pendaftaran disetujui.
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Status Ditolak -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                            <i class="fas fa-times-circle text-6xl text-red-500 mb-4"></i>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Pendaftaran Ditolak</h3>
                            <p class="text-gray-600 mb-4">
                                Maaf, pendaftaran Anda sebagai petani tidak dapat disetujui.
                            </p>
                            @if($farmer->catatan_admin)
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                                    <p class="text-sm text-red-800">
                                        <strong>Catatan Admin:</strong> {{ $farmer->catatan_admin }}
                                    </p>
                                </div>
                            @endif
                            <a href="{{ route('petani.daftar') }}" 
                               class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-redo mr-2"></i>Ajukan Ulang Pendaftaran
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>