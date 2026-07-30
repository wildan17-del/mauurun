@extends('layouts.app')

@section('title', 'Masuk')

@section('page-class', 'page--auth')

@section('content')
<div class="auth-wrap">
    <div class="auth-side">
        <div class="auth-side__content">
            <div class="auth-side__logo">
                <img src="{{ asset('images/logo-maurun.png') }}" alt="Mau Run">
            </div>
            <h2 class="auth-side__title">Taklukan Garismu</h2>
            <p class="auth-side__desc">Temukan, daftar, dan taklukkan garis finishmu. Platform event lari terdepan di Indonesia.</p>
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
                <h1>Selamat Datang</h1>
                <p>Masuk ke akun Mau Run kamu</p>
            </div>

            @if ($errors->any())
                <div class="alert alert--danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus placeholder="Masukkan username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" id="password" name="password" required placeholder="Masukkan password">
                    </div>
                </div>
                <div class="form-group form-group--inline">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" class="checkbox-input">
                        <span class="checkbox-custom"></span>
                        Ingat saya
                    </label>
                </div>
                <button type="submit" class="btn btn--primary btn--block btn--lg">Masuk</button>
            </form>

            <p class="auth-card__footer">
                Belum punya akun peserta? <a href="{{ route('register') }}">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
