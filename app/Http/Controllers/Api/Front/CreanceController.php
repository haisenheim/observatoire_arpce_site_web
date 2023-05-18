<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Resources\ActifResource;
use App\Http\Resources\CreanceResource;
use App\Http\Resources\Projet;
use App\Http\Resources\ProjetCollection;
use App\Http\Resources\ProjetResource;
use App\Models\Actif;
use App\Models\Creance;
use App\Models\Earlie;
use App\Models\Follow;


class CreanceController extends Controller
{

	public function index(){

		$dossiers = Creance::all('id','debiteur','prix_cession','debiteur_image_path')->paginate(10);
		return response()->json($dossiers);
	}



	public function show($id){
		$projet	= new CreanceResource(Creance::find($id));
		return response()->json($projet);
	}
}
