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

    public function getClassColorAttribute()
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
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

}
