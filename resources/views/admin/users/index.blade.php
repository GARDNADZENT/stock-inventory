@extends('layouts.app')
@section('title', 'Manage Users')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Manage Users</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success">Add User</a>
</div>
<div class="bg-white rounded p-3">
    @if($users->isEmpty())
        <p class="text-muted mb-0">No users found.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verified</th>
                        <th>Joined</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name ?? '—' }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge bg-{{ $user->role === 'admin' ? 'warning' : 'secondary' }}">{{ $user->role }}</span></td>
                        <td>@if($user->hasVerifiedEmail())<span class="text-success">Yes</span>@else<span class="text-danger">No</span>@endif</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            @if($user->email !== 'gadnadolo19@gmail.com')
                            <form method="post" action="{{ route('admin.users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Delete this user?')">
                                @csrf @method('delete')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
