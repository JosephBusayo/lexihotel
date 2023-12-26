<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'End Business Day';
        return view('admin.business-day.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBusinessDay(Request $request)
    {
        $businessDay = BusinessDay::query()
            ->where('status', 1)
            ->first();

        abort_if(!$businessDay, 404);

        if (date('Y-m-d') == date('Y-m-d', strtotime($businessDay->current_date))) {
            $notify[] = ['error', ' You cannot end business on current date'];
            return back()->withNotify($notify);
        }

        $businessDay->current_date = Carbon::now();
        $businessDay->save();

        $notify[] = ['success', ' Business day end successfully'];
        return redirect('/admin/dashboard')->withNotify($notify);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessDay  $businessDay
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessDay $businessDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessDay  $businessDay
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessDay $businessDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessDay  $businessDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessDay $businessDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessDay  $businessDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessDay $businessDay)
    {
        //
    }
}
