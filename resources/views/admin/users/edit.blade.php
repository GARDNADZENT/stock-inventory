@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Edit User</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Back</a>
</div>
<div class="bg-white rounded p-3">
    <form method="post" action="{{ route('admin.users.update', $user) }}" class="row g-3" style="max-width:480px">
        @csrf @method('patch')
        <div class="col-12">
            <label for="name" class="form-label">Full name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
            <label for="password" class="form-label">New password <span class="text-muted small">(leave blank to keep current)</span></label>
            <input id="password" type="password" name="password" class="form-control">
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="sales" {{ old('role', $user->role) === 'sales' ? 'selected' : '' }}>Sales</option>
            </select>
            @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
            <button class="btn btn-success">Update user</button>
        </div>
    </form>
</div>
@endsection
