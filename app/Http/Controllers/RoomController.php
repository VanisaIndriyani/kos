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
                'status' => 'required|in:tersedia,tidak_tersedia',
                'latitude' => 'nullable|string',
                'longitude' => 'nullable|string',
                'fasilitas' => 'nullable|array',
                'kontak_whatsapp' => 'nullable|string',
            ]);

            $data = $request->only([
                'nama_kamar', 'deskripsi', 'harga_sewa', 'status',
                'latitude', 'longitude', 'fasilitas', 'kontak_whatsapp'
            ]);

            // Format nomor WhatsApp ke internasional (62...)
            if (!empty($data['kontak_whatsapp'])) {
                $wa = preg_replace('/[^0-9]/', '', $data['kontak_whatsapp']);
                if (substr($wa, 0, 1) === '0') {
                    $wa = '62' . substr($wa, 1);
                }
                $data['kontak_whatsapp'] = $wa;
            }

            // Pastikan fasilitas selalu array
            if (!isset($data['fasilitas'])) {
                $data['fasilitas'] = [];
            }

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
        $waNumber = '6282180725532';
        $pesan = "Halo Admin 👋\n\nSaya tertarik dengan KOS GRAHA  *{$room->nama_kamar}* dan ingin melakukan survei lokasi 🏠.\n\nKapan saya bisa berkunjung untuk melihat langsung? 😊\n\nTerima kasih 🙏";
        $waMessage = rawurlencode($pesan);
        $waLink = "https://api.whatsapp.com/send/?phone={$waNumber}&text={$waMessage}&type=phone_number&app_absent=0";
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
            'status' => 'required|in:tersedia,tidak_tersedia',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'fasilitas' => 'nullable|array',
        ]);

        $data = $request->only([
            'nama_kamar', 'deskripsi', 'harga_sewa', 'status',
            'latitude', 'longitude', 'fasilitas'
        ]);

        // Pastikan fasilitas selalu array
        if (!isset($data['fasilitas'])) {
            $data['fasilitas'] = [];
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
