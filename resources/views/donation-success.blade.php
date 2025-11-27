@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <!-- Success Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Success Header -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-8 text-center">
            <div class="inline-block bg-white bg-opacity-20 p-4 rounded-full mb-4">
                <i class="fas fa-check text-white text-5xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Donasi Berhasil!</h1>
            <p class="text-green-100">Terima kasih atas dukungan Anda untuk menanam pohon</p>
        </div>

        <!-- Donation Details -->
        <div class="p-8 space-y-6">
            <!-- Campaign Info -->
            <div class="border-b pb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Kampanye</h2>
                <div class="flex items-start gap-4">
                    @if($donation->campaign->image)
                        <img src="{{ asset('storage/' . $donation->campaign->image) }}" 
                             alt="{{ $donation->campaign->title }}" 
                             class="w-20 h-20 object-cover rounded-lg">
                    @else
                        <div class="w-20 h-20 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tree text-green-600 text-2xl"></i>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $donation->campaign->title }}</h3>
                        <p class="text-gray-600 text-sm">{{ $donation->campaign->location }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="border-b pb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Pembayaran</h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Nominal Donasi</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Jumlah Pohon</span>
                        <span class="font-semibold text-gray-800">{{ $donation->trees_count }} pohon</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status Pembayaran</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Terbayar
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Tanggal Pembayaran</span>
                        <span class="font-semibold text-gray-800">{{ $donation->paid_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Donor Info -->
            <div class="border-b pb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Pendonasi</h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Nama</span>
                        <span class="font-semibold text-gray-800">{{ $donation->donor_name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Email</span>
                        <span class="font-semibold text-gray-800 text-sm">{{ $donation->donor_email }}</span>
                    </div>
                </div>
            </div>

            <!-- Message -->
            @if($donation->message)
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                    <h3 class="font-semibold text-gray-800 mb-2">Pesan Anda</h3>
                    <p class="text-gray-700">{{ $donation->message }}</p>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4">
                <a href="{{ route('kampanye.show', $donation->campaign) }}" class="flex-1 bg-primary text-white text-center py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Kampanye
                </a>
                <a href="{{ route('kampanye') }}" class="flex-1 bg-gray-200 text-gray-800 text-center py-3 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="mt-8 bg-blue-50 rounded-xl p-6 border-l-4 border-blue-500">
        <h3 class="font-semibold text-blue-900 mb-2">
            <i class="fas fa-info-circle mr-2"></i>Apa Selanjutnya?
        </h3>
        <ul class="text-blue-800 space-y-2 text-sm">
            <li><i class="fas fa-check text-green-600 mr-2"></i>Kami akan mengirimkan konfirmasi donasi ke email Anda</li>
            <li><i class="fas fa-tree text-green-600 mr-2"></i>Pohon-pohon akan ditanam sesuai jadwal kampanye</li>
            <li><i class="fas fa-camera text-green-600 mr-2"></i>Anda akan menerima update foto proses penanaman</li>
        </ul>
    </div>
</div>
@endsection
