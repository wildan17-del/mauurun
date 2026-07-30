@extends('layouts.app')

@section('title', 'Edit Pendaftaran: ' . $event->nama_event)

@section('content')
<div class="register-page">
  <div class="container">
    <div class="register-hero" @if($event->gambar) style="background-image: url('{{ asset('storage/'.$event->gambar) }}');" @endif>
      <div class="register-hero__overlay"></div>
      <div class="register-hero__content">
        <a href="{{ route('peserta.riwayat') }}" class="register-hero__back">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
          Kembali
        </a>
        <div class="register-hero__badge">{{ $event->jenis_event }}</div>
        <h1 class="register-hero__title">Edit Pendaftaran</h1>
        <div class="register-hero__meta">
          <div class="register-hero__meta-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            {{ $event->tanggal->translatedFormat('d M Y') }}
          </div>
          <div class="register-hero__meta-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ $event->kota }}
          </div>
          <div class="register-hero__meta-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            {{ $event->nama_event }}
          </div>
        </div>
      </div>
    </div>

    <div class="register-body">
      <div class="register-summary">
        <div class="register-summary__icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
        </div>
        <div class="register-summary__label">Harga Pendaftaran</div>
        <div class="register-summary__price">Rp {{ number_format($event->harga, 0, ',', '.') }}</div>
      </div>

      <div class="register-card">
        @if ($errors->any())
          <div class="register-alert register-alert--danger">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('peserta.pendaftaran.update', $registration) }}" class="register-form">
          @csrf
          @method('PATCH')

          <div class="register-form__section">
            <h3 class="register-form__title">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              Data Diri
            </h3>

            <div class="register-form__row">
              <div class="register-form__group">
                <label for="nama_lengkap">Nama Lengkap <span class="req">*</span></label>
                <div class="register-form__input-wrap">
                  <svg class="register-form__input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                  <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $registration->nama_lengkap) }}" required>
                </div>
                @error('nama_lengkap') <div class="register-form__error">{{ $message }}</div> @enderror
              </div>
              <div class="register-form__group">
                <label for="email">Email <span class="req">*</span></label>
                <div class="register-form__input-wrap">
                  <svg class="register-form__input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                  <input type="email" id="email" name="email" value="{{ old('email', $registration->email) }}" required>
                </div>
                @error('email') <div class="register-form__error">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="register-form__row">
              <div class="register-form__group">
                <label for="no_hp">Nomor HP <span class="req">*</span></label>
                <div class="register-form__input-wrap">
                  <svg class="register-form__input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                  <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp', $registration->no_hp) }}" required>
                </div>
                @error('no_hp') <div class="register-form__error">{{ $message }}</div> @enderror
              </div>
              <div class="register-form__group">
                <label>Jenis Kelamin <span class="req">*</span></label>
                <div class="register-form__radio-group">
                  <label class="register-form__radio-label {{ old('jenis_kelamin', $registration->jenis_kelamin) === 'Laki-Laki' ? 'is-selected' : '' }}">
                    <input type="radio" name="jenis_kelamin" value="Laki-Laki" {{ old('jenis_kelamin', $registration->jenis_kelamin) === 'Laki-Laki' ? 'checked' : '' }} required>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="3"/><path d="M12 8v8"/><path d="M8 16h8"/></svg>
                    Laki-Laki
                  </label>
                  <label class="register-form__radio-label {{ old('jenis_kelamin', $registration->jenis_kelamin) === 'Perempuan' ? 'is-selected' : '' }}">
                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin', $registration->jenis_kelamin) === 'Perempuan' ? 'checked' : '' }}>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 2v8"/><path d="M6 12h12"/></svg>
                    Perempuan
                  </label>
                </div>
                @error('jenis_kelamin') <div class="register-form__error">{{ $message }}</div> @enderror
              </div>
            </div>
          </div>

          <div class="register-form__section">
            <h3 class="register-form__title">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
              Jersey & Kupon
            </h3>

            <div class="register-form__row">
              <div class="register-form__group">
                <label for="ukuran_jersey">Ukuran Jersey <span class="req">*</span></label>
                <div class="register-form__size-picker">
                  @foreach(['S','M','L','XL','XXL'] as $ukuran)
                    <label class="register-form__size-option {{ old('ukuran_jersey', $registration->ukuran_jersey) === $ukuran ? 'is-active' : '' }}">
                      <input type="radio" name="ukuran_jersey" value="{{ $ukuran }}" {{ old('ukuran_jersey', $registration->ukuran_jersey) === $ukuran ? 'checked' : '' }} required>
                      <span class="register-form__size-label">{{ $ukuran }}</span>
                      @if($ukuran === 'L')
                        <span class="register-form__size-popular">Populer</span>
                      @endif
                    </label>
                  @endforeach
                </div>
                @error('ukuran_jersey') <div class="register-form__error">{{ $message }}</div> @enderror
              </div>
              <div class="register-form__group">
                <label for="kode_kupon">Kode Kupon</label>
                <div class="register-form__input-wrap">
                  <svg class="register-form__input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                  <input type="text" id="kode_kupon" name="kode_kupon" value="{{ old('kode_kupon', $registration->kode_kupon) }}" placeholder="Masukkan kode kupon">
                </div>
                <div class="register-form__kupon-info">
                  @php
                    $coupons = \App\Models\Coupon::where('aktif', true)
                      ->where(function($q) { $q->whereNull('tanggal_berakhir')->orWhere('tanggal_berakhir', '>=', now()); })
                      ->where(function($q) { $q->whereNull('kuota')->orWhereColumn('kuota_terpakai', '<', 'kuota'); })
                      ->get();
                  @endphp
                  @forelse($coupons as $c)
                    <div class="register-form__kupon-item">
                      <span class="register-form__kupon-code">{{ $c->kode }}</span>
                      <span class="register-form__kupon-desc">
                        diskon {{ number_format($c->diskon_persen, 0) }}%
                        @if($c->maks_potongan)
                          (maks Rp {{ number_format($c->maks_potongan, 0, ',', '.') }})
                        @endif
                      </span>
                    </div>
                  @empty
                    <div class="register-form__kupon-item">
                      <span class="register-form__kupon-desc" style="opacity:.6;">Tidak ada kupon tersedia saat ini.</span>
                    </div>
                  @endforelse
                </div>
                @error('kode_kupon') <div class="register-form__error">{{ $message }}</div> @enderror
              </div>
            </div>
          </div>

          <div class="register-form__actions">
            <button type="submit" class="register-form__btn register-form__btn--primary">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              Simpan Perubahan
            </button>
            <a href="{{ route('peserta.riwayat') }}" class="register-form__btn register-form__btn--outline">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.register-form__radio-label input[type="radio"]').forEach(function(radio) {
  radio.addEventListener('change', function() {
    var group = this.closest('.register-form__radio-group');
    group.querySelectorAll('.register-form__radio-label').forEach(function(l) {
      l.classList.remove('is-selected');
    });
    this.closest('.register-form__radio-label').classList.add('is-selected');
  });
});

document.querySelectorAll('.register-form__size-option input[type="radio"]').forEach(function(radio) {
  radio.addEventListener('change', function() {
    var group = this.closest('.register-form__size-picker');
    group.querySelectorAll('.register-form__size-option').forEach(function(o) {
      o.classList.remove('is-active');
    });
    this.closest('.register-form__size-option').classList.add('is-active');
  });
});
</script>
@endpush
