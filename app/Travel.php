<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class Travel extends Model
{
    protected $fillable = [
        'travel', 'budget', 'start_datetime', 'end_datetime', 'start_timezone_id', 'end_timezone_id'
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

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class)->orderBy('start_datetime');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)->orderBy('start_datetime');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class)->orderBy('ammount');
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
