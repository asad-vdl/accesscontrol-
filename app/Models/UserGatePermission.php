<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGatePermission extends Model
{
    protected $fillable = [

        'user_id',

        'gate_id',

        'access_allowed',

    ];


    protected function casts(): array
    {
        return [

            'access_allowed' => 'boolean',

        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function gate()
    {
        return $this->belongsTo(Gate::class);
    }

}