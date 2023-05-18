<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    //
    protected $guarded = [];

    public function domaine()
    {
        return $this->belongsTo('App\Models\Domaine');
    }

    public function exploitant()
    {
        return $this->belongsToMany('App\Models\Exploitant','exploitant_formation');
    }
}
