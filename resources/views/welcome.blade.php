@extends('layouts.app')

@section('title', 'Beranda')

@section('page-class', 'page--landing')

@section('content')
    {{-- HERO --}}
    <section class="landing-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/hijau.jpg') }}') center/cover no-repeat;">
        <div class="container landing-hero__inner">
            <span class="landing-hero__tagline">#MauRun</span>
            <h1 class="landing-hero__title">Taklukan <span>Garismu</span>,<br>Raih Medali Finisher</h1>
            <p class="landing-hero__desc">Platform event lari nomor #1 di Indonesia. Dari 3K hingga Full Marathon — temukan, daftar, dan raih prestasi terbaikmu di setiap langkah.</p>
            <div class="landing-hero__actions">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn--hero">Buka Dashboard</a>
                    @else
                        <a href="{{ route('peserta.events.index') }}" class="btn--hero">Lihat Semua Event</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn--hero">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="btn--hero-ghost">Masuk</a>
                @endauth
            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section class="landing-section">
        <div class="container">
            <div class="stats-row">
                <div class="stat-item">
                    <span class="stat-item__num">12+</span>
                    <span class="stat-item__label">Event</span>
                </div>
                <div class="stat-item">
                    <span class="stat-item__num">2.500+</span>
                    <span class="stat-item__label">Peserta</span>
                </div>
                <div class="stat-item">
                    <span class="stat-item__num">5</span>
                    <span class="stat-item__label">Kota</span>
                </div>
                <div class="stat-item">
                    <span class="stat-item__num">100%</span>
                    <span class="stat-item__label">Terpercaya</span>
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG --}}
    <section class="landing-section landing-section--alt">
        <div class="container">
            <div class="about-split">
                <div class="about-split__content">
                    <span class="section-badge">Tentang Mau Run</span>
                    <h2 class="section-title--lg">Platform Event Lari Terdepan di Indonesia</h2>
                    <p>Mau Run hadir untuk menghubungkan para pelari dengan event-event lari terbaik di berbagai kota. Kami memudahkan pendaftaran, menyediakan informasi lengkap, dan membantu Anda mencapai garis finish berikutnya.</p>
                    <p>Dari pemula hingga maratonier, semua bisa menemukan tantangan yang sesuai di Mau Run.</p>
                    <a href="{{ route('register') }}" class="btn btn--primary" style="margin-top:8px;">Mulai Petualanganmu</a>
                </div>
            </div>
        </div>
    </section>

    {{-- KATEGORI --}}
    <section class="landing-section">
        <div class="container">
            <div class="section-heading">
                <span class="section-badge">Kategori</span>
                <h2 class="section-title--lg">Pilih Jarak Sesuai Kemampuanmu</h2>
                <p>Dari pemula hingga profesional, ada kategori untuk semua level.</p>
            </div>
             <div class="kategori-grid">
              <div class="kategori-card kategori-card--3k">
                    <div class="kategori-card__img" style="background-image: url('{{ asset('images/kategori-3k.jpg') }}');"></div>
                    <span class="kategori-card__dist">3<span class="kategori-card__dist-km">KM</span></span>
                    <span class="kategori-card__label">Fun Run</span>
                    <span class="kategori-card__desc">Cocok untuk pemula dan keluarga</span>
                </div>
                <div class="kategori-card kategori-card--5k">
                    <div class="kategori-card__img" style="background-image: url('{{ asset('images/kategori-5k.jpg') }}');"></div>
                    <span class="kategori-card__dist">5<span class="kategori-card__dist-km">KM</span></span>
                    <span class="kategori-card__label">Pemula</span>
                    <span class="kategori-card__desc">Tantangan ringan untuk start</span>
                </div>
                <div class="kategori-card kategori-card--10k">
                    <div class="kategori-card__img" style="background-image: url('{{ asset('images/kategori-10k.jpg') }}');"></div>
                    <span class="kategori-card__dist">10<span class="kategori-card__dist-km">KM</span></span>
                    <span class="kategori-card__label">Menengah</span>
                    <span class="kategori-card__desc">Uji ketahanan dirimu</span>
                </div>
                <div class="kategori-card kategori-card--half">
                    <div class="kategori-card__img" style="background-image: url('{{ asset('images/kategori-21k.jpg') }}');"></div>
                    <span class="kategori-card__dist">21<span class="kategori-card__dist-km">KM</span></span>
                    <span class="kategori-card__label">Half Marathon</span>
                    <span class="kategori-card__desc">Tantangan serius para pelari</span>
                </div>
                <div class="kategori-card kategori-card--full">
                    <div class="kategori-card__img" style="background-image: url('{{ asset('images/kategori-42k.jpg') }}');"></div>
                    <span class="kategori-card__dist">42<span class="kategori-card__dist-km">KM</span></span>
                    <span class="kategori-card__label">Full Marathon</span>
                    <span class="kategori-card__desc">Puncak prestasi lari</span>
                </div>
            </div>
        </div>
    </section>

    {{-- CARA DAFTAR --}}
    <section class="landing-section landing-section--alt">
        <div class="container">
            <div class="section-heading">
                <span class="section-badge">Panduan</span>
                <h2 class="section-title--lg">Cara Mendaftar Event</h2>
                <p>Hanya 3 langkah mudah untuk ikut event lari favoritmu.</p>
            </div>
            <div class="steps-row">
                <div class="step-card">
                    <span class="step-card__num">01</span>
                    <h4>Buat Akun</h4>
                    <p>Daftar akun peserta dengan username dan password.</p>
                </div>
                <div class="step-card">
                    <span class="step-card__num">02</span>
                    <h4>Pilih Event</h4>
                    <p>Cari event lari sesuai jarak, kota, dan jadwal favoritmu.</p>
                </div>
                <div class="step-card">
                    <span class="step-card__num">03</span>
                    <h4>Daftar & Bayar</h4>
                    <p>Isi data diri, pilih jersey, dan selesaikan pendaftaran.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- EVENT TERDEKAT --}}
    <section class="landing-section">
        <div class="container">
            <div class="section-heading section-heading--row">
                <div>
                    <span class="section-badge">Event</span>
                    <h2 class="section-title--lg">Event Terdekat</h2>
                </div>
                @auth
                    @if(auth()->user()->isPeserta())
                        <a href="{{ route('peserta.events.index') }}" class="btn btn--outline">Lihat Semua &rarr;</a>
                    @endif
                @endauth
            </div>

            @if($events->isEmpty())
                <div class="empty-state">
                    <div class="empty-state__icon">🗓️</div>
                    <p>Belum ada event yang tersedia saat ini.</p>
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
                                <p class="card__desc">{{ Str::limit($event->deskripsi, 90) }}</p>
                                <div class="card__footer">
                                    <span class="card__price">Rp {{ number_format($event->harga, 0, ',', '.') }}</span>
                                    <span class="badge {{ $event->kuota > 0 ? 'badge--green' : 'badge--red' }}">
                                        {{ $event->kuota > 0 ? 'Sisa '.$event->kuota : 'Kuota Penuh' }}
                                    </span>
                                </div>
                                <div class="card__action">
                                    @auth
                                        @if(auth()->user()->isPeserta())
                                            <a href="{{ route('peserta.events.daftar', $event) }}" class="btn btn--primary btn--block btn--sm">Daftar Sekarang</a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn--outline btn--block btn--sm">Masuk untuk Daftar</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    {{-- CTA --}}
    <section class="landing-section landing-cta">
        <div class="container landing-cta__inner">
            <h2>Siap Taklukkan Garis Finish?</h2>
            <p>Daftar sekarang dan mulai perjalanan larimu bersama ribuan pelari lainnya.</p>
            <a href="{{ route('register') }}" class="btn--hero">Daftar Gratis</a>
        </div>
    </section>
@endsection
