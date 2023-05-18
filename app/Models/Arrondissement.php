<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrondissement extends Model
{
    //
    protected $guarded = [];

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function cooperatives()
    {
        return $this->hasMany('App\Models\Cooperative');
    }
    public function gics()
    {
        return $this->hasMany('App\Models\Gic');
    }

    public function exploitants()
    {
        return $this->hasMany('App\Models\Exploitant');
    }

    public function zones()
    {
        return $this->hasMany('App\Models\Zone');
    }

    public function villages()
    {
        return $this->hasMany('App\Models\Village');
    }
}
