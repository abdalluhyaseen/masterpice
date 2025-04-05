@extends('landing_page.layouts.master')
@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-1" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Change Password</h4>
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

                    
                    <!-- Form -->
                    <form method="POST" action="update-password">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="new" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="new">
                        </div>
                        @error('new')
                            <p class="text-danger fw-semibold mt-1 small">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="confirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm">
                        </div>
                        @error('confirm')
                            <p class="text-danger fw-semibold mt-1 small">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="btn btn-primary">Save Password</button>
                    </form>
                </div>
            </div>
      
        </div>
    </div>
</div>
<!-- About End -->

@stop
