@extends('landing_page.layouts.master')
@section('content')

      <!-- Header Start -->
            <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="{{ route('Home') }}">Home</a></li>
                        <li class="breadcrumb-item active text-primary">About</li>
                    </ol>
                </div>
            </div>
            <!-- Header End -->
        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                        <div>
                            <h4 class="text-primary">About Us</h4>
                            <h1 class="display-5 mb-4">A brief about our company</h1>
                            <p class="mb-4">At PlayZone, we bring your love for sports to life by offering a seamless way to choose and book the perfect court for your game. Whether you prefer indoor or outdoor play, we provide access to top-quality spaces tailored to your needs.
                            </p>
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="d-flex">
                                        <div><i class="fas fa-lightbulb fa-3x text-primary"></i></div>
                                        <div class="ms-4">
                                            <h4>Business Consuluting</h4>
                                            <p>Expert advice to boost bookings and grow your sports business with PlayZone.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="d-flex">
                                        <div><i class="bi bi-bookmark-heart-fill fa-3x text-primary"></i></div>
                                        <div class="ms-4">
                                            <h4>Year of Expertise</h4>
                                            <p>Years of experience connecting sports enthusiasts with the best playing courts.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('services.index') }}" class="btn btn-primary rounded-pill py-3 px-5 flex-shrink-0">Discover Now</a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex">
                                        <i class="fas fa-phone-alt fa-2x text-primary me-4"></i>
                                        <div>
                                            <h4>Call Us</h4>
                                            <p class="mb-0 fs-5" style="letter-spacing: 1px;">+962 799007721</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
    <div class="bg-primary rounded position-relative overflow-hidden">
        <img src="{{ asset('landing/img/tennisC.jpg') }}" class="img-fluid rounded w-100" alt="">
    </div>
</div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->



@stop
