<?php

namespace App\Http\Controllers\Marchand;

use App\Http\Controllers\Controller;
use App\Models\Carte;
use App\Models\CategorieSocioPro;
use App\Models\Client;
use App\Models\Role;
use App\Models\Site;
use App\Models\TrancheRevenu;
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
        $users = User::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        $roles = Role::all();
        $sites = Site::all()->where('fournisseur_id',auth()->user()->fournisseur_id);
        return view('/Marchand/Compte/index')->with(compact('users','roles','sites'));
    }

    public function getDownloads(Request $request){
        $phone = $request->phone;
        $tranche_id = $request->tranche_id;
        $category_id = $request->category_id;
        $from = $request->from;
        $to = $request->to;
        $categories = CategorieSocioPro::all();
        $tranches = TrancheRevenu::all();

        $clients = Client::orderBy('created_at','DESC')->get();
        if($phone){
            $clients = $clients->where('phone',$phone);
        }
        if($tranche_id){
            $clients = $clients->where('tranche_id',$tranche_id);
        }
        if($category_id){
            $clients = $clients->where('categorie_id',$category_id);
        }
        if($from){
            if($to){
                $clients = $clients->whereBetween('created_at',[$from,$to]);
            }
        }
        return view('Marchand.Clients.telechargements')->with(compact('clients','categories','tranches'));
        //dd($clients);
    }

    public function searchForm(){
        $categories = CategorieSocioPro::all();
        $tranches = TrancheRevenu::all();
        return view('Marchand.Clients.telechargements')->with(compact('categories','tranches'));
    }

    public function show($token){
        $client = Client::where('token',$token)->first();
        return view('Marchand.Clients.show')->with(compact('client'));
    }

    public function resetPassword($token){
        $client = Client::where('token',$token)->first();
        $client->password = bcrypt('12345');
        $client->save();
        $this->flash('warning','Le nouveau mot de passe de compte est 12345');
        return redirect()->back();
    }

    public function getClientByPhone($number){
        $clients = Client::where('phone',$number)->get();
        return view('Marchand.Clients.telechargements')->with(compact('clients'));
    }

    public function getCard($token){
        $carte = Carte::where('token',$token)->first();
        return view('Marchand.Clients.carte')->with(compact('carte'));
    }

    public function enable($id){
        $user = User::find($id);
        $user->active = 1;
        $user->save();
        return back();
    }

    public function disable($id){
        $user = User::find($id);
        $user->active = 0;
        $user->save();
        return back();
    }

    public function save(Request $request){
        $data = $request->except('password','id');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user = User::updateOrCreate(['id'=>$request->id],$data);
        return redirect()->back();
    }

    public function getSites(){
        $sites = Site::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        $villes = Ville::all();
        return view('Marchand.Compte.sites')->with(compact('sites','villes'));
    }

    public function setSite(Request $request){

        $user = User::where('token',$request->user_id)->first();
        if($user){
            $user->site_id = $request->site_id;
            $user->save();
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
        //addUserSite
        $data['first_name'] = $request->fn;
        $data['last_name'] = $request->ln;

        $data['phone'] = $request->phone;
        $data['role_id'] = $request->role_id;
        $data['annee'] = date('Y');
        $data['moi_id'] = date('m');
        $data['site_id'] = $request->site_id;
        $data['fournisseur_id'] = auth()->user()->fournisseur_id;
        if($request->site_id == 4){
            $data['email'] = $request->email;
        }
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $data['token'] = sha1(time().auth()->user()->id);
        $user = User::create($data);
        return redirect()->back();
    }

    public function addUserSite(Request $request)
    {
        //addUserSite
        $data['first_name'] = $request->fn;
        $data['last_name'] = $request->ln;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['role_id'] = $request->role_id;
        $data['annee'] = date('Y');
        $data['moi_id'] = date('m');
        $data['site_id'] = $request->site_id;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $data['token'] = sha1(time().auth()->user()->id);
        $user = User::create($data);
        return redirect()->back();
    }



}
