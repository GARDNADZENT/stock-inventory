<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - MAASAI SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --shop-ink: #0f172a;
            --shop-muted: #64748b;
            --shop-line: #e2e8f0;
            --shop-primary: #6366f1;
            --shop-primary-dark: #4f46e5;
            --shop-accent: #f59e0b;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.3);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            color: var(--shop-ink);
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(236, 72, 153, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(34, 211, 238, 0.2) 0%, transparent 40%);
            pointer-events: none;
            z-index: -1;
        }

        .login-shell { min-height: 100vh; }

        .login-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            max-width: 440px;
            width: 100%;
            padding: 2.5rem;
            animation: slideIn 0.6s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-mark {
            align-items: center;
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-accent));
            border-radius: 14px;
            color: #fff;
            display: inline-flex;
            font-weight: 800;
            height: 3.5rem;
            justify-content: center;
            width: 3.5rem;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4); }
            50% { box-shadow: 0 8px 35px rgba(99, 102, 241, 0.6); }
        }

        .brand-title {
            letter-spacing: .08em;
            font-weight: 700;
        }

        .text-muted {
            color: var(--shop-muted) !important;
        }

        .form-control {
            border-color: #cbd5e1;
            border-radius: 12px;
            padding: 0.875rem 1rem;
            min-height: 50px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: var(--shop-primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15), 0 4px 15px rgba(99, 102, 241, 0.2);
            transform: translateY(-2px);
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-primary-dark));
            border: none;
            border-radius: 12px;
            font-weight: 700;
            min-height: 50px;
            padding: 0.875rem 1.5rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, var(--shop-primary-dark), var(--shop-primary));
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }

        .btn-link-custom {
            color: var(--shop-primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-link-custom:hover {
            color: var(--shop-primary-dark);
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            animation: slideIn 0.5s ease;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.15));
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
    </style>
</head>
<body>
<main class="login-shell d-flex align-items-center justify-content-center px-3">
    <form method="post" action="{{ route('register.store') }}" class="login-panel bg-white p-4">
        @csrf
        <div class="d-flex align-items-center gap-3 mb-4">
            <span class="brand-mark">MS</span>
            <div>
                <h1 class="h4 brand-title mb-1">MAASAI SHOP</h1>
                <div class="text-muted small fw-semibold text-uppercase"><i class="fas fa-user-plus me-1"></i> Create account</div>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <div class="mb-3">
            <label for="name" class="form-label"><i class="fas fa-user me-2"></i>Full name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" autocomplete="name" autofocus required placeholder="Enter your full name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="email" required placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
            <input id="password" type="password" name="password" class="form-control" autocomplete="new-password" required placeholder="Create a password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label"><i class="fas fa-lock me-2"></i>Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="new-password" required placeholder="Confirm your password">
        </div>
        <button class="btn btn-success w-100 mb-3"><i class="fas fa-user-plus me-2"></i>Create account</button>
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn-link-custom small"><i class="fas fa-sign-in-alt me-1"></i> Already have an account? Sign in</a>
        </div>
    </form>
</main>
</body>
</html>
