<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gic extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['dtn'];

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    public function exploitants(){
        return $this->hasMany('App\Models\Exploitant');
    }
}
