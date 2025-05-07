@extends('landing_page.layouts.master')
@section('content')

      <!-- Header Start -->
            <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-1" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Profile</h4>
                </div>
            </div>
            <!-- Header End -->
        <!-- profile Start -->
        <div class="container-fluid about py-2">
                        <div class="d-flex justify-content-center mt-3 gap-2">
            <a href='profile'><button class="btn btn-primary" >Profile</button></a>
            <a href='edit-profile'><button class="btn btn-primary" >Change Info</button></a>
            <a href='edit-password'><button class="btn btn-primary">Change Password</button></a>
        </div>
            <div class="container py-5">
                                    <!-- Success Message -->
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                <div class="row g-5 justify-content-center align-items-center">
                    <div class="col-xl-4 wow fadeInLeft" data-wow-delay="0.2s">
                        <div>
                                <div class="mb-3">
                                    <label>Name</label>
                                    <h1>{{$user->name}}</h1>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <h3>{{$user->email}}</h3>
                                </div>

                                <div class="mb-3">
                                    <label>Phone</label>
                                    <h3>{{$user->phone? $user->phone:'--'}}</h3>
                                </div>
                        </div>
                    </div>
            <div class="col-xl-4 wow fadeInRight" data-wow-delay="0.2s">
    <div class="position-relative overflow-hidden">
        <img src="{{ $user->image? $user->image : 'https://avatar.iran.liara.run/public/boy?username=Ash' }}" class="rounded mx-auto d-block w-100 h-auto" alt="Profile Picture">
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px; margin-bottom: 20ox; flex-direction: column;">
            <h2>Your Bookings</h2>

@if($user->bookings->isEmpty())
    <p>You have no bookings.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Field Name</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>Duration</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->bookings as $booking)
                <tr>
                    <td>{{ $booking->field->field_name }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->start_at }}</td>
                    <td>{{ $booking->duration }} hours</td>
                    <td>${{ $booking->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

</div>

@stop
