<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\Controller;


class UserController extends Controller
{

  public function get(){
	  return auth('api')->user();
  }
}
