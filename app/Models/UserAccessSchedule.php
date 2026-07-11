<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccessSchedule extends Model
{
    protected $fillable = [

        'user_id',

        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',

        'start_time',
        'end_time',

        'valid_from',
        'valid_to',

        'status',

    ];

    protected $casts = [

        'monday' => 'boolean',
        'tuesday' => 'boolean',
        'wednesday' => 'boolean',
        'thursday' => 'boolean',
        'friday' => 'boolean',
        'saturday' => 'boolean',
        'sunday' => 'boolean',

        'status' => 'boolean',

        'valid_from' => 'date',
        'valid_to' => 'date',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}