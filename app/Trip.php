<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class Trip extends Model
{
    protected $fillable = [
        'travel_id', 'trip', 'start_latitude', 'start_longitude', 'end_latitude', 'end_longitude', 'start_datetime', 'end_datetime', 'start_timezone_id', 'end_timezone_id'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'start_datetime', 'end_datetime'
    ];

    protected $appends = [
        'color'
    ];
    
    public function getStartAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_datetime, $this->startTimezone->timezone)->setTimezone(Session::get('timezone'));
    }

    public function getEndAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->end_datetime, $this->endTimezone->timezone)->setTimezone(Session::get('timezone'));
    }

    public function startTimezone()
    {
        return $this->belongsTo(Timezone::class, 'start_timezone_id');
    }
    
    public function EndTimezone()
    {
        return $this->belongsTo(Timezone::class, 'end_timezone_id');
    }

    public function getColorAttribute()
    {
        return color();
    }
}
