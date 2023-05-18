<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    //
    protected $guarded = [];

    public function exploitant()
    {
        return $this->belongsToMany('App\Models\Exploitant','activite_exploitant');
    }
}
