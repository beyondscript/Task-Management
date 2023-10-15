<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.home');
    }

    public function revokedSupervisorHome()
    {
        return view('supervisor.revokedHome');
    }

    public function supervisorHome()
    {
        return view('supervisor.home');
    }

    public function home()
    {
        return view('stuff.home');
    }
}
