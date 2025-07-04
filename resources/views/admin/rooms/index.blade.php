@extends('layouts.admin')

@section('title', 'Kelola Kamar - Admin KosKu')

@section('styles')
<style>
    .rooms-card {
        border: none;
        background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%);
        box-shadow: 0 2px 12px rgba(185,122,86,0.10);
        border-radius: 18px;
        color: #6d4c1b;
    }
    .table thead th, .table-light th {
        background: #f7e9d2 !important;
        color: #6d4c1b;
        border-bottom: 2px solid #e6c9a8;
    }
    .table-hover tbody tr:hover {
        background: #fffaf4;
    }
    .badge.bg-success {
        background: #25d366 !important;
        color: #fff;
        font-weight: 600;
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 0.4em 1em;
    }
    .badge.bg-danger {
        background: #b97a56 !important;
        color: #fff;
        font-weight: 600;
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 0.4em 1em;
    }
    .badge.bg-light.text-dark {
        background: #f7e9d2 !important;
        color: #6d4c1b !important;
        border-radius: 10px;
        font-size: 0.92rem;
        margin-right: 2px;
    }
    .btn-primary, .btn-warning, .btn-danger {
        border-radius: 20px !important;
        font-weight: 600;
        border: none;
    }
    .btn-warning {
        background: #ffe0a3;
        color: #b97a56;
    }
    .btn-warning:hover, .btn-warning:focus {
        background: #b97a56;
        color: #fff;
    }
    .btn-danger {
        background: #b97a56;
    }
    .btn-danger:hover, .btn-danger:focus {
        background: #6d4c1b;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0"><i class="fas fa-bed me-2"></i>Kelola Kamar</h1>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Tambah Kamar
    </a>
</div>

<div class="card shadow-sm rooms-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Kamar</th>
                        <th>Harga</th>
                        <th>Status</th>
                       
                        <th>Fasilitas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    <tr>
                        <td class="fw-semibold">{{ $room->nama_kamar }}</td>
                        <td class="text-primary">Rp {{ number_format($room->harga_sewa, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $room->status === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($room->status) }}
                            </span>
                        </td>
                        <td>
                            @foreach(array_slice($room->fasilitas, 0, 2) as $fasilitas)
                                <span class="badge bg-light text-dark">{{ $fasilitas }}</span>
                            @endforeach
                            @if(count($room->fasilitas) > 2)
                                <span class="badge bg-light text-dark">+{{ count($room->fasilitas) - 2 }} lagi</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data kamar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
