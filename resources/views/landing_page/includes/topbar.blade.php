<!-- Topbar Start -->
<div class="container-fluid topbar bg-light px-5 d-none d-lg-block">
    @auth
    <!-- تظهر فقط إذا كان المستخدم مسجل دخول -->
    <div class="row gx-0 align-items-center">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <!-- <div class="d-flex flex-wrap">
                <a href="#" class="text-muted small me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                <a href="tel:+01234567890" class="text-muted small me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                <a href="mailto:example@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
            </div> -->
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                @auth

                <div class="dropdown ms-4">
                    <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                        <small><i class="fa fa-home text-primary me-2"></i>{{ Auth::user()->name }}</small>
                    </a>
                    <div class="dropdown-menu rounded">
                        <a href="{{ route('profile')}}" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                        @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
                        <a href="{{ url('/dash') }}" class="dropdown-item">
                            <i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard
                        </a>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}" class="dropdown-item" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               <i class="fas fa-power-off me-2"></i> Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
    @endauth
</div>
<!-- Topbar End -->
