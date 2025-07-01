@extends('layouts.admin')

@section('title', 'Kelola Pesan - Admin KosKu')

@section('styles')
<style>
    .messages-card {
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
    .badge.bg-warning.text-dark {
        background: #ffe0a3 !important;
        color: #b97a56 !important;
        font-weight: 600;
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 0.4em 1em;
    }
    .badge.bg-secondary {
        background: #b97a56 !important;
        color: #fff;
        font-weight: 600;
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 0.4em 1em;
    }
    .btn-outline-primary, .btn-outline-warning, .btn-outline-secondary {
        border-radius: 20px !important;
        font-weight: 600;
        border: 2px solid #b97a56 !important;
        color: #b97a56 !important;
        background: #fffaf4;
        transition: background 0.2s, color 0.2s;
    }
    .btn-outline-primary.active, .btn-outline-primary:focus, .btn-outline-primary:hover {
        background: #b97a56 !important;
        color: #fff !important;
        border-color: #b97a56 !important;
    }
    .btn-outline-warning.active, .btn-outline-warning:focus, .btn-outline-warning:hover {
        background: #ffe0a3 !important;
        color: #b97a56 !important;
        border-color: #ffe0a3 !important;
    }
    .btn-outline-secondary.active, .btn-outline-secondary:focus, .btn-outline-secondary:hover {
        background: #6d4c1b !important;
        color: #fff !important;
        border-color: #6d4c1b !important;
    }
    .btn-info, .btn-success, .btn-warning, .btn-danger {
        border-radius: 20px !important;
        font-weight: 600;
        border: none;
    }
    .btn-info {
        background: #b97a56;
        color: #fff;
    }
    .btn-info:hover, .btn-info:focus {
        background: #6d4c1b;
        color: #fff;
    }
    .btn-success {
        background: #25d366;
    }
    .btn-success:hover, .btn-success:focus {
        background: #128c7e;
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
    <h1 class="h4 mb-0"><i class="fas fa-envelope me-2"></i>Kelola Pesan</h1>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-primary" onclick="filterMessages('all')">
            <i class="fas fa-list me-1"></i>Semua
        </button>
        <button class="btn btn-outline-warning" onclick="filterMessages('unread')">
            <i class="fas fa-envelope me-1"></i>Belum Dibaca
        </button>
        <button class="btn btn-outline-secondary" onclick="filterMessages('read')">
            <i class="fas fa-envelope-open me-1"></i>Sudah Dibaca
        </button>
    </div>
</div>

<div class="card messages-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Status</th>
                        <th>Nama Pengirim</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Kamar</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                    <tr class="message-row" data-status="{{ $message->dibaca ? 'read' : 'unread' }}">
                        <td>
                            @if($message->dibaca)
                                <span class="badge bg-secondary">Dibaca</span>
                            @else
                                <span class="badge bg-warning text-dark">Baru</span>
                            @endif
                        </td>
                        <td>{{ $message->nama_pengirim }}</td>
                        <td>{{ $message->email_pengirim }}</td>
                        <td>{{ $message->telepon_pengirim }}</td>
                        <td>{{ $message->room->nama_kamar ?? '-' }}</td>
                        <td>{{ Str::limit($message->pesan, 50) }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$message->dibaca)
                                <form action="{{ route('admin.messages.mark-read', $message) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function filterMessages(status) {
    const rows = document.querySelectorAll('.message-row');
    
    rows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
@endsection 