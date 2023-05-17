<?php

namespace App\Http\Controllers\Marchand;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExtendedController;
use App\Imports\ImportIntoRayon;
use App\Imports\ImportIntoSousRayon;
use App\Models\Article;
use App\Models\Rayon;
use App\Models\Sousrayon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArticleController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rayons = Rayon::all()->where('fournisseur_id',auth()->user()->fournisseur_id);
        return view('/Marchand/Articles/rayons')->with(compact('rayons'));
    }

    public function getRayon($token)
    {
        //
        $rayon = Rayon::where('token',$token)->first();
        return view('/Marchand/Articles/rayon')->with(compact('rayon'));
    }

    public function saveRayon(){
        $token = sha1(auth()->user()->id.date('hismdY'));
        $data = [
            'name'=>request('name'),
            'fournisseur_id'=>auth()->user()->fournisseur_id,
            'token'=>$token,
        ];
        if(request('photo')){
            $data['image'] = $this->entityImgCreate(request('photo'),'rayons',date('HismdYW'));
        }
        Rayon::create($data);
        return back();
    }

    public function saveSousRayon(){
        $token = sha1(auth()->user()->id.date('hismdY'));
       $data = [
        'name'=>request('name'),
        'rayon_id'=>request('rayon_id'),
        'fournisseur_id'=>auth()->user()->fournisseur_id,
        'token'=>$token,
       ];
        if(request('photo')){
            $data['image'] = $this->entityImgCreate(request('photo'),'sousrayons',date('HismdYW'));
        }

        Sousrayon::create($data);
        return back();
    }

    public function save(){

        $data = [
            'price'=>request('price'),
        ];
        if(request('photo')){
            $data['image'] = $this->entityImgCreate(request('photo'),'articles',request('id'));
        }

        Article::updateOrCreate(['id'=>request('id')],$data);
        return back();
    }


    public function getSousRayon($token)
    {
        //
        $rayon = Sousrayon::where('token',$token)->first();
        return view('/Marchand/Articles/sousrayon')->with(compact('rayon'));
    }

    public function importIntoRayon(){
        $id = request('rayon_id');
        Excel::import(new ImportIntoRayon($id), request()->file('file_to_upload'));
        return back()->with('success', 'Excel Imported.');
    }

    public function importIntoSousRayon($id){
        Excel::import(new ImportIntoSousRayon($id), request()->file('file_to_upload'));
        return back()->with('success', 'Excel Imported.');
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
