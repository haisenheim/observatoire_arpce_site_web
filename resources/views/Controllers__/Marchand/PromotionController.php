<?php

namespace App\Http\Controllers\Marchand;


use App\Http\Controllers\ExtendedController;
use App\Models\Objectif;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promotions = Promotion::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        return view('/Marchand/Promotions/index')->with(compact('promotions'));
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('/Marchand/Promotions/create');
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
        $data['image_uri'] = $this->entityImgCreate($image,'promotions',time().auth()->user()->fournisseur_id);
        $data['fournisseur_id'] = auth()->user()->fournisseur_id;
        $data['token'] = sha1(time().auth()->user()->fournisseur_id);
        $promotion = Promotion::create($data);
        return redirect('/marchand/promotions/'.$promotion->token);
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
        $promotion = Promotion::updateOrCreate(['id'=>$id],$data);
        return redirect('/marchand/promotions/'.$promotion->token);
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
        $promotion = Promotion::where('token',$token)->first();

		return view('/Marchand/Promotions/show')->with(compact('promotion'));
	}

    public function booster($token)
	{
		//$projet = Creance::where('token',$token)->first();
        $promotion = Promotion::where('token',$token)->first();
        $objectifs = Objectif::all()->where('active',1);

		return view('/Marchand/Promotions/booster')->with(compact('promotion','objectifs'));
	}


    public function boosterByPush(){
        dd(request()->all());
    }


}
