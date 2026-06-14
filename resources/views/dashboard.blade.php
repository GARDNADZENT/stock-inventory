@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 fade-in">
    <div>
        <h1 class="h3 mb-0">Dashboard</h1>
        <p class="text-muted mb-0">Welcome back! Here's what's happening with your inventory today.</p>
    </div>
    <a href="{{ route('sales.create') }}" class="btn btn-success btn-lg">
        <i class="fas fa-plus-circle me-2"></i>New Sale
    </a>
</div>

<div class="row g-4">
    <div class="col-12 col-md-6 col-xl-4">
        <div class="metric fade-in" style="animation-delay: 0.1s">
            <i class="fas fa-box metric-icon" style="color: var(--shop-primary)"></i>
            <div class="text-muted small fw-semibold text-uppercase">Total Products</div>
            <div class="fs-3 fw-bold mt-2">{{ number_format($totalProducts) }}</div>
            <div class="text-success small mt-2"><i class="fas fa-arrow-up"></i> Active Inventory</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="metric fade-in" style="animation-delay: 0.2s">
            <i class="fas fa-coins metric-icon" style="color: var(--shop-accent)"></i>
            <div class="text-muted small fw-semibold text-uppercase">Inventory Value</div>
            <div class="fs-3 fw-bold mt-2">${{ number_format($inventoryValue, 2) }}</div>
            <div class="text-info small mt-2"><i class="fas fa-chart-line"></i> Total Assets</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="metric fade-in" style="animation-delay: 0.3s">
            <i class="fas fa-shopping-bag metric-icon" style="color: var(--shop-success)"></i>
            <div class="text-muted small fw-semibold text-uppercase">Today's Sales</div>
            <div class="fs-3 fw-bold mt-2">${{ number_format($todaysSales, 2) }}</div>
            <div class="text-success small mt-2"><i class="fas fa-arrow-up"></i> Revenue Today</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="metric fade-in" style="animation-delay: 0.4s">
            <i class="fas fa-truck metric-icon" style="color: var(--shop-info)"></i>
            <div class="text-muted small fw-semibold text-uppercase">Today's Purchases</div>
            <div class="fs-3 fw-bold mt-2">${{ number_format($todaysPurchases, 2) }}</div>
            <div class="text-info small mt-2"><i class="fas fa-boxes"></i> Stock Added</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="metric fade-in" style="animation-delay: 0.5s">
            <i class="fas fa-exclamation-triangle metric-icon" style="color: var(--shop-warning)"></i>
            <div class="text-muted small fw-semibold text-uppercase">Low Stock Products</div>
            <div class="fs-3 fw-bold mt-2">{{ number_format($lowStockProducts) }}</div>
            <div class="text-warning small mt-2"><i class="fas fa-bell"></i> Attention Needed</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="metric fade-in" style="animation-delay: 0.6s">
            <i class="fas fa-times-circle metric-icon" style="color: var(--shop-danger)"></i>
            <div class="text-muted small fw-semibold text-uppercase">Out of Stock</div>
            <div class="fs-3 fw-bold mt-2">{{ number_format($outOfStockProducts) }}</div>
            <div class="text-danger small mt-2"><i class="fas fa-exclamation-circle"></i> Restock Required</div>
        </div>
    </div>
</div>

<div class="bg-white rounded p-4 mt-4 fade-in" style="animation-delay: 0.7s">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h5 mb-0"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Low Stock Watch</h2>
        <span class="badge bg-warning text-dark">{{ $recentLowStock->count() }} Items</span>
    </div>
    @include('partials.products_table', ['products' => $recentLowStock])
</div>
@endsection
