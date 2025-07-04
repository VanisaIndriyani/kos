<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->text('deskripsi');
            $table->decimal('harga_sewa', 10, 2);
            $table->string('status')->default('tersedia'); // tersedia, penuh
            $table->string('lokasi');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('foto_utama')->nullable();
            $table->json('foto_tambahan')->nullable();
            $table->json('fasilitas')->nullable();
            $table->string('kontak_whatsapp')->nullable();
            $table->string('kontak_form')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
