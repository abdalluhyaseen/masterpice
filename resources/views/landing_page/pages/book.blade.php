@extends('landing_page.layouts.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Fields</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('Home') }}" class="text-white">Home</a></li>
            <li class="breadcrumb-item active text-primary">Fields</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Booking Form Start -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h1 class="h3 text-white">Book {{ $field->field_name }}</h1>
                </div>
                <div class="card-body p-4">
                    <h2 class="h4 mb-4">Book a Court</h2>

                    <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="field_id" value="{{ $field->id }}">

                        <!-- Date -->
                        <div class="form-group mb-3">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}" max="{{ \Carbon\Carbon::now()->addMonth()->toDateString() }}" value="{{ old('date') }}"   >
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Start Time -->
                        <div class="form-group mb-3">
                            <label for="start_at" class="form-label">Start Time:</label>
                            <select name="start_at" id="start_at" class="form-select @error('start_at') is-invalid @enderror" >
                                <option value="">Select Start Time</option>
                                @foreach ($availableHours as $hour)
                                    <option value="{{ $hour }}" {{ old('start_at') == $hour ? 'selected' : '' }}>{{ $hour }}</option>
                                @endforeach
                            </select>
                            @error('start_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div class="form-group mb-4">
                            <label for="duration" class="form-label">Duration (hours):</label>
                            <input type="number" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" min="1" value="{{ old('duration') }}" >
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn bg-primary text-white rounded-pill py-2 px-4">Book Now</button>
                                        <a href="{{ route('services.index') }}" class="btn bg-primary text-white rounded-pill py-2 px-4">Back to Courts</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>
<!-- Booking Form End -->

@endsection
