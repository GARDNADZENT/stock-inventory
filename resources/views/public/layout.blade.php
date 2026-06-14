<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Maasai Shop')</title>
    <meta name="description" content="Maasai Shop retail inventory and sales management at traderspulse.site">
    @include('partials.adsense-head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --surface: #ffffff;
            --bg: #f8fafc;
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --accent: #f59e0b;
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
            color: var(--ink);
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

        .topbar {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: var(--glass-bg);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: var(--shadow-xl);
        }

        .brand-mark {
            align-items: center;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            color: #fff;
            display: inline-flex;
            font-size: .9rem;
            font-weight: 800;
            height: 2.5rem;
            justify-content: center;
            width: 2.5rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4); }
            50% { box-shadow: 0 4px 25px rgba(99, 102, 241, 0.6); }
        }

        .hero {
            padding: clamp(4rem, 8vw, 7rem) 0 3rem;
        }

        .panel {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .panel:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .eyebrow {
            color: var(--primary);
            font-size: .8rem;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .lead {
            color: var(--muted);
            max-width: 65ch;
            font-size: 1.15rem;
        }

        .btn {
            border-radius: 12px;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }

        .btn-outline-secondary {
            border-color: var(--glass-border);
            background: var(--glass-bg);
            color: var(--ink);
        }

        .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-3px);
        }

        .feature {
            border-top: 1px solid var(--line);
            padding-top: 1.5rem;
            transition: all 0.3s ease;
        }

        .feature:hover {
            transform: translateX(8px);
        }

        .feature h2,
        .feature h3 {
            font-size: 1.1rem;
            margin-bottom: .5rem;
            font-weight: 700;
        }

        .feature p,
        footer {
            color: var(--muted);
        }

        footer a {
            color: inherit;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .adsense-wrap {
            min-height: 90px;
            overflow: hidden;
        }

        .fade-in {
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<nav class="topbar navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand fw-semibold d-inline-flex align-items-center gap-3" href="{{ route('home') }}">
            <span class="brand-mark">MS</span>
            <span>Maasai Shop</span>
        </a>
        <div class="ms-auto d-flex gap-2">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('privacy-policy') }}"><i class="fas fa-shield-alt me-1"></i> Privacy Policy</a>
            <a class="btn btn-primary btn-sm" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<div class="container-fluid px-3 px-lg-4" style="max-width: 980px;">
    @include('partials.adsense-ad')
</div>

<footer class="py-5">
    <div class="container-fluid px-3 px-lg-4 d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center">
        <div class="fw-semibold"><i class="fas fa-store me-2"></i>Maasai Shop &middot; traderspulse.site</div>
        <div class="d-flex gap-3">
            <a href="{{ route('privacy-policy') }}"><i class="fas fa-shield-alt me-1"></i> Privacy Policy</a>
            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
