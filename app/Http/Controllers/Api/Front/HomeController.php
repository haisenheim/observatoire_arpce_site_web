<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Resources\ProjetResource;
use App\Models\Comment;
use App\Models\Earlie;
use App\Models\Post;
use App\Models\Projet;


class HomeController extends Controller
{

  public function index(){
	  $posts = Post::all()->load(['user','projet','earlie','commentaires']);
	  $ps = ProjetResource::collection(Projet::all()->where('expert_id','>',0)->where('active',1)->take(-2));
	  $els = ProjetResource::collection(Earlie::all()->where('expert_id','>',0)->where('active',1)->take(-2));
	  $dossiers = collect($ps)->merge($els);
	  return response()->json(["posts"=>$posts,"dossiers"=>$dossiers]);
  }

	public function comment(){
		$user = auth('api')->user();
		Comment::create(['post_id'=>request('post_id'),'user_id'=>$user->id,'body'=>request('body')]);
		return response()->json(['message'=>'Vous avez commenté'],200);
	}
}
