<?php

namespace App\Http\Controllers\Marchand;

use App\Http\Controllers\Controller;
use App\Models\Achat;
use App\Models\Cashback;
use App\Models\Secteur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

	public function __invoke()
	{
        $m = date('m');
        $y = date('Y');
        $mp = $m==1?12:$m-1;
        $yp=$m==12?$y-1:$y;
        $achats = Achat::where('fournisseur_id',auth()->user()->fournisseur_id)->where('mois',$m)->where('annee',$y)->get();
        $achats_prev = Achat::where('fournisseur_id',auth()->user()->fournisseur_id)->where('mois',$mp)->where('annee',$yp)->get();
        $cashback_prev = Cashback::where('fournisseur_id',auth()->user()->fournisseur_id)->where('moi_id',date('m'))->where('annee',date('Y'))->first();
		return view('Marchand/dashboard')->with(compact('achats','cashback_prev','achats_prev'));
	}

    public function getKpi(){
        $achats = Achat::where('annee',date('Y'))->where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        $group_achats = $achats->groupBy('mois');
        //dd($group_achats);
        $groups = $group_achats->map(function($items){
            return $items->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
        });
        $cartes = $group_achats->map(function($items){
            return $items->groupBy('carte_id')->count();
        });

        $panier = $group_achats->map(function($items){
            $crts = $items->groupBy('carte_id');
            $nb = $crts->count();
            $montant = $items->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
            return $nb?$montant/$nb:0;
        });
       /* foreach($group_achats as $k=>$v){
            $cartes[$k]=$v->groupBy('carte_id')->count();
        }*/
        return ['cartes'=>$cartes,'ventes'=>$groups];
       // dd($groups);
    }
}
