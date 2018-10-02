<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'travel_id', 'trip', 'start_latitude', 'start_longitude', 'end_latitude', 'end_longitude', 'start_datetime', 'end_datetime'
    ];
}
