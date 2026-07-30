@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran')

@section('content')
<div class="riwayat-page">
  <div class="container">
    <div class="section-header">
      <div>
        <h2>Riwayat Pendaftaran Saya</h2>
        <p>Daftar event yang sudah Anda pilih dan daftarkan.</p>
      </div>
    </div>

    @if($registrations->isEmpty())
      <div class="empty-state">
        <div class="empty-state__icon">🏃</div>
        <p>Anda belum mendaftar pada event apa pun.</p>
        <a href="{{ route('peserta.events.index') }}" class="btn btn--primary" style="margin-top:14px;">Lihat Daftar Event</a>
      </div>
    @else
      <div class="riwayat-cards">
        @foreach($registrations as $reg)
          <div class="riwayat-card">
            <div class="riwayat-card__header">
              <div class="riwayat-card__header-left">
                <div class="riwayat-card__icon">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                  <h3 class="riwayat-card__title">{{ $reg->event->nama_event }}</h3>
                  <div class="riwayat-card__badges">
                    <span class="badge badge--primary">{{ $reg->event->jenis_event }}</span>
                    <span class="badge">{{ $reg->event->kota }}</span>
                  </div>
                </div>
              </div>
              <div class="riwayat-card__status">
                @if($reg->confirmed)
                  <span class="riwayat-card__status-badge riwayat-card__status-badge--confirmed">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Terkonfirmasi
                  </span>
                @else
                  <span class="riwayat-card__status-badge riwayat-card__status-badge--pending">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Menunggu
                  </span>
                @endif
              </div>
            </div>

            <div class="riwayat-card__body">
              <div class="riwayat-card__info">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span>{{ $reg->event->tanggal->translatedFormat('d M Y') }}</span>
              </div>
              <div class="riwayat-card__info">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                <span>Jersey: <strong>{{ $reg->ukuran_jersey }}</strong></span>
              </div>
              <div class="riwayat-card__info">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                <span>Kupon: <strong>{{ $reg->kode_kupon ?? '-' }}</strong></span>
              </div>
              <div class="riwayat-card__info">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                <span>Potongan: <strong>Rp {{ number_format($reg->potongan_harga, 0, ',', '.') }}</strong></span>
              </div>
            </div>

            <div class="riwayat-card__footer">
              <div class="riwayat-card__price">
                <span class="riwayat-card__price-label">Total Pembayaran</span>
                <span class="riwayat-card__price-value">Rp {{ number_format($reg->harga_akhir, 0, ',', '.') }}</span>
              </div>
              <a href="{{ route('peserta.pendaftaran.edit', $reg) }}" class="riwayat-card__edit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit
              </a>
            </div>
          </div>
        @endforeach
      </div>

      <div>{{ $registrations->links() }}</div>
    @endif
  </div>
</div>
@endsection
