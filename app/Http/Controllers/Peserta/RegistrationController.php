<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Tampilkan form pendaftaran peserta untuk sebuah event.
     */
    public function create(Event $event): View|RedirectResponse
    {
        if (! $event->isKuotaTersedia()) {
            return redirect()->route('peserta.events.index')
                ->with('error', 'Mohon maaf, kuota event "'.$event->nama_event.'" sudah penuh.');
        }

        return view('peserta.events.daftar', compact('event'));
    }

    /**
     * Simpan pendaftaran peserta pada event tertentu.
     * Menerapkan potongan kode kupon & mengurangi kuota event secara otomatis.
     */
    public function store(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'no_hp' => ['required', 'string', 'max:20'],
            'jenis_kelamin' => ['required', 'in:Laki-Laki,Perempuan'],
            'ukuran_jersey' => ['required', 'in:S,M,L,XL,XXL'],
            'kode_kupon' => ['nullable', 'string', 'max:20'],
        ], [], [
            'nama_lengkap' => 'Nama Lengkap',
            'email' => 'Email',
            'no_hp' => 'Nomor HP',
            'jenis_kelamin' => 'Jenis Kelamin',
            'ukuran_jersey' => 'Ukuran Jersey',
            'kode_kupon' => 'Kode Kupon',
        ]);

        return DB::transaction(function () use ($data, $event, $request) {
            // Lock baris event agar kuota tidak berkurang ganda saat diakses bersamaan.
            $event = Event::whereKey($event->id)->lockForUpdate()->firstOrFail();

            if (! $event->isKuotaTersedia()) {
                return redirect()->route('peserta.events.index')
                    ->with('error', 'Mohon maaf, kuota event "'.$event->nama_event.'" baru saja penuh.');
            }

            $sudahDaftar = Registration::where('user_id', $request->user()->id)
                ->where('event_id', $event->id)
                ->exists();

            if ($sudahDaftar) {
                return redirect()->route('peserta.riwayat')
                    ->with('error', 'Anda sudah terdaftar pada event ini sebelumnya.');
            }

            $kodeKupon = $data['kode_kupon'] ? strtoupper(trim($data['kode_kupon'])) : null;
            $potongan = 0;

            if ($kodeKupon) {
                $coupon = Coupon::where('kode', $kodeKupon)->first();

                if (!$coupon) {
                    return back()
                        ->withErrors(['kode_kupon' => 'Kode kupon tidak valid atau tidak dikenali.'])
                        ->withInput();
                }

                $valid = $coupon->cekValid($event);

                if (!$valid['valid']) {
                    return back()
                        ->withErrors(['kode_kupon' => $valid['message']])
                        ->withInput();
                }

                $diskon = $coupon->hitungDiskon($event->harga);
                $potongan = $diskon['nominal'];
                $coupon->pakai();
            }

            $hargaAkhir = max(0, $event->harga - $potongan);

            Registration::create([
                'user_id' => $request->user()->id,
                'event_id' => $event->id,
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'no_hp' => $data['no_hp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'ukuran_jersey' => $data['ukuran_jersey'],
                'kode_kupon' => $kodeKupon,
                'potongan_harga' => $potongan,
                'harga_akhir' => $hargaAkhir,
            ]);

            // Kuota berkurang otomatis sejumlah 1.
            $event->kurangiKuota();

            return redirect()->route('peserta.riwayat')
                ->with('status', 'Pendaftaran pada event "'.$event->nama_event.'" berhasil disimpan.');
        });
    }

    /**
     * Tampilkan form edit pendaftaran peserta.
     */
    public function edit(Request $request, Registration $registration): View|RedirectResponse
    {
        abort_if($registration->user_id !== $request->user()->id, 403);

        $event = $registration->event;

        return view('peserta.events.edit', compact('event', 'registration'));
    }

    /**
     * Update data pendaftaran peserta.
     */
    public function update(Request $request, Registration $registration): RedirectResponse
    {
        abort_if($registration->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'no_hp' => ['required', 'string', 'max:20'],
            'jenis_kelamin' => ['required', 'in:Laki-Laki,Perempuan'],
            'ukuran_jersey' => ['required', 'in:S,M,L,XL,XXL'],
            'kode_kupon' => ['nullable', 'string', 'max:20'],
        ], [], [
            'nama_lengkap' => 'Nama Lengkap',
            'email' => 'Email',
            'no_hp' => 'Nomor HP',
            'jenis_kelamin' => 'Jenis Kelamin',
            'ukuran_jersey' => 'Ukuran Jersey',
            'kode_kupon' => 'Kode Kupon',
        ]);

        $kodeKupon = $data['kode_kupon'] ? strtoupper(trim($data['kode_kupon'])) : null;
        $potongan = 0;

        if ($kodeKupon) {
            $coupon = Coupon::where('kode', $kodeKupon)->first();

            if (!$coupon) {
                return back()
                    ->withErrors(['kode_kupon' => 'Kode kupon tidak valid atau tidak dikenali.'])
                    ->withInput();
            }

            $valid = $coupon->cekValid($registration->event);

            if (!$valid['valid']) {
                return back()
                    ->withErrors(['kode_kupon' => $valid['message']])
                    ->withInput();
            }

            $diskon = $coupon->hitungDiskon($registration->event->harga);
            $potongan = $diskon['nominal'];

            if ($kodeKupon !== $registration->kode_kupon) {
                $coupon->pakai();
            }
        }

        $hargaAkhir = max(0, $registration->event->harga - $potongan);

        $registration->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'ukuran_jersey' => $data['ukuran_jersey'],
            'kode_kupon' => $kodeKupon,
            'potongan_harga' => $potongan,
            'harga_akhir' => $hargaAkhir,
        ]);

        return redirect()->route('peserta.riwayat')
            ->with('status', 'Data pendaftaran berhasil diperbarui.');
    }

    /**
     * Tampilkan riwayat/daftar event yang sudah dipilih peserta.
     */
    public function riwayat(Request $request): View
    {
        $registrations = $request->user()
            ->registrations()
            ->with('event')
            ->latest()
            ->paginate(10);

        return view('peserta.riwayat', compact('registrations'));
    }
}
