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
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('foto_utama')->nullable()->change();
            $table->json('foto_tambahan')->nullable()->change();
            $table->json('fasilitas')->nullable()->change();
            $table->string('kontak_whatsapp')->nullable()->change();
            $table->string('lokasi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('foto_utama')->nullable(false)->change();
            $table->json('foto_tambahan')->nullable(false)->change();
            $table->json('fasilitas')->nullable(false)->change();
            $table->string('kontak_whatsapp')->nullable(false)->change();
            $table->string('lokasi')->nullable(false)->change();
        });
    }
}; 