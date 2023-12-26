<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;

class ReportController extends Controller
{
    //discount report
    public function showDiscount()
    {
        $pageTitle = "Discount Reports";
        $users = User::where('status', 1)->get();
        return view('admin.reports.discount', compact('pageTitle', 'users'));
    }

    //discount report
    public function showDebt()
    {
        $pageTitle = "Debt Reports";
        $users = User::where('status', 1)->get();
        return view('admin.reports.debt', compact('pageTitle', 'users'));
    }

    //discount report
    public function showCancel()
    {
        $pageTitle = "Cancel Reports";
        $users = User::where('status', 1)->get();
        return view('admin.reports.cancel', compact('pageTitle', 'users'));
    }
    //discount report
    public function showSales()
    {
        $pageTitle = "Sales Reports";
        $users = User::where('status', 1)->get();
        return view('admin.reports.sales', compact('pageTitle', 'users'));
    }

    public function showReserve()
    {
        $pageTitle = "Reserve Reports";
        $users = User::where('status', 1)->get();
        return view('admin.reports.reserve', compact('pageTitle', 'users'));
    }

    public function showVacant()
    {
        $pageTitle = "Vacant Room Reports";
        $users = User::where('status', 1)->get();
        $rooms = Room::where('is_available', 1)->orderBy('category_id', 'ASC')->get();
        return view('admin.reports.vacant', compact('pageTitle', 'users', 'rooms'));
    }

    public function showGeneral()
    {
        $pageTitle = "General Room Reports";
        $users = User::where('status', 1)->get();
        $rooms = Room::where('is_available', 1)->orderBy('category_id', 'ASC')->get();
        return view('admin.reports.general', compact('pageTitle', 'users', 'rooms'));
    }

}
