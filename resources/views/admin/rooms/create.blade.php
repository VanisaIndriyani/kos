@extends('layouts.admin')

@section('title', 'Tambah Kamar - Admin KosKu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0"><i class="fas fa-plus me-2"></i>Tambah Kamar</h1>
    <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nama_kamar" class="form-label">Nama Kamar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_kamar') is-invalid @enderror" id="nama_kamar" name="nama_kamar" value="{{ old('nama_kamar') }}" required>
                        @error('nama_kamar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="harga_sewa" class="form-label">Harga Sewa <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('harga_sewa') is-invalid @enderror" id="harga_sewa" name="harga_sewa" value="{{ old('harga_sewa') }}" required>
                                </div>
                                @error('harga_sewa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="tidak_tersedia" {{ old('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label">Fasilitas</label>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                            @php
                                $fasilitasList = [
                                    'AC', 'Kamar Mandi Dalam', 'Kamar Mandi Luar', 'Dapur', 'Teras', 
                                    'Parkir Motor', 'Parkir Mobil', 'Wifi', 'Listrik', 'Air', 
                                    'Kasur', 'Lemari', 'Meja', 'Kursi', 'TV', 'Kipas Angin'
                                ];
                                $selectedFasilitas = old('fasilitas', []);
                            @endphp
                            @foreach($fasilitasList as $fasilitas)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $fasilitas }}" id="fasilitas_{{ $loop->index }}" {{ in_array($fasilitas, $selectedFasilitas) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fasilitas_{{ $loop->index }}">
                                        {{ $fasilitas }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('fasilitas')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tambahkan validasi form
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    let isSubmitting = false;

    form.addEventListener('submit', function(e) {
        if (isSubmitting) {
            e.preventDefault();
            return;
        }

        isSubmitting = true;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
    });

    // Tambahkan error handler
    window.addEventListener('error', function() {
        isSubmitting = false;
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>Simpan';
    });
</script>
@endsection