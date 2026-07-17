<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Gate extends Model
{


    protected $fillable = [

        'name',
        'gate_code',
        'location',
        'status',

    ];



    protected function casts(): array
    {
        return [

            'status'=>'boolean',

        ];
    }





    public function devices()
    {

        return $this->hasMany(Device::class);

    }




    public function userPermissions()
    {

        return $this->hasMany(UserGatePermission::class);

    }

    public function users()
{
    return $this->belongsToMany(
        User::class,
        'user_gate_permissions'
    )->withPivot('access_allowed');
}



}