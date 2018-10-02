<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'travel', 'budget', 'start_datetime', 'end_datetime'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'start_datetime', 'end_datetime'
    ];

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
}
