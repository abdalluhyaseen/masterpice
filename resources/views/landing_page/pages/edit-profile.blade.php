@extends('landing_page.layouts.master')
@section('content')

      <!-- Header Start -->
            <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-1" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Change Info</h4>
                </div>
            </div>
            <!-- Header End -->
        <!-- profile Start -->
        <div class="container-fluid about py-2">
            <div class="d-flex justify-content-center mt-3 gap-2">
                <a href='profile'><button class="btn btn-primary" >Profile</button></a>
                <a href='edit-profile'><button class="btn btn-primary" >Change Info</button></a>
                <a href='edit-password'><button class="btn btn-primary">Change Password</button></a>
            </div>
            <div class="container py-5">
                <div class="row g-5 justify-content-center align-items-center">
                    <div class="col-xl-4 wow fadeInLeft" data-wow-delay="0.2s">
        <div class="card-body">
            <form method="POST" action="update-user" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{ $user->name}}">
                </div>
                @error('name')
                <p class="text-danger fw-semibold mt-1 small">{{ $message }}</p>
            @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{ $user->email}}">
                </div>
                @error('email')
                <p class="text-danger fw-semibold mt-1 small">{{ $message }}</p>
            @enderror
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" name="phone" value="{{ $user->phone? $user->phone: ''}}" placeholder="07XXXXXXXX / Empty" >
            </div>
            @error('phone')
            <p class="text-danger fw-semibold mt-1 small">The phone number must start with "07" and be 10 digits long.</p>
        @enderror
        <div class="mb-3">
            <label for="profileImage" class="form-label">Upload New Image</label>
            <input class="form-control" type="file" name="image">
        </div>
        @error('image')
        <p class="text-danger fw-semibold mt-1 small">{{ $message }}</p>
        @enderror
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
                        </div>
                    </div>
                    <div class="col-xl-4 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $user->image? $user->image : 'https://avatar.iran.liara.run/public/boy?username=Ash' }}" class="rounded mx-auto d-block w-100 h-auto" alt="Profile Picture">
                        </div>  
                        @if($user->image)
                        <div class="d-flex justify-content-center mt-3">
                            <form action="{{ route('users.remove') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove Photo</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->



@stop