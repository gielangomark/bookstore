<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('front.about');
    }

    public function storeMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('about')->with('success', 'Terima kasih! Pesan Anda telah kami terima. Admin akan segera merespons.');
    }
}
