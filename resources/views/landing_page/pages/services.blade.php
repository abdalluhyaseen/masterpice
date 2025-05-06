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
    <div class="alert alert-success text-center my-3">
        {{ session('success') }}
    </div>
@endif

<!-- Filters Start -->
<div class="container py-5">
    <form method="GET" action="{{ route('services.index') }}">
        <div class="row mb-4">
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

<!-- Services Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-4">
            @forelse($fields as $field)
                <div class="col-md-6 col-lg-4 wow fadeInUp">
                    <div class="card h-100 shadow-sm">
                        <!-- Image Section -->
                        <div class="card-img-top">
                            @if($field->fieldImages->isNotEmpty())
                                <img src="{{ asset($field->fieldImages->first()->field_images) }}"
                                     class="img-fluid rounded-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="{{ $field->field_name }}">
                            @else
                                <img src="{{ asset('landing/img/placeholder.jpg') }}"
                                     class="img-fluid rounded-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="Placeholder">
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $field->field_name }}</h5>
                            <p class="card-text">
                                <strong>Field Type:</strong> {{ $field->fieldType->field_type }}<br>
                               <p class="card-text">
    <strong>Sport Type:</strong>
    {{ $field->sportType ? $field->sportType->sport_type : 'No sport type available' }}
</p>

                            </p>
                            <p class="card-text text-muted">
                                {{ $field->description ?? 'No description available' }}
                            </p>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer text-center">
                            <a href="{{ route('services.show', $field->id) }}" class="btn btn-primary btn-sm">View Details</a>
                            <a href="{{ route('book', ['field_id' => $field->id]) }}" class="btn btn-success btn-sm">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No fields available.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $fields->links() }}
        </div>
    </div>
</div>
<!-- Services End -->

@endsection
