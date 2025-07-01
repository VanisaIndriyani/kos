@extends('layouts.app')
@section('title', 'Testimoni Pelanggan')
@section('styles')
<style>
    .testimonial-card {
        border: none;
        background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%);
        box-shadow: 0 2px 12px rgba(185,122,86,0.10);
        border-radius: 18px;
        color: #6d4c1b;
        margin-bottom: 2rem;
    }
    .testimonial-profile {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #f7e9d2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: #b97a56;
        margin-right: 1.2rem;
    }
</style>
@endsection
@section('content')
<div class="row justify-content-center mb-4">
    <div class="col-lg-8 text-center">
        <h1 class="mb-3" style="color:#b97a56; font-weight:bold;">Testimoni Pelanggan</h1>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus me-1"></i>Tulis Testimoni</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8">
        @foreach($testimonials as $t)
        <div class="card testimonial-card mb-3">
            <div class="card-body d-flex align-items-start">
                <div class="testimonial-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div>
                    <h5 class="mb-1" style="font-weight:600; color:#b97a56;">{{ $t->nama }}</h5>
                    <p class="mb-2">{{ $t->isi }}</p>
                    <small class="text-muted">{{ $t->created_at->format('d M Y H:i') }}</small>
                    @if($t->balasan)
                    <div class="mt-3">
                        <div class="p-3 rounded" style="background:#f7e9d2; color:#b97a56;">
                            <i class="fas fa-user-cog me-1"></i><strong>Admin:</strong> {{ $t->balasan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @if($testimonials->isEmpty())
            <div class="text-center text-muted py-5">Belum ada testimoni.</div>
        @endif
    </div>
</div>
@endsection 