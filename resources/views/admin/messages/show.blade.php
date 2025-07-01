@extends('layouts.admin')

@section('title', 'Detail Pesan - Admin KosKu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0"><i class="fas fa-envelope-open me-2"></i>Detail Pesan</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Kembali
        </a>
        <a href="{{ route('admin.messages.edit', $message) }}" class="btn btn-warning">
            <i class="fas fa-edit me-1"></i>Edit
        </a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"><i class="fas fa-trash me-1"></i>Hapus</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Pesan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Status:</strong> 
                            @if($message->dibaca)
                                <span class="badge bg-success">Dibaca</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum Dibaca</span>
                            @endif
                        </p>
                        <p><strong>Tanggal Kirim:</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Kamar:</strong> {{ $message->room->nama_kamar ?? 'Tidak ada kamar' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nama Pengirim:</strong> {{ $message->nama_pengirim }}</p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $message->email_pengirim }}">{{ $message->email_pengirim }}</a></p>
                        <p><strong>Telepon:</strong> <a href="tel:{{ $message->telepon_pengirim }}">{{ $message->telepon_pengirim }}</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-comment me-2"></i>Isi Pesan</h5>
            </div>
            <div class="card-body">
                <div class="bg-light p-3 rounded">
                    {{ $message->pesan }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @if($message->room)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bed me-2"></i>Informasi Kamar</h5>
            </div>
            <div class="card-body">
                <img src="{{ asset($message->room->foto_utama) }}" class="img-fluid rounded mb-3" alt="Foto Kamar">
                <h6>{{ $message->room->nama_kamar }}</h6>
                <p class="text-muted">{{ $message->room->lokasi }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($message->room->harga_sewa, 0, ',', '.') }}/bulan</p>
                <p><strong>Status:</strong> 
                    <span class="badge {{ $message->room->status === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($message->room->status) }}
                    </span>
                </p>
                <a href="{{ route('admin.rooms.edit', $message->room) }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit me-1"></i>Edit Kamar
                </a>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Kontak Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $message->email_pengirim }}?subject=Balasan: {{ $message->room->nama_kamar ?? 'Pertanyaan Kamar' }}" 
                       class="btn btn-outline-primary">
                        <i class="fas fa-envelope me-1"></i>Balas Email
                    </a>
                    <a href="https://wa.me/{{ $message->telepon_pengirim }}?text=Halo {{ $message->nama_pengirim }}, terima kasih atas pesan Anda mengenai {{ $message->room->nama_kamar ?? 'kamar kos' }}. Kami akan segera menghubungi Anda." 
                       class="btn btn-outline-success" target="_blank">
                        <i class="fab fa-whatsapp me-1"></i>WhatsApp
                    </a>
                    <a href="tel:{{ $message->telepon_pengirim }}" class="btn btn-outline-info">
                        <i class="fas fa-phone me-1"></i>Telepon
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 