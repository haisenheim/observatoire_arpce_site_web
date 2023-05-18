<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    //
    protected $guarded = [];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function arrondissements()
    {
        return $this->hasMany('App\Models\Arrondissement');
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
