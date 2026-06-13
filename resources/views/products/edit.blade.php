@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<h1 class="h3 mb-3">Edit Product</h1>
<form method="post" action="{{ route('products.update', $product) }}" class="bg-white rounded p-3">
    @method('PUT')
    @include('products._form')
</form>
@endsection
