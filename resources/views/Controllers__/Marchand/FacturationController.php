<?php

namespace App\Http\Controllers\Marchand;

use App\Exports\BonAchatExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\BonAchatResource;
use App\Models\BonAchat;
use App\Models\Carte;
use App\Models\Facture;
use App\Models\Fournisseur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use OneSignal;

class FacturationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $factures = Facture::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        return view('/Marchand/Facturation/index')->with(compact('factures'));
    }

    private function send($token){
        $bon = BonAchat::find(2);
        $data['type'] = 1;
        $data['content'] = new BonAchatResource($bon);
        $fields['include_external_user_ids'] = ['b4843a1242651320421522ed9d6108f135b19128'];
        $fields['channel_for_external_user_ids'] = "push";
        $fields['isAndroid'] = true;
        $fields['data'] = $data;
        $message = 'Hello Clement votre bon d’achat de 15.000 fcfa est disponible jusqu’au 31/01/23';
        $notif =  OneSignal::sendPush($fields, $message);
       // return response()->json($notif);
    }

    public function exportBonAchatByDate($dt){
        $bons = BonAchat::where('expired_at',$dt)->get();


        return Excel::download(new BonAchatExport($bons),'Bons_achat-'.date('d-m-Y').'.xlsx');
    }

    public function getBonAchat($token){
        $bon = BonAchat::where('token',$token)->first();
        QrCode::size(200)->generate($token, public_path('qrcodes/qrcode.svg'));
        $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
        //$pdf = Pdf::loadView('exports.pdf.bon', compact('bon','fournisseur','qrcode'));
        //return $pdf->stream('bon_'.$bon->name.'.pdf');
        return view('Marchand.Facturation.bon')->with(compact('bon','fournisseur'));
    }

    public function ExportPreviewBonAchat(){
        $data = [];
        $cartes = Carte::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        //dd($cartes);
        foreach($cartes as $carte){
          // dd($this->division($carte->cashback,1000));
          $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
          $nb = floor($carte->montant/1000);
            if($carte->montant>= $fournisseur->min_bon_achat){
                //dd($this->division($carte->cashback,1000));
                //dd(($carte->montant - $carte->montant % 35000)/35000);
                $nb = (int)floor($carte->montant - ($carte->montant % 5000));
                $reste = $carte->montant - $nb;
                $data[] = ['carte'=>$carte,'nb'=>$nb,'reste'=>$reste];
            }
        }
        return Excel::download(new BonAchatExport($data),'Bons_achats'.date('d-m-Y').'.xlsx');
    }

    public function getFacture($token){
        $facture = Facture::where('token',$token)->first();
        return view('/Marchand/Facturation/facture')->with(compact('facture'));
    }

    private function division($a,$b){
       return ($a - $a%$b)/$b;
    }

    public function previewBon(){
        $data = [];
        $cartes = Carte::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        //dd($cartes);
        foreach($cartes as $carte){
          // dd($this->division($carte->cashback,1000));
          $nb = floor($carte->montant/1000);
          $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
            if($carte->montant >= $fournisseur->min_bon_achat){
                //dd($this->division($carte->cashback,1000));
                //dd(($carte->montant - $carte->montant % 35000)/35000);
                $nb = (int)floor($carte->montant - ($carte->montant % 5000));
                $reste = $carte->montant - $nb;
                $data[] = ['carte'=>$carte,'nb'=>$nb,'reste'=>$reste];
                //$this->send($carte->token);
                $push['type'] = 2;
                $push['content'] = 'nada';
                $fields['include_external_user_ids'] = ['b4843a1242651320421522ed9d6108f135b19128'];
                $fields['channel_for_external_user_ids'] = "push";
                $fields['isAndroid'] = true;
                $fields['isIos'] = true;
                $fields['data'] = $push;
                $message = 'Hello '. $carte->client->first_name .' votre bon d’achat de 25.000 fcfa est disponible jusqu’au 22/01/2023';
                //$notif =  OneSignal::sendPush($fields, $message);
            }
        }
        $dt = Carbon::today()->addDays(30);
        return view('Marchand/Facturation/preview_bons')->with(compact('data','dt'));
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
                $push['type'] = 2;
                $push['content'] = 'ok';
                $fields['include_external_user_ids'] = [$carte->client->token];
                $fields['channel_for_external_user_ids'] = "push";
                $fields['isAndroid'] = true;
                $fields['isIos'] = true;
                $fields['data'] = $push;
                $message = 'Hello '. $carte->client->first_name .' votre bon d’achat de '. number_format($bon->montant,0,',','.') .' fcfa est disponible jusqu’au '.date_format($bon->expired_at,"d/m/Y");
                $notif =  OneSignal::sendPush($fields, $message);
            }
        }

        //dd($data);
        $dt = Carbon::today()->addDays(30);

        return view('Marchand/Facturation/bons')->with(compact('data','dt'));
    }

    public function getAllBonAchat(){
        $bons = BonAchat::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        return view('Marchand/Facturation/all_bons')->with(compact('bons',));
    }

    public function validateBonAchat($token){
        $bon = BonAchat::where('token',$token)->first();
        $bon->validated_at = new \DateTime();
        $bon->validated_by = auth()->user()->id;
        $bon->save();
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
