@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<main class="admin-page">
    <div class="container admin-container">
        <div class="page-heading">
            <div>
                <span class="eyebrow">Pengelolaan produk</span>
                <h1>Edit Produk</h1>
            </div>
        </div>

        <form method="POST"
              action="{{ route('produk.update', $produk) }}"
              enctype="multipart/form-data" class="form-card">
            @csrf
            @method('PUT')
            @include('produk._form', ['tombol' => 'Perbarui Produk'])
        </form>
    </div>
</main>
@endsection
