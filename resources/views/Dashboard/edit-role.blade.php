@extends('Dashboard.master')

@section('content')
<div class="page-container">
    <div class="main-content">

<div class="container">
    <h2>Edit Role for {{ $user->name }}</h2>

    <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
        <a href="{{ route('dashboard.main') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
    </div>
    </div>
@endsection
