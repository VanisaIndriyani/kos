<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\GalleryAdminController;

// =======================
// Frontend / Public Routes
// =======================

// Halaman utama - Daftar kamar kos
Route::get('/', [RoomController::class, 'index'])->name('home');

// Detail kamar
Route::get('/kamar/{room}', [RoomController::class, 'show'])->name('rooms.show');

// Kirim pesan
Route::post('/kirim-pesan', [MessageController::class, 'store'])->name('messages.store');

// Halaman galeri
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Testimoni user
Route::resource('testimonials', TestimonialController::class)->only(['index', 'create', 'store']);

// Redirect /login ke /admin/login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


// =======================
// Admin Routes
// =======================
Route::prefix('admin')->name('admin.')->group(function () {

    // Halaman login admin
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Routes yang dilindungi middleware admin
    Route::middleware('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Manajemen kamar
        Route::resource('rooms', RoomController::class);
        
        // Manajemen pesan
        Route::resource('messages', MessageController::class);
        Route::patch('/messages/{message}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.mark-read');

        // Manajemen testimoni (edit, update, delete)
        Route::get('testimonials', [TestimonialController::class, 'adminIndex'])->name('testimonials.index');
        Route::resource('testimonials', TestimonialController::class)->only(['edit', 'update', 'destroy']);

        // Manajemen galeri
        Route::resource('gallery', GalleryAdminController::class)
            ->only(['index', 'create', 'store', 'destroy'])
            ->names('gallery');
    });
});
