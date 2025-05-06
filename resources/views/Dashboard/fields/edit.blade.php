@extends('Dashboard.master')

@section('content')
<div class="page-container">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-success text-white text-center">
                            <h3 class="card-title text-white">Edit Field - {{ $field->field_name }}</h3>
                        </div>
                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('fields.update', $field->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Field Name -->
                                <div class="form-group mb-3">
                                    <label for="field_name" class="form-label">Field Name</label>
                                    <input type="text" name="field_name" id="field_name" class="form-control" value="{{ $field->field_name }}" required>
                                </div>

                                <!-- Field Description -->
                                <div class="form-group mb-3">
                                    <label for="field_description" class="form-label">Description</label>
                                    <textarea name="field_description" id="field_description" class="form-control" rows="3" required>{{ $field->field_description }}</textarea>
                                </div>

                                <!-- Field Location -->
                                <div class="form-group mb-3">
                                    <label for="field_location" class="form-label">Location</label>
                                    <input type="text" name="field_location" id="field_location" class="form-control" value="{{ $field->field_location }}" required>
                                </div>

                                <!-- Field Price -->
                                <div class="form-group mb-3">
                                    <label for="field_price" class="form-label">Price</label>
                                    <input type="number" name="field_price" id="field_price" class="form-control" value="{{ $field->field_price }}" step="0.01" required>
                                </div>

<div class="form-group mb-3">
    <label for="opens_at" class="form-label">Open At</label>
    <input type="time" name="opens_at" id="opens_at" class="form-control" value="{{ old('opens_at', \Carbon\Carbon::parse($field->opens_at)->format('H:i')) }}" required>
</div>

<div class="form-group mb-3">
    <label for="closes_at" class="form-label">Close At</label>
    <input type="time" name="closes_at" id="closes_at" class="form-control" value="{{ old('closes_at', \Carbon\Carbon::parse($field->closes_at)->format('H:i')) }}" required>
</div>
                                <div class="form-group mb-3">
                                    <label for="sport_type_id" class="form-label">Sport Type</label>
                                    <select name="sport_type_id" id="sport_type_id" class="form-select" required>
                                        @foreach($sports as $sport)
                                            <option value="{{ $sport->id }}" {{ $field->sport_type_id == $sport->id ? 'selected' : '' }}>
                                                {{ $sport->sport_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Field Type -->
                                <div class="form-group mb-3">
                                    <label for="field_type_id" class="form-label">Field Type</label>
                                    <select name="field_type_id" id="field_type_id" class="form-select" required>
                                        @foreach($fieldTypes as $type)
                                            <option value="{{ $type->id }}" {{ $field->field_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->field_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Availability -->
                                <div class="form-group mb-3">
                                    <label for="field_avilable" class="form-label">Availability</label>
                                    <select name="field_avilable" id="field_avilable" class="form-select" required>
                                        <option value="0" {{ $field->field_avilable == 0 ? 'selected' : '' }}>Available</option>
                                        <option value="1" {{ $field->field_avilable == 1 ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </div>

                                <!-- Current Images -->
                                <div class="form-group mb-4">
                                    <label for="field_images" class="form-label">Current Images</label>
                                    <div class="row">
                                        @foreach($field->fieldImages as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ asset($image->field_images) }}" alt="Field Image" class="card-img-top img-thumbnail">
                                                    <div class="card-body text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                                            <label class="form-check-label text-danger" for="delete_image_{{ $image->id }}"> <i class="fas fa-trash"></i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Add New Images -->
                                <div class="form-group mb-4">
                                    <label for="field_images" class="form-label">Add New Images</label>
                                    <input type="file" name="field_images[]" id="field_images" class="form-control-file" multiple>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg w-100">Update Field</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('fields.index') }}" class="btn btn-secondary btn-lg">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
