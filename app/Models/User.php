<?php

namespace App\Models;
use App\Models\UserGatePermission;
use App\Models\Gate;
use App\Models\UserAccessSchedule;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


#[Fillable([
    'name',
    'email',
    'phone',
    'employee_id',
    'password',
    'role',
    'photo',
    'status'
])]

#[Hidden([
    'password',
    'remember_token'
])]


class User extends Authenticatable
{
    use Notifiable;


    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'status' => 'boolean',

        ];
    }

        public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }

    public function gatePermissions()
{
    return $this->hasMany(UserGatePermission::class);
}



public function gates()
{
    return $this->belongsToMany(
        Gate::class,
        'user_gate_permissions'
    )
    ->withPivot('access_allowed');
}

public function accessSchedule()
{
    return $this->hasOne(UserAccessSchedule::class);
}
}