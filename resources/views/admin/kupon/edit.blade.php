@extends('layouts.app')

@section('title', 'Edit Kupon')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h2>Edit Kupon: {{ $kupon->kode }}</h2>
            <p>Perbarui informasi kupon diskon.</p>
        </div>
        <a href="{{ route('admin.kupon.index') }}" class="btn btn--outline btn--sm">&larr; Kembali</a>
    </div>

    <div class="form-card form-card--wide">
        <form method="POST" action="{{ route('admin.kupon.update', $kupon) }}">
            @method('PUT')
            @include('admin.kupon._form')

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.kupon.index') }}" class="btn btn--outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
