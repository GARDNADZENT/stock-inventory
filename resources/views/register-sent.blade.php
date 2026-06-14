<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify email - MAASAI SHOP</title>
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
            background: #f4f6f8;
            color: var(--shop-ink);
            min-height: 100vh;
        }

        .login-shell { min-height: 100vh; }

        .login-panel {
            border: 1px solid var(--shop-line);
            border-radius: 8px;
            box-shadow: 0 24px 60px rgba(31, 41, 51, .12);
            max-width: 480px;
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
    </style>
</head>
<body>
<main class="login-shell d-flex align-items-center justify-content-center px-3">
    <div class="login-panel bg-white p-4 text-center">
        <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
            <span class="brand-mark">MS</span>
            <div class="text-start">
                <h1 class="h4 mb-1">MAASAI SHOP</h1>
                <div class="text-muted small fw-semibold text-uppercase">Verify your email</div>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <p class="mb-2">We sent a verification email to</p>
        <p class="fw-semibold fs-5 mb-3">{{ $email }}</p>
        <p class="text-muted small mb-4">Click the link in the email to verify your account. The link expires in 60 minutes.</p>
        <form method="post" action="{{ route('verify-email.resend') }}">
            @csrf
            <button class="btn btn-success w-100 mb-2">Resend verification email</button>
        </form>
        <a href="{{ route('login') }}" class="btn-link-custom small">Back to sign in</a>
    </div>
</main>
</body>
</html>
