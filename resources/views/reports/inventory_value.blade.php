@extends('layouts.app')
@section('content')<h1 class="h3 mb-3">Inventory Value Report</h1><div class="bg-white rounded p-3"><div class="fs-4 mb-3">Total: {{ number_format($totalValue, 2) }}</div>@include('partials.products_table', ['products' => $products])</div>@endsection
