<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                       class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
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
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-primary">Dashboard Admin</h1>
                <p class="text-gray-600">Overview sistem PohonUntukEsok</p>
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

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</div>
                            <div class="text-gray-600">Total User</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-user-tie text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_farmers'] }}</div>
                            <div class="text-gray-600">Total Petani</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ $stats['pending_farmers'] }}</div>
                            <div class="text-gray-600">Petani Pending</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-seedling text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_plants'] }}</div>
                            <div class="text-gray-600">Total Pohon</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Chart Status Petani -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-primary mb-4">Status Petani</h3>
                    <canvas id="farmersChart" width="400" height="200"></canvas>
                </div>

                <!-- Chart Status Kampanye -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-primary mb-4">Status Kampanye</h3>
                    <canvas id="campaignsChart" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Petani Terbaru -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-primary">Petani Terbaru</h3>
                        <a href="{{ route('admin.petani') }}" class="text-primary hover:underline text-sm">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentFarmers as $farmer)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div>
                                    <h4 class="font-semibold">{{ $farmer->nama_lengkap }}</h4>
                                    <p class="text-sm text-gray-600">{{ $farmer->user->email }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $farmer->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                       ($farmer->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $farmer->status === 'approved' ? 'Disetujui' : 
                                       ($farmer->status === 'pending' ? 'Pending' : 'Ditolak') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Kampanye Terbaru -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-primary">Kampanye Terbaru</h3>
                        <a href="{{ route('admin.kampanye') }}" class="text-primary hover:underline text-sm">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentCampaigns as $campaign)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-semibold truncate">{{ $campaign->title }}</h4>
                                    <p class="text-sm text-gray-600">Oleh: {{ $campaign->user->name }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $campaign->status === 'active' ? 'bg-green-100 text-green-800' : 
                                       ($campaign->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $campaign->status === 'active' ? 'Aktif' : 
                                       ($campaign->status === 'completed' ? 'Selesai' : 'Pending') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Farmers Chart
        const farmersCtx = document.getElementById('farmersChart').getContext('2d');
        const farmersChart = new Chart(farmersCtx, {
            type: 'doughnut',
            data: {
                labels: ['Disetujui', 'Pending', 'Ditolak'],
                datasets: [{
                    data: [
                        {{ $farmersByStatus->where('status', 'approved')->first()->total ?? 0 }},
                        {{ $farmersByStatus->where('status', 'pending')->first()->total ?? 0 }},
                        {{ $farmersByStatus->where('status', 'rejected')->first()->total ?? 0 }}
                    ],
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Campaigns Chart
        const campaignsCtx = document.getElementById('campaignsChart').getContext('2d');
        const campaignsChart = new Chart(campaignsCtx, {
            type: 'bar',
            data: {
                labels: ['Aktif', 'Selesai', 'Pending'],
                datasets: [{
                    label: 'Jumlah Kampanye',
                    data: [
                        {{ $campaignsByStatus->where('status', 'active')->first()->total ?? 0 }},
                        {{ $campaignsByStatus->where('status', 'completed')->first()->total ?? 0 }},
                        {{ $campaignsByStatus->where('status', 'pending')->first()->total ?? 0 }}
                    ],
                    backgroundColor: ['#10B981', '#3B82F6', '#6B7280'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>