@extends('public.layout')

@section('title', 'Maasai Shop')

@section('content')
<section class="hero fade-in">
    <div class="container-fluid px-3 px-lg-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="eyebrow mb-3"><i class="fas fa-chart-line me-2"></i>Retail inventory and sales management</div>
                <h1 class="display-4 fw-bold mb-3">Maasai Shop</h1>
                <p class="lead mb-4">
                    A focused stock, purchasing, sales, and reporting system for our retail shop.
                    Manage product lookup, stock movements, and daily operations from one place at
                    <strong>traderspulse.site</strong>.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-primary btn-lg" href="{{ route('login') }}"><i class="fas fa-rocket me-2"></i>Open App</a>
                    <a class="btn btn-outline-secondary btn-lg" href="{{ route('privacy-policy') }}"><i class="fas fa-shield-alt me-2"></i>Privacy Policy</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="panel p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="small text-uppercase fw-semibold text-muted"><i class="fas fa-box me-1"></i> Products</div>
                            <div class="h4 mb-0 fw-bold">Barcode lookup</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-uppercase fw-semibold text-muted"><i class="fas fa-shopping-bag me-1"></i> Sales</div>
                            <div class="h4 mb-0 fw-bold">Fast checkout</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-uppercase fw-semibold text-muted"><i class="fas fa-warehouse me-1"></i> Stock</div>
                            <div class="h4 mb-0 fw-bold">Movements tracked</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-uppercase fw-semibold text-muted"><i class="fas fa-chart-bar me-1"></i> Reports</div>
                            <div class="h4 mb-0 fw-bold">Inventory visibility</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid px-3 px-lg-4" style="max-width: 980px;">
    @include('partials.adsense-ad')
</div>

<section class="py-5">
    <div class="container-fluid px-3 px-lg-4">
        <div class="panel p-4">
            <div class="row g-4">
                <div class="col-md-4 feature pt-3">
                    <h2><i class="fas fa-cogs me-2"></i>Operations</h2>
                    <p class="mb-0">Handle products, purchases, sales, and supplier records from one admin workspace.</p>
                </div>
                <div class="col-md-4 feature pt-3">
                    <h2><i class="fas fa-chart-pie me-2"></i>Reporting</h2>
                    <p class="mb-0">Review inventory value, stock movement, low-stock items, and profit reports.</p>
                </div>
                <div class="col-md-4 feature pt-3">
                    <h2><i class="fas fa-info-circle me-2"></i>About this site</h2>
                    <p class="mb-0">Maasai Shop runs on traderspulse.site. Staff log in to manage inventory; this public page is open to visitors.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
