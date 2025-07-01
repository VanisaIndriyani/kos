@extends('layouts.app')

@section('title', $room->nama_kamar . ' -  Kos GRAHA')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Foto Kamar -->
        <div class="card mb-4">
            <div class="card-body p-0">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="0" class="active"></button>
                        @if($room->foto_tambahan)
                            @foreach($room->foto_tambahan as $index => $foto)
                            <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="{{ $index + 1 }}"></button>
                            @endforeach
                        @endif
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset($room->foto_utama) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $room->nama_kamar }}">
                        </div>
                        @if($room->foto_tambahan)
                            @foreach($room->foto_tambahan as $foto)
                            <div class="carousel-item">
                                <img src="{{ asset($foto) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $room->nama_kamar }}">
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Informasi Kamar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h2 class="card-title mb-0">{{ $room->nama_kamar }}</h2>
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

                <div class="mb-4">
                    <h5>Lokasi Kos</h5>
                    <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.9963475851314!2d98.6476002!3d3.588312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312f88d62f4053%3A0x28d50c742a207d7a!2sKost%20Graha%2021!5e0!3m2!1sid!2sid!4v1751092697615!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Form Kontak -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-envelope me-2"></i>Hubungi Pemilik
                </h5>
            </div>
            <div class="card-body">
                @if($room->status === 'tersedia')
                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="mb-3">
                            <label for="nama_pengirim" class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror" 
                                   id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim') }}" required>
                            @error('nama_pengirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email_pengirim" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email_pengirim') is-invalid @enderror" 
                                   id="email_pengirim" name="email_pengirim" value="{{ old('email_pengirim') }}" required>
                            @error('email_pengirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telepon_pengirim" class="form-label">Nomor Telepon *</label>
                            <input type="text" class="form-control @error('telepon_pengirim') is-invalid @enderror" 
                                   id="telepon_pengirim" name="telepon_pengirim" value="{{ old('telepon_pengirim') }}" required>
                            @error('telepon_pengirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan *</label>
                            <textarea class="form-control @error('pesan') is-invalid @enderror" 
                                      id="pesan" name="pesan" rows="4" required>{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </form>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                        <h5 class="text-danger">Kamar Sudah Penuh</h5>
                        <p class="text-muted">Maaf, kamar ini sudah tidak tersedia untuk disewa.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Kontak Langsung -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-phone me-2"></i>Kontak Langsung
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ $waLink }}"
                       class="btn btn-success whatsapp-btn text-center fw-bold" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i>Booking via WhatsApp
                    </a>
                    
                    @if($room->kontak_form)
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Blok Google Maps API dihapus karena sudah pakai iframe --}}
@endsection 