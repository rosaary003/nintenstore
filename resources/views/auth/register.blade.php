<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - NintenStore</title>

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

        .register-card {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .brand {
            color: #e60012;
            font-weight: bold;
            text-align: center;
        }

        .btn-register {
            background: #e60012;
            color: white;
        }

        .btn-register:hover {
            background: #c90010;
            color: white;
        }

        .login-link {
            color: #e60012;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="register-card">

    <h2 class="brand">NintenStore</h2>

    <p class="text-center text-muted mb-4">
        Buat akun untuk mulai berbelanja
    </p>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   placeholder="Masukkan nama"
                   required>
        </div>

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
                   placeholder="Minimal 6 karakter"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>

            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Ulangi password"
                   required>
        </div>

        <button type="submit"
                class="btn btn-register w-100">
            Daftar
        </button>

    </form>

    <p class="text-center mt-4 mb-0">
        Sudah punya akun?

        <a href="{{ route('login') }}"
           class="login-link">
            Login
        </a>
    </p>

</div>

</body>
</html>