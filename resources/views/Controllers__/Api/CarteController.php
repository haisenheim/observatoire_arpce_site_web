<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Controller;
use App\Http\Resources\AchatResource;
use App\Http\Resources\BonAchatResource;
use App\Http\Resources\CarteResource;
use App\Http\Resources\FavoriResource;
use App\Http\Resources\OrderResource;
use App\Models\Achat;
use App\Models\BonAchat;
use App\Models\Carte;
use App\Models\Facture;
use App\Models\Favori;
use App\Models\Fournisseur;
use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CarteController extends Controller
{



  public function saveAchat(){
        $rq = request()->all();
      $carte = Carte::find($rq['carte_id']);
      $fournisseur = Fournisseur::find($carte->fournisseur_id);
      $cashback = $rq['montant'] * $fournisseur->percent / 100;
      $facture = Facture::where('mois',date('m'))->where('annee',date('Y'))->first();
      if(!$facture){
        $facture = Facture::create([
            'fournisseur_id'=>$carte->fournisseur_id,
            'name'=> date('mY').$carte->fournisseur_id,
            'mois'=>date('m'),
            'annee'=>date('Y'),
            'token'=>sha1(date('Ymdish').$carte->fournisseur_id),
        ]);
      }
      $user = User::find($rq['user_id']);


      $achat = Achat::create([
            'carte_id'=>$carte->id,
            'montant'=>$rq['montant'],
            'fournisseur_id'=>$carte->fournisseur_id,
            'cashback'=>$cashback,
            'user_id'=>$rq['user_id'],
            'client_id'=>$carte->client_id,
            'mois'=>date('m'),
            'annee'=>date('Y'),
            'facture_id'=>$facture->id,
            'imageUri'=>$rq['imageUri'],
            'site_id'=>$user->site_id,
        ]);
      //return response()->json($order,401);
      $carte->montant = $carte->montant + $cashback;
      $carte->lastly_used_at = new \DateTime();
      $carte->save();
      return response()->json(new CarteResource($carte));
  }


  public function saveBaWithPhoto(){
    $rq = request()->all();
    $user = User::find($rq['user_id']);
    $ba = BonAchat::find($rq['bon_id']);
    $ba->validated_at = new \DateTime();
    $ba->validated_by = $rq['user_id'];
    $ba->imageUri=$rq['imageUri'];
    $ba->validated_site_id = $user->site_id;
    $ba->save();
  }

 public function get($cart_token,$fournisseur_id){
    $carte = Carte::where('token',$cart_token)->first();
    if($carte->fournisseur_id != $fournisseur_id){
        return response()->json('Fournisseur invalide',401);
    }
    return response()->json(['carte'=>new CarteResource($carte)]);
 }

 public function getBaByCarte($carte_id){
    $bon = BonAchat::where('carte_id',$carte_id)->whereDate('expired_at','>',Carbon::today())->first();
    //$bon = BonAchat::find(1);
    if($bon){
        return response()->json(new BonAchatResource($bon));
    }else{
        return response()->json(['error'=>'Aucun Bon'],404);
    }
 }

 public function getAchatsByCarte($carte_id){
    $achats = Achat::orderBy('created_at','DESC')->where('carte_id',$carte_id)->get();
    return response()->json(['achats'=>AchatResource::collection($achats)]);
 }

 public function getFavorisByCarte($carte_id){
    $favoris = Favori::orderBy('created_at','DESC')->where('carte_id',$carte_id)->get();
    return response()->json(['favoris'=>FavoriResource::collection($favoris)]);
 }

 public function getOrderById($id){
    $order = Order::find($id);
   return response()->json(new OrderResource($order));
 }

 public function setFavori($carte_id, $article_id){
    $carte = Carte::find($carte_id);
    $favori = Favori::create(['carte_id'=>$carte_id,'client_id'=>$carte->client_id,'article_id'=>$article_id]);
    return response()->json(new FavoriResource($favori));
 }

 public function unsetFavori($id){
    Favori::destroy($id);
    return response()->json('ok');
 }

 public function checkBa($id,$fournisseur_id){
    $ba = BonAchat::find($id);
    if($ba->fournisseur_id != $fournisseur_id){
        return response()->json('Fournisseur invalide',401);
    }
    if($ba->validated_at){
        return response()->json('Bon d\'achat deja utilise : '.date_format($ba->validated_at,'d/m/Y H:i:s') ,401);
    }
    if($ba->expired){
        return response()->json('ce bon d\'achat a expired le : '.date_format($ba->expired_at,'d/m/Y H:i:s') ,401);
    }
    if(!$ba->active){
        return response()->json('ce bon d\'achat a ete annule' ,401);
    }
    return response()->json(new BonAchatResource($ba));
 }

 public function validateBa($id,$user_id){
    $ba = BonAchat::find($id);
    $ba->validated_at = new \DateTime();
    $ba->validated_by = $user_id;
    $ba->save();
    return response()->json('ok');
 }


}
