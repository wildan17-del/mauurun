@extends('layouts.app')

@section('title', 'Kelola Event')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h2>Kelola Event Lari</h2>
            <p>Atur semua event lari yang tersedia.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="btn btn--primary">+ Tambah Event</a>
    </div>

    @if($events->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">🗓️</div>
            <p>Belum ada event. Klik "Tambah Event" untuk membuat event baru.</p>
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
                        <th>Kuota</th>
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
                                <div class="table-actions">
                                    <a href="{{ route('admin.events.peserta', $event) }}" class="btn btn--secondary btn--sm">Peserta</a>
                                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn--outline btn--sm">Edit</a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                          onsubmit="return confirm('Hapus event &quot;{{ $event->nama_event }}&quot;? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger btn--sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>{{ $events->links() }}</div>
    @endif
</div>
@endsection
