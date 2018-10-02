<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Http\Request;
use App\Travel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class VisitController extends Controller
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
    public function index(Travel $travel)
    {
        return view('visits.index')->with([
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
    public function store(Request $request, Travel $travel)
    {
        $travel->visits()->create([
            'name' => $request->name,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'start_datetime' => Carbon::parse($request->start_datetime)->timezone('UTC'),
            'end_datetime' => Carbon::parse($request->end_datetime)->timezone('UTC'),
            'priority' => $request->priority
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel, Visit $visit)
    {
        $visit->delete();
        return redirect()->back();
    }
}
