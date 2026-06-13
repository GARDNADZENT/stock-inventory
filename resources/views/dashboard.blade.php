@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Dashboard</h1>
    <a href="{{ route('sales.create') }}" class="btn btn-success">New Sale</a>
</div>
<div class="row g-3">
    @foreach([
        'Total Products' => number_format($totalProducts),
        'Inventory Value' => number_format($inventoryValue, 2),
        "Today's Sales" => number_format($todaysSales, 2),
        "Today's Purchases" => number_format($todaysPurchases, 2),
        'Low Stock Products' => number_format($lowStockProducts),
        'Out of Stock Products' => number_format($outOfStockProducts),
    ] as $label => $value)
    <div class="col-12 col-md-6 col-xl-4">
        <div class="bg-white rounded p-3 metric">
            <div class="text-muted small">{{ $label }}</div>
            <div class="fs-3 fw-semibold">{{ $value }}</div>
        </div>
    </div>
    @endforeach
</div>
<div class="bg-white rounded p-3 mt-4">
    <h2 class="h5">Low Stock Watch</h2>
    @include('partials.products_table', ['products' => $recentLowStock])
</div>
@endsection
