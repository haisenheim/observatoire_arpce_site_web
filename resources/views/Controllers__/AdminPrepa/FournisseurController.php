<?php

namespace App\Http\Controllers\AdminPrepa;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExtendedController;
use App\Models\Category;
use App\Models\Fournisseur;
use App\Models\Tfournisseur;
use App\User;
use Illuminate\Http\Request;

class FournisseurController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fournisseurs = Fournisseur::where('shown',1)->get();
        return view('/AdminPrepa/Fournisseurs/index')->with(compact('fournisseurs'));
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
        $fournisseur = Fournisseur::find($id);

		return view('/AdminPrepa/Fournisseurs/show')->with(compact('fournisseur'));
	}


}
