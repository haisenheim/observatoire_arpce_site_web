<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Resources\Projet;
use App\Http\Resources\ProjetCollection;
use App\Http\Resources\ProjetResource;
use App\Models\Earlie;
use App\Models\Follow;


class StartupController extends Controller
{

	public function index(){
		//$dossiers = ProjetResource::collection(Earlie::paginate());
		$dossiers = Earlie::all('id','name','ville_id','imageUri','etape','validated_step','active','description','expert_id')->where('active',1)->where('id','!=',31)->where('expert_id','>',0)->load(['ville'])->paginate(10);
		//$dossiers = new ProjetCollection(\App\Models\Projet::paginate());
		return response()->json($dossiers);
	}

	public function follow(){
		$user = auth('api')->user();
		Follow::create(['user_id'=>$user->id,'earlie_id'=>request('earlie_id')]);
		return response()->json(['message'=>'Vous suivez desormais ce dossier'],200);
	}


	public function getNews(){
		$dossiers = ProjetResource::collection(Earlie::all()->where('expert_id','>',0)->where('active',1)->take(-6));
		return response()->json($dossiers);
	}

	public function show($id){
		$projet	= new ProjetResource(Earlie::find($id));
		return response()->json($projet);
	}
}
