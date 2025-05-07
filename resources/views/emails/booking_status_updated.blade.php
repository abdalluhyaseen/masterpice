<!-- resources/views/emails/booking_status_updated.blade.php -->

<h1>Booking Status Update</h1>
<p>Hello {{ $booking->user->name }},</p>
<p>Your booking for the field <strong>{{ $booking->field->field_name }}</strong> has been updated.</p>
<p>Status: <strong>{{ ucfirst($booking->status) }}</strong></p>
<p>Thank you for your reservation!</p>
