<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    //
    protected $guarded = [];

    public function formations()
    {
        return $this->hasMany('App\Models\Formation');
    }
}
