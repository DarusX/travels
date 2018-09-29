<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'name', 'address', 'start_datetime', 'end_datetime', 'latitude', 'longitude', 'priority'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'start_datetime', 'end_datetime'
    ];

    public function getColorAttribute()
    {
        switch ($this->priority) {
            case 'high':
                return "#e3342f";
                break;
            case 'medium':
                return "#4dc0b5";
                break;
            case 'low':
                return "#38c172";
                break;
            
           
        }
    }
    public function getClassColorAttribute()
    {
        switch ($this->priority) {
            case 'high':
                return "danger";
                break;
            default:
                return "dark";
                break;
        }
    }
}
