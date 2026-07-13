@extends('admin.layouts.app')

@section('content')

<style>
    .welcome {
        margin-bottom: 35px;
        animation: fadeDashboard 0.6s ease;
    }

    .welcome h1 {
        margin-bottom: 8px;
        font-size: 32px;
    }

    .welcome p {
        color: #777;
        margin: 0;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: white;
        padding: 28px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;

        transition:
            transform 0.35s ease,
            box-shadow 0.35s ease;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: #e60012;
    }

    .stat-card:hover {
        transform: scale(1.01);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .stat-icon {
        font-size: 30px;
        margin-bottom: 15px;
    }


    .stat-card h3 {
        margin: 0;
        color: #777;
        font-size: 15px;
    }

    .stat-card h2 {
        margin: 10px 0 0;
        font-size: 38px;
        color: #e60012;
    }

    .product-list {
        background: white;
        padding: 28px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        animation: fadeDashboard 0.8s ease;
    }

    .product-list h2 {
        margin-top: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
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
            transform 0.25s ease,
            background 0.25s ease;
    }

    tbody tr:hover {
        background: #fff5f6;
        transform: translateX(5px);
    }

    .price {
        color: #e60012;
        font-weight: bold;
    }

    .stock {
        display: inline-block;
        background: #f1f1f1;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    @keyframes fadeDashboard {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 800px) {
        .stats {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="welcome">

    <h1>Dashboard Admin 👋</h1>

    <p>
        Selamat datang, {{ auth()->user()->name }}.
        Kelola NintenStore melalui halaman admin.
    </p>

</div>


<div class="stats">

    <div class="stat-card">

        <div class="stat-icon">
            🎮
        </div>

        <h3>Total Produk</h3>

        <h2>{{ $totalProducts }}</h2>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            📦
        </div>

        <h3>Total Stok</h3>

        <h2>{{ $totalStock }}</h2>

    </div>

</div>


<div class="product-list">

    <h2>Produk Terbaru</h2>

    <table>

        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>

            @forelse($latestProducts as $product)

                <tr>

                    <td>
                        <strong>
                            {{ $product->name }}
                        </strong>
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

                </tr>

            @empty

                <tr>
                    <td colspan="4">
                        Belum ada produk.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection