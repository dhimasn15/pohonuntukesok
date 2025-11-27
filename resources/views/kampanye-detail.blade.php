<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->title }} - PohonUntukEsok</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-tittle.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-tittle.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Include Navigation -->
    @include('layouts.navigation')

    <!-- Campaign Detail -->
    <main class="pt-32">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Campaign Header -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <div class="relative h-96">
                    @if($campaign->image)
                        <img src="{{ asset('storage/' . $campaign->image) }}" 
                             alt="{{ $campaign->title }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                            <i class="fas fa-tree text-6xl text-green-300"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="status-badge status-{{ $campaign->status }}">
                            <i class="fas fa-circle mr-1 text-xs"></i>
                            {{ $campaign->status_badge['text'] }}
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="category-badge px-3 py-1 rounded-full text-white text-sm font-semibold bg-primary">
                            {{ ucfirst($campaign->category) }}
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $campaign->title }}</h1>
                    
                    <div class="flex items-center text-gray-600 mb-6">
                        <div class="flex items-center mr-6">
                            <i class="far fa-calendar mr-2"></i>
                            <span>{{ $campaign->days_left }} Hari Lagi</span>
                        </div>
                        <div class="flex items-center mr-6">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $campaign->location }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tree mr-2"></i>
                            <span>{{ $campaign->tree_type }}</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-bold text-green-700">{{ $campaign->progress_percentage }}% Terkumpul</span>
                            <span>{{ number_format($campaign->current_trees) }}/{{ number_format($campaign->target_trees) }} pohon</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-primary" style="width: {{ $campaign->progress_percentage }}%"></div>
                        </div>
                    </div>

                    <!-- Campaign Stats -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="text-center p-4 bg-gray-50 rounded-xl">
                            <div class="text-2xl font-bold text-primary mb-1">{{ number_format($campaign->target_trees) }}</div>
                            <div class="text-sm text-gray-600">Target Pohon</div>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-xl">
                            <div class="text-2xl font-bold text-primary mb-1">Rp {{ number_format($campaign->tree_price) }}</div>
                            <div class="text-sm text-gray-600">Biaya per Pohon</div>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-xl">
                            <div class="text-2xl font-bold text-primary mb-1">{{ $campaign->total_donors }}</div>
                            <div class="text-sm text-gray-600">Total Donatur</div>
                        </div>
                    </div>

                    <!-- Donation Button -->
                    @if($campaign->status === 'active')
                    <div class="flex gap-4">
                        <button onclick="openDonationModal({{ $campaign->id }}, {{ $campaign->tree_price }})" class="flex-1 bg-primary text-white text-center py-4 rounded-xl hover:bg-green-700 transition-colors font-semibold">
                            <i class="fas fa-hand-holding-heart mr-2"></i> Donasi Sekarang
                        </button>
                        <button class="w-14 h-14 border-2 border-primary text-primary rounded-xl hover:bg-primary hover:text-white transition-colors">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                    @else
                    <div class="text-center py-4 bg-gray-100 rounded-xl text-gray-600 font-semibold">
                        {{ $campaign->status === 'completed' ? 'Kampanye Telah Selesai' : 'Kampanye Akan Datang' }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Campaign Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Description -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tentang Kampanye</h2>
                        <div class="prose max-w-none">
                            {{ $campaign->description }}
                        </div>
                    </div>

                    <!-- Benefits -->
                    @if($campaign->benefits)
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Manfaat</h2>
                        <div class="prose max-w-none">
                            {{ $campaign->benefits }}
                        </div>
                    </div>
                    @endif

                    <!-- Planting Method -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Metode Penanaman</h2>
                        <div class="flex items-center space-x-4 text-gray-600">
                            <i class="fas fa-seedling text-2xl text-primary"></i>
                            <span>{{ ucfirst($campaign->planting_method) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Campaign Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Kampanye</h3>
                        <div class="space-y-4 text-gray-600">
                            <div class="flex justify-between">
                                <span>Dibuat oleh</span>
                                <span class="font-semibold">{{ $campaign->user->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tanggal Mulai</span>
                                <span class="font-semibold">{{ $campaign->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Durasi</span>
                                <span class="font-semibold">{{ $campaign->campaign_duration }} hari</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Perkiraan Tanam</span>
                                <span class="font-semibold">{{ $campaign->planting_date->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Lokasi Penanaman</h3>
                        <div class="rounded-xl overflow-hidden h-48 mb-4">
                            <!-- Add map here if you have coordinates -->
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <i class="fas fa-map-marker-alt text-4xl"></i>
                            </div>
                        </div>
                        <p class="text-gray-600">{{ $campaign->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Donation Modal -->
    <div id="donationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 p-4" style="display: none;">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-96 overflow-y-auto">
                <div class="sticky top-0 bg-primary text-white p-6 flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Donasi untuk Kampanye</h3>
                    <button type="button" onclick="closeDonationModal()" class="text-2xl hover:opacity-80">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="donationForm" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" id="campaignId" name="campaign_id">
                    <input type="hidden" name="tree_price" id="treePrice">

                <!-- Tree Count Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Pohon</label>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="decrementTrees()" class="p-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" id="treesCount" name="trees_count" value="1" min="1" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-center font-semibold" onchange="updateAmount()">
                        <button type="button" onclick="incrementTrees()" class="p-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Amount Display -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Total Donasi</p>
                    <p class="text-2xl font-bold text-primary">Rp <span id="amountDisplay">0</span></p>
                    <input type="hidden" id="amount" name="amount">
                </div>

                <!-- Donor Info -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="donor_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="donor_email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan (Opsional)</label>
                    <textarea name="message" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" rows="3" placeholder="Pesan dukungan Anda..."></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                    <i class="fas fa-lock mr-2"></i> Lanjutkan ke Pembayaran
                </button>

                <!-- Loading Spinner -->
                <div id="loadingSpinner" class="hidden text-center">
                    <div class="inline-block animate-spin">
                        <i class="fas fa-spinner text-primary text-2xl"></i>
                    </div>
                    <p class="mt-2 text-gray-600">Sedang memproses...</p>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        let currentTreePrice = 0;
        let currentCampaignId = 0;

        function closeDonationModal() {
            document.getElementById('donationModal').classList.add('hidden');
            document.getElementById('donationModal').style.display = 'none';
            document.getElementById('donationForm').reset();
        }

        function openDonationModal(campaignId, treePrice) {
            currentCampaignId = campaignId;
            currentTreePrice = treePrice;
            
            document.getElementById('campaignId').value = campaignId;
            document.getElementById('treePrice').value = treePrice;
            document.getElementById('donationModal').classList.remove('hidden');
            document.getElementById('donationModal').style.display = 'block';
            document.getElementById('treesCount').value = 1;
            updateAmount();
        }

        function incrementTrees() {
            const input = document.getElementById('treesCount');
            input.value = parseInt(input.value) + 1;
            updateAmount();
        }

        function decrementTrees() {
            const input = document.getElementById('treesCount');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateAmount();
            }
        }

        function updateAmount() {
            const trees = parseInt(document.getElementById('treesCount').value) || 1;
            const amount = trees * currentTreePrice;
            
            document.getElementById('amount').value = amount;
            document.getElementById('amountDisplay').textContent = new Intl.NumberFormat('id-ID').format(amount);
        }

        document.getElementById('donationForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const loadingSpinner = document.getElementById('loadingSpinner');

            submitBtn.style.display = 'none';
            loadingSpinner.classList.remove('hidden');

            try {
                const response = await fetch('{{ route("donate") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.status === 'success') {
                    // Store donation ID in session storage
                    sessionStorage.setItem('donationId', data.donation_id);
                    
                    // Redirect to Xendit invoice URL
                    window.location.href = data.invoice_url;
                } else {
                    alert('Error: ' + data.message);
                    submitBtn.style.display = 'block';
                    loadingSpinner.classList.add('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
                submitBtn.style.display = 'block';
                loadingSpinner.classList.add('hidden');
            }
        });

        // Close modal on outside click
        document.getElementById('donationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDonationModal();
            }
        });
    </script>
</body>
</html>