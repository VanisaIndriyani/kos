@extends('layouts.app')

@push('styles')
<style>
.filter-btn {
    border-radius: 2rem !important;
    padding: 0.6rem 1.5rem !important;
    font-size: 1.1rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
}
.filter-btn i {
    font-size: 1.2rem;
}
.filter-btn.active.btn-outline-primary {
    background: #1976d2 !important;
    color: #fff !important;
    border-color: #1976d2 !important;
    box-shadow: 0 2px 12px 0 rgba(25,118,210,0.12);
}
.filter-btn.active.btn-outline-success {
    background: #2e7d32 !important;
    color: #fff !important;
    border-color: #2e7d32 !important;
    box-shadow: 0 2px 12px 0 rgba(46,125,50,0.12);
}
.filter-btn.active.btn-outline-danger {
    background: #d32f2f !important;
    color: #fff !important;
    border-color: #d32f2f !important;
    box-shadow: 0 2px 12px 0 rgba(211,47,47,0.12);
}
@media (max-width: 600px) {
    .filter-btn { font-size: 1rem; padding: 0.5rem 1rem !important; }
    .d-flex.gap-2 { gap: 0.7rem !important; }
}
</style>
@endpush

@section('title', 'Daftar Kamar  Kos GRAHA')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-bed me-2"></i>Daftar Kamar Kos
            </h1>
            <div class="d-flex gap-2 flex-wrap mb-4">
                <button id="filter-all" class="btn btn-outline-primary filter-btn active" onclick="filterRooms('all', this)">
            <div class="d-flex gap-2">
                <button id="filter-all" class="btn btn-outline-primary active" onclick="filterRooms('all', this)">
                    <i class="fas fa-list me-1"></i>Semua
                </button>
                <button id="filter-tersedia" class="btn btn-outline-success" onclick="filterRooms('tersedia', this)">
                    <i class="fas fa-check me-1"></i>Tersedia
                </button>
                <button id="filter-penuh" class="btn btn-outline-danger" onclick="filterRooms('penuh', this)">
                    <i class="fas fa-times me-1"></i>Penuh
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row" id="rooms-container">
    @forelse($rooms as $room)
    <div class="col-md-6 col-lg-4 mb-4 room-card" data-status="{{ $room->status }}">
        <div class="card h-100">
            <div class="position-relative">
                <img src="{{ asset($room->foto_utama) }}" class="card-img-top room-image" alt="{{ $room->nama_kamar }}">
                <span class="badge status-badge {{ $room->status === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($room->status) }}
                </span>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $room->nama_kamar }}</h5>
               
                <p class="card-text">{{ Str::limit($room->deskripsi, 100) }}</p>
                
                <div class="mb-3">
                    <strong class="text-primary fs-5">Rp {{ number_format($room->harga_sewa, 0, ',', '.') }}/bulan</strong>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Fasilitas:</h6>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach(array_slice($room->fasilitas, 0, 3) as $fasilitas)
                        <span class="badge bg-light text-dark">{{ $fasilitas }}</span>
                        @endforeach
                        @if(count($room->fasilitas) > 3)
                        <span class="badge bg-light text-dark">+{{ count($room->fasilitas) - 3 }} lagi</span>
                        @endif
                    </div>
                </div>
                <div class="d-grid gap-2">
    <a href="{{ route('rooms.show', $room) }}" class="btn btn-primary">
        <i class="fas fa-eye me-1"></i>Lihat Detail
    </a>
    @if($room->status === 'tersedia')
    <a href="https://wa.me/{{ $room->kontak_whatsapp ?? '6281264609317' }}?text={{ urlencode('Halo kak, saya ingin booking kamar '.$room->nama_kamar.' di kos '.$room->lokasi.'. Masih tersedia? Mohon infonya ya, terima kasih.') }}"
       class="btn btn-success whatsapp-btn text-center fw-bold" target="_blank">
        <i class="fab fa-whatsapp me-1"></i>Booking via WhatsApp
    </a>
    @endif
</div>

            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5">
            <i class="fas fa-bed fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada kamar tersedia</h4>
            <p class="text-muted">Silakan cek kembali nanti atau hubungi admin untuk informasi lebih lanjut.</p>
        </div>
    </div>
    @endforelse
</div>

@if($rooms->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-map me-2"></i>Lokasi Kos
                </h5>
                <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.9963475851314!2d98.6476002!3d3.588312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312f88d62f4053%3A0x28d50c742a207d7a!2sKost%20Graha%2021!5e0!3m2!1sid!2sid!4v1751092697615!5m2!1sid!2sid" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
function filterRooms(status, btn) {
    const cards = document.querySelectorAll('.room-card');
    cards.forEach(card => {
        if (status === 'all' || (status === 'tersedia' && card.dataset.status === 'tersedia') || (status === 'penuh' && card.dataset.status !== 'tersedia')) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
    // Atur tombol aktif
    document.getElementById('filter-all').classList.remove('active');
    document.getElementById('filter-tersedia').classList.remove('active');
    document.getElementById('filter-penuh').classList.remove('active');
    btn.classList.add('active');
}
</script>
@endsection 