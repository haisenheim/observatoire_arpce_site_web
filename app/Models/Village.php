<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    //
    protected $guarded = [];

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    public function exploitants()
    {
        return $this->hasMany('App\Models\Exploitant');
    }

    public function agents()
    {
        return $this->hasMany('App\Models\Agent');
    }
}
