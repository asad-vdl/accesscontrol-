<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        'company_name',

        'company_logo',

        'timezone',

        'door_unlock_time',

        'voice_enabled',

        'hardware_enabled'

    ];
}