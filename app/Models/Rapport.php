<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    //
    protected $guarded = [];

    public function entreprise()
    {
        return $this->belongsTo('App\Models\Entreprise');
    }

    

}
