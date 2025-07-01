@extends('layouts.app')
@section('title', 'Tulis Testimoni')
@section('styles')
<style>
    .testimonial-form-card {
        border: none;
        background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%);
        box-shadow: 0 2px 12px rgba(185,122,86,0.10);
        border-radius: 18px;
        color: #6d4c1b;
        margin-bottom: 2rem;
    }
</style>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card testimonial-form-card">
            <div class="card-body">
                <h2 class="mb-3" style="color:#b97a56; font-weight:bold;">Tulis Testimoni</h2>
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <form method="POST" action="{{ route('testimonials.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Testimoni</label>
                        <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="4" required>{{ old('isi') }}</textarea>
                        @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane me-1"></i>Kirim Testimoni</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 