<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Debt;
use App\Models\Discount;
use App\Models\Floor;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uid)
    {
        //find room
        $room = Room::findByUid($uid);
        abort_if(!$room, 404);
        // check if room is booked
        if (!$room->is_clean) {
            $notify[] = ['warning', $room->name . ' untidy'];
            return redirect()->back()->withNotify($notify);
        }
        $pageTitle = 'Booking Room; ' . $room->name;

        return view('admin.bookings.index', compact('pageTitle', 'room'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uid)
    {
        // dd($request->all());

        $room = Room::findByUid($uid);
        abort_if(!$room, 404);

        $data = $request->validate([
            'checkin' => 'required',
            'checkout' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'booking_option' => 'required',
            'duration' => 'required',
        ]);
        if ($data['booking_option'] != 'cancel' || $data['booking_option'] != 'reserved') {
            $data['payment_type'] = $request->validate(['payment_type' => 'required']);
        }

        // generate tracking code
        $trackingCode = getTrx(10);

        // totalAmount
        $totalAmount = (int) $data['duration'] * (int) $room->category->price;

        // amount paid
        $amountPaid = array_sum($request->transaction);

        // check for discount
        if ($request->has('applydiscount') && $request->applydiscount == 'on') {
            $totalAmount = $totalAmount - $request->discount;
        }

        // check for debt
        if ($request->has('applydebt') && $request->applydebt == 'on') {
            $debt = new Debt();
            $debt->amount = $totalAmount;
            $debt->tracking_no = $trackingCode;
            $debt->user_id = Auth::user()->id;
            $debt->customer_id = null;
            $debt->amount_paid = $amountPaid;
            $debt->created_at = businessDay()->current_date;
            $debt->save();

        } else {
            if ($data['booking_option'] == 'checkin') {
                if ($amountPaid < $totalAmount) {
                    $notify[] = ['warning', ' amount paid is lower than booking amount'];
                    return back()->withNotify($notify);
                }
            }

        }

        $customer = Customer::where('name', $data['customer_name'])->first();
        if (!$customer) {
            $customer = Customer::create([
                'name' => $data['customer_name'],
                'mobile' => $data['customer_mobile'],
                'address' => ($request->customer_address) ? $request->customer_address : null,
                'created_at' => businessDay()->current_date
            ]);
        }

        // save customer ID
        $debt = Debt::where('tracking_no', $trackingCode)->first();
        if ($debt) {
            $debt->customer_id = $customer->id;
            $debt->save();
        }

        // check if there's a discount
        if ($request->has('applydiscount') && $request->applydiscount == 'on') {
            $discount = new Discount();
            $discount->amount = $request->discount;
            $discount->tracking_no = $trackingCode;
            $discount->user_id = Auth::user()->id;
            $discount->customer_id = $customer->id;
            $discount->created_at = businessDay()->current_date;
            $discount->save();
        }

        // save booking
        $booking = Booking::create([
            'per_night' => $request->per_night,
            'checkin' => $data['checkin'],
            'checkout' => $data['checkout'],
            'amount' => $totalAmount,
            'room_id' => $room->id,
            'trx' => $trackingCode,
            'customer_id' => $customer->id,
            'booking_option' => $data['booking_option'],
            'payment_type' => $request->payment_type,
            'duration' => $data['duration'],
            'status' => ($data['booking_option'] == 'reserved') ? 2 : 1,
            'user_id' => Auth::user()->id,
            'created_at' => businessDay()->current_date
        ]);

        // save payment
        if ($request->transaction['pos'] >= 0 || $request->transaction['pos'] == null) {
            Payment::create([
                'name' => 'pos',
                'booking_id' => $booking->id,
                'trx' => $booking->uid,
                'amount' => $request->transaction['pos'] ?? 0,
                'user_id' => Auth::user()->id,
                'customer_id' => $customer->id,
            ]);
        }
        if ($request->transaction['cash'] >= 0 || $request->transaction['cash'] == null) {

            Payment::create([
                'name' => 'cash',
                'booking_id' => $booking->id,
                'trx' => $booking->uid,
                'amount' => $request->transaction['cash'] ?? 0,
                'user_id' => Auth::user()->id,
                'customer_id' => $customer->id,
            ]);
        }
        if ($request->transaction['transfer'] >= 0 || $request->transaction['transfer'] == null) {
            Payment::create([
                'name' => 'transfer',
                'booking_id' => $booking->id,
                'trx' => $booking->uid,
                'amount' => $request->transaction['transfer'] ?? 0,
                'user_id' => Auth::user()->id,
                'customer_id' => $customer->id,
            ]);
        }

        if ($booking->status == 2) {
            $room->is_available = true;
            $room->is_booked = 2;
        } else {
            $room->is_available = false;
            $room->is_booked = 1;
        }
        $room->save();

        $notify[] = ['success', $booking->room->name ?? null . ' Booked successfully'];
        return redirect()->route('admin.booking.receipt', $booking->uid)->withNotify($notify);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function receipt($uid)
    {
        $booking = Booking::findByUid($uid);
        $payment = Payment::findByUid($uid);

        return view('admin.bookings.receipt', compact('booking', 'payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function list() {
        //find bookings
        $bookings = Booking::where('status', '<=', 2)->latest()->get();
        $pageTitle = 'Bookings';
        $totalBookingAmount = $bookings->sum('amount');
        return view('admin.bookings.list', compact('pageTitle', 'bookings', 'totalBookingAmount'));
    }

    public function checkoutRoom(Request $request)
    {
        // return $request->all();
        // find booking by ID
        $booking = Booking::findByUid($request->uid);
        // check if there is pending debt
        $debt = Debt::where('tracking_no', $booking->trx)->first();
        if ($debt) {
            // check if debt is cleared
            if (!$debt->cleared) {
                return response()->json(['msg' => 'debt']);
            }
        }
        $checkinDate = Carbon::parse($booking->checkin);
        $checkoutDate = Carbon::parse($booking->checkout);
        $todayDate = businessDay()->current_date;

        // check if checkout date match
        if ($checkoutDate->greaterThan($todayDate)) {
            return response()->json(['msg' => 'notdue']);
        }
        $booking->status = 3;
        $booking->checkout_time = $todayDate;
        $booking->save();
        $booking->room->is_clean = false;
        $booking->is_available = true;
        $booking->is_booked = 0;
        $booking->room->save();
        return response()->json(['msg' => 'checkout']);
        //password

    }

    public function postCheckoutRoom(Request $request)
    {
        // dd($request->all());
        // find booking by ID
        $booking = Booking::findByUid($request->uid);
        // dd($booking);
        // check if there is pending debt
        $debt = Debt::where('tracking_no', $booking->trx)->where('cleared', 0)->first();
        if ($debt) {
            $notify[] = ['warning', 'This transaction has a pending debt to be settled'];
            return back()->withNotify($notify);
        }
        $checkinDate = Carbon::parse($booking->checkin);
        $checkoutDate = Carbon::parse($booking->checkout);
        $todayDate = businessDay()->current_date;

        // check if checkout date match
        if (!$checkoutDate->isSameAs($todayDate)) {
            $notify[] = ['warning', 'Room not overdue'];
            return back()->withNotify($notify);
        }
        $booking->status = 3;
        $booking->save();
        $booking->room->is_booked = 0;
        $booking->room->is_available = true;
        $booking->room->is_clean = false;
        $booking->room->save();
        $notify[] = ['success', 'Room checkout successfully'];
        return back()->withNotify($notify);

    }

    public function getCheckoutRoom(Request $request)
    {
        $booking = Booking::with('room')->where('room_id', $request->id)->first();
        return view('admin.frontdesk._modal.checkout-modal', compact('booking'));
    }

    public function getCleanRoom(Request $request)
    {
        $room = Room::findByUid($request->uid);
        return view('admin.frontdesk._modal.clean-modal', compact('room'));
    }

    public function getPayDebt(Request $request)
    {
        $debt = Debt::find($request->id);
        $booking = Booking::where('trx', $debt->tracking_no)->first();
        return view('admin.frontdesk._modal.paydebt-modal', compact('booking'));
    }

    public function cancelRoom(Request $request, $uid)
    {
        // find booking by ID
        $booking = Booking::findByUid($uid);
        // dd($booking);
        // check if room has not exceed an hour
        $start_time = new Carbon($booking->created_at->format('h:i:s a'));

        $end_time = new Carbon(date('h:i:s a'));
        $diff = $end_time->diffInHours($start_time);
        if ($booking->status != 2) {
            if ($diff >= 2) {
                $notify[] = ['warning', 'This booking can not be cancel as it has exceed an hour'];
                return redirect()->back()->withNotify($notify);
                //return response()->json(['msg' => 'unavailable']);
            }
        }
        $booking->status = 4;
        $booking->cancel_reason = $request->cancel_reason;
        $booking->save();

        // make room available
        $booking->room->is_available = true;
        $booking->room->is_booked = false;
        $booking->room->is_clean = true;
        $booking->room->save();

        $notify[] = ['success', $booking->room->name . ' Canceled Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function activateRoom(Request $request, $uid)
    {
        // find booking by ID
        $booking = Booking::findByUid($uid);
        // dd($booking);
        $checkinDate = Carbon::parse($booking->checkin)->startOfDay();
        $todayDate = Carbon::now()->startOfDay();

        // if (!$checkinDate->isSameDay($todayDate)) {

        //     $notify[] = ['warning', 'This booking cannot be activated today'];
        //     return redirect()->back()->withNotify($notify);

        // }

        // check for payment
        // totalAmount
        $totalAmount = (int) $booking->duration * (int) $booking->room->category->price;

        // amount paid
        $amountPaid = array_sum($request->transaction);

        // check for discount
        $discount = Discount::where('tracking_no', $booking->trx)->first();
        if ($discount) {
            # subtract the discount from the amount
            $amountPaid -= $discount->amount;
        }
        // check if amount is cleared
        if ($amountPaid < $totalAmount) {
            $notify[] = ['warning', 'This booking can only be cleared once'];
            return redirect()->back()->withNotify($notify);
        }

        // save payment
        if ($request->transaction['pos'] >= 0 || $request->transaction['pos'] == null) {
            $payment = Payment::where('name', 'pos')
                ->where('booking_id', $booking->id)
                ->first();
            $payment->update(['amount' => $request->transaction['pos'] ?? 0]);
        }
        if ($request->transaction['cash'] >= 0 || $request->transaction['cash'] == null) {

            $payment = Payment::where('name', 'cash')
                ->where('booking_id', $booking->id)
                ->first();
            $payment->update(['amount' => $request->transaction['cash'] ?? 0]);
        }
        if ($request->transaction['transfer'] >= 0 || $request->transaction['transfer'] == null) {
            $payment = Payment::where('name', 'transfer')
                ->where('booking_id', $booking->id)
                ->first();
            $payment->update(['amount' => $request->transaction['transfer'] ?? 0]);
        }
        $booking->status = 1;
        $booking->save();
        // make room available
        $booking->room->is_available = false;
        $booking->room->is_booked = true;
        $booking->room->is_clean = false;
        $booking->room->save();

        $notify[] = ['success', $booking->room->name . ' activated Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function payDebt(Request $request, $uid)
    {
        $booking = Booking::findByUid($uid);
        abort_if(!$booking, 404);

        // find debt
        $debt = Debt::where('tracking_no', $booking->trx)->where('cleared', 0)->first();
        if ($debt) {
            // amount paid
            $amountPaid = array_sum($request->transaction);
            // dd($debt->amount);
            if ($amountPaid < ($debt->amount - $debt->amount_paid)) {
                $notify[] = ['warning', ' Insufficient Amount, Debt can only be paid once'];
                return back()->withNotify($notify);
            }

            $debt->cleared = true;
            $debt->amount_paid = $amountPaid + $debt->amount_paid;
            $debt->cleared_by = Auth::user()->id;
            $debt->date_cleared = Carbon::now();
            $debt->save();

            // payments
            foreach ($request->transaction as $key => $value) {
                // dd($key);
                $payment = Payment::where('trx', $booking->uid)->where('name', $key)->first();
                if ($payment) {
                    $sumAmount = $payment->amount + $value;
                    $payment->amount = $sumAmount;
                    $payment->save();
                }
            }

        }
        $notify[] = ['success', ' Debt Cleared successfully'];
        return back()->withNotify($notify);
    }

    public function getCancelRoom(Request $request)
    {
        $booking = Booking::with('room')->where('room_id', $request->id)->first();
        return view('admin.frontdesk._modal.cancel-modal', compact('booking'));
    }

    public function reservation()
    {
        $pageTitle = 'Reservations';
        $floors = Floor::with(['room'])->get();
        $rooms = Room::onlyAvailable()->onlyClean()->get(['id', 'name', 'price']);
        return view('admin.frontdesk.reservation', compact('pageTitle', 'floors', 'rooms'));

    }

    public function reserveRoom(Request $request)
    {
        // find room
        $room = Room::findorfail($request->room);

        // validate
        $data = $request->validate([
            'checkin' => 'required',
            'checkout' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'duration' => 'required',
            'payment_type' => 'required',
        ]);

        // check if checkin is not today
        $checkinDate = Carbon::parse($data['checkin'])->startOfDay();
        $todayDate = Carbon::now()->startOfDay();
        // check if checkout date match
        if ($todayDate->equalTo($checkinDate)) {
            $notify[] = ['info', 'You cannot reserve room for today'];
            return redirect()->back()->withNotify($notify);
        }

        $trackingCode = getTrx(10);
        $totalAmount = (int) $data['duration'] * (int) $room->category->price;
        $amountPaid = array_sum($request->transaction);

        // check for discount
        if ($request->has('applydiscount') && $request->applydiscount == 'on') {
            $totalAmount = $totalAmount - $request->discount;
        }
        // check for debt
        if ($request->has('applydebt') && $request->applydebt == 'on') {
            $debt = new Debt();
            $debt->amount = $totalAmount;
            $debt->tracking_no = $trackingCode;
            $debt->user_id = Auth::user()->id;
            $debt->customer_id = null;
            $debt->amount_paid = $amountPaid;
            $debt->save();

        } else {
            if ($amountPaid < $totalAmount) {
                $notify[] = ['info', ' amount paid is lower than booking amount'];
                return back()->withNotify($notify);
            }

        }

        $customer = Customer::firstOrCreate(
            ['name' => request('customer_name')],
            [
                'name' => request('customer_name'),
                'mobile' => request('customer_mobile'),
                'address' => (request('customer_address')) ? request('customer_address') : null,
            ]
        );

        // save customer ID
        $debt = Debt::where('tracking_no', $trackingCode)->first();
        if ($debt) {
            $debt->customer_id = $customer->id;
            $debt->save();
        }

        // check if there's a discount
        if ($request->has('applydiscount') && $request->applydiscount == 'on') {
            $discount = new Discount();
            $discount->amount = $request->discount;
            $discount->tracking_no = $trackingCode;
            $discount->user_id = Auth::user()->id;
            $discount->customer_id = $customer->id;
            $discount->save();
        }

        // save booking
        $booking = Booking::create([
            'per_night' => $room->price,
            'checkin' => $data['checkin'],
            'checkout' => $data['checkout'],
            'amount' => $totalAmount,
            'room_id' => $room->id,
            'trx' => $trackingCode,
            'customer_id' => $customer->id,
            'booking_option' => 'reserved',
            'payment_type' => $request->payment_type,
            'duration' => $data['duration'],
            'status' => 2,
            'user_id' => Auth::user()->id,
        ]);

        // save payment
        if ($request->transaction['pos'] >= 0 || $request->transaction['pos'] == null) {
            Payment::create([
                'name' => 'pos',
                'booking_id' => $booking->id,
                'trx' => $booking->uid,
                'amount' => $request->transaction['pos'] ?? 0,
                'user_id' => Auth::user()->id,
                'customer_id' => $customer->id,
            ]);
        }
        if ($request->transaction['cash'] >= 0 || $request->transaction['cash'] == null) {
            Payment::create([
                'name' => 'cash',
                'booking_id' => $booking->id,
                'trx' => $booking->uid,
                'amount' => $request->transaction['cash'] ?? 0,
                'user_id' => Auth::user()->id,
                'customer_id' => $customer->id,
            ]);
        }
        if ($request->transaction['transfer'] >= 0 || $request->transaction['transfer'] == null) {
            Payment::create([
                'name' => 'transfer',
                'booking_id' => $booking->id,
                'trx' => $booking->uid,
                'amount' => $request->transaction['transfer'] ?? 0,
                'user_id' => Auth::user()->id,
                'customer_id' => $customer->id,
            ]);
        }
        $room->is_available = true;
        $room->is_booked = 2;

        $room->save();

        $notify[] = ['success', $booking->room->name ?? null . ' Reserved successfully'];
        return redirect()->route('admin.booking.receipt', $booking->uid)->withNotify($notify);

    }

    public function listReservation()
    {
        $pageTitle = 'All Reservations';
        $bookings = Booking::onlyReserved()->get();
        return view('admin.bookings.list-reservations', compact('pageTitle', 'bookings'));
    }
}
