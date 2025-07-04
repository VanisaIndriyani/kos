<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:50',
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('gallery', 'public');
                Gallery::create([
                    'kategori' => $request->kategori,
                    'path_foto' => 'storage/' . $path,
                    'keterangan' => $request->keterangan,
                ]);
            }
        }
        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil diupload!');
    }

    public function destroy(Gallery $gallery)
    {
        // Hapus file fisik jika ada
        if ($gallery->path_foto && file_exists(public_path($gallery->path_foto))) {
            unlink(public_path($gallery->path_foto));
        }
        $gallery->delete();
        return back()->with('success', 'Foto galeri berhasil dihapus!');
    }
} 