@extends('Dashboard.master')

@section('content')

<div class="page-container">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-success text-white text-center">
                            <h3 class="card-title text-white">Edit Sport Type - {{ $sport_type->sport_type }}</h3>
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

                            <form action="{{ route('sport-types.update', $sport_type->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-4">
                                    <label for="sport_image" class="form-label">Current Image</label>
                                    <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ asset($sport_type->sport_image) }}" alt="Sport Image" class="card-img-top img-thumbnail">
                                                    {{-- <div class="card-body text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                                            <label class="form-check-label text-danger" for="delete_image_{{ $image->id }}"> <i class="fas fa-trash"></i></label>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="sport_image" class="form-label">Select another Image</label>
                                    <input type="file" name="sport_image" id="sport_image" class="form-control" onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                </div>


                                <div class="form-group mb-3">
                                    <label for="sport_type" class="form-label">Type of Sport</label>
                                    <input type="text" name="sport_type" id="sport_type" class="form-control" value="{{ $sport_type->sport_type }}" required onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="sport_desc" class="form-label">Description</label>
                                    <textarea name="sport_desc" id="sport_desc" class="form-control" rows="3" required onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">{{ $sport_type->sport_desc }}</textarea>
                                </div>


                                <button type="submit" class="btn btn-success btn-lg w-100">Save Update</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('fields.index') }}" class="btn btn-secondary btn-lg">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
























        {{-- <div class="col-lg-6" style="width: 100%;">
            <div class="card"> --}}
                {{-- <div class="card-header">Edit Sport/Court Details</div> --}}
                {{-- <div class="card-header">
                    <strong style="color: #00D084;">Edit Court Type</strong> Details for your field 
                </div>
                <div class="card-body"> --}}
                    {{-- <div class="card-title">
                        <h3 class="text-center title-2">Pay Invoice</h3>
                    </div>
                    <hr> --}}
                    {{-- <form action="{{ route('sport-types.update', $sport_type->id) }}" method="POST">
                        @csrf
                        @method("put")

                        <div class="form-group">
                            <label for="sport_type">Sport type:</label>
                            <input class="is-valid form-control-success form-control" type="text" name="sport_type"  value="{{$sport_type->sport_type}}" required>
                        </div>

                        <div class="form-group">
                            <label for="sport_image">Sport Image:</label>
                            <td><img src="{{asset($sport_type->sport_image)}}" alt="sport_image" name="sport_image" width="100px" height="100px"></td>
                        </div>
                        <div>
                            <input type="file" id="formFile" name="sport_image">
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" style="background-color: #00D084;">Save</button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection