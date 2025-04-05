        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src={{asset("Dashboard/images/iccon/logo.png")}} alt="PlayZone logo" />    {{-- RGD --}}
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="{{url('dash')}}">
                                <i class="fas fa-tachometer-alt" style="color: #00d084;"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar" style="color: #00d084;"></i>My Fields</a>
                        </li>
                        {{-- RGD --}}
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fa-solid fa-futbol" style="color: #00d084;"></i>Sports</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{route('sport-types.create')}}"><i class="fa-regular fa-plus" style="color: #00d084;"></i>Add sport</a>
                                </li>
                                <li>
                                    <a href="index2.html">Sport Details</a>
                                </li>
                            </ul>
                        </li>
                        {{-- /RGD --}}
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table" style="color: #00d084;"></i>Subscribers/Users</a>
                        </li>
                        <li>
                            <a href="{{route('bookings.index')}}">
                                <i class="far fa-check-square" style="color: #00d084;"></i>Reservations Details</a>
                        </li>
                        <li>
                            <a href="{{url('contact-us')}}">
                                <i class="fas fa-calendar-alt" style="color: #00d084;"></i>User comments</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{url('dash')}}">
                    <img src="{{ asset('landing/img/image.png') }}" alt="PlayZone logo" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        {{-- /RGD --}}
                        <li>
                            <a href="{{url('dash')}}">
                                <i class="fa-solid fa-users" style="color: #00d084;"></i>Dashboard</a>
                        </li>
                        {{-- Add sports --}}
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fa-solid fa-users" style="color: #00d084;"></i>Subscribers/Users</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{url('dash/create-user')}}"><i class="fa-regular fa-plus" style="color: #00d084;"></i>Add User</a>
                                </li>
                                <li>

                                    <a href="{{url('users')}}"><i class="fa-solid fa-users" style="color: #00d084;"></i>User Details</a>
                                </li>
                            </ul>
                        </li>    
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fa-solid fa-futbol" style="color: #00d084;"></i>Sports</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{route('sport-types.create')}}"><i class="fa-regular fa-plus" style="color: #00d084;"></i>Add sport</a>
                                </li>
                                <li>
                                    <a href="{{route('sport-types.index')}}"><i class="fa-solid fa-table" style="color: #00d084;"></i>Sports Details</a>
                                </li>
                            </ul>
                        </li>    
                     <!-- zaina change -->
                      <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fa-regular fa-paste" style="color: #00d084;"></i>Fields</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                     <a href="{{route('fields.create')}}"><i class="fa-solid fa-plus"></i>New Field</a>
                                </li>
                               <li>
                        <a href="{{route('fields.index')}}">
                           <i class="fa-regular fa-futbol" style="color: #00d084;"></i> All Field</a>
                        </li>
                               
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('bookings.index')}}">
                                <i class="far fa-check-square" style="color: #00d084;"></i>Booking Details</a>
                        </li>
                   
                        <!-- zaina change -->
                        <li>
                            <a href="{{url('dash/contact-us')}}">
                                <i class="fas fa-comments" style="color: #00d084;"></i> User comments
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        {{-- <div class="page-container">           //this tag moved to main page--}}
            <!-- HEADER Navbar DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        {{-- <div class="image">
                                            <img src="{{ asset($admin_profile->image) }}" alt="Admin user Image" class="card-img-top img-thumbnail">
                                        </div> --}}
                                        <div class="content">
                                            <a role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}   
                                                {{-- تعديل --}}
                                            </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                {{-- <div class="image">
                                                    <img src="{{ asset($admin_profile->image) }}" alt="Admin user Image" class="card-img-top img-thumbnail">
                                                </div> --}}
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                            {{ Auth::user()->name }}
                                                        </a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ url('/') }}">
                                                        <i class="zmdi zmdi-home"></i>Home
                                                    </a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href={{route('a_profile.index')}}>
                                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                                </div>
                                            
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="zmdi zmdi-power"></i>Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER Navbar DESKTOP-->
