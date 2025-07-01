<?php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'isi' => 'required|string|max:500',
        ]);
        Testimonial::create($request->only('nama', 'isi'));
        return redirect()->route('testimonials.index')->with('success', 'Testimoni berhasil dikirim!');
    }

    // ADMIN: Daftar testimoni
    public function adminIndex()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    // ADMIN: Form balas/edit balasan
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    // ADMIN: Simpan balasan
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $request->validate([
            'balasan' => 'nullable|string|max:1000',
        ]);
        $testimonial->balasan = $request->balasan;
        $testimonial->save();
        return redirect()->route('admin.testimonials.index')->with('success', 'Balasan berhasil disimpan!');
    }

    // ADMIN: Hapus testimoni
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus!');
    }
} 