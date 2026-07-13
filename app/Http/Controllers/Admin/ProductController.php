<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'category' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only([
        'name',
        'category',
        'price',
        'stock',
        'description',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')
            ->store('products', 'public');
    }

    Product::create($data);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil ditambahkan');
}

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
         $request->validate([
        'name' => 'required',
        'category' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only([
        'name',
        'category',
        'price',
        'stock',
        'description',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')
            ->store('products', 'public');
    }

    $product->update($data);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil diperbarui');
}


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}