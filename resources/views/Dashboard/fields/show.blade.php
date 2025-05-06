@extends('Dashboard.master')

@section('content')
<div class="page-container">
    <div class="main-content">
        <div class="container">
            <!-- Field Details Heading -->
            <h1 class="text-center text-success my-4">Field Details</h1>

            <!-- Field Details Card -->
            <div class="card shadow-lg border-success">
                <div class="card-header bg-success text-white text-center">
                    <h3 class="card-title text-white    ">{{ $field->field_name }}</h3>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong >Description:</strong> {{ $field->field_description }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $field->field_location }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $field->field_price }}</p>
                    <p class="card-text"><strong>Sport Type:</strong> {{ $field->sportType ? $field->sportType->sport_type : 'No sport type available' }}</p>
                    <p class="card-text"><strong>Field Type:</strong> {{ $field->fieldType->field_type }}</p>
                      <p class="card-text"><strong>Opening At :</strong> {{ \Carbon\Carbon::parse($field->opens_at)->format('g:i A') }}</p>
                    <p class="card-text"><strong>Closing At :</strong> {{ \Carbon\Carbon::parse($field->closes_at)->format('g:i A') }}</p>
                    <p class="card-text"><strong>Availability:</strong>
                        <span class="{{ $field->field_available == 0 ? 'text-success' : 'text-danger' }}">
                            {{ $field->field_available == 0 ? 'Available' : 'Not Available' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Field Images Section -->
            <h2 class="text-center text-success mt-5">Field Images</h2>
            <div class="row mt-4">
                @forelse ($field->fieldImages as $image)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-success">
                            <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 200px; overflow: hidden;">
                                <img src="{{ asset($image->field_images) }}" alt="Field Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No images available for this field.</p>
                    </div>
                @endforelse
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('fields.edit', $field->id) }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-edit"></i> Edit Field
                </a>
                <a href="{{ route('fields.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
