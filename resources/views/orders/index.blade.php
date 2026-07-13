<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Pesanan - NintenStore</title>

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
            width: 80%;
            margin: 45px auto;
            animation: fadeUp 0.7s ease;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin-bottom: 8px;
        }

        .header p {
            color: #777;
        }

        .order {
            background: white;
            padding: 25px;
            margin-bottom: 22px;
            border-radius: 14px;
            border-left: 5px solid #e60012;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease;
        }

        .order:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.14);
        }

        .order h3 {
            margin-top: 0;
            color: #e60012;
        }

        .order p {
            margin: 10px 0;
        }

        .status {
            display: inline-block;
            background: #fff3cd;
            color: #856404;
            padding: 7px 13px;
            border-radius: 20px;
            font-weight: bold;

            transition: transform 0.3s ease;
        }

        .status:hover {
            transform: scale(1.05);
        }

        .btn {
            display: inline-block;
            background: #e60012;
            color: white;
            padding: 11px 20px;
            text-decoration: none;
            margin-top: 12px;
            border-radius: 7px;
            font-weight: bold;

            transition:
                transform 0.3s ease,
                background 0.3s ease,
                box-shadow 0.3s ease;
        }

        .btn:hover {
            background: #b8000e;
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(230, 0, 18, 0.25);
        }

        .back {
            display: inline-block;
            color: #e60012;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;

            transition: transform 0.3s ease;
        }

        .back:hover {
            transform: translateX(-5px);
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            font-size: 45px;
            animation: float 2s ease-in-out infinite;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }

        @media (max-width: 700px) {
            .container {
                width: 90%;
                margin: 30px auto;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>NintenStore 🎮 - Riwayat Pesanan</h2>
    </div>

    <div class="container">
        <div class="header">

            <h1>Riwayat Pesanan 📦</h1>

            <p>
                Lihat kembali pesanan dan perkembangan status pesanan Anda.
            </p>

        </div>

        @forelse($orders as $order)

            <div class="order">

                <h3>
                    Pesanan #{{ $order->id }}
                </h3>

                <p>
                    <strong>Nama:</strong>
                    {{ $order->name }}
                </p>

                <p>
                    <strong>Total:</strong>
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </p>

                <p>
                    <strong>Metode Pembayaran:</strong>
                    {{ $order->payment_method }}
                </p>

                <p>
                    <strong>Status:</strong>

                    <span class="status">
                        {{ $order->status }}
                    </span>
                </p>

                <a
                    href="{{ route('checkout.success', $order->id) }}"
                    class="btn"
                >
                    Lihat Detail →
                </a>

            </div>

        @empty

            <div class="empty">

                <div class="empty-icon">
                    📦
                </div>

                <h2>Belum Ada Pesanan</h2>

                <p>
                    Pesanan yang Anda buat akan muncul di halaman ini.
                </p>

            </div>

        @endforelse

        <a href="{{ route('home') }}" class="back">
            ← Kembali ke Home
        </a>

    </div>

</body>

</html>