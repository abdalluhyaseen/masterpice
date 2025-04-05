@include('landing_page.includes.head')
@include('landing_page.includes.topbar')
@include('landing_page.includes.nav')
@include('landing_page.includes.spinner')


@yield('content')


@include('landing_page.includes.footer')