<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'travel_id', 'status_id', 'task', 'description', 'priority'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function getColorAttribute()
    {
        switch ($this->priority) {
            case 'Low':
                return 'dark';
                break;
            
            case 'Medium':
                return 'warning';
                break;
            
            case 'High':
                return 'danger';
                break;
            
            
        }
    }

}
