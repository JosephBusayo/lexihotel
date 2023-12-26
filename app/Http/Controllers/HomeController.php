<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // return "Hello";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome', [
            'pageTitle' => "Homepage",
        ]);
    }

    public function news()
    {
        $admin = User::where('is_admin', 1)->first();

        return view('welcome', [
            'pageTitle' => 'Welcome Page',
            'admin' => $admin,
        ]);
    }
}