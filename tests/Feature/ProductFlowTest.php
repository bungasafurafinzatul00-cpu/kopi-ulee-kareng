<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_dapat_diakses(): void
    {
        $response = $this->get(route('landing'));

        $response->assertOk();
        $response->assertSee('Kopi Ulee Kareng');
    }

    public function test_produk_valid_dapat_disimpan(): void
    {
        $response = $this->post(route('produk.store'), [
            'nama_produk' => 'Kopi Test',
            'deskripsi' => 'Produk untuk pengujian.',
            'harga' => 20000,
            'gambar' => null,
        ]);

        $response->assertRedirect(route('produk.index'));

        $this->assertDatabaseHas('products', [
            'nama_produk' => 'Kopi Test',
            'harga' => 20000,
        ]);
    }

    public function test_harga_harus_bilangan_bulat(): void
    {
        $response = $this->post(route('produk.store'), [
            'nama_produk' => 'Kopi Tidak Valid',
            'deskripsi' => 'Data uji tidak valid.',
            'harga' => 'dua puluh ribu',
        ]);

        $response->assertSessionHasErrors(['harga']);
        $this->assertDatabaseCount('products', 0);
    }
}
