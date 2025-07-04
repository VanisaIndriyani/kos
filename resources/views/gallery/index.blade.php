@extends('layouts.app')

@section('title', 'Galeri Kos')

@section('content')
<h1 class="mb-4" style="color:#b97a56; font-weight:bold;"><i class="fas fa-images me-2"></i>Galeri Kos</h1>
@foreach($categories as $kategori => $fotos)
    <h3 class="mt-4 mb-3" style="color:#6d4c1b; font-weight:600;">{{ $kategori }}</h3>
    <div class="row g-3">
        @forelse($fotos as $foto)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset($foto->path_foto) }}" class="card-img-top" style="height:180px; object-fit:cover; border-radius:12px;" alt="Foto {{ $kategori }}">
            </div>
        </div>
        @empty
        <div class="col-12 text-muted">Belum ada foto untuk kategori ini.</div>
        @endforelse
    </div>
@endforeach
@endsection 