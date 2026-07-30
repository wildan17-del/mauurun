<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Tampilkan seluruh event lari (listing Admin).
     */
    public function index(): View
    {
        $events = Event::withCount('registrations')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Tampilkan form tambah event baru.
     */
    public function create(): View
    {
        return view('admin.events.create', [
            'jenisOptions' => Event::jenisOptions(),
            'kotaOptions' => Event::kotaOptions(),
        ]);
    }

    /**
     * Simpan event baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateEvent($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('status', 'Event lari berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit event.
     */
    public function edit(Event $event): View
    {
        return view('admin.events.edit', [
            'event' => $event,
            'jenisOptions' => Event::jenisOptions(),
            'kotaOptions' => Event::kotaOptions(),
        ]);
    }

    /**
     * Perbarui data event.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $this->validateEvent($request);

        if ($request->hasFile('gambar')) {
            if ($event->gambar) {
                Storage::disk('public')->delete($event->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('status', 'Event lari berhasil diperbarui.');
    }

    /**
     * Hapus event.
     */
    public function destroy(Event $event): RedirectResponse
    {
        if ($event->gambar) {
            Storage::disk('public')->delete($event->gambar);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('status', 'Event lari berhasil dihapus.');
    }

    /**
     * Tampilkan daftar peserta yang mendaftar di event tertentu.
     */
    public function peserta(Event $event): View
    {
        $registrations = $event->registrations()
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.events.peserta', compact('event', 'registrations'));
    }

    /**
     * Konfirmasi pendaftaran peserta.
     */
    public function confirm(Event $event, Registration $registration): RedirectResponse
    {
        abort_if($registration->event_id !== $event->id, 404);

        $registration->update([
            'confirmed' => true,
            'confirmed_at' => now(),
        ]);

        return redirect()->route('admin.events.peserta', $event)
            ->with('status', 'Pendaftaran atas nama "'.$registration->nama_lengkap.'" berhasil dikonfirmasi.');
    }

    /**
     * Validasi input formulir event lari sesuai PRD.
     */
    private function validateEvent(Request $request): array
    {
        return $request->validate([
            'nama_event' => ['required', 'string', 'max:150'],
            'jenis_event' => ['required', 'in:'.implode(',', Event::jenisOptions())],
            'tanggal' => ['required', 'date'],
            'kota' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'integer', 'min:0'],
            'kuota' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [], [
            'nama_event' => 'Nama Event',
            'jenis_event' => 'Jenis Event',
            'tanggal' => 'Tanggal',
            'kota' => 'Kota',
            'harga' => 'Harga',
            'kuota' => 'Kuota Peserta',
            'deskripsi' => 'Deskripsi',
            'gambar' => 'Gambar Event',
        ]);
    }
}
