 <div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="#" class="navbar-brand p-0">
            <img src="{{ asset('landing/img/image.png') }}" class="img-fluid w-100 rounded" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('Home') }}"
                   class="nav-item nav-link {{ Request::routeIs('Home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}"
                   class="nav-item nav-link {{ Request::routeIs('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('services.index') }}"
                   class="nav-item nav-link {{ Request::routeIs('services.index') ? 'active' : '' }}">Courts</a>
                <a href="{{ route('contact') }}"
                   class="nav-item nav-link {{ Request::routeIs('contact') ? 'active' : '' }}">Contact Us</a>
            </div>
            @auth
                <!-- If the user is authenticated -->
                <a href="{{ url('/') }}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Dashboard</a>
            @else
                <!-- If the user is not authenticated -->
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Login</a>
            @endauth
        </div>
    </nav>
</div>
