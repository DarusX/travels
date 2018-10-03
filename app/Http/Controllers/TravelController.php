<?php

namespace App\Http\Controllers;

use App\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Status;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Timezone;

class TravelController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('travels.index')->with([
            'travels' => Travel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return Carbon::parse($request->end_datetime);
        Auth::user()->travels()->create([
            'budget' => $request->budget,
            'travel' => $request->travel,
            'start_datetime' => Carbon::createFromFormat('Y-m-d H:i', "{$request->start_datetime}"),
            'end_datetime' => Carbon::createFromFormat('Y-m-d H:i', "{$request->end_datetime}"),
            'start_timezone_id' => Timezone::whereTimezone(Session::get('timezone'))->first()->id,
            'end_timezone_id' => Timezone::whereTimezone(Session::get('timezone'))->first()->id,
        ]);
        Session::flash('success', 'Travel stored');
        //return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        return view('travels.show')->with([
            'travel' => $travel,
            'statuses' => Status::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        $travel->delete();
        return redirect()->back();
    }
}
