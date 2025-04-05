<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Field;
use App\Models\Booking; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $adminsCount = User::where('role', 'admin')->count();
        $superadminsCount = User::where('role', 'superadmin')->count();
        $fieldsCount = Field::count();
        $bookingsCount = Booking::count();

        // Reservation counts
        $todayReservations = Booking::whereDate('created_at', Carbon::today())->count();
        $monthReservations = Booking::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $yearReservations = Booking::whereYear('created_at', Carbon::now()->year)->count();

        $users = User::all();

        return view('dashboard.main', compact('users', 'usersCount', 'adminsCount','superadminsCount', 'fieldsCount', 'bookingsCount', 'todayReservations', 'monthReservations', 'yearReservations'));
    }
}
