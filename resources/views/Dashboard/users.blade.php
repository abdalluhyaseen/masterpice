@extends('Dashboard.master')

@section('content')
<div class="page-container">
    <div class="main-content">
        <div class="container-fluid">
            <!-- Success Alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Users Table -->
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- Data Table -->
                    <div class="card shadow-lg">
                        <div class="card-header bg-success text-white text-center">
                            <h3 class="text-white"><i class="fas fa-users"></i> All Users</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Role</th>
                                            @if(auth()->user()->role === 'superadmin')
                                            <th class="text-center">Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            @if(auth()->user()->role === 'superadmin')
                                                <td class="text-center">
                                                    <!-- Edit Role Button -->
                                                    <a href="#" class="btn btn-sm btn-warning m-r-3" data-toggle="modal" data-target="#editRoleModal{{ $user->id }}">
                                                        <i class="fas fa-edit"></i> Edit Role
                                                    </a>
                                                  
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger m-l-3">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endif
                                        </tr>
                                           <!-- Modal for Editing Role -->
                                           <div class="modal fade" id="editRoleModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel{{ $user->id }}" aria-hidden="true">
                                               <div class="modal-dialog" role="document">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                           <h5 class="modal-title" id="editRoleModalLabel{{ $user->id }}">Edit Role for {{ $user->name }}</h5>
                                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                               <span aria-hidden="true">&times;</span>
                                                           </button>
                                                       </div>
                                                       <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                                           @csrf
                                                           @method('PUT')
                                                           <div class="modal-body">
                                                               <div class="form-group">
                                                                   <label for="role">Role</label>
                                                                   <select name="role" id="role" class="form-control custom-select-role">
                                                                       <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                                       <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                               <button type="submit" class="btn btn-success">Update Role</button>
                                                           </div>
                                                       </form>
                                                   </div>
                                               </div>
                                           </div>
                                           <!-- End Modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Data Table -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
