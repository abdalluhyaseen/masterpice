@extends('Dashboard.master')
@section('content')
<div class="page-container">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <!-- Start Form Card -->
                        <div class="card shadow-lg ">
                            <div class="card-header bg-success text-white text-center ">
                                <h4><strong class="text-white">Add New Field</strong></h4>
                            </div>
                            <div class="card-body">
                                <!-- Form Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Start Form -->
                                <form action="{{ route('fields.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Field Name -->
                                    <div class="form-group">
                                        <label for="field_name">Field Name</label>
                                        <input type="text" id="field_name" name="field_name" placeholder="Enter field name" class="form-control" value="{{ old('field_name') }}">
                                    </div>

                                    <!-- Field Description -->
                                    <div class="form-group">
                                        <label for="field_description">Field Description</label>
                                        <textarea name="field_description" id="field_description" rows="4" placeholder="Enter field description" class="form-control">{{ old('field_description') }}</textarea>
                                    </div>

                                    <!-- Field Location -->
                                    <div class="form-group">
                                        <label for="field_location">Location</label>
                                        <input type="text" id="field_location" name="field_location" placeholder="Enter field location" class="form-control" value="{{ old('field_location') }}">
                                    </div>

                                    <!-- Field Price -->
                                    <div class="form-group">
                                        <label for="field_price">Field Price</label>
                                        <input type="number" id="field_price" name="field_price" step="0.01" class="form-control" value="{{ old('field_price') }}">
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="form-group">
                                        <label for="field_images">Upload Images</label>
                                        <input type="file" id="field_images" name="field_images[]" multiple class="form-control-file">
                                    </div>

                                    <!-- Sport Type -->
                                    <div class="form-group">
                                        <label for="sport_type_id">Sport Type</label>
                                        <select name="sport_type_id" id="sport_type_id" class="form-control">
                                            <option value="">Please select</option>
                                            @foreach($sports as $sport)
                                                <option value="{{ $sport->id }}" {{ old('sport_type_id') == $sport->id ? 'selected' : '' }}>{{ $sport->sport_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Field Type -->
                                    <div class="form-group">
                                        <label for="field_type_id">Field Type</label>
                                        <div class="form-check">
                                            @foreach($fields as $field)
                                                <div class="radio">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="field_type_id" value="{{ $field->id }}" class="form-check-input" {{ old('field_type_id') == $field->id ? 'checked' : '' }}>
                                                        {{ $field->field_type }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Opens At -->
                                    <div class="form-group">
                                        <label for="opens_at">Opens At</label>
                                        <input type="time" id="opens_at" name="opens_at" class="form-control" value="{{ old('opens_at') }}">
                                    </div>

                                    <!-- Closes At -->
                                    <div class="form-group">
                                        <label for="closes_at">Closes At</label>
                                        <input type="time" id="closes_at" name="closes_at" class="form-control" value="{{ old('closes_at') }}">
                                    </div>

                                    <!-- Is 24 Hours -->
                                    <div class="form-group">
                                        <label for="is_24_hours">Is 24 Hours?</label>
                                        <div class="form-check">
                                            <input type="checkbox" id="is_24_hours" name="is_24_hours" class="form-check-input" {{ old('is_24_hours') ? 'checked' : '' }}>
                                            <label for="is_24_hours" class="form-check-label">Yes</label>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-check-circle"></i> Add Field
                                        </button>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                        <!-- End Form Card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
