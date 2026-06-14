<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot password - MAASAI SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --shop-ink: #1f2933;
            --shop-muted: #667085;
            --shop-line: #e6e9ef;
            --shop-primary: #0f766e;
            --shop-primary-dark: #115e59;
        }

        body {
            background: radial-gradient(circle at top left, rgba(15, 118, 110, .16), transparent 24rem), #f4f6f8;
            color: var(--shop-ink);
            min-height: 100vh;
        }

        .login-shell { min-height: 100vh; }

        .login-panel {
            border: 1px solid var(--shop-line);
            border-radius: 8px;
            box-shadow: 0 24px 60px rgba(31, 41, 51, .12);
            max-width: 430px;
            width: 100%;
        }

        .brand-mark {
            align-items: center;
            background: linear-gradient(135deg, var(--shop-primary), #b45309);
            border-radius: 8px;
            color: #fff;
            display: inline-flex;
            font-weight: 800;
            height: 2.75rem;
            justify-content: center;
            width: 2.75rem;
        }

        .form-control {
            border-color: #d0d5dd;
            border-radius: 8px;
            min-height: 44px;
        }

        .form-control:focus {
            border-color: var(--shop-primary);
            box-shadow: 0 0 0 .2rem rgba(15, 118, 110, .14);
        }

        .btn-success {
            background: var(--shop-primary);
            border-color: var(--shop-primary);
            border-radius: 8px;
            font-weight: 700;
            min-height: 44px;
        }

        .btn-success:hover {
            background: var(--shop-primary-dark);
            border-color: var(--shop-primary-dark);
        }

        .btn-link-custom {
            color: var(--shop-primary);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
<main class="login-shell d-flex align-items-center justify-content-center px-3">
    <form method="post" action="{{ route('password.email') }}" class="login-panel bg-white p-4">
        @csrf
        <div class="d-flex align-items-center gap-3 mb-4">
            <span class="brand-mark">MS</span>
            <div>
                <h1 class="h4 mb-1">MAASAI SHOP</h1>
                <div class="text-muted small fw-semibold text-uppercase">Reset password</div>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <p class="text-muted small mb-3">Enter your email address and we will send you a password reset link.</p>
        <div class="mb-4">
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="email" autofocus required>
        </div>
        <button class="btn btn-success w-100 mb-3">Send reset link</button>
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn-link-custom small">Back to sign in</a>
        </div>
    </form>
</main>
</body>
</html>
