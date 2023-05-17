<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BonAchat;
use App\Models\Carte;
use App\Models\Fournisseur;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use OneSignal;

class BonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getValides()
    {
        //
        $bons = BonAchat::where('validated_by',0)->where('fournisseur_id',auth()->user()->fournisseur_id)->where('expired_at','>=',Carbon::today())->get();
        return view('/Site/Bons/valides')->with(compact('bons'));
    }


    public function getExpired()
    {
        //
        $bons = BonAchat::where('fournisseur_id',auth()->user()->fournisseur_id)->where('validated_by',0)->where('expired_at','<',Carbon::today())->get();
        return view('/Site/Bons/expires')->with(compact('bons'));
    }

    public function getConsommes()
    {
        //
        $from = request()->from;
        $to = Carbon::parse(request()->to)->addDays(1);
        $user_id = request()->user_id;
        $users = User::where('role_id',3)
        ->where('site_id',auth()->user()->site_id)
        ->where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        if($from && $to){
            $bons = BonAchat::where('fournisseur_id',auth()->user()->fournisseur_id)->where('validated_at','>=',$from)->where('validated_at','<=',$to)->where('validated_by','>',0)
            ->where('validated_site_id',auth()->user()->site_id)
            ->get();
            if($user_id){
                $bons = $bons->where('validated_by',$user_id);
                $agent = User::find($user_id);
                return view('/Site/Bons/consommes')->with(compact('bons','users','from','to','agent'));
            }
            return view('/Site/Bons/consommes')->with(compact('bons','users','from','to'));
        }else{
            $start = Carbon::today()->firstOfMonth();
            $bons = BonAchat::where('fournisseur_id',auth()->user()->fournisseur_id)
            ->where('validated_site_id',auth()->user()->site_id)
            ->where('validated_by','>',0)->where('validated_at','>=',$start)->get();
            return view('/Site/Bons/consommes')->with(compact('users','bons'));
        }

    }



    public function preview(){
        $data = [];
        $cartes = Carte::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        //dd($cartes);
        foreach($cartes as $carte){
          // dd($this->division($carte->cashback,1000));
          $nb = floor($carte->montant/1000);
          $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
            if($carte->montant >= $fournisseur->min_bon_achat){
                $nb = (int)floor($carte->montant - ($carte->montant % 5000));
                $reste = $carte->montant - $nb;
                $data[] = ['carte'=>$carte,'nb'=>$nb,'reste'=>$reste];
            }
        }
        $dt = Carbon::today()->addDays(30);
        return view('Site/Bons/preview')->with(compact('data','dt'));
    }

    public function genererBon(){
        $data = [];
        $cartes = Carte::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        //dd($cartes);
        $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
        foreach($cartes as $carte){
          // dd($this->division($carte->cashback,1000));
          $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
          $nb = floor($carte->montant/1000);
            if($carte->montant >= $fournisseur->min_bon_achat){
                $nb = (int)floor($carte->montant - ($carte->montant % 5000));
                $reste = $carte->montant - $nb;
                $bon = BonAchat::create([
                    'carte_id'=>$carte->id,
                    'client_id'=>$carte->client_id,
                    'fournisseur_id'=>$carte->fournisseur_id,
                    'token'=>sha1(now()->timestamp . $carte->id),
                    'name'=>date('yms').($carte->id%255).($carte->client_id%255).$carte->fournisseur_id,
                    'montant'=>$nb,
                    'semaine'=>date('W'),
                    'mois'=>date('m'),
                    'annee'=>date('Y'),
                    'expired_at'=>Carbon::today()->addDays(30),
                ]);
                if($bon){
                    $carte->montant = $reste;
                    $carte->save();
                }
                $data[] = $bon;

            }
        }
        //dd($data);
        $dt = Carbon::today()->addDays(30);

        return view('Site/Facturation/bons')->with(compact('data','dt'));
    }

    public function getBonAchat($token){
        $bon = BonAchat::where('token',$token)->first();
        QrCode::size(200)->generate($token, public_path('qrcodes/qrcode.svg'));
        $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
        return view('Site.Bons.show')->with(compact('bon','fournisseur'));
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
