<?php

namespace App\Http\Controllers\Api\Preparateur;


use App\Http\Controllers\Api\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\User;

class OrderController extends Controller
{


  public function index($user_id){
      $user = User::find($user_id);
	  $orders = Order::where('picking_user_id',$user_id)->where('cancelled_by',0)->where('site_id',$user->site_id)->get();
	  return response()->json(OrderResource::collection($orders));
  }

  public function show($id){
    $order = Order::find($id);
    return response()->json(new OrderResource($order));
  }

}
