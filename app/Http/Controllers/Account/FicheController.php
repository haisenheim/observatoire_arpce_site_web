<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\ExtendedController;
use App\Models\Agent;
use App\Models\Rapport;
use App\Models\Region;
use Illuminate\Http\Request;

class FicheController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rapports = Rapport::where('entreprise_id',auth()->user()->entreprise_id)->get();
        return view('/Account/Rapports/index')->with(compact('rapports'));
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
       // $data = $request->except('fichier_uri');
        $rapport = new Rapport();
        $fichier = $request->fichier_uri;
        $fichier->name = $request->name;
        $rapport->fichier_uri = $this->entityDocumentCreate($fichier,'rapports',time());
        $rapport->entreprise_id = auth()->user()->entreprise_id;
        $rapport->user_id = auth()->user()->id;
        $rapport->annee = $request->annee;
        $rapport->save();
        return back();
    }




}
