<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'nama_pengirim',
        'email_pengirim',
        'telepon_pengirim',
        'pesan',
        'dibaca'
    ];

    protected $casts = [
        'dibaca' => 'boolean'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
