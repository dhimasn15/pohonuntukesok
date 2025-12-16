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
                        'primary-light': '#3d6b3a',
                        'primary-dark': '#1a3a1a',
                    }
                }
            }
        };
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Progress bar animation */
        @keyframes progressFill {
            from { width: 0%; }
            to { width: var(--progress-width); }
        }
        
        .progress-animated {
            animation: progressFill 1.5s ease-out forwards;
        }

        /* Smooth modal animation */
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -48%) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        .modal-slide-in {
            animation: modalSlideIn 0.3s ease-out forwards;
        }

        /* Mobile bottom sheet */
        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }
            to {
                transform: translateY(0);
            }
        }

        .slide-up {
            animation: slideUp 0.3s ease-out forwards;
        }

        /* Loading spinner */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Include Navigation -->
    @include('layouts.navigation')

    <!-- Campaign Detail -->
    <main class="pt-24 md:pt-32">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Campaign Header - Responsive -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg overflow-hidden mb-6 md:mb-8">
                <!-- Image Section -->
                <div class="relative h-48 md:h-64 lg:h-96">
                    @if($campaign->image)
                        <img src="{{ asset('storage/' . $campaign->image) }}" 
                             alt="{{ $campaign->title }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                            <i class="fas fa-tree text-4xl md:text-6xl text-green-300"></i>
                        </div>
                    @endif
                    
                    <!-- Badges -->
                    <div class="absolute top-3 md:top-4 left-3 md:left-4 flex flex-col gap-2">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-xs font-semibold text-primary">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            {{ $campaign->status_badge['text'] }}
                        </span>
                        <span class="px-3 py-1 bg-primary text-white rounded-lg text-xs font-semibold">
                            {{ ucfirst($campaign->category) }}
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-4 md:p-6 lg:p-8">
                    <!-- Title -->
                    <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-800 mb-3 md:mb-4">{{ $campaign->title }}</h1>
                    
                    <!-- Campaign Info -->
                    <div class="flex flex-wrap items-center text-gray-600 text-sm md:text-base mb-4 md:mb-6 gap-3 md:gap-6">
                        <div class="flex items-center">
                            <i class="far fa-calendar mr-2 text-primary text-sm"></i>
                            <span>{{ $campaign->days_left }} Hari Lagi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-primary text-sm"></i>
                            <span class="truncate max-w-[150px] md:max-w-none">{{ $campaign->location }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tree mr-2 text-primary text-sm"></i>
                            <span>{{ $campaign->tree_type }}</span>
                        </div>
                    </div>

                    <!-- Progress Bar Section -->
                    @php
                        use Illuminate\Support\Facades\DB;
                        
                        $totalDonations = DB::table('donations')
                            ->where('campaign_id', $campaign->id)
                            ->sum('amount');
                        
                        $fundingGoal = $campaign->target_trees * $campaign->tree_price;
                        $progressPercentage = $fundingGoal > 0 ? min(100, round(($totalDonations / $fundingGoal) * 100, 2)) : 0;
                        
                        function formatRupiah($amount) {
                            return 'Rp ' . number_format($amount, 0, ',', '.');
                        }
                        
                        $calculatedCurrentTrees = $campaign->tree_price > 0 ? floor($totalDonations / $campaign->tree_price) : 0;
                    @endphp

                    <!-- Progress Bar -->
                    <div class="mb-6 md:mb-8">
                        <div class="flex justify-between text-sm mb-2">
                            <span id="progressPercentage" class="font-bold text-primary">{{ $progressPercentage }}% Terkumpul</span>
                            <span id="progressAmount" class="text-gray-600">{{ formatRupiah($totalDonations) }} / {{ formatRupiah($fundingGoal) }}</span>
                        </div>
                        <div class="h-2 md:h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div id="progressBar" class="h-full bg-gradient-to-r from-primary to-primary-light progress-animated" 
                                 style="--progress-width: {{ $progressPercentage }}%; width: 0%;">
                            </div>
                        </div>
                        <div class="mt-2 text-xs md:text-sm text-gray-600 flex justify-between">
                            <span><span id="currentTrees">{{ number_format($calculatedCurrentTrees) }}</span> pohon terkumpul</span>
                            <span>Target: <span id="targetTrees">{{ number_format($campaign->target_trees) }}</span> pohon</span>
                        </div>
                    </div>

                    <!-- Campaign Stats - Grid Responsif -->
                    <div class="grid grid-cols-3 gap-2 md:gap-4 mb-6 md:mb-8">
                        <div class="text-center p-3 md:p-4 bg-gray-50 rounded-lg md:rounded-xl">
                            <div class="text-lg md:text-xl lg:text-2xl font-bold text-primary mb-1">{{ number_format($campaign->target_trees) }}</div>
                            <div class="text-xs md:text-sm text-gray-600">Target Pohon</div>
                        </div>
                        <div class="text-center p-3 md:p-4 bg-gray-50 rounded-lg md:rounded-xl">
                            <div class="text-lg md:text-xl lg:text-2xl font-bold text-primary mb-1">{{ formatRupiah($campaign->tree_price) }}</div>
                            <div class="text-xs md:text-sm text-gray-600">Biaya per Pohon</div>
                        </div>
                        <div class="text-center p-3 md:p-4 bg-gray-50 rounded-lg md:rounded-xl">
                            <div class="text-lg md:text-xl lg:text-2xl font-bold text-primary mb-1">{{ $campaign->total_donors }}</div>
                            <div class="text-xs md:text-sm text-gray-600">Total Donatur</div>
                        </div>
                    </div>

                    <!-- Donation Button -->
                    @if($campaign->status === 'active')
                    <div class="flex gap-3">
                        <button onclick="openDonationModal({{ $campaign->id }}, {{ $campaign->tree_price }})" 
                                class="flex-1 bg-primary text-white text-center py-3 md:py-4 rounded-lg md:rounded-xl hover:bg-primary-dark transition-colors font-semibold text-sm md:text-base">
                            <i class="fas fa-hand-holding-heart mr-2"></i> Donasi Sekarang
                        </button>
                        <button class="w-12 h-12 md:w-14 md:h-14 border border-gray-300 text-gray-600 rounded-lg md:rounded-xl hover:bg-gray-50 transition-colors flex items-center justify-center">
                            <i class="fas fa-share-alt text-sm md:text-base"></i>
                        </button>
                    </div>
                    @else
                    <div class="text-center py-3 md:py-4 bg-gray-100 rounded-lg md:rounded-xl text-gray-600 font-semibold text-sm md:text-base">
                        {{ $campaign->status === 'completed' ? 'Kampanye Telah Selesai' : 'Kampanye Akan Datang' }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Campaign Details - Responsif Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-4 md:space-y-6">
                    <!-- Description -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-gray-800 mb-3 md:mb-4 flex items-center">
                            <i class="fas fa-info-circle text-primary mr-2 text-sm md:text-base"></i>
                            Tentang Kampanye
                        </h2>
                        <div class="text-gray-700 text-sm md:text-base leading-relaxed">
                            {{ $campaign->description }}
                        </div>
                    </div>

                    <!-- Benefits -->
                    @if($campaign->benefits)
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-gray-800 mb-3 md:mb-4 flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-2 text-sm md:text-base"></i>
                            Manfaat
                        </h2>
                        <div class="text-gray-700 text-sm md:text-base leading-relaxed">
                            {{ $campaign->benefits }}
                        </div>
                    </div>
                    @endif

                    <!-- Planting Method -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-gray-800 mb-3 md:mb-4 flex items-center">
                            <i class="fas fa-seedling text-primary mr-2 text-sm md:text-base"></i>
                            Metode Penanaman
                        </h2>
                        <div class="flex items-center text-gray-700 bg-gray-50 p-3 md:p-4 rounded-lg md:rounded-xl">
                            <i class="fas fa-seedling text-primary mr-3 text-lg md:text-xl"></i>
                            <span class="font-medium">{{ ucfirst($campaign->planting_method) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-4 md:space-y-6">
                    <!-- Campaign Info -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-base md:text-lg font-bold text-gray-800 mb-3 md:mb-4 flex items-center">
                            <i class="fas fa-clipboard-list text-primary mr-2 text-sm"></i>
                            Informasi Kampanye
                        </h3>
                        <div class="space-y-3 text-sm md:text-base">
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-600">Dibuat oleh</span>
                                <span class="font-semibold text-gray-800">{{ $campaign->user->name }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-600">Tanggal Mulai</span>
                                <span class="font-semibold text-gray-800">{{ $campaign->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-semibold text-gray-800">{{ $campaign->campaign_duration }} hari</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Perkiraan Tanam</span>
                                <span class="font-semibold text-gray-800">{{ $campaign->planting_date->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Funding Summary -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-base md:text-lg font-bold text-gray-800 mb-3 md:mb-4 flex items-center">
                            <i class="fas fa-chart-line text-primary mr-2 text-sm"></i>
                            Ringkasan Dana
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Terkumpul</span>
                                <span class="font-bold text-primary">{{ formatRupiah($totalDonations) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Target Dana</span>
                                <span class="font-bold text-gray-800">{{ formatRupiah($fundingGoal) }}</span>
                            </div>
                            <div class="pt-3 border-t">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Sisa Kebutuhan</span>
                                    <span class="font-bold text-yellow-600">
                                        {{ formatRupiah(max(0, $fundingGoal - $totalDonations)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-base md:text-lg font-bold text-gray-800 mb-3 md:mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-primary mr-2 text-sm"></i>
                            Lokasi Penanaman
                        </h3>
                        <div class="rounded-lg md:rounded-xl overflow-hidden h-32 md:h-40 mb-3">
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-3xl md:text-4xl text-gray-400"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm md:text-base">{{ $campaign->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Simple Modern Donation Modal -->
    <div id="donationModal" class="hidden fixed inset-0 z-50">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDonationModal()"></div>
        
        <!-- Modal Content -->
        <div class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm md:max-w-md modal-slide-in hidden md:block">
            <div class="bg-white rounded-xl md:rounded-2xl shadow-2xl overflow-hidden mx-4">
                <!-- Header -->
                <div class="bg-primary p-4 md:p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg md:text-xl font-bold text-white">Donasi Sekarang</h3>
                            <p class="text-white/80 text-sm mt-1">{{ $campaign->title }}</p>
                        </div>
                        <button onclick="closeDonationModal()" 
                                class="text-white hover:text-gray-200 w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <!-- Progress Indicator -->
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <div class="h-1 bg-white/30 rounded-full overflow-hidden">
                                <div id="modalProgressBar" class="h-full bg-white transition-all duration-300" style="width: 33%"></div>
                            </div>
                        </div>
                        <span class="text-white text-sm font-medium">1/3</span>
                    </div>
                </div>
                
                <!-- Modal Body -->
                <div class="p-4 md:p-6 max-h-[60vh] overflow-y-auto">
                    <!-- Step 1: Tree Selection -->
                    <div id="step1Content">
                        <div class="mb-6">
                            <h4 class="font-bold text-gray-800 mb-2">Pilih Jumlah Pohon</h4>
                            <p class="text-gray-600 text-sm mb-4">Harga per pohon: <span class="font-bold text-primary">{{ formatRupiah($campaign->tree_price) }}</span></p>
                            
                            <!-- Tree Counter -->
                            <div class="flex items-center justify-center mb-6">
                                <button onclick="decrementTrees()" 
                                        class="w-10 h-10 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 flex items-center justify-center">
                                    <i class="fas fa-minus"></i>
                                </button>
                                
                                <div class="mx-4 text-center">
                                    <input type="number" 
                                           id="treesCount" 
                                           name="trees_count" 
                                           value="1" 
                                           min="1" 
                                           class="w-20 text-3xl font-bold text-center border-0 focus:outline-none"
                                           onchange="updateAmount()">
                                    <p class="text-gray-500 text-sm mt-1">pohon</p>
                                </div>
                                
                                <button onclick="incrementTrees()" 
                                        class="w-10 h-10 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 flex items-center justify-center">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <!-- Quick Selection -->
                            <div class="grid grid-cols-3 gap-2 mb-6">
                                <button type="button" onclick="setTrees(5)" class="py-2 border border-gray-300 rounded-lg hover:border-primary hover:text-primary text-sm">
                                    5 Pohon
                                </button>
                                <button type="button" onclick="setTrees(10)" class="py-2 border border-gray-300 rounded-lg hover:border-primary hover:text-primary text-sm">
                                    10 Pohon
                                </button>
                                <button type="button" onclick="setTrees(20)" class="py-2 border border-gray-300 rounded-lg hover:border-primary hover:text-primary text-sm">
                                    20 Pohon
                                </button>
                            </div>
                            
                            <!-- Total Amount -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <p class="text-gray-600 text-sm mb-1">Total Donasi</p>
                                <p class="text-2xl font-bold text-primary" id="totalAmountDisplay">Rp 0</p>
                            </div>
                        </div>
                        
                        <!-- Next Button -->
                        <button onclick="nextStep()" 
                                class="w-full bg-primary text-white py-3 rounded-lg hover:bg-primary-dark transition-colors font-semibold">
                            Lanjutkan
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                    
                    <!-- Step 2: Donor Info -->
                    <div id="step2Content" class="hidden">
                        <form id="donationForm">
                            @csrf
                            <input type="hidden" id="campaignId" name="campaign_id" value="{{ $campaign->id }}">
                            <input type="hidden" name="tree_price" id="treePrice" value="{{ $campaign->tree_price }}">
                            <input type="hidden" id="amount" name="amount">
                            
                            <h4 class="font-bold text-gray-800 mb-4">Data Diri</h4>
                            
                            <!-- Donor Info -->
                            <div class="space-y-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                                    <input type="text" 
                                           name="donor_name" 
                                           id="donorName" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input type="email" 
                                           name="donor_email" 
                                           id="donorEmail" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp *</label>
                                    <input type="tel" 
                                           name="donor_phone" 
                                           id="donorPhone" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pesan (Opsional)</label>
                                    <textarea name="message" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary" 
                                              rows="2"></textarea>
                                </div>
                            </div>
                            
                            <!-- Navigation Buttons -->
                            <div class="flex gap-2">
                                <button type="button" 
                                        onclick="prevStep()" 
                                        class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
                                </button>
                                <button type="button" 
                                        onclick="validateAndNext()" 
                                        class="flex-1 bg-primary text-white py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                    Lanjut
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Step 3: Confirmation -->
                    <div id="step3Content" class="hidden">
                        <h4 class="font-bold text-gray-800 mb-4">Konfirmasi</h4>
                        
                        <!-- Summary -->
                        <div class="space-y-4 mb-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Jumlah Pohon</span>
                                    <span class="font-bold" id="summaryTrees">1</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Total Donasi</span>
                                    <span class="text-lg font-bold text-primary" id="summaryTotal">Rp 0</span>
                                </div>
                            </div>
                            
                            <div class="text-sm text-gray-600">
                                <p class="mb-1">Nama: <span class="font-medium text-gray-800" id="summaryName">-</span></p>
                                <p class="mb-1">Email: <span class="font-medium text-gray-800" id="summaryEmail">-</span></p>
                                <p>WhatsApp: <span class="font-medium text-gray-800" id="summaryPhone">-</span></p>
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="flex gap-2">
                            <button type="button" 
                                    onclick="prevStep()" 
                                    class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-50 transition-colors">
                                Edit
                            </button>
                            <button type="button" 
                                    onclick="submitDonation()" 
                                    id="submitDonationBtn"
                                    class="flex-1 bg-primary text-white py-3 rounded-lg hover:bg-primary-dark transition-colors font-semibold">
                                <i class="fas fa-lock mr-2"></i>
                                Bayar
                            </button>
                        </div>
                    </div>
                    
                    <!-- Loading -->
                    <div id="loadingOverlay" class="hidden absolute inset-0 bg-white/90 flex items-center justify-center rounded-xl">
                        <div class="text-center">
                            <i class="fas fa-spinner animate-spin text-primary text-2xl mb-2 block"></i>
                            <p class="text-gray-700 font-medium">Memproses...</p>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="border-t border-gray-200 p-4">
                    <p class="text-xs text-gray-500 text-center">
                        <i class="fas fa-lock text-primary mr-1"></i>
                        Transaksi aman & terenkripsi
                    </p>
                </div>
            </div>
        </div>

        <!-- Mobile Bottom Sheet -->
        <div id="mobileDonationModal" class="md:hidden fixed inset-x-0 bottom-0 z-50">
            <div class="bg-white rounded-t-2xl shadow-2xl slide-up">
                <!-- Header -->
                <div class="bg-primary p-4 rounded-t-2xl">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <h3 class="text-lg font-bold text-white">Donasi</h3>
                            <p class="text-white/80 text-sm">{{ $campaign->title }}</p>
                        </div>
                        <button onclick="closeDonationModal()" 
                                class="text-white w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Body -->
                <div class="p-4 max-h-[70vh] overflow-y-auto">
                    <!-- Step content same as desktop but with mobile optimizations -->
                    <div id="mobileStep1Content">
                        <div class="mb-4">
                            <h4 class="font-bold text-gray-800 mb-2">Jumlah Pohon</h4>
                            <p class="text-gray-600 text-sm mb-3">Harga per pohon: <span class="font-bold text-primary">{{ formatRupiah($campaign->tree_price) }}</span></p>
                            
                            <!-- Mobile Tree Counter -->
                            <div class="flex items-center justify-center mb-4">
                                <button onclick="decrementTrees()" 
                                        class="w-12 h-12 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
                                    <i class="fas fa-minus"></i>
                                </button>
                                
                                <div class="mx-4 text-center">
                                    <input type="number" 
                                           id="mobileTreesCount" 
                                           value="1" 
                                           min="1" 
                                           class="w-16 text-2xl font-bold text-center border-0"
                                           onchange="updateMobileAmount()">
                                    <p class="text-gray-500 text-xs">pohon</p>
                                </div>
                                
                                <button onclick="incrementTrees()" 
                                        class="w-12 h-12 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <!-- Mobile Quick Selection -->
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <button type="button" onclick="setMobileTrees(5)" class="py-2 border border-gray-300 rounded-lg text-xs">
                                    5 Pohon
                                </button>
                                <button type="button" onclick="setMobileTrees(10)" class="py-2 border border-gray-300 rounded-lg text-xs">
                                    10 Pohon
                                </button>
                                <button type="button" onclick="setMobileTrees(20)" class="py-2 border border-gray-300 rounded-lg text-xs">
                                    20 Pohon
                                </button>
                            </div>
                            
                            <!-- Mobile Total -->
                            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                <p class="text-gray-600 text-xs mb-1">Total Donasi</p>
                                <p class="text-xl font-bold text-primary" id="mobileTotalAmountDisplay">Rp 0</p>
                            </div>
                        </div>
                        
                        <button onclick="nextMobileStep()" 
                                class="w-full bg-primary text-white py-3 rounded-lg font-semibold">
                            Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true,
            offset: 50
        });

        let currentTreePrice = {{ $campaign->tree_price }};
        let currentStep = 1;
        let isMobile = window.innerWidth < 768;

        // Update responsive state
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth < 768;
        });

        // Campaign progress update
        async function updateCampaignProgress() {
            try {
                const response = await fetch(`/api/campaigns/{{ $campaign->id }}`);
                if (!response.ok) return;
                const data = await response.json();
                
                if (data.status === 'success') {
                    const campaign = data.data;
                    const fundingGoal = (campaign.target_trees || 0) * (campaign.tree_price || 0);
                    
                    let currentAmount = 0;
                    if (typeof campaign.total_donations !== 'undefined') currentAmount = Number(campaign.total_donations);
                    else if (typeof campaign.total_amount !== 'undefined') currentAmount = Number(campaign.total_amount);
                    else if (typeof campaign.donations_sum !== 'undefined') currentAmount = Number(campaign.donations_sum);
                    else if (typeof campaign.current_trees !== 'undefined') currentAmount = Number(campaign.current_trees) * (campaign.tree_price || 0);

                    const treesCollected = (campaign.tree_price && campaign.tree_price > 0)
                        ? Math.floor(currentAmount / campaign.tree_price)
                        : 0;

                    const progressPercentage = fundingGoal > 0
                        ? Math.min(100, Math.round((currentAmount / fundingGoal) * 100))
                        : 0;
                    
                    // Update progress bar
                    const progressBar = document.getElementById('progressBar');
                    if (progressBar) {
                        progressBar.style.setProperty('--progress-width', progressPercentage + '%');
                        progressBar.style.width = progressPercentage + '%';
                    }

                    // Update text elements
                    const progressText = document.getElementById('progressPercentage');
                    const progressAmount = document.getElementById('progressAmount');
                    const currentTreesEl = document.getElementById('currentTrees');
                    const targetTreesEl = document.getElementById('targetTrees');

                    if (progressText) progressText.textContent = progressPercentage + '% Terkumpul';
                    if (progressAmount) progressAmount.textContent = formatRupiah(currentAmount) + ' / ' + formatRupiah(fundingGoal);
                    if (currentTreesEl) currentTreesEl.textContent = new Intl.NumberFormat('id-ID').format(treesCollected);
                    if (targetTreesEl) targetTreesEl.textContent = new Intl.NumberFormat('id-ID').format(campaign.target_trees || 0);
                }
            } catch (error) {
                console.error('Error updating campaign progress:', error);
            }
        }

        setInterval(updateCampaignProgress, 10000);

        // Modal Functions
        function openDonationModal(campaignId, treePrice) {
            currentTreePrice = treePrice;
            
            if (isMobile) {
                document.getElementById('mobileDonationModal').style.display = 'block';
            } else {
                document.getElementById('donationModal').classList.remove('hidden');
                const modal = document.querySelector('.modal-slide-in');
                modal.style.display = 'block';
            }
            
            resetToStep1();
            updateAmount();
            updateMobileAmount();
        }

        function closeDonationModal() {
            if (isMobile) {
                document.getElementById('mobileDonationModal').style.display = 'none';
            } else {
                document.getElementById('donationModal').classList.add('hidden');
                const modal = document.querySelector('.modal-slide-in');
                modal.style.display = 'none';
            }
            
            document.getElementById('donationForm').reset();
            resetToStep1();
        }

        // Step Navigation
        function resetToStep1() {
            currentStep = 1;
            updateStepIndicator();
            document.getElementById('step1Content').classList.remove('hidden');
            document.getElementById('step2Content').classList.add('hidden');
            document.getElementById('step3Content').classList.add('hidden');
            document.getElementById('mobileStep1Content').classList.remove('hidden');
        }

        function nextStep() {
            if (currentStep < 3) {
                document.getElementById(`step${currentStep}Content`).classList.add('hidden');
                currentStep++;
                document.getElementById(`step${currentStep}Content`).classList.remove('hidden');
                updateStepIndicator();
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                document.getElementById(`step${currentStep}Content`).classList.add('hidden');
                currentStep--;
                document.getElementById(`step${currentStep}Content`).classList.remove('hidden');
                updateStepIndicator();
            }
        }

        function updateStepIndicator() {
            const progress = (currentStep / 3) * 100;
            document.getElementById('modalProgressBar').style.width = `${progress}%`;
        }

        // Tree Functions
        function incrementTrees() {
            const input = isMobile ? document.getElementById('mobileTreesCount') : document.getElementById('treesCount');
            input.value = parseInt(input.value) + 1;
            updateAmount();
            if (isMobile) updateMobileAmount();
        }

        function decrementTrees() {
            const input = isMobile ? document.getElementById('mobileTreesCount') : document.getElementById('treesCount');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateAmount();
                if (isMobile) updateMobileAmount();
            }
        }

        function setTrees(count) {
            const input = document.getElementById('treesCount');
            input.value = count;
            updateAmount();
        }

        function setMobileTrees(count) {
            const input = document.getElementById('mobileTreesCount');
            input.value = count;
            updateMobileAmount();
        }

        function updateAmount() {
            const input = document.getElementById('treesCount');
            const trees = parseInt(input.value) || 1;
            const amount = trees * currentTreePrice;
            
            document.getElementById('amount').value = amount;
            document.getElementById('totalAmountDisplay').textContent = formatRupiah(amount);
            document.getElementById('summaryTrees').textContent = trees;
            document.getElementById('summaryTotal').textContent = formatRupiah(amount);
        }

        function updateMobileAmount() {
            const input = document.getElementById('mobileTreesCount');
            const trees = parseInt(input.value) || 1;
            const amount = trees * currentTreePrice;
            
            document.getElementById('mobileTotalAmountDisplay').textContent = formatRupiah(amount);
        }

        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Mobile step navigation (simplified)
        function nextMobileStep() {
            // Validate and proceed to payment directly for mobile
            const donorName = prompt('Nama lengkap:');
            const donorEmail = prompt('Email:');
            const donorPhone = prompt('Nomor WhatsApp:');
            
            if (!donorName || !donorEmail || !donorPhone) {
                alert('Harap isi semua data!');
                return;
            }
            
            // Submit directly for mobile
            submitMobileDonation(donorName, donorEmail, donorPhone);
        }

        // Validate and next for desktop
        function validateAndNext() {
            const donorName = document.getElementById('donorName').value.trim();
            const donorEmail = document.getElementById('donorEmail').value.trim();
            const donorPhone = document.getElementById('donorPhone').value.trim();
            
            if (!donorName || !donorEmail || !donorPhone) {
                alert('Harap isi semua data yang diperlukan!');
                return;
            }
            
            if (!validateEmail(donorEmail)) {
                alert('Email tidak valid!');
                return;
            }
            
            // Update summary
            document.getElementById('summaryName').textContent = donorName;
            document.getElementById('summaryEmail').textContent = donorEmail;
            document.getElementById('summaryPhone').textContent = donorPhone;
            
            nextStep();
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Submit functions
        async function submitDonation() {
            const submitBtn = document.getElementById('submitDonationBtn');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Memproses...';
            loadingOverlay.classList.remove('hidden');
            
            try {
                const formData = new FormData(document.getElementById('donationForm'));
                
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
                    sessionStorage.setItem('donationId', data.donation_id);
                    sessionStorage.setItem('campaignId', document.getElementById('campaignId').value);
                    window.location.href = data.invoice_url;
                } else {
                    alert('Error: ' + data.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-lock mr-2"></i> Bayar';
                    loadingOverlay.classList.add('hidden');
                }
            } catch (error) {
                alert('Terjadi kesalahan: ' + error.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-lock mr-2"></i> Bayar';
                loadingOverlay.classList.add('hidden');
            }
        }

        async function submitMobileDonation(name, email, phone) {
            const trees = parseInt(document.getElementById('mobileTreesCount').value) || 1;
            const amount = trees * currentTreePrice;
            
            const formData = new FormData();
            formData.append('campaign_id', '{{ $campaign->id }}');
            formData.append('tree_price', currentTreePrice);
            formData.append('amount', amount);
            formData.append('trees_count', trees);
            formData.append('donor_name', name);
            formData.append('donor_email', email);
            formData.append('donor_phone', phone);
            formData.append('_token', document.querySelector('[name="_token"]').value);
            
            try {
                const response = await fetch('{{ route("donate") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.status === 'success') {
                    sessionStorage.setItem('donationId', data.donation_id);
                    sessionStorage.setItem('campaignId', '{{ $campaign->id }}');
                    window.location.href = data.invoice_url;
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                alert('Terjadi kesalahan: ' + error.message);
            }
        }

        // Close modal on outside click
        document.getElementById('donationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDonationModal();
            }
        });

        // Initialize progress bar animation
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.getElementById('progressBar');
            if (progressBar) {
                void progressBar.offsetWidth;
                progressBar.style.width = progressBar.style.getPropertyValue('--progress-width');
            }
        });
    </script>
</body>
</html>