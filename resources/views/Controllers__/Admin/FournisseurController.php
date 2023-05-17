<?php

namespace App\Http\Controllers\Admin;

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
        return view('/Admin/Fournisseurs/index')->with(compact('fournisseurs'));
    }


    public function reset(){
        $fournisseurs = Fournisseur::all();
        $i=1;
        foreach($fournisseurs as $fournisseur){
            $fournisseur->old_id = $fournisseur->id;
            $fournisseur->id = $i;
            $fournisseur->save();
            $user = User::create([
                'first_name'=>'Admin',
                'last_name'=>$fournisseur->name,
                'phone'=>$fournisseur->phone,
                'address'=>$fournisseur->city,
                'email'=>$fournisseur->email,
                'role_id'=>2,
                'fournisseur_id'=>$fournisseur->id,
                'password'=>bcrypt('1234'),
                'token'=>sha1($i . $fournisseur->old_id* $i)
            ]);
            $i++;
        }

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
        //
        //dd($request->all());
        $ud = [
            'first_name'=>$request->fn,
            'last_name'=>$request->ln,
            'phone'=>$request->user_phone,
            'email'=>$request->user_email,
            'password'=> bcrypt($request->password),
            'role_id'=>2,
        ];
        $data = [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'percent'=>$request->percent,
        ];
        //dd($request->all());
        $image = request()->image;
        if($image){
            $path = $this->entityImgCreate($image,'fournisseurs',time());
            $data['image'] = $path;
        }


        $logo = request()->logo;
        if($logo){
            $path = $this->entityImgCreate($logo,'fournisseurs',sha1(time()));
            $data['logo_uri'] = $path;
        }

        $fournisseur = Fournisseur::create($data);

        $ud['fournisseur_id'] = $fournisseur->id;
        $ud['token'] = sha1($fournisseur->id . date('Yhmids'));
       // dd($ud);
        $user = User::create($ud);

        $request->session()->flash('success','Ok');

        return back();
    }

    public function save(){
        $data = request()->except('image','_token');
        $id = request()->id;
        $image = request()->image;
        if($image){
            $path = $this->entityImgCreate($image,'fournisseurs',time());
            $data['image'] = $path;
        }

        $logo = request()->logo;
        if($logo){
            $path = $this->entityImgCreate($logo,'fournisseurs',sha1(time()));
            $data['logo_uri'] = $path;
        }
        Fournisseur::updateOrCreate(['id'=>$id],$data);

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
		//$projet = Creance::where('token',$token)->first();
        $fournisseur = Fournisseur::find($id);
        $types = Tfournisseur::all();
        $categories = Category::all()->where('fournisseur_id',$id)->where('parent_id',0);

		return view('/Admin/Fournisseurs/show')->with(compact('fournisseur','types','categories'));
	}


}
