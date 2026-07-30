<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function index(): View
    {
        $coupons = Coupon::orderByDesc('created_at')->paginate(10);

        return view('admin.kupon.index', compact('coupons'));
    }

    public function create(): View
    {
        return view('admin.kupon.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:coupons,kode'],
            'nama' => ['required', 'string', 'max:100'],
            'diskon_persen' => ['required', 'numeric', 'min:0', 'max:100'],
            'maks_potongan' => ['nullable', 'integer', 'min:0'],
            'min_belanja' => ['required', 'integer', 'min:0'],
            'kuota' => ['nullable', 'integer', 'min:0'],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_berakhir' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'aktif' => ['boolean'],
        ], [], [
            'kode' => 'Kode Kupon',
            'nama' => 'Nama Kupon',
            'diskon_persen' => 'Diskon (%)',
            'maks_potongan' => 'Maksimal Potongan',
            'min_belanja' => 'Minimal Belanja',
            'kuota' => 'Kuota Pemakaian',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_berakhir' => 'Tanggal Berakhir',
            'aktif' => 'Aktif',
        ]);

        $data['aktif'] = $request->boolean('aktif');

        Coupon::create($data);

        return redirect()->route('admin.kupon.index')
            ->with('status', 'Kupon "' . $data['kode'] . '" berhasil ditambahkan.');
    }

    public function edit(Coupon $kupon): View
    {
        return view('admin.kupon.edit', compact('kupon'));
    }

    public function update(Request $request, Coupon $kupon): RedirectResponse
    {
        $data = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:coupons,kode,' . $kupon->id],
            'nama' => ['required', 'string', 'max:100'],
            'diskon_persen' => ['required', 'numeric', 'min:0', 'max:100'],
            'maks_potongan' => ['nullable', 'integer', 'min:0'],
            'min_belanja' => ['required', 'integer', 'min:0'],
            'kuota' => ['nullable', 'integer', 'min:0'],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_berakhir' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'aktif' => ['boolean'],
        ], [], [
            'kode' => 'Kode Kupon',
            'nama' => 'Nama Kupon',
            'diskon_persen' => 'Diskon (%)',
            'maks_potongan' => 'Maksimal Potongan',
            'min_belanja' => 'Minimal Belanja',
            'kuota' => 'Kuota Pemakaian',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_berakhir' => 'Tanggal Berakhir',
            'aktif' => 'Aktif',
        ]);

        $data['aktif'] = $request->boolean('aktif');

        $kupon->update($data);

        return redirect()->route('admin.kupon.index')
            ->with('status', 'Kupon "' . $data['kode'] . '" berhasil diperbarui.');
    }

    public function destroy(Coupon $kupon): RedirectResponse
    {
        $kode = $kupon->kode;
        $kupon->delete();

        return redirect()->route('admin.kupon.index')
            ->with('status', 'Kupon "' . $kode . '" berhasil dihapus.');
    }

    public function toggle(Coupon $kupon): RedirectResponse
    {
        $kupon->update(['aktif' => !$kupon->aktif]);

        $status = $kupon->aktif ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.kupon.index')
            ->with('status', 'Kupon "' . $kupon->kode . '" berhasil ' . $status . '.');
    }
}
