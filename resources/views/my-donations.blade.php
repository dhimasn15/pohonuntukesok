@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Riwayat Donasi Saya</h1>
        <p class="text-gray-600">Lihat semua donasi yang telah Anda berikan</p>
    </div>

    @if(auth()->check())
        @if($donations->count() > 0)
            <div class="grid grid-cols-1 gap-6">
                @foreach($donations as $donation)
                    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">
                                    {{ $donation->campaign->title }}
                                </h3>
                                <p class="text-gray-600 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    {{ $donation->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($donation->status === 'paid')
                                    bg-green-100 text-green-700
                                @elseif($donation->status === 'pending')
                                    bg-yellow-100 text-yellow-700
                                @elseif($donation->status === 'expired')
                                    bg-red-100 text-red-700
                                @else
                                    bg-gray-100 text-gray-700
                                @endif
                            ">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-600 text-sm mb-1">Jumlah Pohon</p>
                                <p class="text-2xl font-bold text-primary">{{ $donation->trees_count }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-600 text-sm mb-1">Jumlah Donasi</p>
                                <p class="text-2xl font-bold text-primary">
                                    Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-600 text-sm mb-1">Invoice</p>
                                <p class="text-sm font-mono text-gray-700">{{ substr($donation->external_id, 0, 20) }}...</p>
                            </div>
                        </div>

                        @if($donation->message)
                            <div class="bg-blue-50 p-4 rounded-lg mb-4 border-l-4 border-blue-400">
                                <p class="text-gray-700"><strong>Pesan:</strong> {{ $donation->message }}</p>
                            </div>
                        @endif

                        <div class="flex gap-3">
                            <a href="{{ route('kampanye.show', $donation->campaign) }}" class="text-primary hover:underline font-semibold">
                                <i class="fas fa-arrow-right mr-2"></i>Lihat Kampanye
                            </a>
                            @if($donation->status === 'paid')
                                <a href="{{ route('donation.show', $donation) }}" class="text-primary hover:underline font-semibold">
                                    <i class="fas fa-receipt mr-2"></i>Struk
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $donations->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fas fa-hand-holding-heart text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Donasi</h3>
                <p class="text-gray-600 mb-6">Anda belum melakukan donasi apapun</p>
                <a href="{{ route('kampanye') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                    <i class="fas fa-tree mr-2"></i>Jelajahi Kampanye
                </a>
            </div>
        @endif
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <i class="fas fa-lock text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Silakan Login Terlebih Dahulu</h3>
            <p class="text-gray-600 mb-6">Anda harus login untuk melihat riwayat donasi</p>
            <a href="{{ route('login') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </a>
        </div>
    @endif
</div>
@endsection
