<?php

namespace App\Http\Controllers\AdminPrepa;
use App\Http\Controllers\ExtendedController;
use App\Models\Fournisseur;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::where('site_id','>',0)->where('cancelled_by',0)->where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        /* $orders = DB::table('orders')
            ->select('*')
            ->where('fournisseur_id',auth()->user()->fournisseur_id)
            ->get(); */
        return view('/AdminPrepa/Orders/index')->with(compact('orders'));
    }

    public function cancel($token){
        $order = Order::where('token',$token)->first();
        $order->cancelled_at = new \DateTime();
        $order->cancelled_by = auth()->user()->id;
        $order->save();
        return redirect('admin-prepa/orders');
    }

    public function prepare($token){

        $order = Order::where('token',$token)->first();
        $user = User::where('site_id',$order->site_id)->where('role_id',6)->first();
        if(!$user){
            request()->session()->flash('warning','Attention! aucun preparateur n\'a ete trouve dans ce site');
            return back();
        }
        $order->picking_transferred_at = new \DateTime();
        $order->picking_transferred_by = auth()->user()->id;
        $order->picking_user_id = $user->id;
        $order->save();
        return redirect('admin-prepa/orders');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($id)
	{
		//$projet = Creance::where('token',$token)->first();
        $order = Order::find($id);
		return view('/AdminPrepa/Orders/show')->with(compact('order'));
	}


}
