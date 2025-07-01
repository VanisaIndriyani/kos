@extends('layouts.admin')

@section('title', 'Dashboard Admin - KosKu')

@section('styles')
<style>
    .dashboard-card {
        border: none;
        background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%);
        box-shadow: 0 2px 12px rgba(185,122,86,0.10);
        border-radius: 18px;
        color: #6d4c1b;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .dashboard-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 6px 24px rgba(185,122,86,0.13);
    }
    .dashboard-card .fa-2x {
        font-size: 2.5rem;
        color: #b97a56;
        background: #f7e9d2;
        border-radius: 50%;
        padding: 12px;
        margin-right: 1rem;
    }
    .dashboard-title {
        color: #b97a56;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .dashboard-badge {
        background: #b97a56;
        color: #fff;
        border-radius: 18px;
        font-size: 1rem;
        padding: 0.5rem 1.2rem;
        font-weight: 600;
    }
    .table thead th {
        background: #f7e9d2;
        color: #6d4c1b;
        border-bottom: 2px solid #e6c9a8;
    }
    .table-hover tbody tr:hover {
        background: #fffaf4;
    }
    .card-header.bg-light {
        background: #f7e9d2 !important;
        color: #b97a56;
        font-weight: bold;
        border-bottom: 1px solid #e6c9a8;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 dashboard-title"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h1>
    <span class="dashboard-badge">Selamat datang, Admin!</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bed fa-2x me-3"></i>
                    <div>
                        <h5 class="card-title mb-0">Total Kamar</h5>
                        <h2 class="mb-0">{{ $totalRooms }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check fa-2x me-3"></i>
                    <div>
                        <h5 class="card-title mb-0">Tersedia</h5>
                        <h2 class="mb-0">{{ $availableRooms }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-times fa-2x me-3"></i>
                    <div>
                        <h5 class="card-title mb-0">Penuh</h5>
                        <h2 class="mb-0">{{ $fullRooms }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-envelope fa-2x me-3"></i>
                    <div>
                        <h5 class="card-title mb-0">Pesan Baru</h5>
                        <h2 class="mb-0">{{ $unreadMessages }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="fas fa-envelope-open-text me-2"></i>Pesan Terbaru</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama Pengirim</th>
                        <th>Kamar</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $msg)
                    <tr>
                        <td>{{ $msg->nama_pengirim }}</td>
                        <td>{{ $msg->room->nama_kamar ?? '-' }}</td>
                        <td>{{ Str::limit($msg->pesan, 40) }}</td>
                        <td>
                            @if($msg->dibaca)
                                <span class="badge bg-secondary">Dibaca</span>
                            @else
                                <span class="badge bg-warning text-dark">Baru</span>
                            @endif
                        </td>
                        <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 