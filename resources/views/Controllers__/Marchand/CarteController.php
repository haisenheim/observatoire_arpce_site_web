<?php

namespace App\Http\Controllers\Marchand;

use App\Http\Controllers\ExtendedController;
use App\Models\Carte;
use Illuminate\Http\Request;

class CarteController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jour = request()->jour();
        $cartes = Carte::all()->where('active',1)->where('fournisseur_id',auth()->user()->fournisseur_id);
        if($jour){
            //$cartes = $cartes->where('created_at');
        }
       // $achats =

        //return view('/Marchand/Cartes/index')->with(compact('cartes'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($token)
	{
        $carte = Carte::where('token',$token)->first();
		return view('/Marchand/Cartes/show')->with(compact('carte'));
	}


}
