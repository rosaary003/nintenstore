<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesanan Berhasil - NintenStore</title>

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
            padding: 18px 15%;
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
            width: 70%;
            max-width: 850px;
            margin: 50px auto;
            animation: fadeUp 0.7s ease;
        }

        .success-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .success-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .success-icon {
            width: 75px;
            height: 75px;
            background: #28a745;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 38px;
            font-weight: bold;
            animation: pop 0.7s ease;
        }

        .success {
            color: #28a745;
            margin-bottom: 8px;
        }

        .success-header p {
            color: #777;
        }

        .detail {
            background: #fafafa;
            padding: 22px;
            border-radius: 10px;
            line-height: 2;
            border-left: 5px solid #e60012;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .detail:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        }

        .total {
            color: #e60012;
            font-size: 20px;
        }

        .payment {
            background: #fff5f6;
            padding: 22px;
            margin-top: 25px;
            border-radius: 10px;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .payment:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(230, 0, 18, 0.1);
        }

        .payment h3 {
            margin-top: 0;
            color: #e60012;
        }

        .status {
            display: inline-block;
            background: #fff3cd;
            color: #856404;
            padding: 7px 12px;
            border-radius: 20px;
            font-weight: bold;
        }

        .button {
            display: inline-block;
            margin-top: 28px;
            background: #e60012;
            color: white;
            padding: 13px 24px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;

            transition:
                transform 0.3s ease,
                background 0.3s ease,
                box-shadow 0.3s ease;
        }

        .button:hover {
            background: #b8000e;
            transform: translateY(-4px);
            box-shadow: 0 9px 20px rgba(230, 0, 18, 0.25);
        }

        @keyframes pop {
            0% {
                opacity: 0;
                transform: scale(0);
            }

            70% {
                transform: scale(1.15);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
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

        @media (max-width: 700px) {
            .container {
                width: 90%;
                margin: 30px auto;
            }

            .success-box {
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>NintenStore 🎮 - Pesanan</h2>
    </div>

    <div class="container">

        <div class="success-box">

            <div class="success-header">

                <div class="success-icon">
                    ✓
                </div>

                <h1 class="success">
                    Pesanan Berhasil
                </h1>

                <p>
                    Pesanan Anda berhasil dibuat dan telah masuk ke sistem.
                </p>

            </div>


            <div class="detail">

                <strong>ID Pesanan:</strong>
                #{{ $order->id }}
                <br>

                <strong>Nama:</strong>
                {{ $order->name }}
                <br>

                <strong>No. HP:</strong>
                {{ $order->phone }}
                <br>

                <strong>Alamat:</strong>
                {{ $order->address }}
                <br>

                <strong>Total:</strong>

                <span class="total">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </span>

            </div>


            <div class="payment">

                <h3>💳 Informasi Pembayaran</h3>

                <p>
                    Metode Pembayaran:
                    <strong>
                        {{ $order->payment_method }}
                    </strong>
                </p>


                @if($order->payment_method == 'Transfer Bank')

                    <p>
                        Silakan transfer ke rekening BCA:
                        <strong>1234567890</strong>
                    </p>

                @elseif($order->payment_method == 'DANA')

                    <p>
                        Silakan bayar melalui DANA:
                        <strong>081234567890</strong>
                    </p>

                @elseif($order->payment_method == 'GoPay')

                    <p>
                        Silakan bayar melalui GoPay:
                        <strong>081234567890</strong>
                    </p>

                @elseif($order->payment_method == 'COD')

                    <p>
                        Pembayaran dilakukan saat pesanan diterima.
                    </p>

                @endif


                <p>
                    Status:
                    <span class="status">
                        {{ $order->status }}
                    </span>
                </p>

            </div>


            <a
                href="{{ route('home') }}"
                class="button"
            >
                ← Kembali ke Home
            </a>

        </div>

    </div>

</body>
</html>