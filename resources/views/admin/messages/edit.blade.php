@extends('layouts.admin')

@section('title', 'Edit Pesan - Admin KosKu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0"><i class="fas fa-edit me-2"></i>Edit Pesan</h1>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.messages.update', $message) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Kamar *</label>
                        <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                            <option value="">Pilih Kamar</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id', $message->room_id) == $room->id ? 'selected' : '' }}>
                                    {{ $room->nama_kamar }} - {{ $room->lokasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_pengirim" class="form-label">Nama Pengirim *</label>
                        <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror" 
                               id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim', $message->nama_pengirim) }}" required>
                        @error('nama_pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email_pengirim" class="form-label">Email Pengirim *</label>
                        <input type="email" class="form-control @error('email_pengirim') is-invalid @enderror" 
                               id="email_pengirim" name="email_pengirim" value="{{ old('email_pengirim', $message->email_pengirim) }}" required>
                        @error('email_pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon_pengirim" class="form-label">Telepon Pengirim *</label>
                        <input type="text" class="form-control @error('telepon_pengirim') is-invalid @enderror" 
                               id="telepon_pengirim" name="telepon_pengirim" value="{{ old('telepon_pengirim', $message->telepon_pengirim) }}" required>
                        @error('telepon_pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="dibaca" name="dibaca" value="1" {{ $message->dibaca ? 'checked' : '' }}>
                            <label class="form-check-label" for="dibaca">
                                Sudah Dibaca
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan *</label>
                        <textarea class="form-control @error('pesan') is-invalid @enderror" 
                                  id="pesan" name="pesan" rows="8" required>{{ old('pesan', $message->pesan) }}</textarea>
                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Pesan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 