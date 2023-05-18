<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Resources\ActifResource;
use App\Http\Resources\Projet;
use App\Http\Resources\ProjetCollection;
use App\Http\Resources\ProjetResource;
use App\Models\Actif;
use App\Models\Earlie;
use App\Models\Follow;


class ActifController extends Controller
{

	public function index(){
		$dossiers = Actif::all('id','name','imageUri','prix')->paginate(10);
		return response()->json($dossiers);
	}



	public function show($id){
		$projet	= new ActifResource(Actif::find($id));
		return response()->json($projet);
	}
}
