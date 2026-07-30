<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'diskon_persen',
        'maks_potongan',
        'min_belanja',
        'kuota',
        'kuota_terpakai',
        'tanggal_mulai',
        'tanggal_berakhir',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'diskon_persen' => 'decimal:2',
            'maks_potongan' => 'integer',
            'min_belanja' => 'integer',
            'kuota' => 'integer',
            'kuota_terpakai' => 'integer',
            'tanggal_mulai' => 'date',
            'tanggal_berakhir' => 'date',
            'aktif' => 'boolean',
        ];
    }

    public function cekValid(Event $event): array
    {
        if (!$this->aktif) {
            return ['valid' => false, 'message' => 'Kupon tidak aktif.'];
        }

        $sekarang = now()->startOfDay();

        if ($this->tanggal_mulai && $sekarang->lt($this->tanggal_mulai)) {
            return ['valid' => false, 'message' => 'Kupon belum berlaku.'];
        }

        if ($this->tanggal_berakhir && $sekarang->gt($this->tanggal_berakhir)) {
            return ['valid' => false, 'message' => 'Kupon sudah kedaluwarsa.'];
        }

        if ($this->kuota && $this->kuota_terpakai >= $this->kuota) {
            return ['valid' => false, 'message' => 'Kuota pemakaian kupon sudah habis.'];
        }

        if ($event->harga < $this->min_belanja) {
            return ['valid' => false, 'message' => 'Minimal harga event Rp ' . number_format($this->min_belanja, 0, ',', '.') . ' untuk menggunakan kupon ini.'];
        }

        return ['valid' => true, 'message' => 'Kupon valid.'];
    }

    public function hitungDiskon(int $hargaEvent): array
    {
        $nominal = (int) round($hargaEvent * $this->diskon_persen / 100);

        if ($this->maks_potongan && $nominal > $this->maks_potongan) {
            $nominal = $this->maks_potongan;
        }

        return [
            'persen' => $this->diskon_persen,
            'nominal' => $nominal,
        ];
    }

    public function pakai(): void
    {
        $this->increment('kuota_terpakai');
    }

    public function sisaKuota(): ?int
    {
        if (!$this->kuota) {
            return null;
        }

        return max(0, $this->kuota - $this->kuota_terpakai);
    }
}
