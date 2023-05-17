<?php

namespace App\Http\Controllers\AdminPrepa;

use App\Http\Controllers\ExtendedController;
use App\Models\Fournisseur;
use App\Models\Site;
use App\User;
use Illuminate\Http\Request;

class UserController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('role_id',6)->get();
        $fournisseurs = Fournisseur::where('shown',1)->get();
        return view('/AdminPrepa/Users/index')->with(compact('users','fournisseurs'));
    }

    public function getSitesByFournisseurId($id){
       // $frn = Fournisseur::find($id);
        $agences = Site::where('fournisseur_id',$id)->get();
        return response()->json($agences);
    }

    public function setSite(){
        $user = User::find(request()->user_id);
        $user->site_id = request()->site_id;
        $user->fournisseur_id = request()->fournisseur_id;
        $user->save();
        return back();
    }

    public function store(Request $request){
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['token'] = sha1(time());
        $data['role_id'] = 6;
        User::create($data);
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
