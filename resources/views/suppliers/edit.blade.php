@extends('layouts.app')
@section('content')<h1 class="h3 mb-3">Edit Supplier</h1><form method="post" action="{{ route('suppliers.update', $supplier) }}" class="bg-white rounded p-3">@method('PUT')@include('suppliers._form')</form>@endsection
