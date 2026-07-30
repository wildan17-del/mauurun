<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Tampilkan halaman landing publik dengan preview event terdekat.
     */
    public function index(): View
    {
        $events = Event::where('kuota', '>', 0)
            ->orderBy('tanggal')
            ->take(4)
            ->get();

        return view('welcome', compact('events'));
    }
}
