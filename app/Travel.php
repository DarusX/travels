<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'travel', 'budget', 'start_date', 'end_date'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
