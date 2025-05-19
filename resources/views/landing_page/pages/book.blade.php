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
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}" max="{{ \Carbon\Carbon::now()->addMonth()->toDateString() }}" value="{{ old('date') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Start Time -->
                        <div class="form-group mb-3">
                            <label for="start_at" class="form-label">Start Time:</label>
                            <select name="start_at" id="start_at" class="form-select @error('start_at') is-invalid @enderror">
                                <option value="">Select Start Time</option>
                                @foreach ($availableHours as $hour)
                                    <option value="{{ $hour }}" {{ old('start_at') == $hour ? 'selected' : '' }}>
                                        {{ $hour }}
                                    </option>
                                @endforeach
                            </select>
                            @error('start_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div class="form-group mb-4">
                            <label for="duration" class="form-label">Duration (hours):</label>
                            <input type="number" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" min="1" value="{{ old('duration') }}">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div class="form-group mb-4">
                            <label for="payment_method" class="form-label">Payment Method:</label>
                            <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                                <option value="">Select Payment Method</option>
                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Information -->
                        <div class="form-group mb-4" id="payment_info" style="display: none;">
                            <label for="card_number" class="form-label">Card Number:</label>
                            <input type="text" name="card_number" id="card_number" class="form-control mb-3 @error('card_number') is-invalid @enderror" placeholder="Enter card number" required>
                            @error('card_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="card_expiry" class="form-label">Expiry Date:</label>
                            <input type="text" name="card_expiry" id="card_expiry" class="form-control mb-3 @error('card_expiry') is-invalid @enderror" placeholder="MM/YY" required>
                            @error('card_expiry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="card_cvc" class="form-label">CVC:</label>
                            <input type="text" name="card_cvc" id="card_cvc" class="form-control mb-3 @error('card_cvc') is-invalid @enderror" placeholder="Enter CVC" required>
                            @error('card_cvc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="paypal_email" class="form-label" id="paypal_email_label" style="display: none;">PayPal Email:</label>
                            <input type="email" name="paypal_email" id="paypal_email" class="form-control @error('paypal_email') is-invalid @enderror" placeholder="Enter PayPal email" style="display: none;" required>
                            @error('paypal_email')
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

<script>
    document.getElementById('payment_method').addEventListener('change', function() {
    var paymentInfo = document.getElementById('payment_info');
    var paypalEmail = document.getElementById('paypal_email');
    var paypalEmailLabel = document.getElementById('paypal_email_label');
    var cardFields = [document.getElementById('card_number'), document.getElementById('card_expiry'), document.getElementById('card_cvc')];

    if (this.value === 'credit_card') {
        paymentInfo.style.display = 'block';
        paypalEmail.style.display = 'none';
        paypalEmailLabel.style.display = 'none';

        cardFields.forEach(function(field) {
            field.style.display = 'block';
            field.required = true;
            field.disabled = false; // مهم
        });

        paypalEmail.required = false;
        paypalEmail.disabled = true; // مهم
    } else if (this.value === 'paypal') {
        paymentInfo.style.display = 'block';
        paypalEmail.style.display = 'block';
        paypalEmailLabel.style.display = 'block';

        cardFields.forEach(function(field) {
            field.style.display = 'none';
            field.required = false;
            field.disabled = true; // مهم
        });

        paypalEmail.required = true;
        paypalEmail.disabled = false; // مهم
    } else {
        paymentInfo.style.display = 'none';

        cardFields.forEach(function(field) {
            field.required = false;
            field.disabled = true; // مهم
        });

        paypalEmail.required = false;
        paypalEmail.disabled = true; // مهم
    }
});


</script>

@endsection
