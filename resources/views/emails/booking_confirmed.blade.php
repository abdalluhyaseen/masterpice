<h1>Your Booking is Confirmed!</h1>

<p>Dear {{ $booking->user->name }},</p>

<p>Thank you for booking with us. Here are your booking details:</p>

<ul>
    <li><strong>Field Name:</strong> {{ $booking->field->field_name }}</li>
    <li><strong>Date:</strong> {{ $booking->date }}</li>
    <li><strong>Start Time:</strong> {{ $booking->start_at }}</li>
    <li><strong>Duration:</strong> {{ $booking->duration }} hours</li>
    <li><strong>Total Price:</strong> ${{ $booking->total_price }}</li>
</ul>

<p>We look forward to seeing you!</p>
