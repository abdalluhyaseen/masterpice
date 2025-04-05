@extends('Dashboard.master')

@section('content')
<div class="page-container">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                
                <!-- Filter Form -->
              <!-- Filter Form -->
<form action="{{ route('bookings.index') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control custom-focus">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control custom-focus">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control custom-focus">
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">Filter</button>
            </div>
        </div>
    </div>
</form>


                <!-- Reservations Table -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-header bg-success text-white text-center">
                                <h3 class="text-white"><i class="fas fa-list-alt"></i> Reservations</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th>ID</th>
                                                <th>User</th>
                                                <th>Court Name</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->id }}</td>
                                                    <td>{{ $booking->user->name }}</td>
                                                    <td>{{ $booking->field->field_name }}</td>
                                                    <td>${{ $booking->total_price }}</td>
                                                    <td>
                                                        @if($booking->status == 'confirmed')
                                                            <span class="text-success font-weight-bold">Confirmed</span>
                                                        @elseif($booking->status == 'pending')
                                                            <span class="text-warning font-weight-bold">Pending</span>
                                                        @elseif($booking->status == 'rejected')
                                                            <span class="text-danger font-weight-bold">Unavailable</span>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex justify-content-around">
                                                        <!-- View Button -->
                                                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-success">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                   
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
