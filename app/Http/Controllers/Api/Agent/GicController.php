<?php

namespace App\Http\Controllers\Api\Agent;

use App\Http\Controllers\Controller;
use App\Models\Cooperative;
use App\Models\Gic;
use App\User;
use Illuminate\Http\Request;

class GicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $gics = Gic::all()->where('zone_id',auth('api')->user()->zone_id);
	    return   response()->json($gics);
    }

    public function getCooperatives()
    {


        $gics = Cooperative::all()->where('region_id',auth('api')->user()->region_id);
	    return   response()->json($gics);
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
        //
        $data = $request->all();

        $data['zone_id'] = auth('api')->user()->zone_id;
        $data['token'] = sha1(date('hiYmsd').auth('api')->user()->id);
        $gic = Gic::create($data);
        return  response()->json($gic);
    }


}
