@extends('landing_page.layouts.master')
@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $field->field_name }}</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('Home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Fields</a></li>
            <li class="breadcrumb-item active text-primary">{{ $field->field_name }}</li>
        </ol>
    </div>
</div>

<!-- Field Details Start -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
         @if($field->fieldImages->isNotEmpty())
    <div id="fieldImagesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($field->fieldImages as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset($image->field_images) }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Field Image">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#fieldImagesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#fieldImagesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif
        </div>
        <div class="col-lg-6">
            <h2 class="mb-4">{{ $field->field_name }}</h2>
            <p class="mb-2"><strong>Field Type:</strong> {{ $field->fieldType->field_type }}</p>
            <p class="mb-2"><strong>Sport Type:</strong> {{ $field->sportType->sport_type }}</p>
            <p class="mb-4"><strong>Description:</strong> {{ $field->field_description ?? 'No description available.' }}</p>
            <p class="mb-4"><strong>Location:</strong> {{ $field->field_location }}</p>
            <p class="mb-4"><strong>price:</strong> ${{ $field->field_price }}</p>
           <p class="mb-4"><strong>Opening At :</strong> {{ \Carbon\Carbon::parse($field->opens_at)->format('g:i A') }}</p>
<p class="mb-4"><strong>Closing At :</strong> {{ \Carbon\Carbon::parse($field->closes_at)->format('g:i A') }}</p>

            <p class="mb-4 {{ $field->field_avilable == 0 ? 'text-success' : 'text-danger' }}">{{ $field->field_avilable == 0 ? 'Available' : 'Not Available' }}</p>


<a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('book', ['field_id' => $field->id]) }}">Book Now</a>

            <a href="{{ route('services.index') }}" class="btn btn-success rounded-pill py-2 px-4">Back to Courts</a>
        </div>
    </div>
</div>
<!-- Field Details End -->

@endsection
