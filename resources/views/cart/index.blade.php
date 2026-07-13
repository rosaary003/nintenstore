<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang - NintenStore</title>

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
            padding: 18px 8%;
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
            transform: translateX(5px);
        }

        .container {
            width: 85%;
            margin: 40px auto;
            animation: fadeUp 0.6s ease;
        }

        .title {
            margin-bottom: 30px;
        }

        .cart-item {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 25px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease;
        }

        .cart-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.14);
        }

        .cart-item img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 10px;

            transition: transform 0.4s ease;
        }

        .cart-item:hover img {
            transform: scale(1.06);
        }

        .info {
            flex: 1;
        }

        .info h3 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .price {
            color: #e60012;
            font-weight: bold;
            font-size: 18px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .actions form {
            margin: 0;
        }

        .quantity-button {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 7px;
            background: #eeeeee;
            font-size: 18px;
            cursor: pointer;

            transition:
                transform 0.2s ease,
                background 0.2s ease;
        }

        .quantity-button:hover {
            background: #dddddd;
            transform: scale(1.1);
        }

        .quantity-button:active {
            transform: scale(0.9);
        }

        .quantity {
            min-width: 25px;
            text-align: center;
            font-size: 18px;
        }

        .remove {
            background: #e60012;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;

            transition:
                transform 0.25s ease,
                background 0.25s ease;
        }

        .remove:hover {
            background: #b8000e;
            transform: translateY(-3px);
        }

        .summary {
            background: white;
            padding: 25px;
            border-radius: 14px;
            margin-top: 30px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);

            animation: fadeUp 0.7s ease;
        }

        .summary h2 {
            margin-top: 0;
        }

        .total {
            color: #e60012;
        }

        .checkout {
            display: inline-block;
            background: #e60012;
            color: white;
            padding: 13px 28px;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
            margin-top: 10px;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                background 0.3s ease;
        }

        .checkout:hover {
            background: #b8000e;
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(230, 0, 18, 0.25);
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            color: #e60012;
            text-decoration: none;
            font-weight: bold;

            transition: transform 0.3s ease;
        }

        .back:hover {
            transform: translateX(-5px);
        }

        .empty {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
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

        @media (max-width: 700px) {
            .container {
                width: 90%;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item img {
                width: 100%;
                height: 230px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>NintenStore 🎮 - Keranjang</h2>
    </div>

    <div class="container">

        <h1 class="title">Keranjang Belanja 🛒</h1>

        @forelse($cart as $id => $item)

            <div class="cart-item">

                @if($item['image'])

                    <img
                        src="{{ asset('storage/' . $item['image']) }}"
                        alt="{{ $item['name'] }}"
                    >

                @endif

                <div class="info">

                    <h3>{{ $item['name'] }}</h3>

                    <p class="price">
                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                    </p>

                    <div class="actions">

                        <form
                            action="{{ route('cart.decrease', $id) }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="quantity-button"
                            >
                                −
                            </button>
                        </form>

                        <strong class="quantity">
                            {{ $item['quantity'] }}
                        </strong>

                        <form
                            action="{{ route('cart.increase', $id) }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="quantity-button"
                            >
                                +
                            </button>
                        </form>

                        <form
                            action="{{ route('cart.remove', $id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="remove"
                            >
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="empty">
                <h2>🛒</h2>
                <p>Keranjang masih kosong.</p>
            </div>

        @endforelse


        @if(count($cart) > 0)

            @php
                $total = 0;

                foreach ($cart as $cartItem) {
                    $total +=
                        $cartItem['price']
                        * $cartItem['quantity'];
                }
            @endphp

            <div class="summary">

                <h2>
                    Ringkasan Belanja
                </h2>

                <h2 class="total">
                    Total:
                    Rp {{ number_format($total, 0, ',', '.') }}
                </h2>

                <a
                    href="{{ route('checkout.index') }}"
                    class="checkout"
                >
                    Lanjut Checkout →
                </a>

            </div>

        @endif


        <a href="{{ route('home') }}" class="back">
            ← Kembali ke Home
        </a>

    </div>

</body>
</html>