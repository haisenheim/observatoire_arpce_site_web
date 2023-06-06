<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PointExport;
use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Entreprise;
use App\Models\Exploitant;
use App\Models\Indicateur;
use App\Models\Parcelle;
use App\Models\Region;
use App\Models\Tindicateur;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IndicateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $indicateurs = Indicateur::all();
        $entreprises = Entreprise::all();
        //$annees = Annee::all();
        $types = Tindicateur::all();
        return view('/Admin/Indicateurs/index')->with(compact('indicateurs','types','entreprises'));
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
        Indicateur::create($data);
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
		$exploitant = Exploitant::find($id);
		return view('/Admin/Exploitants/show')->with(compact('exploitant'));
	}




}
