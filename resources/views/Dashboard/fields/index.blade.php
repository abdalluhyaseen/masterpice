@extends('Dashboard.master')
@section('content')
<div class="page-container">
    <div class="main-content">
        <div class="section__content section__content--p30">
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

                <!-- Table -->
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- Data Table -->
                        <div class="card shadow-lg">
                            <div class="card-header bg-success text-white text-center">
                                <h3 class="text-white"><i class="fas fa-futbol "></i> Sports Fields</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th>Field Name</th>
                                                <th>Field Available</th>
                                                <th>Price Per Hour</th>
                                                <th>Sport Type</th>
                                                <th>Field Type</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fields as $field)
                                                <tr>
                                                    <td>{{ $field->field_name }}</td>
                                                    <td class="{{ $field->field_avilable == 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $field->field_avilable == 0 ? 'Available' : 'Not Available' }}
                                                    </td>
                                                    <td>${{ $field->field_price }}</td>
                                                    <td>{{ $field->sportType ? $field->sportType->sport_type : 'No sport type available' }}</td>

                                                    <td>{{ $field->fieldType->field_type }}</td>
                                                    <td class="d-flex align-items-center">
                                                        <!-- View Button -->
                                                        <a href="{{ route('fields.show', $field->id) }}" class="btn btn-sm btn-info m-r-5">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('fields.edit', $field->id) }}" class="btn btn-sm btn-warning m-r-5">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this field?');" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
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
</div>
@endsection
