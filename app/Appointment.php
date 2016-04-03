<?php

namespace Calendar;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'user_id'
    ];

    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo('Calendar\User');
    }

    public function getIcsDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('Ymd\THis');
    }

    public function getDateAttribute($date)
    {
        return \Carbon\Carbon::parse($date)->format('d.m.Y H:i');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = \Carbon\Carbon::createFromFormat('d.m.Y H:i', $value);
    }

    public function scopeUpcomming($query) {
        return $query->whereDate('date', '>=', \Carbon\Carbon::today())->orderBy('date', 'ASC')->take(10)->get();
    }
}
