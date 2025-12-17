<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Dashboard Relawan - PohonUntukEsok</title>
	<link rel="icon" type="image/png" href="{{ asset('img/logo-tittle.png') }}">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50 min-h-screen font-sans">
	@include('layouts.navigation')
	@include('components.auth-modal')

	@php
		// Safe data preparation di view (controller idealnya menyediakan ini)
		$user = auth()->user();
		try {
			$tasks = $tasks ?? \Illuminate\Support\Facades\DB::table('volunteer_tasks')->where('user_id', $user->id)->orderBy('due_date')->limit(8)->get();
			$upcomingEvents = $upcomingEvents ?? \Illuminate\Support\Facades\DB::table('volunteer_events')->where('date', '>=', now())->orderBy('date')->limit(5)->get();
			$totalTasks = $tasks->count();
			$pendingTasks = collect($tasks)->where('status', 'pending')->count();
			$completedTasks = collect($tasks)->where('status', 'completed')->count();
			$hoursVolunteered = \Illuminate\Support\Facades\DB::table('volunteer_logs')->where('user_id', $user->id)->sum('hours') ?? 0;
		} catch (\Throwable $e) {
			$tasks = collect();
			$upcomingEvents = collect();
			$totalTasks = 0;
			$pendingTasks = 0;
			$completedTasks = 0;
			$hoursVolunteered = 0;
		}
	@endphp

	<header class="pt-24 pb-8">
		<div class="container mx-auto px-4">
			<div class="bg-white rounded-2xl shadow-md p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
				<div>
					<h1 class="text-2xl font-bold text-gray-800">Halo, {{ $user->name ?? 'Relawan' }}</h1>
					<p class="text-sm text-gray-600">Terima kasih telah menjadi bagian dari PohonUntukEsok. Berikut ringkasan aktivitas Anda.</p>
				</div>
				<div class="flex gap-3 items-center">
					<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.daftar') ? route('relawan.daftar') : '#' }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
						<i class="fas fa-user-plus mr-2"></i> Daftar Kegiatan
					</a>
					<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.profile') ? route('relawan.profile') : '#' }}" class="px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">
						<i class="fas fa-user-cog mr-2"></i> Pengaturan
					</a>
				</div>
			</div>
		</div>
	</header>

	<main class="container mx-auto px-4 pb-16">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
			<!-- Left: Stats & Quick Actions -->
			<div class="space-y-6">
				<div class="bg-white rounded-2xl shadow p-5">
					<h2 class="text-lg font-semibold mb-4">Ringkasan Relawan</h2>
					<div class="grid grid-cols-2 gap-4">
						<div class="p-4 bg-green-50 rounded-lg">
							<p class="text-sm text-gray-500">Tugas</p>
							<p class="text-2xl font-bold text-green-700">{{ $totalTasks }}</p>
							<p class="text-xs text-gray-500">{{ $completedTasks }} selesai • {{ $pendingTasks }} menunggu</p>
						</div>
						<div class="p-4 bg-yellow-50 rounded-lg">
							<p class="text-sm text-gray-500">Jam Kontribusi</p>
							<p class="text-2xl font-bold text-yellow-700">{{ $hoursVolunteered }} jam</p>
							<p class="text-xs text-gray-500">Total jam tercatat</p>
						</div>
						<div class="p-4 bg-blue-50 rounded-lg col-span-2">
							<p class="text-sm text-gray-500">Event Mendatang</p>
							<p class="text-xl font-semibold text-blue-700">{{ $upcomingEvents->count() }} event</p>
							<p class="text-xs text-gray-500">Cek tanggal & lokasi sebelum hadir</p>
						</div>
					</div>
				</div>

				<div class="bg-white rounded-2xl shadow p-5">
					<h3 class="font-semibold mb-3">Aksi Cepat</h3>
					<div class="flex flex-col gap-3">
						<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.events') ? route('relawan.events') : '#' }}" class="px-4 py-3 bg-primary text-white rounded-lg flex items-center justify-between">
							<span><i class="fas fa-calendar-alt mr-2"></i> Lihat Semua Event</span>
							<i class="fas fa-chevron-right"></i>
						</a>
						<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.tasks.create') ? route('relawan.tasks.create') : '#' }}" class="px-4 py-3 border border-gray-200 rounded-lg flex items-center justify-between">
							<span><i class="fas fa-tasks mr-2"></i> Tambah Aktivitas</span>
							<i class="fas fa-plus"></i>
						</a>
						<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.logs') ? route('relawan.logs') : '#' }}" class="px-4 py-3 border border-gray-200 rounded-lg flex items-center justify-between">
							<span><i class="fas fa-clock mr-2"></i> Catat Jam Kerja</span>
							<i class="fas fa-chevron-right"></i>
						</a>
					</div>
				</div>

				<div class="bg-white rounded-2xl shadow p-5">
					<h3 class="font-semibold mb-3">Informasi Penting</h3>
					<ul class="text-sm text-gray-600 space-y-2">
						<li class="flex items-start gap-2"><i class="fas fa-check-circle text-green-500 mt-1"></i> Pastikan membawa perlengkapan sesuai instruksi event.</li>
						<li class="flex items-start gap-2"><i class="fas fa-info-circle text-blue-500 mt-1"></i> Laporkan hasil kegiatan lewat halaman tugas.</li>
						<li class="flex items-start gap-2"><i class="fas fa-phone-alt text-yellow-500 mt-1"></i> Hubungi koordinator jika ada kendala di lapangan.</li>
					</ul>
				</div>
			</div>

			<!-- Middle: Tasks / Activities -->
			<div class="lg:col-span-2 space-y-6">
				<div class="bg-white rounded-2xl shadow p-5">
					<div class="flex items-center justify-between mb-4">
						<h2 class="text-lg font-semibold">Tugas Saya</h2>
						<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.tasks') ? route('relawan.tasks') : '#' }}" class="text-sm text-gray-500 hover:underline">Lihat semua</a>
					</div>

					@if($tasks->count())
						<table class="w-full text-sm text-left">
							<thead class="text-xs text-gray-500 uppercase">
								<tr>
									<th class="py-2">Judul</th>
									<th class="py-2 hidden md:table-cell">Lokasi</th>
									<th class="py-2">Tanggal</th>
									<th class="py-2">Status</th>
									<th class="py-2"></th>
								</tr>
							</thead>
							<tbody class="divide-y">
								@foreach($tasks as $task)
								<tr>
									<td class="py-3">{{ $task->title ?? ($task->name ?? 'Tugas tanpa judul') }}</td>
									<td class="py-3 hidden md:table-cell">{{ $task->location ?? '-' }}</td>
									<td class="py-3">{{ isset($task->due_date) ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}</td>
									<td class="py-3">
										@if(($task->status ?? '') === 'completed')
											<span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Selesai</span>
										@elseif(($task->status ?? '') === 'in_progress')
											<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Berlangsung</span>
										@else
											<span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">Menunggu</span>
										@endif
									</td>
									<td class="py-3">
										<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.tasks.show') ? route('relawan.tasks.show', $task->id ?? '#') : '#' }}" class="text-sm text-primary hover:underline">Detail</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="text-center py-8 text-gray-500">
							<i class="fas fa-clipboard-list text-3xl mb-3"></i>
							<p>Belum ada tugas. Telusuri event untuk bergabung.</p>
						</div>
					@endif
				</div>

				<div class="bg-white rounded-2xl shadow p-5">
					<div class="flex items-center justify-between mb-4">
						<h2 class="text-lg font-semibold">Event Mendatang</h2>
						<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.events') ? route('relawan.events') : '#' }}" class="text-sm text-gray-500 hover:underline">Lihat semua</a>
					</div>

					@if($upcomingEvents->count())
						<ul class="space-y-3">
							@foreach($upcomingEvents as $ev)
								<li class="p-3 border border-gray-100 rounded-lg flex items-center justify-between">
									<div>
										<div class="font-semibold">{{ $ev->title ?? ($ev->name ?? 'Event') }}</div>
										<div class="text-xs text-gray-500">{{ isset($ev->date) ? \Carbon\Carbon::parse($ev->date)->format('d M Y') : '-' }} • {{ $ev->location ?? 'Lokasi belum ditentukan' }}</div>
									</div>
									<a href="{{ \Illuminate\Support\Facades\Route::has('relawan.events.show') ? route('relawan.events.show', $ev->id ?? '#') : '#' }}" class="text-sm text-green-600 hover:underline">Daftar / Detail</a>
								</li>
							@endforeach
						</ul>
					@else
						<div class="text-center py-6 text-gray-500">
							<i class="fas fa-calendar-day text-3xl mb-3"></i>
							<p>Tidak ada event yang dijadwalkan.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</main>

	@include('layouts.footer')
</body>
</html>
