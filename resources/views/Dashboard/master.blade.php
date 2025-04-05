<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="icon" href="{{ asset('landing/img/playzone-favicon-color.png') }}" type="image/png">

    <!-- Title Page-->
    <title>PlayZone-Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('Dashboard/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('Dashboard/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('Dashboard/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('Dashboard/css/theme.css') }}" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- FontAwesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body{
            background-color: #fff;
        }
        .header-wrap {
    display: flex;
    justify-content: flex-end; 
    align-items: center; 
}
.copyright {
    margin-top: 200px; /* Adjust the value as needed */
}
.stats-container{
    margin-bottom: 100px; /* Adjust the value as needed */

}
.h3bokking{
    margin-left: 160px;
}
        .stats-container {
            display: flex;
            flex-wrap: wrap; 
            width: 100%;
            gap: 20px; 
            padding: 20px;
            box-sizing: border-box;
        }
        .stat-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            flex: 1 1 calc(25% - 20px); 
            max-width: calc(25% - 20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease; 
            box-sizing: border-box;
        }
        .stat-card:hover {
            transform: translateY(-10px); 
        }
        .stat-card .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        .stat-card .text {
            font-size: 18px;
            color: #888;
            margin-bottom: 10px;
        }
        .stat-card .number {
            font-size: 24px;
            font-weight: bold;
        }
        .stat-card.blue .icon {
            color: #007bff;
        }
        .stat-card.green .icon {
            color: #28a745;
        }
        .stat-card.purple .icon {
            color: #6f42c1;
        }
        .stat-card.red .icon {
            color: #dc3545;
        }    
        </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('Dashboard.include.header')
        @yield('content')
        @include('Dashboard.include.footer')
    </div>

    <!-- Scripts -->

    <!-- Font Awesome Script -->
    <script src="https://kit.fontawesome.com/41e45c37a6.js" crossorigin="anonymous"></script>

    <!-- Jquery JS-->
    <script src="{{ asset('Dashboard/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('Dashboard/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('Dashboard/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('Dashboard/js/main.js') }}"></script>

</body>

</html>
