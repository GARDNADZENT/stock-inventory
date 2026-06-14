<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MAASAI SHOP')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --shop-ink: #0f172a;
            --shop-muted: #64748b;
            --shop-line: #e2e8f0;
            --shop-surface: #ffffff;
            --shop-bg: #f8fafc;
            --shop-primary: #6366f1;
            --shop-primary-dark: #4f46e5;
            --shop-primary-light: #818cf8;
            --shop-accent: #f59e0b;
            --shop-success: #10b981;
            --shop-danger: #ef4444;
            --shop-warning: #f59e0b;
            --shop-info: #3b82f6;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.3);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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

        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-xl);
        }

        .navbar-brand {
            align-items: center;
            display: inline-flex;
            gap: .75rem;
            letter-spacing: .08em;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .brand-mark {
            align-items: center;
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-accent));
            border-radius: 12px;
            color: #fff;
            display: inline-flex;
            font-size: .9rem;
            font-weight: 800;
            height: 2.5rem;
            justify-content: center;
            letter-spacing: 0;
            width: 2.5rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4); }
            50% { box-shadow: 0 4px 25px rgba(99, 102, 241, 0.6); }
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .brand-copy small {
            color: var(--shop-muted);
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .nav-link {
            border-radius: 10px;
            color: #475569;
            font-weight: 500;
            margin-right: .25rem;
            padding: 0.6rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link.active,
        .nav-link:focus,
        .nav-link:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            color: var(--shop-primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .nav-link i {
            margin-right: 0.4rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .nav-link:hover i {
            opacity: 1;
        }

        main.container-fluid {
            max-width: 1400px;
            padding-left: clamp(1.5rem, 4vw, 2.5rem);
            padding-right: clamp(1.5rem, 4vw, 2.5rem);
        }

        h1, h2, h3, h4, h5, h6 {
            color: #0f172a;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .bg-white.rounded {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px !important;
            box-shadow: var(--shadow-xl);
            transition: all 0.3s ease;
        }

        .bg-white.rounded:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .metric {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            min-height: 130px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-lg);
        }

        .metric::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            transition: all 0.4s ease;
        }

        .metric:hover::before {
            top: -30%;
            right: -30%;
        }

        .metric:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .metric-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 2rem;
            opacity: 0.15;
            transition: all 0.3s ease;
        }

        .metric:hover .metric-icon {
            opacity: 0.25;
            transform: scale(1.1) rotate(5deg);
        }

        .metric .text-muted,
        .text-muted {
            color: var(--shop-muted) !important;
        }

        .table {
            background: transparent;
            border-radius: 12px;
            overflow: hidden;
        }

        .table td, .table th { 
            vertical-align: middle;
            padding: 1rem 1.25rem;
        }

        .table thead th {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(139, 92, 246, 0.05));
            border-bottom: 2px solid var(--shop-line);
            color: #475569;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 1rem 1.25rem;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--shop-line);
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody tr:hover td {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.03), rgba(139, 92, 246, 0.03));
            transform: scale(1.01);
        }

        .table tbody tr:hover {
            box-shadow: var(--shadow-md);
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: none;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-success,
        .btn-primary {
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-primary-dark));
            border-color: var(--shop-primary);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-success:hover,
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--shop-primary-dark), var(--shop-primary));
            border-color: var(--shop-primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }

        .btn-outline-primary {
            border-color: var(--shop-primary);
            color: var(--shop-primary);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-primary-dark));
            border-color: var(--shop-primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706, #f59e0b);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.5);
        }

        .form-control,
        .form-select {
            border-color: #cbd5e1;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--shop-primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15), 0 4px 15px rgba(99, 102, 241, 0.2);
            transform: translateY(-2px);
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            box-shadow: var(--shadow-lg);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(5, 150, 105, 0.15));
            color: #065f46;
            border-left: 4px solid var(--shop-success);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.15));
            color: #991b1b;
            border-left: 4px solid var(--shop-danger);
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(37, 99, 235, 0.15));
            color: #1e40af;
            border-left: 4px solid var(--shop-info);
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.15));
            color: #92400e;
            border-left: 4px solid var(--shop-warning);
        }
        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .scale-in {
            animation: scaleIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Dropdown styling */
        .dropdown-menu {
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
            padding: 0.5rem;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            transform: translateX(4px);
        }

        /* Badge styling */
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
        }

        /* Card hover effects */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        /* Pagination */
        .pagination .page-link {
            border-radius: 10px;
            margin: 0 0.25rem;
            border: 1px solid var(--shop-line);
            color: var(--shop-primary);
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-primary-dark));
            color: white;
            border-color: var(--shop-primary);
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-primary-dark));
            border-color: var(--shop-primary);
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(248, 250, 252, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-primary-dark));
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--shop-primary-dark), var(--shop-primary));
        }
    </style>
