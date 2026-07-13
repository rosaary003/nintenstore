<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NintenStore</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #222;
        }

        .navbar {
            background: #e60012;
            color: white;
            padding: 18px 50px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
        }

        .navbar h2 {
            margin: 0;
            transition: transform 0.3s ease;
        }

        .navbar h2:hover {
            transform: rotate(-2deg) scale(1.05);
        }

        .nav-menu {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 25px;
            margin-right: 25px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            position: relative;
        }

        .nav-menu a::after {
            content: "";
            position: absolute;
            width: 0;
            height: 2px;
            background: white;
            left: 0;
            bottom: -5px;
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .logout {
            background: white;
            color: #e60012;
            border: none;
            padding: 9px 17px;
            cursor: pointer;
            border-radius: 6px;
            font-weight: bold;
            transition: transform 0.3s ease,
                        box-shadow 0.3s ease;
        }

        .logout:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 45px 50px;
        }

        .welcome {
            margin-bottom: 35px;
            animation: fadeDown 0.7s ease;
        }

        .welcome h1 {
            margin-bottom: 8px;
        }

        .welcome p {
            color: #666;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(240px, 1fr)
            );
            gap: 25px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease;

            animation: fadeUp 0.7s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.16);
        }

        .card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;

            transition: transform 0.4s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .category {
            color: #777;
        }

        .price {
            color: #e60012;
            font-weight: bold;
            font-size: 19px;
        }

        .cart-button {
            width: 100%;
            background: #e60012;
            color: white;
            border: none;
            padding: 11px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;

            transition:
                transform 0.25s ease,
                background 0.25s ease,
                box-shadow 0.25s ease;
        }

        .cart-button:hover {
            background: #b8000e;
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(230, 0, 18, 0.25);
        }

        .cart-button:active {
            transform: scale(0.97);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 15px 20px;
                flex-wrap: wrap;
                gap: 15px;
            }

            .nav-menu {
                margin-left: 0;
                margin-right: 0;
            }

            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">

        <h2>NintenStore 🎮</h2>

        <div class="nav-menu">

            <a href="{{ route('orders.index') }}">
                Riwayat Pesanan
            </a>

            <a href="{{ route('cart.index') }}">
                🛒 Keranjang
            </a>

        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout">
                Logout
            </button>
        </form>

    </div>


    <div class="container">

        <div class="welcome">

            <h1>
                Selamat Datang, {{ Auth::user()->name }} 👋
            </h1>

            <p>
                Temukan game Nintendo pilihan di NintenStore.
            </p>

        </div>


        <h2>Daftar Produk</h2>


        <div class="products">

            @forelse($products as $product)

                <div class="card">

                    @if($product->image)

                        <img
                            src="{{ asset('image/' . $product->image) }}"
                            alt="{{ $product->name }}"
                        >

                    @endif


                    <h3>
                        {{ $product->name }}
                    </h3>


                    <p class="category">
                        {{ $product->category }}
                    </p>


                    <p class="price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>


                    <p>
                        Stok: {{ $product->stock }}
                    </p>


                    <p>
                        {{ $product->description }}
                    </p>


                    <form
                        action="{{ route('cart.add', $product->id) }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="cart-button"
                        >
                            🛒 Tambah ke Keranjang
                        </button>

                    </form>

                </div>

            @empty

                <p>Belum ada produk.</p>

            @endforelse

        </div>

    </div>

</body>
</html>