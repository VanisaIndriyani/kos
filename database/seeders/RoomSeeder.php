<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['tersedia', 'penuh'];
        $fasilitas = [
            ['WiFi', 'Kamar Mandi Dalam', 'AC'],
            ['Kipas Angin', 'Lemari', 'Meja Belajar'],
            ['TV', 'Dapur Bersama', 'Parkir Motor'],
            ['AC', 'WiFi', 'Kasur Springbed']
        ];

        for ($i = 1; $i <= 22; $i++) {
            DB::table('rooms')->insert([
                'nama_kamar' => 'Kamar ' . $i,
                'deskripsi' => 'Kamar nyaman nomor ' . $i . ' dengan fasilitas lengkap.',
                'harga_sewa' => rand(500000, 1500000),
                'status' => $statuses[array_rand($statuses)],
                'lokasi' => 'Jl. Kosan Indah No.' . $i,
                'latitude' => '-7.7' . rand(10000, 99999),
                'longitude' => '110.3' . rand(10000, 99999),
                'foto_utama' => 'images/kamar/kamar' . $i . '.jpg',
                'foto_tambahan' => json_encode([
                    'images/kamar/kamar' . $i . '_1.jpg',
                    'images/kamar/kamar' . $i . '_2.jpg',
                    'images/kamar/kamar' . $i . '_3.jpg',
                ]),
                'fasilitas' => json_encode($fasilitas[array_rand($fasilitas)]),
                'kontak_whatsapp' => '08' . rand(1111111111, 9999999999),
                'kontak_form' => 'kamar' . $i . '@kosan.id',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
