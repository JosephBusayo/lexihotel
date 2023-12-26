<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Debt;
use App\Models\Discount;
use App\Models\Floor;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxRequestController extends Controller
{
    // get Category
    public function getCategory(Request $request)
    {
        $category = Category::where('id', $request->category)->first();
        if (!$category) {
            return response()->json(['msg' => 'not found'], 404);
        }
        return response()->json(['category' => $category]);
    }

    public function getRooms()
    {
        $rooms = Room::where('status', 1)->get();

        $all_rooms = $rooms->load(['floor', 'category', 'booking']);

        $floors = Floor::where('status', 1)->get()->load(['building']);

        return response()->json(['all_room' => $all_rooms, 'floors' => $floors]);
    }

    public function getDiscount(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $discounts = Discount::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $discounts = $discounts->where('user_id', $request->user);
        }
        $total = $discounts->sum('amount');
        $discounts = $discounts->get();

        return view('admin.reports.datas.show-discount', compact('discounts', 'total', 'start_date', 'end_date'));
    }

    public function getDebt(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $debts = Debt::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $debts = $debts->where('user_id', $request->user);
        }
        $total = $debts->sum('amount');
        $debts = $debts->get();

        return view('admin.reports.datas.show-debt', compact('debts', 'total', 'start_date', 'end_date'));
    }

    public function getCancel(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        // return $request->all();
        $bookings = DB::table('bookings')->where('status', 4)->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $bookings = $bookings->where('user_id', $request->user);
        }
        $total = $bookings->sum('amount');
        $bookings = $bookings->get();
        $cash = null;
        $transfer = null;
        $pos = null;
        foreach ($bookings as $key => $value) {
            $cash = Payment::where('name', 'cash')->where('trx', $value->uid)
                ->sum('amount');
            $transfer = Payment::where('name', 'transfer')->where('trx', $value->uid)
                ->sum('amount');
            $pos = Payment::where('name', 'pos')->where('trx', $value->uid)
                ->sum('amount');
        }
        // cash

        // return $bookings;
        return view('admin.reports.datas.show-cancel', compact('bookings', 'total', 'cash', 'transfer', 'pos', 'start_date', 'end_date'));
    }

    public function getSales(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $debts = Debt::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $debts = $debts->where('user_id', $request->user);
        }
        $total = $debts->sum('amount');
        $debts = $debts->get();

        return view('admin.reports.datas.show-sales', compact('debts', 'total', 'start_date', 'end_date'));
    }

    public function getReservation(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $bookings = Booking::where('status', 2)->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $bookings = $bookings->where('user_id', $request->user);
        }
        $bookings = $bookings->get();
        $total = $bookings->sum('amount');
        return view('admin.reports.datas.show-reservation', compact('total', 'bookings', 'start_date', 'end_date'));
    }

    public function getGeneral(Request $request)
    {
        // return $request->all();
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $user = $request->user;
        $bookings = Booking::where('status', '=', 1)->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $bookings = $bookings->where('user_id', $request->user);
        }
        $total = $bookings->sum('amount');
        $bookings = $bookings->get();

        $debt = Debt::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->where('cleared', 0);
        if ($request->user != 'all') {
            $debt = $debt->where('user_id', $request->user);
        }
        $debt = $debt->sum('amount');

        $cash = Payment::where('name', 'cash')
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $cash = $cash->where('user_id', $request->user);
        }
        $cash = $cash->sum('amount');

        $transfer = Payment::where('name', 'transfer')
            ->where('status', 1)
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $transfer = $transfer->where('user_id', $request->user);
        }
        $transfer = $transfer->sum('amount');

        $pos = Payment::where('name', 'pos')
            ->where('status', 1)
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $pos = $pos->where('user_id', $request->user);
        }
        $pos = $pos->sum('amount');

        $discount = Discount::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        if ($request->user != 'all') {
            $discount = $discount->where('user_id', $request->user);
        }
        $discount = $discount->sum('amount');

        return view('admin.reports.datas.show-general', compact('discount', 'pos', 'cash', 'transfer', 'debt', 'bookings', 'total', 'start_date', 'end_date', 'user'));
    }

    public function getBookingDetail(Request $request)
    {

        $booking = Booking::with('room')->where('room_id', $request->id)->first();
        return view('admin.frontdesk._modal.view-detail', compact('booking'));
    }

    public function getCancelRoom(Request $request)
    {
        $booking = Booking::with('room')->where('room_id', $request->id)->first();
        return view('admin.frontdesk._modal.cancel-modal', compact('booking'));
    }

    public function getCheckoutRoom(Request $request)
    {
        $booking = Booking::with('room')->where('room_id', $request->id)->first();
        return view('admin.frontdesk._modal.checkout-modal', compact('booking'));
    }

}
