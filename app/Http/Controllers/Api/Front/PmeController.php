<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Resources\ProjetResource;
use App\Models\Follow;
use App\Models\Projet;
//use App\Http\Controllers\Api\Controller;


class PmeController extends Controller
{

  public function index(){
	  //$dossiers = ProjetResource::collection(Projet::all()->where('expert_id','>',0)->where('active',1));
	  $dossiers = Projet::all('id','name','ville_id','imageUri','validated_step','active','expert_id')->where('active',1)->where('expert_id','>',0)->load(['ville','consultant'])->paginate(10);
	  return response()->json($dossiers);
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

	public function show($id){
		$projet	= new ProjetResource(Projet::find($id));
		return response()->json($projet);
	}


}
