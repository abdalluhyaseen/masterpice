@extends('landing_page.layouts.master')
@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Fields</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('Home') }}">Home</a></li>
            <li class="breadcrumb-item active text-primary">Fields</li>
        </ol>    
    </div>
</div>

 @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<!-- Services Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Our Fields</h4>
            <h1 class="display-5 mb-4">Explore Our Available Fields</h1>
            <p class="mb-0">Discover a wide range of sports fields available for your activities. From football to tennis, we have the perfect field for your needs.</p>
        </div>
        <!-- Filters Start -->
<div class="container py-5">
    <form method="GET" action="{{ route('services.index') }}">
        <div class="row">
            <div class="col-md-4">
                <select class="form-select" name="sport_type" onchange="this.form.submit()">
                    <option value="">Select Sport Type</option>
                    @foreach($sportTypes as $sportType)
                        <option value="{{ $sportType->id }}" {{ request('sport_type') == $sportType->id ? 'selected' : '' }}>
                            {{ $sportType->sport_type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="field_type" onchange="this.form.submit()">
                    <option value="">Select Field Type</option>
                    @foreach($fieldTypes as $fieldType)
                        <option value="{{ $fieldType->id }}" {{ request('field_type') == $fieldType->id ? 'selected' : '' }}>
                            {{ $fieldType->field_type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <a href="{{ route('services.index') }}" class="btn btn-success w-100">Show All</a>
            </div>
        </div>
    </form>
</div>

<!-- Filters End -->
        <div class="row g-4">
            @foreach($fields as $field)
                <div class="col-md-6 col-lg-4 wow fadeInUp" >
                    <div class="service-item" style="display: flex; flex-direction: column; height: 100%;">
                        <div class="service-img" style="flex: 1;">
                            @if($field->fieldImages->isNotEmpty())
                                <img src="{{ asset($field->fieldImages->first()->field_images) }}" class="img-fluid rounded-top" style="height: 200px; object-fit: cover; width: 100%;" alt="{{ $field->field_name }}">
                            @else
                                <img src="{{ asset('landing/img/placeholder.jpg') }}" class="img-fluid rounded-top" style="height: 200px; object-fit: cover; width: 100%;" alt="Placeholder">
                            @endif
                        </div>
                        <div class="rounded-bottom p-4" style="flex: 1;">
                            <a href="#" class="h4 d-inline-block mb-4" style="display: block; font-size: 1.25rem; color: #333;">{{ $field->field_name }}</a>
                            <p class="mb-4" style="color: #555;"><strong>Field Type :</strong>{{ $field->fieldType-> field_type}}</p>
                            <p class="mb-4" style="color: #555;"><strong>Sport Type :</strong>{{ $field->sportType-> sport_type}}</p>
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('services.show', $field->id) }}">View Details</a>
<a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('book', ['field_id' => $field->id]) }}">Book Now</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Services End -->

@endsection
