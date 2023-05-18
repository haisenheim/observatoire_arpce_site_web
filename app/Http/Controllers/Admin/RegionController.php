<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\User;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $regions = Region::all();
        return view('/Admin/Regions/index')->with(compact('regions'));
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
    public function store(Request $request)
    {
        $data = $request->all();
        $region = Region::create(
            [
                'name'=>$data['name'],
                'abb'=>$data['abb'],


            ]
        );
        $user = User::create(
            [
                'name'=>$data['user_name'],
                'phone'=>$data['phone'],
                'email'=>$data['email'],
                'password'=>bcrypt($data['password']),
                'role_id'=>2,
                'region_id'=>$region->id,
                'token'=>sha1(date('dhmYsi').$region->id)
            ]
        );
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($id)
	{
		$region = Region::find($id);
		return view('/Admin/Regions/show')->with(compact('region'));
	}


}
