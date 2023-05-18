<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['date_creation'];

    public function exploitant()
    {
        return $this->belongsTo('App\Models\Exploitant');
    }

    public function village()
    {
        return $this->belongsTo('App\Models\Village');
    }

    public function points(){
        return $this->hasMany('App\Models\Point');
    }
}
