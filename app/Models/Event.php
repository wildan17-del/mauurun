<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_event',
        'jenis_event',
        'tanggal',
        'kota',
        'harga',
        'kuota',
        'deskripsi',
        'gambar',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'harga' => 'decimal:0',
            'kuota' => 'integer',
        ];
    }

    /**
     * Daftar pilihan jenis event yang tersedia.
     */
    public static function jenisOptions(): array
    {
        return ['3K', '5K', '10K', 'Half Maraton', 'Full Maraton'];
    }

    /**
     * Daftar kota utama (MasterData Kota dasar, dapat diperluas).
     */
    public static function kotaOptions(): array
    {
        return ['Jakarta', 'Yogyakarta', 'Semarang', 'Kendal'];
    }

    /**
     * Relasi ke pendaftaran peserta pada event ini.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Apakah kuota event ini masih tersedia.
     */
    public function isKuotaTersedia(): bool
    {
        return $this->kuota > 0;
    }

    /**
     * Kurangi kuota peserta sejumlah 1 secara aman (atomic).
     */
    public function kurangiKuota(): void
    {
        $this->decrement('kuota');
    }
}
