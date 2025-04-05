@extends('Dashboard.master')

@section('content')

<style>
    /* General Container Styling */
    .admin-profile-container {
        max-width: 680px;
        margin: 60px auto;
        padding: 40px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }
    
    /* Profile Header */
    .profile-header h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
    }
    
    /* Profile Image */
    .profile-image {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .profile-image img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    
    .profile-image img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    
    /* Upload Button Styling */
    .upload-btn-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .btn-upload {
        background-color: #16a085;
        color: white;
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn-upload:hover {
        background-color: #1abc9c;
    }
    
    .upload-btn-wrapper input[type="file"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    
    /* Form Styling */
    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group label {
        font-weight: bold;
        margin-bottom: 8px;
        color: #2c3e50;
    }
    
    .form-group input {
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        background-color: #f7f9f9;
        transition: all 0.3s ease;
    }
    
    .form-group input:focus {
        border-color: #16a085;
        box-shadow: 0 0 5px rgba(22, 160, 133, 0.5);
        outline: none;
    }
    
    /* Button Styling */
    .form-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 20px;
    }
    
    .btn-update {
        background-color: #16a085;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        flex: 1;
    }
    
    .btn-update:hover {
        background-color: #1abc9c;
    }
    
    .btn-cancel {
        background-color: #e74c3c;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        flex: 1;
        transition: background-color 0.3s ease;
    }
    
    .btn-cancel:hover {
        background-color: #c0392b;
    }
    
    /* Media Query for Mobile */
    @media (max-width: 500px) {
        .admin-profile-container {
            padding: 30px;
        }
    
        .form-actions {
            flex-direction: column;
            gap: 10px;
        }
    
        .btn-update, .btn-cancel {
            width: 100%;
        }
    }
    
</style>
<div class="page-container">
<div class="main-content">
    <div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="admin-profile-container">
            <div class="profile-header">
                <h2>Edit Your Profile - {{ $admin_profile->name }}</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="profile-image">
                <img src="{{ asset($admin_profile->image) }}" alt="Admin user Image" class="card-img-top img-thumbnail">
            </div>
        
            <form action="{{ route('a_profile.update', $admin_profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="upload-btn-wrapper">
                    <button class="btn-upload">Change Profile Image</button>
                    <input type="file" name="image" id="image" class="form-control" onfocus="this.style.borderColor='#16a085'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $admin_profile->name }}" required onfocus="this.style.borderColor='#16a085'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $admin_profile->email }}" required onfocus="this.style.borderColor='#16a085'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                </div>
            
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ $admin_profile->password }}" required onfocus="this.style.borderColor='#16a085'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                </div>
            
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $admin_profile->phone }}" required onfocus="this.style.borderColor='#16a085'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                </div>
            
                <div class="form-actions">
                    <button type="submit" class="btn-update">Save Changes</button>
                    {{-- <button type="button" class="btn-cancel">Cancel</button> --}}
                </div>
            </form>
        </div>
    </div>






    {{-- <div class="page-container">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-success text-white text-center">
                                    <h3 class="card-title text-white">Edit Information - {{ $admin_profile->name }}</h3>
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
                                    
                                    <form action="{{ route('a_profile.update', $admin_profile->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                    
                                        <div class="form-group mb-4"> --}}
                                            {{-- <label for="image" class="form-label">Your Image</label> --}}
                                            {{-- <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <div class="card">
                                                            <img src="{{ asset($admin_profile->image) }}" alt="Admin user Image" class="card-img-top img-thumbnail">
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group mb-4">
                                            <label for="image" class="form-label">Select another Image</label>
                                            <input type="file" name="image" id="image" class="form-control" onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $admin_profile->name }}" required onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        </div>
                                    
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $admin_profile->email }}" required onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        </div>
                                    
                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Password:</label>
                                            <input type="password" name="password" id="password" class="form-control" value="{{ $admin_profile->password }}" required onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        </div>
                                    
                                        <div class="form-group mb-3">
                                            <label for="phone" class="form-label">Phone:</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $admin_profile->phone }}" required onfocus="this.style.borderColor='#00D084'; this.style.boxShadow='0 0 5px rgba(76, 175, 80, 0.5)'; this.style.outline='none';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        </div>
                                    
                                        <button type="submit" class="btn btn-success btn-lg w-100">Update</button>
                                    </form>
                                </div>
                                <div class="card-footer text-center"> --}}
                                    {{-- <a href="{{ route('fields.index') }}" class="btn btn-secondary btn-lg">Back to List</a> --}}
                                {{-- </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                {{-- <div class="col-lg-6">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header" style="background-color: #00D084; color:white">Update your Information</div>
                        <div class="card-body card-block">
                            <form action="{{ route('a_profile.update', $admin_profile->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa-solid fa-image-portrait"></i>
                                        </div>
                                        <td><img src="{{asset($admin_profile->image)}}" alt="Admin profile image" width="150px" height="150px"></td>
                                    </div>
                                    <div>
                                        <input type="file" id="admin_img" name="image" placeholder="Profile image" >
                                    </div>
                                </div> --}}
                                {{-- <div>
                                    <img src="{{asset($admin_prof->image)}}" alt="Admin profile image" style="border-radius: 50%;  border: 0.5px solid #00D084; width:100px; hight:100px;">
                                </div> --}}
                                {{-- <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="adminName" name="name" placeholder="{{$admin_profile->name}}" class="form-control" style="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="email" id="email" name="email" placeholder="{{$admin_profile->email}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk"></i>
                                        </div>
                                        <input type="password" id="password" name="password" placeholder="Enter New Password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <input type="text" id="phone_no" name="phone" placeholder="{{$admin_profile->phone}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-success btn-sm" style="width: 100%; background-color:#00D084">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
</div>
</div>
@endsection