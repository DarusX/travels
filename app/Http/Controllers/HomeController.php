<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::has('timezone')) Session::put('timezone', config('app.timezone'));
        return view('home');
    }

    public function timezone(Request $request)
    {
        Session::put('timezone', $request->timezone);
        return redirect()->back();
    }
}
