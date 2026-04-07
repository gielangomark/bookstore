<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    // Tampilkan halaman About
    public function index()
    {
        return view('front.about');
    }

    // Simpan pesan dari form contact di halaman About
    public function storeMessage(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Simpan pesan ke database
        ContactMessage::create($validated);

        // Kasih tahu user kalo pesan berhasil terkirim
        return redirect()->route('about')->with('success', 'Terima kasih! Pesan Anda telah kami terima. Admin akan segera merespons.');
    }
}
