<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Device extends Model
{


    protected $fillable = [

        'name',
        'type',
        'device_code',
        'ip_address',
        'location',
        'status',
        'last_seen',
        'api_token',
        'online_status',

    ];



    protected function casts(): array
    {

        return [

            'status' => 'boolean',
            'last_seen' => 'datetime',
            'online_status' => 'boolean',

        ];

    }



    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }


}