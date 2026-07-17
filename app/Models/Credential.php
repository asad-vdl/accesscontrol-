<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{

    protected $fillable = [

        'user_id',
        'credential_type',
        'credential_value',
        'status',
        'notes',

    ];


    protected function casts(): array
    {
        return [

            'status' => 'boolean',

        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accessLogs()
{
    return $this->hasMany(

        AccessLog::class,

        'credential_value',

        'credential_value'

    );
}

}