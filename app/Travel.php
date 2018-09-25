<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'travel', 'budget', 'start_date', 'end_date'
    ];
}
