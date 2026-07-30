<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') | Mau Run</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <header class="navbar">
        <div class="container navbar__inner">
            <a href="{{ route('welcome') }}" class="navbar__brand">
                <img src="{{ asset('images/logo-maurun.png') }}" alt="Mau Run" class="navbar__logo">
            </a>

            <nav class="navbar__nav">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="navbar__link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">Dashboard</a>
                        <a href="{{ route('admin.events.index') }}" class="navbar__link {{ request()->routeIs('admin.events.*') ? 'is-active' : '' }}">Kelola Event</a>
                        <a href="{{ route('admin.kupon.index') }}" class="navbar__link {{ request()->routeIs('admin.kupon.*') ? 'is-active' : '' }}">Kelola Kupon</a>
                    @else
                        <a href="{{ route('peserta.events.index') }}" class="navbar__link {{ request()->routeIs('peserta.events.*') ? 'is-active' : '' }}">Daftar Event</a>
                        <a href="{{ route('peserta.riwayat') }}" class="navbar__link {{ request()->routeIs('peserta.riwayat') ? 'is-active' : '' }}">Riwayat Saya</a>
                    @endif
                    <div class="navbar__dropdown">
                        <button class="navbar__user" onclick="this.parentElement.classList.toggle('is-open')">
                            <span class="navbar__avatar">{{ substr(auth()->user()->username, 0, 1) }}</span>
                            {{ auth()->user()->username }}
                            <svg class="navbar__chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="navbar__dropdown-menu">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="navbar__dropdown-item">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="navbar__link">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn--primary btn--sm">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="page @yield('page-class')">
        @if (session('status') || session('error'))
            <div class="container">
                @if (session('status'))
                    <div class="alert alert--success">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert--danger">{{ session('error') }}</div>
                @endif
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <div class="footer__brand">
                    <div class="footer__logo">
                        <h1>MauRun</h1>
                    </div>
                    <p>Platform event lari terdepan di Indonesia. Temukan, daftar, dan taklukkan garis finishmu.</p>
                    <div class="footer__social">
                        <a href="#" target="_blank" rel="noopener" title="Facebook">fb</a>
                        <a href="#" target="_blank" rel="noopener" title="Instagram">ig</a>
                        <a href="mailto:wildanashidiqi170505@gmail.com" title="Email">@</a>
                        <a href="#" target="_blank" rel="noopener" title="WhatsApp">wa</a>
                    </div>
                </div>
                <div class="footer__col">
                    <h5>Event</h5>
                    <a href="{{ route('peserta.events.index') }}">Daftar Event</a>
                    <a href="{{ route('peserta.events.index') }}">Kategori Lari</a>
                    <a href="{{ route('peserta.riwayat') }}">Riwayat Saya</a>
                </div>
                <div class="footer__col">
                    <h5>Peserta</h5>
                    <a href="{{ route('register') }}">Daftar Akun</a>
                    <a href="{{ route('login') }}">Masuk</a>
                </div>
                <div class="footer__col">
                    <h5>Kontak</h5>
                    <span>wildanashidiqi170505@gmail.com</span>
                    <span>IG: wildan_asq</span>
                </div>
            </div>
            <div class="footer__bottom">
                <p>&copy; {{ date('Y') }} Mau Run. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        document.addEventListener('click', function(e) {
            document.querySelectorAll('.navbar__dropdown.is-open').forEach(function(d) {
                if (!d.contains(e.target)) d.classList.remove('is-open');
            });
        });
    </script>
</body>
</html>
