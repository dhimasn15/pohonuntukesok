<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Petani - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                       class="flex items-center px-4 py-3 bg-primary text-white rounded-lg">
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
                <h1 class="text-3xl font-bold text-primary">Kelola Petani</h1>
                <p class="text-gray-600">Manajemen pendaftaran dan status petani</p>
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

            <!-- Statistik Petani -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ count($pendingFarmers) }}</div>
                            <div class="text-gray-600">Menunggu Persetujuan</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ count($approvedFarmers) }}</div>
                            <div class="text-gray-600">Petani Disetujui</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-times-circle text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">{{ count($rejectedFarmers) }}</div>
                            <div class="text-gray-600">Petani Ditolak</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button id="pending-tab" class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-primary text-primary">
                            <i class="fas fa-clock mr-2"></i>
                            Menunggu Persetujuan
                            <span class="ml-2 bg-yellow-100 text-yellow-800 py-0.5 px-2 rounded-full text-xs">{{ count($pendingFarmers) }}</span>
                        </button>
                        <button id="approved-tab" class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <i class="fas fa-check-circle mr-2"></i>
                            Petani Disetujui
                            <span class="ml-2 bg-green-100 text-green-800 py-0.5 px-2 rounded-full text-xs">{{ count($approvedFarmers) }}</span>
                        </button>
                        <button id="rejected-tab" class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <i class="fas fa-times-circle mr-2"></i>
                            Petani Ditolak
                            <span class="ml-2 bg-red-100 text-red-800 py-0.5 px-2 rounded-full text-xs">{{ count($rejectedFarmers) }}</span>
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Search Box -->
            <div class="mb-6">
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search-input" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-primary focus:border-primary" placeholder="Cari petani...">
                </div>
            </div>

            <!-- Petani yang Menunggu Persetujuan -->
            <div id="pending-section" class="tab-content">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-primary">
                            <i class="fas fa-clock mr-2 text-yellow-500"></i>
                            Menunggu Persetujuan
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        @if(count($pendingFarmers) > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pendaftaran</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($pendingFarmers as $farmer)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-semibold">
                                                {{ substr($farmer->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $farmer->user->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $farmer->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $farmer->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $farmer->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $farmer->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <form action="{{ route('admin.petani.approve', $farmer->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                    <i class="fas fa-check mr-1"></i> Setujui
                                                </button>
                                            </form>
                                            <button type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors" onclick="openModal('rejectModal{{ $farmer->id }}')">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center py-12">
                            <i class="fas fa-clock text-gray-300 text-5xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada petani yang menunggu persetujuan</h3>
                            <p class="text-gray-500">Semua pendaftaran petani telah diproses.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Petani yang Disetujui -->
            <div id="approved-section" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-primary">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            Petani yang Disetujui
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        @if(count($approvedFarmers) > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Persetujuan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($approvedFarmers as $farmer)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-green-500 text-white rounded-full flex items-center justify-center font-semibold">
                                                {{ substr($farmer->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $farmer->user->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $farmer->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $farmer->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($farmer->approved_at)
                                            <div class="text-sm text-gray-900">{{ $farmer->approved_at->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ $farmer->approved_at->format('H:i') }}</div>
                                        @else
                                            <span class="text-sm text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i> Disetujui
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center py-12">
                            <i class="fas fa-check-circle text-gray-300 text-5xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada petani yang disetujui</h3>
                            <p class="text-gray-500">Setujui pendaftaran petani untuk melihatnya di sini.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Petani yang Ditolak -->
            <div id="rejected-section" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-primary">
                            <i class="fas fa-times-circle mr-2 text-red-500"></i>
                            Petani yang Ditolak
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        @if(count($rejectedFarmers) > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Penolakan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($rejectedFarmers as $farmer)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-red-500 text-white rounded-full flex items-center justify-center font-semibold">
                                                {{ substr($farmer->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $farmer->user->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $farmer->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $farmer->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $farmer->updated_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $farmer->updated_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $farmer->catatan_admin }}">
                                            {{ $farmer->catatan_admin }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center py-12">
                            <i class="fas fa-times-circle text-gray-300 text-5xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada petani yang ditolak</h3>
                            <p class="text-gray-500">Semua pendaftaran petani telah disetujui.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Penolakan -->
    @foreach($pendingFarmers as $farmer)
    <div id="rejectModal{{ $farmer->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-2xl bg-white">
            <div class="mt-3">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Tolak Pendaftaran Petani</h3>
                    <div class="mt-2 px-4 py-3">
                        <p class="text-sm text-gray-500 mb-4">Anda akan menolak pendaftaran petani:</p>
                        <div class="bg-gray-50 p-3 rounded-lg mb-4">
                            <p class="font-medium text-gray-900">{{ $farmer->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $farmer->user->email }}</p>
                        </div>
                        <form action="{{ route('admin.petani.reject', $farmer->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="catatan_admin" class="block text-sm font-medium text-gray-700 text-left mb-1">Alasan Penolakan</label>
                                <textarea id="catatan_admin" name="catatan_admin" rows="3" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Berikan alasan penolakan..." required></textarea>
                                <p class="mt-1 text-xs text-gray-500 text-left">Alasan penolakan akan dikirimkan kepada petani.</p>
                            </div>
                            <div class="flex justify-end space-x-3 mt-5">
                                <button type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors" onclick="closeModal('rejectModal{{ $farmer->id }}')">
                                    Batal
                                </button>
                                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    Tolak Pendaftaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetId = this.id.replace('-tab', '-section');
                    
                    // Update active tab
                    tabs.forEach(t => {
                        t.classList.remove('border-primary', 'text-primary');
                        t.classList.add('border-transparent', 'text-gray-500');
                    });
                    this.classList.add('border-primary', 'text-primary');
                    this.classList.remove('border-transparent', 'text-gray-500');
                    
                    // Show target content
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    document.getElementById(targetId).classList.remove('hidden');
                });
            });
            
            // Search functionality
            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const activeSection = document.querySelector('.tab-content:not(.hidden)');
                const rows = activeSection.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fixed')) {
                e.target.classList.add('hidden');
            }
        });
    </script>
</body>
</html>