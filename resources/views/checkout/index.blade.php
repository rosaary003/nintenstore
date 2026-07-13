<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - NintenStore</title>

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
            width: 70%;
            max-width: 850px;
            margin: 45px auto;
            animation: fadeUp 0.7s ease;
        }

        .checkout-box {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease;
        }

        .checkout-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.13);
        }

        .checkout-box h1 {
            margin-top: 0;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 15px;
            outline: none;

            transition:
                border 0.3s ease,
                box-shadow 0.3s ease,
                transform 0.3s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #e60012;
            box-shadow: 0 0 0 3px rgba(230, 0, 18, 0.1);
            transform: translateY(-2px);
        }

        textarea {
            height: 110px;
            resize: vertical;
        }

        .total-box {
            background: #fff5f6;
            border-left: 5px solid #e60012;
            padding: 18px;
            margin-top: 28px;
            border-radius: 7px;
        }

        .total-label {
            color: #666;
            margin-bottom: 5px;
        }

        .total {
            color: #e60012;
            font-size: 24px;
            font-weight: bold;
        }

        .order-button {
            width: 100%;
            background: #e60012;
            color: white;
            border: none;
            padding: 14px 25px;
            margin-top: 25px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            border-radius: 8px;

            transition:
                transform 0.3s ease,
                background 0.3s ease,
                box-shadow 0.3s ease;
        }

        .order-button:hover {
            background: #b8000e;
            transform: translateY(-4px);
            box-shadow: 0 9px 20px rgba(230, 0, 18, 0.25);
        }

        .order-button:active {
            transform: scale(0.98);
        }

        .back {
            display: inline-block;
            color: #e60012;
            text-decoration: none;
            font-weight: bold;
            margin-top: 25px;

            transition: transform 0.3s ease;
        }

        .back:hover {
            transform: translateX(-5px);
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

            .checkout-box {
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>NintenStore 🎮 - Checkout</h2>
    </div>

    <div class="container">

        <div class="checkout-box">

            <h1>Checkout 🛍️</h1>

            <p class="subtitle">
                Lengkapi data pembeli sebelum membuat pesanan.
            </p>

            <form
                action="{{ route('checkout.store') }}"
                method="POST"
            >
                @csrf

                <label>Nama Pembeli</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama pembeli"
                    required
                >


                <label>No. HP</label>

                <input
                    type="text"
                    name="phone"
                    placeholder="Masukkan nomor HP"
                    required
                >


                <label>Alamat</label>

                <textarea
                    name="address"
                    placeholder="Masukkan alamat lengkap"
                    required
                ></textarea>


                <label>Metode Pembayaran</label>

                <select
                    name="payment_method"
                    required
                >
                    <option value="">
                        -- Pilih Pembayaran --
                    </option>

                    <option value="Transfer Bank">
                        Transfer Bank
                    </option>

                    <option value="DANA">
                        DANA
                    </option>

                    <option value="GoPay">
                        GoPay
                    </option>

                    <option value="COD">
                        COD
                    </option>
                </select>


                <div class="total-box">

                    <div class="total-label">
                        Total Pembayaran
                    </div>

                    <div class="total">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>

                </div>


                <button
                    type="submit"
                    class="order-button"
                >
                    Buat Pesanan →
                </button>

            </form>


            <a
                href="{{ route('cart.index') }}"
                class="back"
            >
                ← Kembali ke Keranjang
            </a>

        </div>

    </div>

</body>
</html>