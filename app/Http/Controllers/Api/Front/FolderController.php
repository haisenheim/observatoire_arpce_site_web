<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Resources\ActifResource;
use App\Http\Resources\CreanceResource;
use App\Http\Resources\ProjetResource;
use App\Models\Actif;
use App\Models\Creance;
use App\Models\Earlie;
use App\Models\Follow;
use App\Models\Projet;
//use App\Http\Controllers\Api\Controller;


class FolderController extends Controller
{

  public function index(){
	  $pmes = ProjetResource::collection(Projet::all()->where('expert_id','>',0)->where('active',1)->take(-6));
	  $startups = ProjetResource::collection(Earlie::all()->where('expert_id','>',0)->where('active',1)->take(-6));
	 // $data =collect($pmes)->merge($startups);

	  $actifs = ActifResource::collection(Actif::all()->where('active',1)->take(-6));
	  $creances = CreanceResource::collection(Creance::all()->where('active',1)->take(-6));
	  $data['actifs'] = $actifs;
	  $data['pmes'] = $pmes;
	  $data['startups'] = $startups;
	  $data['creances'] = $creances;

	  return response()->json($data,200);
  }
	public function follow(){
		$user = auth('api')->user();
		Follow::create(['user_id'=>$user->id,'projet_id'=>request('projet_id')]);
		return response()->json(['message'=>'Vous suivez desormais ce dossier'],200);
	}


	public function getNews(){
		$dossiers = ProjetResource::collection(Projet::all()->where('expert_id','>',0)->where('active',1)->take(-6));
		return response()->json($dossiers);
	}


}
