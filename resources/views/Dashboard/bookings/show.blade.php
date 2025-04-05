@extends('Dashboard.master')

@section('content')
<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cards for User Details and Field Details -->
                        <div class="row">
                            <!-- User Details Card -->
                            <div class="col-md-6 mb-4">
                                <div class="card border-success mb-4">
                                    <div class="card-header bg-success text-white">
                                        <strong>User Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $booking->user->profile_picture }}" alt="User Picture" class="rounded-circle me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div>
                                                <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                                                <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                                                <p><strong>Phone:</strong> {{ $booking->user->phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Field Details Card -->
                            <div class="col-md-6 mb-4">
                                <div class="card border-success mb-4">
                                    <div class="card-header bg-success text-white">
                                        <strong>Field Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <!-- Field Image -->
                                                <div>
                                                <p><strong>Name:</strong> {{ $booking->field->field_name }}</p>
                                                <p><strong>Price:</strong> ${{ $booking->field->field_price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details and Update Status Card -->
                        <div class="card border-success mb-4">
                            <div class="card-header bg-success text-white">
                                <strong>Booking ID:</strong> {{ $booking->id }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><strong>Booking Details:</strong></h5>
                                <ul class="list-group mb-4">
                                    <li class="list-group-item"><strong>Date:</strong> {{ $booking->date }}</li>
                                    <li class="list-group-item"><strong>Start Time:</strong> {{ $booking->start_at }}</li>
                                    <li class="list-group-item"><strong>Duration:</strong> {{ $booking->duration }} hours</li>
                                    <li class="list-group-item"><strong>Total Price:</strong> ${{ $booking->total_price }}</li>
                                    <li class="list-group-item">
                                        <strong>Status:</strong> 
                                        @if($booking->status == 'confirmed')
                                                            <span class="text-success font-weight-bold">Confirmed</span>
                                        @elseif($booking->status == 'pending')
                                                            <span class="text-warning font-weight-bold">Pending</span>
                                                        @elseif($booking->status == 'rejected')
                                                            <span class="text-danger font-weight-bold">Unavailable</span>
                                                        @endif
                                    </li>
                                </ul>

                                <!-- Update Status Form -->
                                <h5 class="card-title"><strong>Update Status:</strong></h5>
                                <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select name="status" class="form-select">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3">Update Status</button>
                                </form>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <div class="mt-4">
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to Reservations</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
</div>
@endsection
