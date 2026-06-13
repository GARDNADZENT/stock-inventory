<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MAASAI SHOP')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --shop-ink: #1f2933;
            --shop-muted: #667085;
            --shop-line: #e6e9ef;
            --shop-surface: #ffffff;
            --shop-bg: #f4f6f8;
            --shop-primary: #0f766e;
            --shop-primary-dark: #115e59;
            --shop-accent: #b45309;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(15, 118, 110, .10), transparent 26rem),
                linear-gradient(180deg, #fbfcfd 0%, var(--shop-bg) 100%);
            color: var(--shop-ink);
            min-height: 100vh;
        }

        .navbar {
            border-bottom: 1px solid var(--shop-line);
            box-shadow: 0 8px 28px rgba(31, 41, 51, .06);
        }

        .navbar-brand {
            align-items: center;
            display: inline-flex;
            gap: .65rem;
            letter-spacing: .08em;
        }

        .brand-mark {
            align-items: center;
            background: linear-gradient(135deg, var(--shop-primary), var(--shop-accent));
            border-radius: 8px;
            color: #fff;
            display: inline-flex;
            font-size: .8rem;
            font-weight: 800;
            height: 2rem;
            justify-content: center;
            letter-spacing: 0;
            width: 2rem;
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
        }

        .brand-copy small {
            color: var(--shop-muted);
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .nav-link {
            border-radius: 8px;
            color: #475467;
            font-weight: 600;
            margin-right: .15rem;
            padding-left: .85rem !important;
            padding-right: .85rem !important;
        }

        .nav-link.active,
        .nav-link:focus,
        .nav-link:hover {
            background: #eef7f6;
            color: var(--shop-primary-dark);
        }

        main.container-fluid {
            max-width: 1440px;
            padding-left: clamp(1rem, 3vw, 2rem);
            padding-right: clamp(1rem, 3vw, 2rem);
        }

        h1, h2, h3 {
            color: #182230;
            font-weight: 700;
        }

        .bg-white.rounded {
            border: 1px solid var(--shop-line);
            border-radius: 8px !important;
            box-shadow: 0 12px 34px rgba(31, 41, 51, .06);
        }

        .metric {
            border-left: 4px solid var(--shop-primary);
            min-height: 110px;
        }

        .metric .text-muted,
        .text-muted {
            color: var(--shop-muted) !important;
        }

        .table td, .table th { vertical-align: middle; }

        .table thead th {
            background: #f8fafc;
            border-bottom-color: var(--shop-line);
            color: #475467;
            font-size: .78rem;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .table tbody tr:hover td {
            background: #fbfdfd;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-success,
        .btn-primary {
            background: var(--shop-primary);
            border-color: var(--shop-primary);
        }

        .btn-success:hover,
        .btn-primary:hover {
            background: var(--shop-primary-dark);
            border-color: var(--shop-primary-dark);
        }

        .btn-outline-primary {
            border-color: var(--shop-primary);
            color: var(--shop-primary);
        }

        .btn-outline-primary:hover {
            background: var(--shop-primary);
            border-color: var(--shop-primary);
        }

        .form-control,
        .form-select {
            border-color: #d0d5dd;
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--shop-primary);
            box-shadow: 0 0 0 .2rem rgba(15, 118, 110, .14);
        }

        .alert {
            border-radius: 8px;
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
                    <a class="nav-link @if(request()->routeIs('sales.create')) active @endif" href="{{ route('sales.create') }}">New Sale</a>
                    <a class="nav-link @if(request()->routeIs('sales.index', 'sales.show')) active @endif" href="{{ route('sales.index') }}">Sales History</a>
                </div>
            @else
                <div class="navbar-nav me-auto">
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="nav-link @if(request()->routeIs('products.*')) active @endif" href="{{ route('products.index') }}">Products</a>
                    <a class="nav-link @if(request()->routeIs('purchases.*')) active @endif" href="{{ route('purchases.index') }}">Purchases</a>
                    <a class="nav-link @if(request()->routeIs('stock-takes.*')) active @endif" href="{{ route('stock-takes.index') }}">Stock Take</a>
                    <a class="nav-link @if(request()->routeIs('suppliers.*')) active @endif" href="{{ route('suppliers.index') }}">Suppliers</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if(request()->routeIs('reports.*')) active @endif" href="#" role="button" data-bs-toggle="dropdown">Reports</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('reports.inventory-value') }}">Inventory Value</a>
                            <a class="dropdown-item" href="{{ route('reports.profit') }}">Profit</a>
                            <a class="dropdown-item" href="{{ route('reports.low-stock') }}">Low Stock</a>
                            <a class="dropdown-item" href="{{ route('reports.stock-movements') }}">Stock Movements</a>
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
