 <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <img src="{{ asset('landing/img/image.png') }}" class="img-fluid w-100 rounded" alt="Service 4">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{ route('Home') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link">About Us</a>
                        <!-- change zaina -->
                        <a href="{{ route('services.index') }}" class="nav-item nav-link">Courts</a>
                        </div>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact Us</a>
                    </div>
                <!-- Add this part where you want the button to appear -->

                    @auth
                    <!-- If the user is authenticated -->
                    <!-- <a href="{{ url('/') }}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Home</a> -->
                    @else
                    <!-- If the user is not authenticated -->
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Register</a>
                    @endif

                </div>
            </nav>
