@csrf

<div class="form-card__section">
    <div class="form-card__section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
        Informasi Kupon
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="kode">Kode Kupon <span class="req">*</span></label>
            <input type="text" id="kode" name="kode"
                   value="{{ old('kode', $kupon->kode ?? '') }}"
                   placeholder="Contoh: WELCOME10" required>
            <div class="form-hint">Peserta akan memasukkan kode ini saat mendaftar.</div>
            @error('kode') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nama">Nama Kupon <span class="req">*</span></label>
            <input type="text" id="nama" name="nama"
                   value="{{ old('nama', $kupon->nama ?? '') }}"
                   placeholder="Contoh: Diskon 10%" required>
            @error('nama') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="form-card__section">
    <div class="form-card__section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        Diskon & Ketentuan
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="diskon_persen">Diskon (%) <span class="req">*</span></label>
            <div class="input-suffix">
                <input type="number" id="diskon_persen" name="diskon_persen" min="0" max="100" step="0.5"
                       value="{{ old('diskon_persen', $kupon->diskon_persen ?? '') }}"
                       placeholder="Contoh: 10" required>
                <span class="input-suffix__text">%</span>
            </div>
            @error('diskon_persen') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="maks_potongan">Maksimal Potongan (Rp)</label>
            <div class="input-prefix">
                <span class="input-prefix__text">Rp</span>
                <input type="number" id="maks_potongan" name="maks_potongan" min="0"
                       value="{{ old('maks_potongan', $kupon->maks_potongan ?? '') }}"
                       placeholder="Kosongkan jika tanpa batas">
            </div>
            <div class="form-hint">Batas atas nominal diskon. Biarkan kosong jika tidak ada batas.</div>
            @error('maks_potongan') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="min_belanja">Minimal Harga Event (Rp)</label>
            <div class="input-prefix">
                <span class="input-prefix__text">Rp</span>
                <input type="number" id="min_belanja" name="min_belanja" min="0"
                       value="{{ old('min_belanja', $kupon->min_belanja ?? '0') }}"
                       placeholder="0">
            </div>
            <div class="form-hint">Harga event harus di atas nominal ini agar kupon bisa digunakan.</div>
            @error('min_belanja') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="kuota">Kuota Pemakaian</label>
            <input type="number" id="kuota" name="kuota" min="0"
                   value="{{ old('kuota', $kupon->kuota ?? '') }}"
                   placeholder="Kosongkan jika unlimited">
            <div class="form-hint">Maksimal berapa kali kupon bisa digunakan. Biarkan kosong jika tanpa batas.</div>
            @error('kuota') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="form-card__section">
    <div class="form-card__section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Masa Berlaku & Status
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                   value="{{ old('tanggal_mulai', isset($kupon) && $kupon->tanggal_mulai ? $kupon->tanggal_mulai->format('Y-m-d') : '') }}">
            @error('tanggal_mulai') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_berakhir">Tanggal Berakhir</label>
            <input type="date" id="tanggal_berakhir" name="tanggal_berakhir"
                   value="{{ old('tanggal_berakhir', isset($kupon) && $kupon->tanggal_berakhir ? $kupon->tanggal_berakhir->format('Y-m-d') : '') }}">
            @error('tanggal_berakhir') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="form-toggle">
            <input type="checkbox" name="aktif" value="1" {{ old('aktif', isset($kupon) ? $kupon->aktif : true) ? 'checked' : '' }}>
            <span class="form-toggle__slider"></span>
            <span class="form-toggle__label">Aktif</span>
        </label>
        <div class="form-hint">Nonaktifkan untuk menyembunyikan kupon tanpa menghapus.</div>
    </div>
</div>
