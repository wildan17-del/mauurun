@extends('layouts.app')

@section('title', 'Daftar Peserta')

@section('page-class', 'page--auth')

@section('content')
<div class="auth-wrap">
    <div class="auth-side">
        <div class="auth-side__content">
            <div class="auth-side__logo">
                <img src="{{ asset('images/logo-maurun.png') }}" alt="Mau Run">
            </div>
            <h2 class="auth-side__title">Mulai Petualanganmu</h2>
            <p class="auth-side__desc">Daftar sekarang dan temukan event lari terbaik. Dari 3K hingga Full Marathon, semua ada di sini.</p>
            <div class="auth-side__features">
                <div class="auth-side__feature">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>Daftar event lari favoritmu</span>
                </div>
                <div class="auth-side__feature">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>Dapatkan medali finisher eksklusif</span>
                </div>
                <div class="auth-side__feature">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>Ikuti event dari 3K hingga Full Marathon</span>
                </div>
            </div>
        </div>
    </div>
    <div class="auth-main">
        <div class="auth-card">
            <div class="auth-card__header">
                <h1>Daftar Akun</h1>
                <p>Buat akun peserta Mau Run</p>
            </div>

            <form method="POST" action="{{ route('register.attempt') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus placeholder="Contoh: pelari_pemula">
                    </div>
                    @error('username')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required maxlength="16" placeholder="16 digit NIK KTP">
                    </div>
                    @error('nik')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" id="password" name="password" required placeholder="Minimal 6 karakter">
                    </div>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password">
                    </div>
                </div>
                <button type="submit" class="btn btn--primary btn--block btn--lg">Daftar</button>
            </form>

            <p class="auth-card__footer">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
