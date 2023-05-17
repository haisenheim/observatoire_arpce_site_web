<?php

namespace App\Http\Controllers\Caissier;

use App\Http\Controllers\Controller;
use App\Models\Rayon;

class DashboardController extends Controller
{

	public function __invoke()
	{
        $rayons = Rayon::all()->where('fournisseur_id',auth()->user()->fournisseur_id);
		return view('Marchand/dashboard')->with(compact($rayons));
	}
}
