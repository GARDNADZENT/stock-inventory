<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check your email - MAASAI SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --shop-ink: #1f2933;
            --shop-muted: #667085;
            --shop-line: #e6e9ef;
            --shop-primary: #0f766e;
        }

        body {
            background: #f4f6f8;
            color: var(--shop-ink);
            min-height: 100vh;
        }

        .login-panel {
            border: 1px solid var(--shop-line);
            border-radius: 8px;
            box-shadow: 0 24px 60px rgba(31, 41, 51, .12);
            max-width: 430px;
            width: 100%;
        }
    </style>
</head>
<body>
<main class="min-vh-100 d-flex align-items-center justify-content-center px-3">
    <div class="login-panel bg-white p-4 text-center">
        <div class="display-6 mb-3">✉</div>
        <h1 class="h4 mb-3">Check your email</h1>
        <p class="text-muted mb-4">
            We sent a sign-in link to <strong>{{ $email }}</strong>.
            Open it on this device to access Maasai Shop. The link expires in 15 minutes.
        </p>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary">Use a different email</a>
    </div>
</main>
</body>
</html>
