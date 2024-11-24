<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalEvents = Event::count();
        $totalReservations = Reservation::count();

        $latestUsers = User::latest()->take(5)->get();

        // Fetch reservations count by event
        $events = Event::withCount('reservations')->get();

        // Check if the user is authenticated
        $user = auth()->user();

        // Check the role of the user and redirect accordingly
        if ($user->role === 'user') {
            return view('dashboard.user');
        }


        return view('dashboard.admin', [
            'data' => compact('totalUsers', 'totalAdmins', 'totalEvents', 'totalReservations', 'latestUsers',),
            'events' => $events
        ]);
    }

}
