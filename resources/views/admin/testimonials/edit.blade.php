@extends('layouts.admin')
@section('title', 'Balas Testimoni')
@section('styles')
<style>
    .testi-form-card {
        border: none;
        background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%);
        box-shadow: 0 2px 12px rgba(185,122,86,0.10);
        border-radius: 18px;
        color: #6d4c1b;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card testi-form-card mb-4">
                <div class="card-body">
                    <h2 class="mb-3" style="color:#b97a56; font-weight:bold;">Balas Testimoni</h2>
                    <div class="mb-3">
                        <strong><i class="fas fa-user-circle me-1"></i> {{ $testimonial->nama }}</strong>
                        <div class="text-muted small">{{ $testimonial->created_at->format('d M Y H:i') }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Testimoni</label>
                        <div class="p-2 rounded" style="background:#f7e9d2;">{{ $testimonial->isi }}</div>
                    </div>
                    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="balasan" class="form-label">Balasan Admin</label>
                            <textarea class="form-control" id="balasan" name="balasan" rows="3" placeholder="Tulis balasan...">{{ old('balasan', $testimonial->balasan) }}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane me-1"></i>Simpan Balasan</button>
                            @if($testimonial->balasan)
                            <a href="#" onclick="event.preventDefault(); document.getElementById('hapus-balasan').submit();" class="btn btn-danger"><i class="fas fa-eraser me-1"></i>Hapus Balasan</a>
                            @endif
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                    @if($testimonial->balasan)
                    <form id="hapus-balasan" method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}" style="display:none;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="balasan" value="">
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 