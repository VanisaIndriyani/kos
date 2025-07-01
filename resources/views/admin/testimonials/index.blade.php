@extends('layouts.admin')
@section('title', 'Kelola Testimoni')
@section('styles')
<style>
    .testi-card {
        border: none;
        background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%);
        box-shadow: 0 2px 12px rgba(185,122,86,0.10);
        border-radius: 18px;
        color: #6d4c1b;
    }
    .badge-admin {
        background: #b97a56;
        color: #fff;
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 0.4em 1em;
    }
</style>
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4" style="color:#b97a56; font-weight:bold;">Kelola Testimoni Pelanggan</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card testi-card mb-4">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Isi Testimoni</th>
                        <th>Tanggal</th>
                        <th>Balasan Admin</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                    <tr>
                        <td><i class="fas fa-user-circle me-1"></i> {{ $t->nama }}</td>
                        <td>{{ $t->isi }}</td>
                        <td>{{ $t->created_at->format('d M Y H:i') }}</td>
                        <td>
                            @if($t->balasan)
                                <span class="badge badge-admin"><i class="fas fa-user-cog me-1"></i>{{ $t->balasan }}</span>
                            @else
                                <span class="text-muted">Belum dibalas</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn btn-sm btn-warning me-1"><i class="fas fa-reply"></i> Balas/Edit</a>
                            <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada testimoni.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 