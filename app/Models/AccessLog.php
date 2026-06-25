<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{

    protected $fillable = [

        'user_id',
        'device_id',
        'credential_type',
        'credential_value',
        'access_status',
        'remarks',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    

}
