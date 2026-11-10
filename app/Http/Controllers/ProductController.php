<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function landing(): View
    {
        $products = Product::query()->latest()->get();

        return view('landing', compact('products'));
    }

    public function index(): View
    {
        $products = Product::query()->latest()->get();

        return view('produk.index', compact('products'));
    }

    public function create(): View
    {
        return view('produk.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nama_produk' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required', 'string'],
                'harga' => ['required', 'integer', 'min:0'],
                'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ],
            $this->validationMessages()
        );

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::query()->create($validated);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $produk): View
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(
        Request $request,
        Product $produk
    ): RedirectResponse {
        $validated = $request->validate(
            [
                'nama_produk' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required', 'string'],
                'harga' => ['required', 'integer', 'min:0'],
                'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ],
            $this->validationMessages()
        );

        if ($request->hasFile('gambar')) {
            // Hapus gambar upload lama, tetapi jangan hapus gambar bawaan di public/images.
            if ($produk->gambar && str_starts_with($produk->gambar, 'products/')) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('products', 'public');
        } else {
            unset($validated['gambar']);
        }

        $produk->update($validated);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $produk): RedirectResponse
    {
        if ($produk->gambar && str_starts_with($produk->gambar, 'products/')) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function validationMessages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.max' => 'Nama maksimal 100 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.integer' => 'Harga harus berupa bilangan bulat.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
