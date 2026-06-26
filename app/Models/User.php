<?php

namespace App\Models;

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
}