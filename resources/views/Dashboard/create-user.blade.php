@extends('Dashboard.master')
@section('content')
<div class="page-container">
    <div class="main-content">

<!-- resources/views/create-user.blade.php -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="card w-100">
            <div class="card-header">
                <strong>Create New</strong> User
            </div>
            <div class="card-body card-block">
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-control-label">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter User Name.." class="form-control" required>
                        <span class="help-block">Please enter the user name</span>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter User Email.." class="form-control" required>
                        <span class="help-block">Please enter the user email</span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter User Password.." class="form-control" required>
                        <span class="help-block">Please enter the user password</span>
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-control-label">Role</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                        <span class="help-block">Please select the user role</span>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
    </div>


@endsection