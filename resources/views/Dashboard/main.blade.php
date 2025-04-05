@extends('Dashboard.master')
@section('content')
<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Overview</h2>
                        </div>
                    </div>
                </div>

                {{-- User Statistics: Display the number of users and admins --}}
                <div class="stats-container">
                    <div class="stat-card red">
                        <div class="icon">
                            <i class="fas fa-calendar-check" style="color: #00d084;"></i>
                        </div>
                        <div class="text">Bookings</div>
                        <div class="number">{{ $bookingsCount }}</div>
                    </div>
                    <div class="stat-card red">
                        <div class="icon">
                            <i class="fas fa-calendar-check" style="color: #00d084;"></i>
                        </div>
                        <div class="text">Today's Reservations</div>
                        <div class="number">{{ $todayReservations }}</div>
                    </div>
                    <div class="stat-card red">
                        <div class="icon">
                            <i class="fas fa-calendar-check" style="color: #00d084;"></i>
                        </div>
                        <div class="text">Month's Reservations</div>
                        <div class="number">{{ $monthReservations }}</div>
                    </div>
                    <div class="stat-card red">
                        <div class="icon">
                            <i class="fas fa-calendar-check" style="color: #00d084;"></i>
                        </div>
                        <div class="text">Year's Reservations</div>
                        <div class="number">{{ $yearReservations }}</div>
                    </div>
                    <div class="stat-card blue">
                        <div class="icon">
                            <i class="fa-solid fa-user-tie" style="color: #00d084;"></i>
                        </div>
                        <div class="text">Admins</div>
                        <div class="number">{{ $adminsCount }}</div>
                    </div>
                    <div class="stat-card green">
                        <div class="icon">
                            <i class="fa-solid fa-user" style="color: #00d084;"></i>
                        </div>
                        <div class="text">Users</div>
                        <div class="number">{{ $usersCount }}</div>
                    </div>
                    <div class="stat-card purple">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill" style="color: #00d084;"></i>
                        </div>
                        <div class="text">PlayZones</div>
                        <div class="number">{{ $fieldsCount }}</div>
                    </div>
                </div>
                {{-- end User Statistics --}}

                {{-- Booking Charts --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h3>Bookings Overview</h3>
                        <br>
                        <br>
                        <br>
                        <canvas id="bookingChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h3 class="h3bokking">Users vs Admins</h3>
                        <br>
                        <br>
                        <br>
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Booking Chart
        var ctx = document.getElementById('bookingChart').getContext('2d');
        var bookingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Today', 'This Month', 'Not Booked'], // Add 'Not Booked' dynamically if needed
                datasets: [{
                    label: 'Bookings',
                    data: [{{ $todayReservations }}, {{ $monthReservations }}, {{ $bookingsCount - ($todayReservations + $monthReservations) }}], // Example data
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // User Chart
        var ctx2 = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['superadminsCount', 'Admins','Users'],
                datasets: [{
                    label: 'Users vs Admins',
                    data: [{{ $superadminsCount }}, {{ $adminsCount }},{{ $usersCount }}],
                    backgroundColor: [ 'rgba(255, 159, 64, 0.2)','rgba(153, 102, 255, 0.2)','rgba(75, 192, 192, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)','rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            }
        });
    });
</script>
@endsection
