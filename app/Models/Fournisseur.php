<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    //
    protected $guarded = ['id'];
    
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }



}
