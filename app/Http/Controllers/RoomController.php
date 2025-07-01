<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();

        if (request()->routeIs('admin.rooms.*')) {
            return view('admin.rooms.index', compact('rooms'));
        }

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->routeIs('admin.rooms.*')) {
            return view('admin.rooms.create');
        }

        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kamar' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'harga_sewa' => 'required|numeric|min:0',
                'status' => 'required|in:tersedia,tidak_tersedia',  // Tambahkan ini
                'latitude' => 'nullable|string',
                'longitude' => 'nullable|string',
                'foto_utama' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'foto_tambahan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fasilitas' => 'nullable|array',  // Ubah required menjadi nullable
                'kontak_whatsapp' => 'nullable|string',  // Ubah required menjadi nullable
                'kontak_form' => 'nullable|string'
            ]);
        
            $data = $request->only([
                'nama_kamar', 'deskripsi', 'harga_sewa', 'status',  // Tambahkan status
                'latitude', 'longitude', 'fasilitas',
                'kontak_whatsapp', 'kontak_form'
            ]);
        
            // Format nomor WhatsApp ke internasional (62...)
            if (!empty($data['kontak_whatsapp'])) {  // Ganti isset dengan !empty
                $wa = preg_replace('/[^0-9]/', '', $data['kontak_whatsapp']);
                if (substr($wa, 0, 1) === '0') {
                    $wa = '62' . substr($wa, 1);
                }
                $data['kontak_whatsapp'] = $wa;
            }
        
            // Upload foto utama
            if ($request->hasFile('foto_utama')) {
                $fotoUtama = $request->file('foto_utama');
                $fotoUtamaPath = $fotoUtama->store('rooms', 'public');
                $data['foto_utama'] = 'storage/' . $fotoUtamaPath;
            }
        
            // Upload foto tambahan
            $fotoTambahan = [];
            if ($request->hasFile('foto_tambahan')) {
                foreach ($request->file('foto_tambahan') as $foto) {
                    $fotoPath = $foto->store('rooms', 'public');
                    $fotoTambahan[] = 'storage/' . $fotoPath;
                }
            }
            $data['foto_tambahan'] = $fotoTambahan;
        
            Room::create($data);
        
            return redirect()
                ->route(request()->routeIs('admin.rooms.*') ? 'admin.rooms.index' : 'rooms.index')
                ->with('success', 'Kamar berhasil ditambahkan!');
        
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $waNumber = $room->kontak_whatsapp ?? '6281264609317';
        $pesan = 'Halo kak, saya ingin booking kamar ' . $room->nama_kamar . ' di kos ' . $room->lokasi . '. Masih tersedia? Mohon infonya ya, terima kasih.';
        $waLink = 'https://wa.me/' . $waNumber . '?text=' . urlencode($pesan);
        return view('rooms.show', compact('room', 'waLink'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_sewa' => 'required|numeric|min:0',
            'lokasi' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_tambahan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas' => 'nullable|array',
            'kontak_whatsapp' => 'nullable|string',
            'kontak_form' => 'nullable|string'
        ]);

        $data = $request->only([
            'nama_kamar', 'deskripsi', 'harga_sewa', 'lokasi',
            'latitude', 'longitude', 'fasilitas',
            'kontak_whatsapp', 'kontak_form'
        ]);

        // Format nomor WhatsApp ke internasional (62...)
        if (isset($data['kontak_whatsapp'])) {
            $wa = preg_replace('/[^0-9]/', '', $data['kontak_whatsapp']);
            if (substr($wa, 0, 1) === '0') {
                $wa = '62' . substr($wa, 1);
            }
            $data['kontak_whatsapp'] = $wa;
        }

        // Pastikan fasilitas dan foto_tambahan selalu array
        if (!isset($data['fasilitas'])) {
            $data['fasilitas'] = [];
        }

        // Upload foto utama jika ada
        if ($request->hasFile('foto_utama')) {
            $fotoUtama = $request->file('foto_utama');
            $fotoUtamaPath = $fotoUtama->store('rooms', 'public');
            $data['foto_utama'] = 'storage/' . $fotoUtamaPath;
        }

        // Upload foto tambahan jika ada
        if ($request->hasFile('foto_tambahan')) {
            $fotoTambahan = [];
            foreach ($request->file('foto_tambahan') as $foto) {
                $fotoPath = $foto->store('rooms', 'public');
                $fotoTambahan[] = 'storage/' . $fotoPath;
            }
            $data['foto_tambahan'] = $fotoTambahan;
        }
        if (!isset($data['foto_tambahan'])) {
            $data['foto_tambahan'] = [];
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus!');
    }
}
