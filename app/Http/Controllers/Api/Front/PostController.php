<?php

namespace App\Http\Controllers\Api\Front;

use App\Models\Comment;
use App\Models\Post;


class PostController extends Controller
{

  public function index(){
	  $posts = Post::all()->load(['user','projet','earlie','commentaires']);
	  return response()->json($posts);
  }

	public function comment(){
		$user = auth('api')->user();
		Comment::create(['post_id'=>request('post_id'),'user_id'=>$user->id,'body'=>request('body')]);
		return response()->json(['message'=>'Vous avez commenté'],200);
	}
}
