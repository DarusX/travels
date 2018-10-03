<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;
use App\Travel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Timezone;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Travel $travel)
    {
        return view('trips.index')->with([
            'travel' => $travel
        ]);
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
    public function store(Travel $travel, Request $request)
    {
        $travel->trips()->create([
            'trip' => $request->trip,
            'start_latitude' => $request->start_latitude,
            'start_longitude' => $request->start_longitude,
            'end_latitude' => $request->end_latitude,
            'end_longitude' => $request->end_longitude,
            'start_datetime' => Carbon::createFromFormat('Y-m-d H:i', $request->start_datetime),
            'end_datetime' => Carbon::createFromFormat('Y-m-d H:i', $request->end_datetime),
            'start_timezone_id' => Timezone::whereTimezone(Session::get('timezone'))->first()->id,
            'end_timezone_id' => Timezone::whereTimezone(Session::get('timezone'))->first()->id,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel,  Trip $trip)
    {
        $trip->delete();
        return redirect()->back();
    }
}
