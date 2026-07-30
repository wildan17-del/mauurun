@csrf

<div class="form-card__section">
    <div class="form-card__section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Informasi Event
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="nama_event">Nama Event <span class="req">*</span></label>
            <input type="text" id="nama_event" name="nama_event"
                   value="{{ old('nama_event', $event->nama_event ?? '') }}"
                   placeholder="Contoh: Grow Run 2026" required>
            @error('nama_event') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jenis_event">Jenis Event <span class="req">*</span></label>
            <div class="select-wrap">
                <select id="jenis_event" name="jenis_event" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenisOptions as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_event', $event->jenis_event ?? '') === $jenis ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
                <svg class="select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            @error('jenis_event') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="tanggal">Tanggal <span class="req">*</span></label>
            <input type="date" id="tanggal" name="tanggal"
                   value="{{ old('tanggal', isset($event) ? $event->tanggal->format('Y-m-d') : '') }}" required>
            @error('tanggal') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="kota">Kota <span class="req">*</span></label>
            <input type="text" id="kota" name="kota" list="kota-list"
                   value="{{ old('kota', $event->kota ?? '') }}"
                   placeholder="Contoh: Yogyakarta" required>
            <datalist id="kota-list">
                @foreach($kotaOptions as $kota)
                    <option value="{{ $kota }}">
                @endforeach
            </datalist>
            <div class="form-hint">Pilih dari daftar atau ketik nama kota baru.</div>
            @error('kota') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="form-card__section">
    <div class="form-card__section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        Harga & Kuota
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="harga">Harga Pendaftaran <span class="req">*</span></label>
            <div class="input-prefix">
                <span class="input-prefix__text">Rp</span>
                <input type="number" id="harga" name="harga" min="0" step="1000"
                       value="{{ old('harga', $event->harga ?? '') }}" placeholder="Contoh: 200000" required>
            </div>
            @error('harga') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="kuota">Kuota Peserta <span class="req">*</span></label>
            <input type="number" id="kuota" name="kuota" min="0"
                   value="{{ old('kuota', $event->kuota ?? '') }}" placeholder="Contoh: 2000" required>
            @error('kuota') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="form-card__section">
    <div class="form-card__section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        Gambar & Deskripsi
    </div>

    <div class="form-group">
        <label for="gambar">Gambar Event</label>
        <div class="file-upload">
            <div class="file-upload__area">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                <p>Klik untuk upload gambar event</p>
                <span>Format: JPG, PNG, WebP. Maksimal 2 MB.</span>
            </div>
            <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/webp" onchange="this.previousElementSibling.querySelector('p').textContent = this.files[0] ? this.files[0].name : 'Klik untuk upload gambar event'">
        </div>
        @error('gambar') <div class="form-error">{{ $message }}</div> @enderror
        @if(isset($event) && $event->gambar)
            <div class="file-upload__current">
                <img src="{{ asset('storage/'.$event->gambar) }}" alt="{{ $event->nama_event }}">
                <span>Gambar saat ini. Upload gambar baru untuk mengganti.</span>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Contoh: Benefit (Jersey, BIB Number, Medal, Refreshment, Water Station, Doorprize)">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <div class="form-error">{{ $message }}</div> @enderror
    </div>
</div>
