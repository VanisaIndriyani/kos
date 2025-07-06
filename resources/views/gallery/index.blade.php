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
                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="{{ asset($foto->path_foto) }}">
                    <img src="{{ asset($foto->path_foto) }}" class="card-img-top" style="height:180px; object-fit:cover; border-radius:12px; cursor:pointer;" alt="Foto {{ $kategori }}">
                </a>
            </div>
        </div>
        @empty
        <div class="col-12 text-muted">Belum ada foto untuk kategori ini.</div>
        @endforelse
    </div>
@endforeach

<!-- Modal untuk gambar besar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 text-center">
        <img src="" id="modalImage" class="img-fluid rounded" style="max-height:80vh;">
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var imageModal = document.getElementById('imageModal');
    imageModal.addEventListener('show.bs.modal', function (event) {
        var trigger = event.relatedTarget;
        var imgSrc = trigger.getAttribute('data-img');
        var modalImg = document.getElementById('modalImage');
        modalImg.src = imgSrc;
    });
});
</script>
@endsection 