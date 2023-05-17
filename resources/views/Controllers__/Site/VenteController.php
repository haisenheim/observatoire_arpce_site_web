<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Achat;
use App\Models\Carte;
use App\Models\Cashback;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('/Site/Ventes/index');
    }

    public function showUploadForm(){
        return view('Site.Ventes.upload');
    }

    public function upload(){
        $request = request();
        $image = $request->file('file');
        $FileName = $image->getClientOriginalName();
        //dd($FileName);
        $image->move(public_path('img/tickets'), $FileName);
        return response()->json(['success' => $FileName]);
    }


    public function disableAchat($token){
        $achat = Achat::where('imageUri',$token)->first();
        if($achat->fournisseur_id == auth()->user()->fournisseur_id){
            $carte = Carte::find($achat->carte_id);
            //$cashback = Cashback::where('moi_id',$achat->mois)->where('annee',$achat->annee)->where('fournisseur_id',$achat->fournisseur_id)->first();
            $carte->montant = $carte->montant - $achat->cashback;
            $carte->save();
            //$cashback->total_ventes = $cashback->total_ventes - $achat->montant;
            //$cashback->save();
            $achat->montant = 0;
            $achat->cashback = 0;
            $achat->save();
        }
        return redirect()->back();
    }

    public function editAchat(){
        //-------
        $achat = Achat::find(request('id'));
        $carte = Carte::find($achat->carte_id);
        $frn = Fournisseur::find(auth()->user()->fournisseur_id);

        //$cashback = Cashback::where('moi_id',$achat->mois)->where('annee',$achat->annee)->where('fournisseur_id',$achat->fournisseur_id)->first();
        $carte->montant = $carte->montant - $achat->cashback + request('montant')*$frn->percent/100;
        $carte->save();
        //$cashback->total_ventes = $cashback->total_ventes - $achat->montant + request('montant')*$frn->percent/100;
        //$cashback->save();
        $achat->montant = request('montant');
        $achat->cashback = request('montant')*$frn->percent/100;
        $achat->save();
        return redirect()->back();
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
		//$projet = Creance::where('token',$token)->first();


		return view('/Consultant/Creances/show')->with(compact('projet'));
	}


}
