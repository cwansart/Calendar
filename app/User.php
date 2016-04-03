<?php

namespace Calendar;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function appointments()
    {
        return $this->hasMany('Calendar\Appointment');
    }

    public function scopeUserColors($query) {
        $users = $query->get();
        $colors = [];
        foreach ($users as $user) {
            $colors[$user->github] = [
                'name'       => $user->name,
                'background' => $user->background,
                'color'      => $user->color
            ];
        }
        return json_encode($colors);
    }

    public function scopeReceiveMail($query)
    {
        return $query->where('receive_mail', '=', true);
    }
}
