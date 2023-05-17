<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Tfournisseur;
use App\User;
use Illuminate\Http\Request;

class TfournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tfournisseurs = Tfournisseur::all();
        return view('/Admin/Tfournisseurs/index')->with(compact('tfournisseurs'));
    }


    public function enable($id){
        $type = Tfournisseur::find($id);
        $type->active = 1;
        $type->save();
        return back();
    }

    public function disable($id){
        $type = Tfournisseur::find($id);
        $type->active = 0;
        $type->save();
        return back();
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


        $fournisseur = Tfournisseur::create(
            [
                'name'=>$request->name,

            ]
        );



        $request->session()->flash('success','Ok');

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

	}


}
