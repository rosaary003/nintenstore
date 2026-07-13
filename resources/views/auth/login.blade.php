<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - NintenStore</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .brand {
            color: #e60012;
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }

        .btn-login {
            background: #e60012;
            color: white;
        }

        .btn-login:hover {
            background: #c90010;
            color: white;
        }

        .register-link {
            color: #e60012;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="login-card">

    <h2 class="brand">NintenStore</h2>

    <p class="text-center text-muted mb-4">
        Masuk untuk membeli game favoritmu
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   placeholder="Masukkan email"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Masukkan password"
                   required>
        </div>

        <button type="submit"
                class="btn btn-login w-100">
            Login
        </button>

    </form>

    <p class="text-center mt-4 mb-0">
        Belum punya akun?

        <a href="{{ route('register') }}"
           class="register-link">
            Daftar sekarang
        </a>
    </p>

</div>

</body>
</html>