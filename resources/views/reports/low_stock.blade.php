@extends('layouts.app')
@section('content')<h1 class="h3 mb-3">Low Stock Report</h1><div class="bg-white rounded p-3">@include('partials.products_table', ['products' => $products])</div>@endsection
