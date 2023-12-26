<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Floor;
use App\Models\Room;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // totalSales
        $totalSales = Booking::whereDate('created_at', date('Y-m-d'))->where('status', '<', 2)->sum('amount');

        // totalCheckedIn
        $totalCheckedIn = Booking::whereDate('created_at', date('Y-m-d'))->where('status', 1)->count();

        // totalCheckedOut
        $totalCheckedOut = Booking::whereDate('created_at', date('Y-m-d'))->where('status', 2)->count();

        // totalReserved
        $totalReserved = Booking::whereDate('created_at', date('Y-m-d'))->where('status', 2)->count();

        // recent 5 transactions
        $bookings = Booking::where('status', 1)
            ->latest()
            ->take(5)
            ->get();

        // recent 5 rooms
        $rooms = Room::where('is_available', 1)
            ->latest()
            ->take(5)
            ->get();

        $reservations = Booking::onlyReserved()->get();

        return view('admin/dashboard/index', [
            'pageTitle' => 'Dashboard',
            'totalSales' => $totalSales,
            'totalCheckedIn' => $totalCheckedIn,
            'totalCheckedOut' => $totalCheckedOut,
            'totalReserved' => $totalReserved,
            'bookings' => $bookings,
            'rooms' => $rooms,
            'reservations' => $reservations,
        ]);
    }

    public function frontdesk()
    {
        $pageTitle = 'Front Desk';
        $floors = Floor::with(['room'])->get();
        return view('admin.frontdesk.index', compact('pageTitle', 'floors'));
    }
}
