<div class="form-group">
    <label for="nama_produk">Nama produk</label>
    <input
        id="nama_produk"
        name="nama_produk"
        type="text"
        value="{{ old('nama_produk', $produk->nama_produk ?? '') }}"
        class="form-control @error('nama_produk') is-invalid @enderror"
    >
    @error('nama_produk')
        <small class="error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea
        id="deskripsi"
        name="deskripsi"
        rows="5"
        class="form-control @error('deskripsi') is-invalid @enderror"
    >{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
        <small class="error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="harga">Harga</label>
    <input
        id="harga"
        name="harga"
        type="number"
        min="0"
        value="{{ old('harga', $produk->harga ?? '') }}"
        class="form-control @error('harga') is-invalid @enderror"
    >
    @error('harga')
        <small class="error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="gambar">Upload gambar produk (opsional)</label>
    @if (!empty($produk?->gambar))
        <div style="margin-bottom: 10px;">
            <img
                src="{{ str_starts_with($produk->gambar, 'products/') ? asset('storage/' . $produk->gambar) : asset('images/' . $produk->gambar) }}"
                alt="{{ $produk->nama_produk }}"
                style="width: 120px; height: 90px; object-fit: cover; border-radius: 8px;"
            >
            <small>Gambar saat ini</small>
        </div>
    @endif
    <input
        id="gambar"
        name="gambar"
        type="file"
        accept="image/jpeg,image/png,image/webp"
        class="form-control @error('gambar') is-invalid @enderror"
    >
    <small>Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</small>
    @error('gambar')
        <small class="error">{{ $message }}</small>
    @enderror
</div>

<div class="form-actions">
    <button class="btn" type="submit">{{ $tombol }}</button>
    <a class="btn btn-secondary" href="{{ route('produk.index') }}">
        Batal
    </a>
</div>
