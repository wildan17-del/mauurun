<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Tampilkan daftar event lari yang tersedia bagi peserta,
     * dengan dukungan filter kategori (jenis event) & kota (Nilai Tambah).
     */
    public function index(Request $request): View
    {
        $query = Event::query()->orderBy('tanggal');

        if ($request->filled('jenis_event')) {
            $query->where('jenis_event', $request->input('jenis_event'));
        }

        if ($request->filled('kota')) {
            $query->where('kota', $request->input('kota'));
        }

        $events = $query->paginate(9)->withQueryString();

        $idEventDiikuti = $request->user()
            ->registrations()
            ->pluck('event_id')
            ->all();

        return view('peserta.events.index', [
            'events' => $events,
            'jenisOptions' => Event::jenisOptions(),
            'kotaOptions' => Event::query()->distinct()->orderBy('kota')->pluck('kota'),
            'idEventDiikuti' => $idEventDiikuti,
        ]);
    }
}
