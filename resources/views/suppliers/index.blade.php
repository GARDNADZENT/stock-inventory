@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h1 class="h3">Suppliers</h1><a href="{{ route('suppliers.create') }}" class="btn btn-success">Add Supplier</a></div>
<div class="bg-white rounded p-3 table-responsive"><table class="table"><thead><tr><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th></th></tr></thead><tbody>@foreach($suppliers as $supplier)<tr><td>{{ $supplier->supplier_name }}</td><td>{{ $supplier->phone }}</td><td>{{ $supplier->email }}</td><td>{{ $supplier->address }}</td><td class="text-end"><a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary">Edit</a></td></tr>@endforeach</tbody></table>{{ $suppliers->links() }}</div>
@endsection
