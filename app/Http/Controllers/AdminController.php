<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'tersedia')->count();
        $fullRooms = Room::where('status', 'penuh')->count();
        $unreadMessages = Message::where('dibaca', false)->count();
        $recentMessages = Message::with('room')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRooms',
            'availableRooms',
            'fullRooms',
            'unreadMessages',
            'recentMessages'
        ));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Simple authentication for demo purposes
        // In production, use proper authentication
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah!']);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}
