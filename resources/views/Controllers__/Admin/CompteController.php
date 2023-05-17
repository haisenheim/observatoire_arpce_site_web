<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carte;
use App\Models\CategorieSocioPro;
use App\Models\Client;
use App\Models\Role;
use App\Models\TrancheRevenu;
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
        $users = User::all();
        $roles = Role::all();
        return view('/Admin/Compte/index')->with(compact('users','roles'));
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
        return view('Admin.Clients.telechargements')->with(compact('clients','categories','tranches'));
        //dd($clients);
    }

    public function searchForm(){
        $categories = CategorieSocioPro::all();
        $tranches = TrancheRevenu::all();
        return view('Admin.Clients.telechargements')->with(compact('categories','tranches'));
    }

    public function deleteClient($id){
        $client = Client::find($id);
        $client->phone = '_'.$client->phone;
        $client->deleted_at = new \DateTime();
        $client->deleted_year = date('Y');
        $client->deleted_month = date('m');
        $client->save();
        return back();
    }

    public function show($id){
        $client = Client::find($id);
        return view('Admin.Clients.show')->with(compact('client'));
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
        return view('Admin.Clients.telechargements')->with(compact('clients'));
    }

    public function getCard($token){
        $carte = Carte::where('token',$token)->first();
        return view('Admin.Clients.carte')->with(compact('carte'));
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
        $data['first_name'] = $request->fn;
        $data['last_name'] = $request->ln;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['role_id'] = $request->role_id;
        $data['annee'] = date('Y');
        $data['moi_id'] = date('m');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $data['token'] = sha1(time().auth()->user()->id);
        $user = User::create($data);
        return redirect()->back();
    }



}
