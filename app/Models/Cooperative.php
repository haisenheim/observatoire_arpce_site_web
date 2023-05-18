<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['dtn'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function arrondissement()
    {
        return $this->belongsTo('App\Models\Arrondissement');
    }

    public function exploitants(){
        return $this->hasMany('App\Models\Exploitant');
    }
}
