<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Seed data event awal sesuai brief Project Web Pro 2.
     */
    public function run(): void
    {
        $benefit = 'Benefit: Jersey, BIB Number, Medal, Refreshment, Water Station, Doorprize.';

        $events = [
            [
                'nama_event' => 'Grow Run 2026',
                'jenis_event' => 'Full Maraton',
                'tanggal' => '2026-02-15',
                'kota' => 'Yogyakarta',
                'harga' => 200000,
                'kuota' => 2000,
                'deskripsi' => $benefit,
            ],
            [
                'nama_event' => 'H Run 2026',
                'jenis_event' => '5K',
                'tanggal' => '2026-05-28',
                'kota' => 'Yogyakarta',
                'harga' => 100000,
                'kuota' => 5000,
                'deskripsi' => $benefit,
            ],
            [
                'nama_event' => 'HRSIY PDHI Fun Run',
                'jenis_event' => '10K',
                'tanggal' => '2026-07-08',
                'kota' => 'Jakarta',
                'harga' => 500000,
                'kuota' => 5000,
                'deskripsi' => $benefit,
            ],
            [
                'nama_event' => 'Sae Run',
                'jenis_event' => '3K',
                'tanggal' => '2026-02-08',
                'kota' => 'Probolinggo',
                'harga' => 400000,
                'kuota' => 500,
                'deskripsi' => $benefit,
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['nama_event' => $event['nama_event']],
                $event
            );
        }
    }
}
