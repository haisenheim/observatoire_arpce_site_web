<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\ExtendedController;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$entreprise = Entreprise::find(auth()->user()->entreprise_id);
        $profil = User::find(auth()->user()->id);
        return view('/Account/profil')->with(compact('profil'));
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
        $data['name'] = $request->user_name;
        $data['phone'] = $request->user_phone;
        $data['email'] = $request->user_email;

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        User::updateOrCreate(['id'=>auth()->user()->id],$data);
        $ent['name'] = $request->name;
        $ent['phone'] = $request->phone;
        $ent['email'] = $request->email;
        $image = request()->logo;
        if($image){
            $path = $this->entityImgCreate($image,'entreprise',time());
            $ent['image_uri'] = $path;
        }
        Entreprise::updateOrCreate(['id'=>auth()->user()->entreprise_id],$ent);
        request()->session()->flash('info','Profil mis a jour avec succes !!!');
        return back();
    }




}
