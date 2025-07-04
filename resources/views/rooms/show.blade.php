@extends('layouts.app')

@section('title', $room->nama_kamar . ' -  Kos GRAHA')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Foto Kamar -->
        <div class="card mb-4">
            <div class="card-body p-0">
                {{-- Bagian galeri/foto kamar dihapus, hanya informasi kamar yang ditampilkan --}}
            </div>
        </div>

        <!-- Informasi Kamar -->
        <div class="card mb-4" style="background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%); border-radius: 1rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="card-title mb-0 fw-bold text-primary">
                        <i class="fas fa-door-open me-2"></i>{{ $room->nama_kamar }}
                    </h2>
                    <span class="badge {{ $room->status === 'tersedia' ? 'bg-success' : 'bg-danger' }} fs-6">
                        {{ ucfirst($room->status) }}
                    </span>
                </div>
                <div class="mb-4">
                    <h4 class="text-primary">Rp {{ number_format($room->harga_sewa, 0, ',', '.') }}/bulan</h4>
                </div>
                <div class="mb-4">
                    <h5>Deskripsi</h5>
                    <p class="text-muted">{{ $room->deskripsi }}</p>
                </div>
                <div class="mb-4">
                    <h5>Fasilitas</h5>
                    <div class="row">
                        @foreach($room->fasilitas as $fasilitas)
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-check text-success me-2"></i>{{ $fasilitas }}
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3 text-center" style="color:#25d366;">
                    Hubungi Pemilik
                </h5>
                @if($room->status === 'tersedia')
                    <div class="d-grid gap-2">
                        <a href="{{ $waLink }}"
                           class="btn btn-success whatsapp-btn fw-bold w-100"
                           target="_blank">
                            <i class="fab fa-whatsapp me-2"></i>Booking via WhatsApp
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Blok Google Maps API dihapus karena sudah pakai iframe --}}
@endsection 