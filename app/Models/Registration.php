<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'nama_lengkap',
        'email',
        'no_hp',
        'jenis_kelamin',
        'ukuran_jersey',
        'kode_kupon',
        'potongan_harga',
        'harga_akhir',
        'confirmed',
        'confirmed_at',
    ];

    protected function casts(): array
    {
        return [
            'potongan_harga' => 'decimal:0',
            'harga_akhir' => 'decimal:0',
            'confirmed' => 'boolean',
            'confirmed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
