<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Caching totals for improved performance
        $totals = Cache::remember('dashboard_totals', now()->addMinutes(10), function () {
            return [
                'totalUsers' => User::count(),
                'totalAdmins' => User::where('role', 'admin')->count(),
                'totalEvents' => Event::count(),
                'totalReservations' => Reservation::count(),
            ];
        });

        // Fetch latest users with eager loading
        $latestUsers = Cache::remember('latest_users', now()->addMinutes(10), function () {
            return User::latest()->take(5)->get(['id', 'name', 'email', 'role', 'created_at']);
        });

        // Fetch events with reservations count using eager loading
        $events = Cache::remember('events_with_reservations', now()->addMinutes(10), function () {
            return Event::withCount('reservations')->latest()->take(10)->get(['id', 'name', 'date']);
        });

        // Check if the user is authenticated
        $user = Auth::user();

        // Redirect based on user role
        if ($user->role === 'user') {
            return view('dashboard.user', compact('user'));
        }

        // Return admin dashboard view
        return view('dashboard.admin', [
            'data' => $totals + ['latestUsers' => $latestUsers],
            'events' => $events,
        ]);
    }
}
