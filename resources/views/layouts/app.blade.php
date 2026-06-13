<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Retail Inventory')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f6f7fb; }
        .navbar { box-shadow: 0 1px 8px rgba(20, 25, 40, .08); }
        .metric { border-left: 4px solid #198754; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">Retail Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                <a class="nav-link" href="{{ route('purchases.index') }}">Purchases</a>
                <a class="nav-link" href="{{ route('sales.index') }}">Sales</a>
                <a class="nav-link" href="{{ route('stock-takes.index') }}">Stock Take</a>
                <a class="nav-link" href="{{ route('suppliers.index') }}">Suppliers</a>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reports</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('reports.inventory-value') }}">Inventory Value</a>
                        <a class="dropdown-item" href="{{ route('reports.profit') }}">Profit</a>
                        <a class="dropdown-item" href="{{ route('reports.low-stock') }}">Low Stock</a>
                        <a class="dropdown-item" href="{{ route('reports.stock-movements') }}">Stock Movements</a>
                    </div>
                </div>
            </div>
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
