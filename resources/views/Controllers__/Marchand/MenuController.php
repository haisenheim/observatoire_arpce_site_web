<?php

namespace App\Http\Controllers\Marchand;


use App\Http\Controllers\ExtendedController;
use App\Models\Menu;
use App\Models\Objectif;
use App\Models\Promotion;
use Illuminate\Http\Request;

class MenuController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menus = Menu::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        return view('/Marchand/Menus/index')->with(compact('menus'));
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('/Marchand/Menus/create');
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
        $data = $request->except('image_uri');
        $image = $request->image_uri;
        $data['image_uri'] = $this->entityImgCreate($image,'menus',time().auth()->user()->fournisseur_id);
        $data['fournisseur_id'] = auth()->user()->fournisseur_id;
        $data['token'] = sha1(time().auth()->user()->fournisseur_id);
        $promotion = Menu::create($data);
        return redirect()->back();
    }

    public function save(Request $request)
    {
        //
        $data = $request->except('image_uri');
        $image = $request->image_uri;
        $id = $request->id;
        if($image){
            $data['image_uri'] = $this->entityImgCreate($image,'promotions',time().$id);
        }

       // $data['fournisseur_id'] = auth()->user()->fournisseur_id;
       // $data['token'] = sha1(time().auth()->user()->fournisseur_id);
        $promotion = Menu::updateOrCreate(['id'=>$id],$data);
        return redirect('/marchand/menus/'.$promotion->token);
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
        $promotion = Menu::where('token',$token)->first();

		return view('/Marchand/Menus/show')->with(compact('promotion'));
	}




}