</head>
<body>
@php($isSalesArea = request()->routeIs('sales.*'))
<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="{{ $isSalesArea ? route('sales.create') : route('dashboard') }}">
            <span class="brand-mark">MS</span>
            <span class="brand-copy">
                <span>MAASAI SHOP</span>
                <small>{{ $isSalesArea ? 'Sales Desk' : 'Inventory Admin' }}</small>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            @if($isSalesArea)
                <div class="navbar-nav me-auto">
                    <a class="nav-link @if(request()->routeIs('sales.create')) active @endif" href="{{ route('sales.create') }}"><i class="fas fa-plus-circle"></i> New Sale</a>
                    <a class="nav-link @if(request()->routeIs('sales.index', 'sales.show')) active @endif" href="{{ route('sales.index') }}"><i class="fas fa-history"></i> Sales History</a>
                </div>
            @else
                <div class="navbar-nav me-auto">
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                    <a class="nav-link @if(request()->routeIs('products.*')) active @endif" href="{{ route('products.index') }}"><i class="fas fa-box"></i> Products</a>
                    <a class="nav-link @if(request()->routeIs('purchases.*')) active @endif" href="{{ route('purchases.index') }}"><i class="fas fa-shopping-cart"></i> Purchases</a>
                    <a class="nav-link @if(request()->routeIs('stock-takes.*')) active @endif" href="{{ route('stock-takes.index') }}"><i class="fas fa-clipboard-check"></i> Stock Take</a>
                    <a class="nav-link @if(request()->routeIs('suppliers.*')) active @endif" href="{{ route('suppliers.index') }}"><i class="fas fa-truck"></i> Suppliers</a>
                    <a class="nav-link @if(request()->routeIs('admin.users.*')) active @endif" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Users</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if(request()->routeIs('reports.*')) active @endif" href="#" role="button" data-bs-toggle="dropdown"><i class="fas fa-chart-bar"></i> Reports</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('reports.inventory-value') }}"><i class="fas fa-coins"></i> Inventory Value</a>
                            <a class="dropdown-item" href="{{ route('reports.profit') }}"><i class="fas fa-dollar-sign"></i> Profit</a>
                            <a class="dropdown-item" href="{{ route('reports.low-stock') }}"><i class="fas fa-exclamation-triangle"></i> Low Stock</a>
                            <a class="dropdown-item" href="{{ route('reports.stock-movements') }}"><i class="fas fa-exchange-alt"></i> Stock Movements</a>
                        </div>
                    </div>
                </div>
            @endif
            <form method="post" action="{{ route('logout') }}" class="ms-lg-auto mt-2 mt-lg-0">
                @csrf
                <button class="btn btn-outline-secondary btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>
<main class="container-fluid py-4">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
async function lookupBarcode(input) {
    const code = input.value.trim();
    if (!code) return;
    const target = input.closest('[data-line-item]');
    const response = await fetch(`{{ route('products.barcode-search') }}?barcode=${encodeURIComponent(code)}`);
    const data = await response.json();
    if (target) {
        target.querySelector('[data-product-name]').textContent = data.found ? data.product.product_name : 'Not found';
        const price = target.querySelector('[data-price]');
        if (price && data.found && !price.value) price.value = price.dataset.mode === 'sale' ? data.product.selling_price : data.product.buying_price;
        const systemQty = target.querySelector('[data-system-quantity]');
        if (systemQty && data.found) systemQty.value = data.product.stock;
    }
}
document.addEventListener('change', event => {
    if (event.target.matches('[data-barcode-input]')) lookupBarcode(event.target);
});
document.addEventListener('keydown', event => {
    if (event.target.matches('[data-barcode-input]') && event.key === 'Enter') {
        event.preventDefault();
        lookupBarcode(event.target);
    }
});
</script>
@stack('scripts')
</body>
</html>
