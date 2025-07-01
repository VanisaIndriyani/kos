<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimonialController;

// Halaman utama - Daftar kamar kos
Route::get('/', [RoomController::class, 'index'])->name('home');

// Detail kamar
Route::get('/kamar/{room}', [RoomController::class, 'show'])->name('rooms.show');

// Kirim pesan
Route::post('/kirim-pesan', [MessageController::class, 'store'])->name('messages.store');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Room management
        Route::resource('rooms', RoomController::class);
        
        // Message management
        Route::resource('messages', MessageController::class);
        Route::patch('/messages/{message}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.mark-read');
        Route::get('testimonials', [TestimonialController::class, 'adminIndex'])->name('testimonials.index');
        Route::resource('testimonials', TestimonialController::class)->only(['edit', 'update', 'destroy']);
    });
});

// Middleware untuk admin
Route::middleware('admin')->group(function () {
    // Admin routes yang sudah didefinisikan di atas
});

Route::resource('testimonials', TestimonialController::class)->only(['index', 'create', 'store']);
