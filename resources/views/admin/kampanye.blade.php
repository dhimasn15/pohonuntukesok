@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Kampanye</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-seedling me-1"></i>
                Daftar Kampanye
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pembuat</th>
                            <th>Target Donasi</th>
                            <th>Terkumpul</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaigns as $campaign)
                            <tr>
                                <td>{{ $campaign->title }}</td>
                                <td>{{ $campaign->user->name }}</td>
                                <td>Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($campaign->status === 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($campaign->status === 'completed')
                                        <span class="badge bg-primary">Selesai</span>
                                    @elseif($campaign->status === 'pending')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $campaign->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('kampanye.show', $campaign->id) }}" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection