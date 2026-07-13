@extends('admin.layouts.app')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        animation: fadeProduct 0.6s ease;
    }

    .page-header h1 {
        margin: 0 0 7px;
    }

    .page-header p {
        margin: 0;
        color: #777;
    }

    .add-button {
        background: #e60012;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease,
            background 0.3s ease;
    }

    .add-button:hover {
        background: #b8000e;
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(230, 0, 18, 0.25);
    }

    .product-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        animation: fadeProduct 0.8s ease;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        color: #777;
        font-size: 14px;
    }

    tbody tr {
        transition:
            transform 0.3s ease,
            background 0.3s ease;
    }

    tbody tr:hover {
        background: #fff5f6;
        transform: translateX(5px);
    }

    .product-image {
        width: 85px;
        height: 85px;
        object-fit: cover;
        border-radius: 9px;
        transition: transform 0.35s ease;
    }

    .product-image:hover {
        transform: scale(1.12);
    }

    .price {
        color: #e60012;
        font-weight: bold;
    }

    .stock {
        display: inline-block;
        background: #f1f1f1;
        padding: 6px 11px;
        border-radius: 20px;
        font-weight: bold;
    }

    .action {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .edit {
        background: #f0ad4e;
        color: white;
        padding: 8px 13px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        transition: transform 0.25s ease;
    }

    .edit:hover {
        transform: translateY(-3px);
    }

    .delete {
        background: #e60012;
        color: white;
        border: none;
        padding: 9px 13px;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition:
            transform 0.25s ease,
            background 0.25s ease;
    }

    .delete:hover {
        background: #b8000e;
        transform: translateY(-3px);
    }

    @keyframes fadeProduct {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


<div class="page-header">

    <div>
        <h1>Data Produk 🎮</h1>

        <p>
            Kelola produk dan stok NintenStore.
        </p>
    </div>

    <a
        href="{{ route('admin.products.create') }}"
        class="add-button"
    >
        + Tambah Produk
    </a>

</div>


<div class="product-card">

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($products as $product)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        <strong>
                            {{ $product->name }}
                        </strong>
                    </td>

                    <td>

                        @if($product->image)

                            <img
                            src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="product-image"
                            >

                        @else

                            Tidak ada gambar

                        @endif

                    </td>

                    <td>
                        {{ $product->category }}
                    </td>

                    <td class="price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td>
                        <span class="stock">
                            {{ $product->stock }}
                        </span>
                    </td>

                    <td>

                        <div class="action">

                            <a
                                href="{{ route('admin.products.edit', $product->id) }}"
                                class="edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.products.destroy', $product->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px;">
                        Belum ada produk.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection