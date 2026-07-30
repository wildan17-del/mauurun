<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /** Tampilkan dashboard Admin berisi ringkasan & daftar event. */
    public function index(): View
    {
        $events = Event::withCount('registrations')
            ->orderBy('tanggal')
            ->get(); 

        $stats = [
            'total_event' => $events->count(),
            'total_kuota' => $events->sum('kuota'),
            'total_pendaftar' => Registration::count(),
        ];

        return view('admin.dashboard', compact('events', 'stats'));
    }
}
