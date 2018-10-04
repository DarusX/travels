<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Helpers\Colors;
use Faker;

class Visit extends Model
{
    protected $fillable = [
        'name', 'address', 'start_datetime', 'end_datetime', 'latitude', 'longitude', 'priority', 'start_timezone_id', 'end_timezone_id'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'start_datetime', 'end_datetime'
    ];

    public function getStartAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_datetime, $this->startTimezone->timezone)->setTimezone(Session::get('timezone'));
    }

    public function getEndAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->end_datetime, $this->endTimezone->timezone)->setTimezone(Session::get('timezone'));
    }

    public function getColorAttribute()
    {
        return color();
    }

    public function startTimezone()
    {
        return $this->belongsTo(Timezone::class, 'start_timezone_id');
    }
    
    public function EndTimezone()
    {
        return $this->belongsTo(Timezone::class, 'end_timezone_id');
    }
}
