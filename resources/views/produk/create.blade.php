@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<main class="admin-page">
    <div class="container admin-container">
        <div class="page-heading">
            <div>
                <span class="eyebrow">Pengelolaan produk</span>
                <h1>Tambah Produk</h1>
            </div>
        </div>

        <form method="POST" action="{{ route('produk.store') }}"
              enctype="multipart/form-data" class="form-card">
            @csrf
            @include('produk._form', ['tombol' => 'Simpan Produk'])
        </form>
    </div>
</main>
@endsection
