<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        // Ambil semua data galeri dari database, group by kategori
        $galleries = Gallery::orderBy('created_at', 'desc')->get()->groupBy('kategori');
        return view('gallery.index', ['categories' => $galleries]);
    }
} 