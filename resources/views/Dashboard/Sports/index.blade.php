@extends('Dashboard.master')

@section('content')
    <div class="page-container">
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- Data Table -->
                            <div class="card shadow-lg">
                                <div class="card-header bg-success text-white text-center">
                                    <h3 class="text-white"><i class="fas fa-futbol "></i> Sports Type</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead class="bg-success text-white">
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Image</th>
                                                    <th>Court Type</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sports_type as $sport_type)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td> <!-- Serial Number -->
                                                        <td><img src="{{ asset($sport_type->sport_image) }}" alt="sport_image" width="100"></td>
                                                        <td>{{ $sport_type->sport_type }}</td>
                                                        <td>{{ $sport_type->sport_desc }}</td>
                                                        <td class="d-flex align-items-center">
                                                            <!-- Edit Button -->
                                                            <a href="{{ route('sport-types.edit', $sport_type->id) }}" class="btn btn-sm btn-warning m-r-5">
                                                                <i class="fas fa-edit"></i>
                                                            </a><br><br><br>
                                                            <!-- Delete Button -->
                                                            <form action="{{ route('sport-types.destroy', $sport_type->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this type of sport?');" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End Data Table -->
                        </div>
                    </div>

                </div>
            </div>

            {{-- <div class="col-lg-9">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>image</th>
                                <th>Court type</th>
                                <th>Actions</th> --}}
                                {{-- <th class="text-right">quantity</th>
                                <th class="text-right">total</th> --}}
                            {{-- </tr>
                        </thead>
                        <tbody>
                            @foreach ($sports_type as $sport_type)
                            <tr>
                                <td>{{$sport_type->id}}</td>
                                <td><img src="{{asset($sport_type->sport_image)}}" alt="sport_image" width="100px" height="100px"></td>
                                <td>{{$sport_type->sport_type}}</td>
                                <td>
                                    <div style="display:flex; flex-direction:row;">
                                        <a href="{{route('sport-types.edit', $sport_type->id )}}" ><button type=submit class="btn btn-info btn-sm"> <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i> </button></a> <br>
                                        <form action="{{route('sport-types.destroy' , $sport_type->id)}}" method="post">
                                            @csrf
                                            @method('Delete')
                                            <button type=submit class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i> </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
