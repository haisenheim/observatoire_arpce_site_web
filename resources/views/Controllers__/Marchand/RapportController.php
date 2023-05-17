<?php

namespace App\Http\Controllers\Marchand;

use App\Http\Controllers\Controller;
use App\Models\Achat;
use App\Models\BonAchat;
use App\Models\Client;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $achats = Achat::all()->where('fournisseur_id',Auth::user()->fournisseur_id);
        $jours = $achats->groupBy(function($item){
            return date_format($item->created_at,'Y-m-d');
        });
        return view('/Marchand/Rapports/index')->with(compact('jours'));
    }


    private function getCountAchatByClientIdInPeriod($client_id,$date_min,$date_max){
        $achats = Achat::where('client_id',$client_id)
                         ->whereBetween('created_at',[$date_min,$date_max])->get();

        return $achats->count();
    }

    private function getClientsInPeriod($date_min,$date_max){
        $clients = Client::whereBetween('created_at',[$date_min,$date_max])->get();
        return $clients;
    }

    private function getWeeksInPeriod($date_min,$date_max){
        $weeks = [];
        $from = Carbon::parse($date_min);
        //dd($from->toDateString());

        do{
            $to = $from->clone();
            $to = $to->addDays(6);
            if($to <= Carbon::parse($date_max)){
                $f = $from->toDateString();
                $t = $to->toDateString();
               $weeks[] = ['date_min'=>$f,'date_max'=>$t];
            }else{
                $weeks[]=['date_min'=>$from->toDateString(),'date_max'=>Carbon::parse($date_max)->toDateString()];

            }
            $from = $to->addDay()->clone();

        }while($to <= Carbon::parse($date_max));
        //dd($weeks);
        return $weeks;
    }

    private function rangeAccountsByWeek($weeks){
        $accounts =[];
        foreach($weeks as $week){
           // dd($week);
            $accounts[$week['date_min'].'_'.$week['date_max']] = $this->getClientsInPeriod($week['date_min'],$week['date_max']);
        }
        return $accounts;
    }

    public function getNbAchats($period1,$period2){
        $w1 = explode('_',$period1);
        $from1 = $w1[0];
        $to1 = $w1[1];

        $w2 = explode('_',$period2);
        $from2 = $w2[0];
        $to2 = $w2[1];

        $clients = Client::whereBetween('created_at',[$from1,$to1])->get();
        $nb = 0;
        $total_achats = 0;
        foreach($clients as $client){
            $achats = Achat::whereBetween('created_at',[$from2,$to2])->where('client_id',$client->id)->get();
            if($achats->count()){
                $nb++;
            }
            $total_achats = $total_achats + $achats->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
        }
        $nbc = $clients->count();
        $panier = $nb?round($total_achats/$nb):0;
        return response()->json(['percent'=>$nbc?round($nb*100/$nbc).'%':'-','panier'=>number_format($panier,0,',','.')]);
    }

    public function getCohorte($from,$to){
        $weeks = $this->getWeeksInPeriod($from,$to);
       // dd($weeks);
        $data = $this->rangeAccountsByWeek($weeks);
       // $nb_passages = [];
        $nb_clients = [];
        $semaines = [];
        foreach($data as $k=>$v){
            $nb_clients[$k] = $v->count();
            $semaines[] = $k;
            //$w = explode('_',$k);
           // $f = $w[0];
           // $t = $w[1];
           // $total = 0;
           /* foreach($v as $client){
                $ats = $this->getCountAchatByClientIdInPeriod($client->id,$f,$t);
                if($ats>0){
                    $total = $total + 1;
                }
            } */
           // $nb_passages[$k] = $total;
        }
        //dd($nb_passages);
        //$achats = $this->getCountAchatByClientIdInPeriod(376,'2022-07-25','2022-08-20');
       // dd($achats);
        return view('Marchand.Rapports.cohorte')->with(['clients'=>$nb_clients,'semaines'=>$semaines]);
    }

    public function showCohorte(){
        $from = request()->debut;
        $to = request()->fin;
        if($from){
            $weeks = $this->getWeeksInPeriod($from,$to);
            $data = $this->rangeAccountsByWeek($weeks);
            $nb_clients = [];
            $semaines = [];
            foreach($data as $k=>$v){
                $nb_clients[$k] = $v->count();
                $semaines[] = $k;
            }
            return view('Marchand.Rapports.cohorte')->with(['clients'=>$nb_clients,'semaines'=>$semaines]);
        }
        return view('Marchand.Rapports.cohorte_empty');
    }

    public function getAchatsByDate($date){
        $dt = Carbon::parse($date);
        $achats = Achat::whereDate('created_at',$dt)->where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        return view('/Marchand/Rapports/details_achats')->with(compact('achats','dt'));
    }

    public function getStatsCaisses(){
        if(isset(request()->debut)){
            $debut = request()->debut;
            $fin = request()->fin;
            $achats = Achat::where('fournisseur_id',auth()->user()->fournisseur_id)
                        ->whereDate('created_at','>=',$debut)
                        ->whereDate('created_at','<=',$fin)
                        ->get();
            $stats = $achats->groupBy(function($item){
                return $item->user?$item->user->name:'-';
            });
            return view('/Marchand/Rapports/stats_caisses')->with(compact('stats','debut','fin'));
        }

        return view('/Marchand/Rapports/stats_caisses');
    }


    public function getGlobal(Request $request){
        $debut = $request->from;
        $fin = $request->to;
        $site_id = $request->site_id;
        $today = Carbon::today();
        $date = $today->clone();
        $df = $date->subMonths(3);
        $bef_achats =  Achat::whereBetween('created_at',[$date,$today])->get();
        $bef_nb = $bef_achats->groupBy(function($item){
            return $item->carte_id;
        })->count();
        $sites = Site::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        if($debut && $fin){
            $clients = Client::whereBetween('created_at',[$debut,$fin])->get();
            $achats = Achat::whereBetween('created_at',[$debut,$fin])->get();
            $bons = BonAchat::whereBetween('validated_at',[$debut,$fin])->get();
            //dd($bons);
            $name = "Tous les magasins";
            if($site_id){
                $achats = $achats->where('site_id',$site_id);
                $bons = $bons->where('validated_site_id',$site_id);
                $site = Site::find($site_id);
                $name = $site->name;
            }
            $nbb = $bons->count();
            $tbs = $bons->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
            $ca = $achats->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
            $nbca = $achats->groupBy(function($item){
                return $item->carte_id;
            })->count();
            $d1 = Carbon::parse($debut);
            $d2 = Carbon::parse($fin);

            return view('/Marchand/Rapports/global')->with(compact('sites','bef_nb','clients','nbca','ca','nbb','tbs','d1','d2','name'));
        }

        return view('/Marchand/Rapports/global')->with(compact('sites','bef_nb'));

    }

    public function getPareto(){
        $debut = request()->debut;
        $fin = request()->fin;
        if($debut && $fin){
            $achats = Achat::whereBetween(
                'created_at', [$debut,$fin]
            )
            ->where('fournisseur_id',auth()->user()->fournisseur_id)
            ->get();

        }else{
            $achats = Achat::whereMonth(
                'created_at', '=', Carbon::now()->month
            )
            ->where('fournisseur_id',auth()->user()->fournisseur_id)
            ->get();
        }

        $total = $achats->reduce(function($carry,$item){
            return $carry + $item->montant;
        });
        $clients = $achats->groupBy(function($item){
            return $item->client->name.'<span class="tel">'. $item->client->phone.'</span>';
        });

        $results = $clients->map(function($client){
            return $client->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
        });
        $results = $results->sortByDesc(function($value,$key){
            return $value;
        });
        //$results = collect($results)->sortBy('Value','DESC');
        $nb = $clients->count();
        return view('Marchand.Rapports.pareto')->with(compact('results','total','nb'));
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
