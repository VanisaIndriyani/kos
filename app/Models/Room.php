<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kamar',
        'deskripsi',
        'harga_sewa',
        'status',
        'lokasi',
        'latitude',
        'longitude',
        'foto_utama',
        'foto_tambahan',
        'fasilitas',
        'kontak_whatsapp',
        'kontak_form'
    ];

    protected $casts = [
        'foto_tambahan' => 'array',
        'fasilitas' => 'array',
        'harga_sewa' => 'decimal:2'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    public function scopePenuh($query)
    {
        return $query->where('status', 'penuh');
    }
}
