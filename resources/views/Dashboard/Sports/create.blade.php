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
                                    <h4><strong class="text-white">Add New Sport Type</strong></h4>
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
                                    <form action="{{ route('sport-types.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Sport Type Name-->
                                        <div class="form-group">
                                            <label for="sport_type">Sport Type</label>
                                            <input type="text" id="sport_type" name="sport_type" placeholder="Enter Sport Type" class="form-control" onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        </div>

                                         <!-- Sport Type Description -->
                                         <div class="form-group">
                                             <label for="sport_desc">Sport Type Description</label>
                                             <input type="text" id="sport_desc" name="sport_desc" placeholder="Enter Sport Type Description" class="form-control" onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                         </div>
    
                                        <!-- Image Upload -->
                                        <div class="form-group">
                                            <label for="sport_image">Add Image</label>
                                            <input type="file" id="sport_image" name="sport_image" class="form-control" onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        </div>
    
                                        <!-- Submit Button -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check-circle"></i> Create
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



            {{-- <div style="width: 100%;" class="col-lg-6">
                <div class="card">
                    <div class="card-header" style="background-color: #00D084;">
                        <strong style="color: white; text-align:center;">Add New Sport Type</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('sport-types.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Sport Type</label>
                                </div>
                                <div class="col-12 col-md-9"> --}}
                                    {{-- <form action="{{ route('sport-types.store') }}" method="POST"> --}}
                                        {{-- @csrf --}}
                                        {{-- <input type="text" id="text-input" name="sport_type" placeholder="eg. football, basketball..." class="form-control"> --}}
                                    {{-- </form> --}}
                                {{-- </div>
                            </div> --}}
                            {{-- <div class="row form-group">
                                <div class="col">
                                    <label style="color: #72c4a6;" class="form-control-label">or you can select from already exists court/ sport type</label>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Exists type</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="select" id="select" class="form-control">
                                        <option value="0">Please select</option>
                                        @foreach ($sports_type as $sport_type)
                                        <option value="{{$sport_type->id}}">{{$sport_type->sport_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label for="formFile" class="form-label">Sport image</label>
                                <input class="form-control" type="file" id="formFile" name="sport_image">
                              </div> --}}
                              
                            {{-- <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="file-multiple-input" class=" form-control-label">Multiple File input</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file-multiple-input" name="file-multiple-input" multiple="" class="form-control-file">
                                </div>
                            </div> --}}
                            {{-- <div>
                                <button type="submit" class="btn btn-success btn-sm">Create</button>
                            </div>
                        </form>
                    </div> --}}
                    {{-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="width: 600px;">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src={{asset('landing\img\about-1.jpg')}} class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="landing\img\about-2.png" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="landing\img\about-3.png" class="d-block w-100" alt="...">
                          </div>
                        </div>
                      </div>
                </div> --}}
                {{-- </div> --}}
        </div>
    </div>
@endsection