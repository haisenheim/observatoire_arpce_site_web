<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Ville;
use App\User;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all()->where('fournisseur_id',auth()->user()->fournisseur_id)->where('role_id',3);
        $sites = Site::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        return view('/Site/Compte/index')->with(compact('users','sites'));
    }

    public function enable($token){
        $user = User::where('token',$token)->first();
        $user->active = 1;
        $user->save();
        request()->session()->flash('success','Ok');
        return back();
    }

    public function disable($token){
        $user = User::where('token',$token)->first();
        $user->active = 0;
        $user->save();
        request()->session()->flash('success','Ok');
        return back();
    }

    public function store(Request $request)
    {
        //
        //dd($request->all());
        $request->validate([
            'phone' => 'required|unique:users,phone',
            'email' => 'unique:users,email',
        ]);
        $ud = [
            'first_name'=>$request->fn,
            'last_name'=>$request->ln,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'role_id'=>3,
            'site_id'=>$request->site_id
        ];

        $ud['fournisseur_id'] = auth()->user()->fournisseur_id;
        $ud['token'] = sha1(auth()->user()->id . date('Yhmids'));
       // dd($ud);

        $user = User::create($ud);
        $request->session()->flash('success','Ok');

        return back();
    }

    public function getSites(){
        $sites = Site::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        $villes = Ville::all();
        return view('/Site/Parametres/sites')->with(compact('sites','villes'));
    }

    public function getSite($token){
        $site = Site::where('token',$token)->first();
        return view('/Site/Compte/sites')->with(compact('site'));
    }

    public function storeSite(){
        $data = request()->all();
        $data['fournisseur_id'] = auth()->user()->fournisseur_id;
        $data['token']=sha1(time().auth()->user()->id);
        Site::create($data);
        return back();
    }

    public function setSite(){
        $user = User::where('token',request()->user_id)->first();
        $user->site_id = request()->site_id;
        $user->save();
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
