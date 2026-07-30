@extends('layouts.app')

@section('title', 'Peserta: ' . $event->nama_event)

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h2>Peserta {{ $event->nama_event }}</h2>
            <p>Total pendaftar: {{ $registrations->total() }} &middot; {{ $event->jenis_event }} &middot; {{ $event->tanggal->translatedFormat('d M Y') }}</p>
        </div>
        <a href="{{ route('admin.events.index') }}" class="btn btn--outline btn--sm">&larr; Kembali</a>
    </div>

    @if(session('status'))
        <div class="alert alert--success">{{ session('status') }}</div>
    @endif

    @if($registrations->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">📋</div>
            <p>Belum ada peserta yang mendaftar di event ini.</p>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Jenis Kelamin</th>
                        <th>Ukuran Jersey</th>
                        <th>Kupon</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $reg)
                        <tr>
                            <td data-label="No">{{ $loop->iteration }}</td>
                            <td data-label="Nama"><strong>{{ $reg->nama_lengkap }}</strong></td>
                            <td data-label="NIK">{{ $reg->user->nik ?? '-' }}</td>
                            <td data-label="Email">{{ $reg->email }}</td>
                            <td data-label="No. HP">{{ $reg->no_hp }}</td>
                            <td data-label="Jenis Kelamin">{{ $reg->jenis_kelamin }}</td>
                            <td data-label="Jersey">{{ $reg->ukuran_jersey }}</td>
                            <td data-label="Kupon">
                                @if($reg->kode_kupon)
                                    <span class="badge badge--orange">{{ $reg->kode_kupon }}</span>
                                    @if($reg->potongan_harga > 0)
                                        <span class="badge" style="margin-left:4px;">-Rp {{ number_format($reg->potongan_harga, 0, ',', '.') }}</span>
                                    @endif
                                @else
                                    <span class="badge">-</span>
                                @endif
                            </td>
                            <td data-label="Harga">Rp {{ number_format($reg->harga_akhir, 0, ',', '.') }}</td>
                            <td data-label="Status">
                                @if($reg->confirmed)
                                    <span class="badge badge--green">Terkonfirmasi</span>
                                @else
                                    <span class="badge badge--red">Belum</span>
                                @endif
                            </td>
                            <td data-label="Aksi">
                                <div class="table-actions">
                                    @if(!$reg->confirmed)
                                        <form action="{{ route('admin.events.peserta.confirm', [$event, $reg]) }}" method="POST"
                                              onsubmit="return confirm('Konfirmasi pendaftaran &quot;{{ $reg->nama_lengkap }}&quot;?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn--primary btn--sm">Konfirmasi</button>
                                        </form>
                                    @else
                                        <span class="badge badge--green" style="font-size:12px;padding:7px 14px;">
                                            {{ $reg->confirmed_at ? $reg->confirmed_at->translatedFormat('d M Y H:i') : 'Terkonfirmasi' }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>{{ $registrations->links() }}</div>
    @endif
</div>
@endsection
