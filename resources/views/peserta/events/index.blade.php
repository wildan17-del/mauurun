@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h2>Daftar Event Lari</h2>
            <p>Temukan event lari yang sesuai dan daftar sekarang.</p>
        </div>
    </div>

    <div class="filter-bar">
        <form method="GET" action="{{ route('peserta.events.index') }}">
            <div class="filter-bar__group">
                <div class="filter-bar__field">
                    <label for="jenis_event">Jenis Event</label>
                    <div class="filter-bar__select-wrap">
                        <select id="jenis_event" name="jenis_event">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisOptions as $jenis)
                                <option value="{{ $jenis }}" {{ request('jenis_event') === $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                        <svg class="filter-bar__arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </div>

                <div class="filter-bar__field">
                    <label for="kota">Kota</label>
                    <div class="filter-bar__select-wrap">
                        <select id="kota" name="kota">
                            <option value="">Semua Kota</option>
                            @foreach($kotaOptions as $kota)
                                <option value="{{ $kota }}" {{ request('kota') === $kota ? 'selected' : '' }}>{{ $kota }}</option>
                            @endforeach
                        </select>
                        <svg class="filter-bar__arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </div>

                <div class="filter-bar__actions">
                    <button type="submit" class="btn btn--primary">Terapkan Filter</button>
                    @if(request('jenis_event') || request('kota'))
                        <a href="{{ route('peserta.events.index') }}" class="btn btn--ghost">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    @if($events->isEmpty())
        <div class="empty-state">
            <div class="empty-state__icon">🔍</div>
            <p>Tidak ada event yang sesuai dengan filter yang dipilih.</p>
        </div>
    @else
        <div class="grid">
            @foreach($events as $event)
                <div class="card">
                    <div class="card__img" style="background-image: url('{{ $event->gambar ? asset('storage/'.$event->gambar) : '' }}');"></div>
                    <div class="card__body">
                        <h3 class="card__title">{{ $event->nama_event }}</h3>
                        <div class="card__meta">
                            <span class="badge badge--primary">{{ $event->jenis_event }}</span>
                            <span class="badge">{{ $event->kota }}</span>
                            <span class="badge">{{ $event->tanggal->translatedFormat('d M Y') }}</span>
                        </div>
                        <p class="card__desc">{{ Str::limit($event->deskripsi, 100) }}</p>
                        <div class="card__footer">
                            <span class="card__price">Rp {{ number_format($event->harga, 0, ',', '.') }}</span>
                            <span class="badge {{ $event->kuota > 0 ? 'badge--green' : 'badge--red' }}">
                                {{ $event->kuota > 0 ? 'Sisa '.$event->kuota : 'Kuota Penuh' }}
                            </span>
                        </div>
                        <div class="card__action">
                            @if(in_array($event->id, $idEventDiikuti))
                                <button class="btn btn--outline btn--block" disabled>✓ Sudah Terdaftar</button>
                            @elseif($event->kuota > 0)
                                <a href="{{ route('peserta.events.daftar', $event) }}" class="btn btn--primary btn--block">Daftar Sekarang</a>
                            @else
                                <button class="btn btn--outline btn--block" disabled>Kuota Penuh</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div>{{ $events->links() }}</div>
    @endif
</div>
@endsection
