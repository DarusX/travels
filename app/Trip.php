<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker;

class Trip extends Model
{
    protected $fillable = [
        'travel_id', 'trip', 'start_latitude', 'start_longitude', 'end_latitude', 'end_longitude', 'start_datetime', 'end_datetime'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'start_datetime', 'end_datetime'
    ];

    protected $appends = ['color']; 

    public function getColorAttribute()
    {
        return Faker::create()->hexColor;
    }
}
