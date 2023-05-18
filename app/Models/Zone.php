<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //
    protected $guarded = [];

    public function arrondissement()
    {
        return $this->belongsTo('App\Models\Arrondissement');
    }

    public function gics()
    {
        return $this->hasMany('App\Models\Gic');
    }

    public function exploitants()
    {
        return $this->hasMany('App\Models\Exploitant');
    }



    public function villages()
    {
        return $this->hasMany('App\Models\Village');
    }
}
