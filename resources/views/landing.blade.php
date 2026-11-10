@extends('layouts.app')

@section('title', 'Kopi Ulee Kareng')

@section('content')
<header class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="#beranda">Kopi Ulee Kareng</a>
        <nav>
            <a href="#tentang">Tentang</a>
            <a href="#keunggulan">Keunggulan</a>
            <a href="#produk">Produk</a>
            <a href="#kontak">Kontak</a>
            <a class="btn btn-small" href="{{ route('produk.index') }}">
                Kelola Produk
            </a>
        </nav>
    </div>
</header>

<main>
    <section id="beranda" class="hero">
        <div class="container hero-grid">
            <div>
                <span class="eyebrow">Cita rasa khas Aceh</span>
                <h1>Hangatnya budaya dalam secangkir kopi.</h1>
                <p>
                    Kenali Kopi Ulee Kareng melalui pilihan produk
                    yang diracik untuk pecinta kopi Nusantara.
                </p>
                <a class="btn" href="#produk">Lihat Produk</a>
            </div>
            <div class="hero-card">
                <p>Aroma kuat</p>
                <p>Rasa autentik</p>
                <p>Warisan budaya Aceh</p>
            </div>
        </div>
    </section>

    <section id="tentang" class="section">
        <div class="container narrow">
            <span class="eyebrow">Tentang</span>
            <h2>Kopi dari ruang temu masyarakat Aceh</h2>
            <p>
                Ulee Kareng dikenal sebagai salah satu kawasan kopi
                di Banda Aceh. Landing page ini memperkenalkan produk
                secara informatif dan sederhana.
            </p>
        </div>
    </section>

    <section id="keunggulan" class="section section-soft">
        <div class="container">
            <span class="eyebrow">Keunggulan</span>
            <div class="features">
                <article><h3>Aroma</h3><p>Karakter wangi yang kuat.</p></article>
                <article><h3>Rasa</h3><p>Cita rasa pekat dan khas.</p></article>
                <article><h3>Budaya</h3><p>Bagian dari tradisi berkumpul.</p></article>
            </div>
        </div>
    </section>

    <section id="produk" class="section">
        <div class="container">
            <span class="eyebrow">Produk</span>
            <h2>Pilihan Kopi Ulee Kareng</h2>
            <div class="product-grid">
                @forelse ($products as $produk)
                    <article class="product-card">
                        <img
                            src="{{ ($produk->gambar && str_starts_with($produk->gambar, 'products/')) ? asset('storage/' . $produk->gambar) : asset('images/' . ($produk->gambar
                                ?: 'kopi-default.jpg')) }}"
                            alt="{{ $produk->nama_produk }}"
                        >
                        <div class="product-body">
                            <h3>{{ $produk->nama_produk }}</h3>
                            <p>{{ $produk->deskripsi }}</p>
                            <strong>
                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </strong>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        Belum ada produk. Silakan kelola data produk.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="kontak" class="section contact">
        <div class="container">
            <span class="eyebrow">Kontak</span>
            <h2>Kunjungi Ulee Kareng, Banda Aceh</h2>
            <p>Telepon: 08xx-xxxx-xxxx • Instagram: @kopiuleekareng</p>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} Kopi Ulee Kareng.</p>
    </div>
</footer>
@endsection
