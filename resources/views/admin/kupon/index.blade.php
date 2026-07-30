@extends('layouts.app')

@section('title', 'Kelola Kupon')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h2>Kelola Kupon Diskon</h2>
            <p>Atur kode kupon diskon untuk peserta.</p>
        </div>
        <a href="{{ route('admin.kupon.create') }}" class="btn btn--primary">+ Tambah Kupon</a>
    </div>

    @if($coupons->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">🏷️</div>
            <p>Belum ada kupon. Klik "Tambah Kupon" untuk membuat kupon baru.</p>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Diskon</th>
                        <th>Maks Potongan</th>
                        <th>Min Belanja</th>
                        <th>Kuota</th>
                        <th>Masa Berlaku</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td data-label="Kode"><strong>{{ $coupon->kode }}</strong></td>
                            <td data-label="Nama">{{ $coupon->nama }}</td>
                            <td data-label="Diskon"><span class="badge badge--primary">{{ number_format($coupon->diskon_persen, 0) }}%</span></td>
                            <td data-label="Maks Potongan">
                                @if($coupon->maks_potongan)
                                    Rp {{ number_format($coupon->maks_potongan, 0, ',', '.') }}
                                @else
                                    <span class="badge">-</span>
                                @endif
                            </td>
                            <td data-label="Min Belanja">Rp {{ number_format($coupon->min_belanja, 0, ',', '.') }}</td>
                            <td data-label="Kuota">
                                @if($coupon->kuota)
                                    {{ $coupon->kuota_terpakai }}/{{ $coupon->kuota }}
                                @else
                                    <span class="badge">Unlimited</span>
                                @endif
                            </td>
                            <td data-label="Masa Berlaku">
                                @if($coupon->tanggal_mulai && $coupon->tanggal_berakhir)
                                    {{ $coupon->tanggal_mulai->translatedFormat('d M') }} - {{ $coupon->tanggal_berakhir->translatedFormat('d M Y') }}
                                @elseif($coupon->tanggal_mulai)
                                    Mulai {{ $coupon->tanggal_mulai->translatedFormat('d M Y') }}
                                @elseif($coupon->tanggal_berakhir)
                                    s.d {{ $coupon->tanggal_berakhir->translatedFormat('d M Y') }}
                                @else
                                    <span class="badge">-</span>
                                @endif
                            </td>
                            <td data-label="Status">
                                @if($coupon->aktif)
                                    <span class="badge badge--green">Aktif</span>
                                @else
                                    <span class="badge badge--red">Nonaktif</span>
                                @endif
                            </td>
                            <td data-label="Aksi">
                                <div class="table-actions">
                                    <a href="{{ route('admin.kupon.edit', $coupon) }}" class="btn btn--outline btn--sm">Edit</a>
                                    <form action="{{ route('admin.kupon.toggle', $coupon) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn--secondary btn--sm">
                                            {{ $coupon->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.kupon.destroy', $coupon) }}" method="POST"
                                          onsubmit="return confirm('Hapus kupon &quot;{{ $coupon->kode }}&quot;? Tindakan ini tidak dapat dibatalkan.');">
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

        <div>{{ $coupons->links() }}</div>
    @endif
</div>
@endsection
