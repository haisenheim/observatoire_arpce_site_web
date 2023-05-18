<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Resources\ClubResource;
use App\Models\Group;
use App\User;


class ClubController extends Controller
{

  public function index(){
	  //$dossiers = ClubResource::collection(Group::all()->paginate());
	  $dossiers =  Group::orderBy('created_at','DESC')->where('active',1)->paginate();
	  return response()->json($dossiers);
  }

	public function myClubs(){
		$id = auth('api')->user()->id;
		$user = User::find($id);
		$clubs = $user->clubs;

		return response()->json($clubs);
	}

	public function show($id){
		$projet	= new ClubResource(Group::find($id));
		return response()->json($projet);
	}




}
