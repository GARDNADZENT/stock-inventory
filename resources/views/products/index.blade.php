@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Products</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('products.export') }}" class="btn btn-outline-secondary">Export</a>
        <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
    </div>
</div>
<div class="bg-white rounded p-3 mb-3">
    <form class="row g-2" method="get">
        <div class="col-md-6"><input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search barcode, product, or category"></div>
        <div class="col-auto"><button class="btn btn-primary">Search</button></div>
    </form>
    <form class="row g-2 mt-2" method="post" action="{{ route('products.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6"><input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required></div>
        <div class="col-auto"><button class="btn btn-outline-primary">Import Excel</button></div>
    </form>
</div>
<div class="bg-white rounded p-3">
    @include('partials.products_table', ['products' => $products, 'showActions' => true])
    {{ $products->links() }}
</div>
@endsection
