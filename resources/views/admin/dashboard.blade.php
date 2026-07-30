@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h2>Dashboard Admin</h2>
            <p>Ringkasan pengelolaan event lari Mau Run.</p>
        </div>
    </div>

    <div class="stats">
        <div class="stat-card stat-card--green">
            <div class="stat-card__label">Total Event</div>
            <div class="stat-card__value">{{ $stats['total_event'] }}</div>
        </div>
        <div class="stat-card stat-card--blue">
            <div class="stat-card__label">Total Sisa Kuota</div>
            <div class="stat-card__value">{{ number_format($stats['total_kuota'], 0, ',', '.') }}</div>
        </div>
        <div class="stat-card stat-card--orange">
            <div class="stat-card__label">Total Pendaftar</div>
            <div class="stat-card__value">{{ $stats['total_pendaftar'] }}</div>
        </div>
    </div>

    <div class="section-header">
        <div>
            <h2>Daftar Event Lari</h2>
        </div>
        <a href="{{ route('admin.events.create') }}" class="btn btn--primary">+ Tambah Event</a>
    </div>

    @if($events->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">🗓️</div>
            <p>Belum ada event yang dibuat. Klik "Tambah Event" untuk membuat event pertama.</p>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Event</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th>Kota</th>
                        <th>Harga</th>
                        <th>Kuota Sisa</th>
                        <th>Pendaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td data-label="Gambar">
                                @if($event->gambar)
                                    <img src="{{ asset('storage/'.$event->gambar) }}" alt="{{ $event->nama_event }}" style="width:50px;height:34px;object-fit:cover;border-radius:6px;">
                                @else
                                    <span style="font-size:20px;opacity:.3;">🏃</span>
                                @endif
                            </td>
                            <td data-label="Nama"><strong>{{ $event->nama_event }}</strong></td>
                            <td data-label="Jenis"><span class="badge badge--primary">{{ $event->jenis_event }}</span></td>
                            <td data-label="Tanggal">{{ $event->tanggal->translatedFormat('d M Y') }}</td>
                            <td data-label="Kota">{{ $event->kota }}</td>
                            <td data-label="Harga">Rp {{ number_format($event->harga, 0, ',', '.') }}</td>
                            <td data-label="Kuota">
                                <span class="badge {{ $event->kuota > 0 ? 'badge--green' : 'badge--red' }}">{{ $event->kuota }}</span>
                            </td>
                            <td data-label="Pendaftar">{{ $event->registrations_count }}</td>
                            <td data-label="Aksi">
                                <a href="{{ route('admin.events.peserta', $event) }}" class="btn btn--secondary btn--sm">Peserta</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
