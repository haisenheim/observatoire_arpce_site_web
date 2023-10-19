<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\ExtendedController;
use App\Mail\SendContactMail;
use App\Mail\SendReportMail;
use App\Models\Agent;
use App\Models\Rapport;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RapportController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rapports = Rapport::orderBy('created_at','DESC')->where('entreprise_id',auth()->user()->entreprise_id)->get();
        return view('/Account/Rapports/index')->with(compact('rapports'));
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
        $rapport = new Rapport();
        $fichier = $request->fichier_uri;
        if($fichier){
            $rapport->name = $request->name;
            $path = $this->entityDocumentCreate($fichier,'rapports',time());
            if(!$path){
                request()->session()->flash('danger',' Impossible d\'enregistrer le fichier, le format n\'est pas correct !!!');
                return back();
            }
            $rapport->fichier_uri = $path;
            $rapport->entreprise_id = auth()->user()->entreprise_id;
            $rapport->user_id = auth()->user()->id;
            $rapport->annee = $request->annee;
            $rapport->save();
            Mail::to('clementessomba@alliages-tech.com')
            ->send(new SendReportMail($rapport));
            /* Mail::to('natsy.bouitiviaudo@sbv-consulting.cg')
            ->send(new SendReportMail($rapport));
            Mail::to('danielle.ouanounga@arpce.cg')
            ->send(new SendReportMail($rapport));
            Mail::to('pascal.mouandza@arpce.cg')
            ->send(new SendReportMail($rapport)); */
        }else{
            request()->session()->flash('danger',' Impossible d\'enregistrer le fichier est incorrect !!!');
        }
        return back();
    }




}
