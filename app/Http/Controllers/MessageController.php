<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with('room')->orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        return view('admin.messages.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email',
            'telepon_pengirim' => 'required|string',
            'pesan' => 'required|string'
        ]);

        Message::create($request->all());

        return redirect()->back()->with('success', 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        $message->update(['dibaca' => true]);
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        $rooms = Room::all();
        return view('admin.messages.edit', compact('message', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email',
            'telepon_pengirim' => 'required|string',
            'pesan' => 'required|string',
            'dibaca' => 'boolean'
        ]);

        $message->update($request->all());

        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus!');
    }

    /**
     * Mark message as read
     */
    public function markAsRead(Message $message)
    {
        $message->update(['dibaca' => true]);
        return redirect()->back()->with('success', 'Pesan ditandai sebagai telah dibaca!');
    }
}
