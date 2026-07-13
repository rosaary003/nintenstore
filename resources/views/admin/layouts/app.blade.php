<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NintenStore Admin</title>

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

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #e60012;
            color: white;
            padding: 30px 20px;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.12);
            z-index: 100;
            animation: slideRight 0.6s ease;
        }

        .brand {
            margin-bottom: 45px;
            padding: 0 10px;
        }

        .brand h2 {
            margin: 0;
            font-size: 24px;
            transition: transform 0.3s ease;
        }

        .brand h2:hover {
            transform: scale(1.05) rotate(-2deg);
        }

        .brand p {
            margin: 7px 0 0;
            font-size: 13px;
            opacity: 0.8;
        }

        .menu-title {
            font-size: 12px;
            font-weight: bold;
            opacity: 0.7;
            margin: 0 10px 12px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            font-weight: bold;

            transition:
                transform 0.3s ease,
                background 0.3s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(7px);
        }

        .logout-form {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 30px;
        }

        .logout {
            width: 100%;
            background: white;
            color: #e60012;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .logout:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
        }

        .content {
            margin-left: 250px;
            padding: 40px;
            min-height: 100vh;
            animation: fadeUp 0.7s ease;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.13);
        }

        button {
            cursor: pointer;
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
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

        @media (max-width: 750px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="brand">
            <h2>NintenStore 🎮</h2>
            <p>Admin Management</p>
        </div>

        <p class="menu-title">Menu Admin</p>

        <a href="{{ route('admin.dashboard') }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('admin.products.index') }}">
            🎮 Data Produk
        </a>

        <a href="{{ route('admin.orders.index') }}">
            📦 Pesanan Masuk
        </a>

        <form
            action="{{ route('logout') }}"
            method="POST"
            class="logout-form"
        >
            @csrf

            <button type="submit" class="logout">
                Logout
            </button>
        </form>

    </div>

    <main class="content">
        @yield('content')
    </main>

</body>
</html>