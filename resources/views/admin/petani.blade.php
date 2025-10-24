@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Petani</h1>
        
        <!-- Petani yang Menunggu Persetujuan -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-clock me-1"></i>
                Menunggu Persetujuan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingFarmers as $farmer)
                            <tr>
                                <td>{{ $farmer->user->name }}</td>
                                <td>{{ $farmer->user->email }}</td>
                                <td>{{ $farmer->created_at->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.petani.approve', $farmer->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $farmer->id }}">
                                        Tolak
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Modal Penolakan -->
                            <div class="modal fade" id="rejectModal{{ $farmer->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tolak Pendaftaran Petani</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.petani.reject', $farmer->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="catatan_admin" class="form-label">Alasan Penolakan</label>
                                                    <textarea class="form-control" id="catatan_admin" name="catatan_admin" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Tolak Pendaftaran</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Petani yang Disetujui -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-check me-1"></i>
                Petani yang Disetujui
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Persetujuan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($approvedFarmers as $farmer)
                            <tr>
                                <td>{{ $farmer->user->name }}</td>
                                <td>{{ $farmer->user->email }}</td>
                                <td>{{ $farmer->approved_at ? $farmer->approved_at->format('d M Y') : '-' }}</td>
                                <td>
                                    <span class="badge bg-success">Disetujui</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Petani yang Ditolak -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-times me-1"></i>
                Petani yang Ditolak
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Penolakan</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rejectedFarmers as $farmer)
                            <tr>
                                <td>{{ $farmer->user->name }}</td>
                                <td>{{ $farmer->user->email }}</td>
                                <td>{{ $farmer->updated_at->format('d M Y') }}</td>
                                <td>{{ $farmer->catatan_admin }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection