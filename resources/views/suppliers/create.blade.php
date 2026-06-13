@extends('layouts.app')
@section('content')<h1 class="h3 mb-3">Add Supplier</h1><form method="post" action="{{ route('suppliers.store') }}" class="bg-white rounded p-3">@include('suppliers._form')</form>@endsection
