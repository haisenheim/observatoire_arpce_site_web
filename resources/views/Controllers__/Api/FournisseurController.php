<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BonAchatResource;
use App\Http\Resources\CarteResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FavoriResource;
use App\Http\Resources\FournisseurListResource;
use App\Http\Resources\FournisseurResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\ProductSiteResource;
use App\Http\Resources\PromotionResource;
use App\Http\Resources\TrancheResource;
use App\Models\BonAchat;
use App\Models\Carte;
use App\Models\Category;
use App\Models\Fournisseur;
use App\Models\Menu;
use App\Models\Promotion;
use Carbon\Carbon;
use App\Models\ArticleSite;
use App\Models\Favori;
use App\Models\Site;
use App\Models\Tranche;
use App\Models\Ville;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSupermarches()
    {
	    return  FournisseurListResource::collection(Fournisseur::where('type_id',1)->get());
    }

    public function getLegumes()
    {
	    return  response()->json(FournisseurListResource::collection(Fournisseur::where('type_id',2)->get()));
    }

    public function getBoucheries()
    {
	    return  response()->json(FournisseurListResource::collection(Fournisseur::where('type_id',3)->get()));
    }

    public function getChambres()
    {
	    return  response()->json(FournisseurListResource::collection(Fournisseur::where('type_id',4)->get()));
    }


    public function getPromotions($id){
        $promotions = Promotion::orderBy('created_at','DESC')->where('fournisseur_id',$id)->where('to','>',Carbon::today())->get();
        return response()->json(PromotionResource::collection($promotions));
    }

    public function getAccueil($id){
        $carte = Carte::find($id);
        $today = Carbon::today();
        $sites = Site::where('fournisseur_id',$carte->fournisseur_id)->get();
        $tranches = TrancheResource::collection(Tranche::where('fournisseur_id',$carte->fournisseur_id)->get());
        $promotions = Promotion::orderBy('created_at','DESC')->where('fournisseur_id',$carte->fournisseur_id)->where('to','>',Carbon::today())->get();
        $bon = BonAchat::where('carte_id',$id)->where('validated_by',0)->where('expired_at','>=',$today)->first();
        $br = $bon? new BonAchatResource($bon):null;
        $rayons = Category::where('fournisseur_id',$carte->fournisseur_id)->where('is_active',1)->where('parent_id',0)->get();
        $favoris = Favori::orderBy('created_at','DESC')->where('carte_id',$id)->get();
    
        return response()->json([
                'promotions'=>PromotionResource::collection($promotions),
                'bon'=> $br,
                'carte'=>new CarteResource($carte),
                'rayons'=>$rayons,
                'tranches'=>$tranches,
                'sites'=>$sites,
                'fournisseur'=>new FournisseurListResource($carte->fournisseur),
                'favoris'=>FavoriResource::collection($favoris),
        ]);
    }

    public function getHome($id){
        $carte = Carte::find($id);
        $today = Carbon::today();
        $promotions = Promotion::orderBy('created_at','DESC')->where('fournisseur_id',$carte->fournisseur_id)->where('to','>',Carbon::today())->get();
        $bon = BonAchat::where('carte_id',$id)->where('validated_by',0)->where('expired_at','>=',$today)->first();
        $br = $bon? new BonAchatResource($bon):null;
        $rayons = Category::where('fournisseur_id',$carte->fournisseur_id)->where('parent_id',0)->where('is_active',1)->get();
        return response()->json(['promotions'=>PromotionResource::collection($promotions),'bon'=> $br,'carte'=>new CarteResource($carte),'rayons'=>$rayons]);
    }

    public function getMenu($id){
        $promotions = Menu::orderBy('created_at','DESC')->where('fournisseur_id',$id)->get();
        return response()->json(MenuResource::collection($promotions));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new FournisseurResource(Fournisseur::find($id)));
    }

    public function getCategory($id)
    {
        return response()->json(new CategoryResource(Category::find($id)));
    }

    public function getRayons($fournisseur_id){
        $rayons = Category::where('fournisseur_id',$fournisseur_id)->where('parent_id',0)->get();
        return response()->json($rayons);
    }

    public function getSousrayonsByRayonId($rayon_id){
        $srs = Category::where('parent_id',$rayon_id)->where('is_active',1)->get();
        return response()->json($srs);
    }

    public function getProduitsBySousRayonId($id,$site_id){
        $produits = ArticleSite::where('category_id',$id)->where('active',1)->where('site_id',$site_id)->get();
        return response()->json(ProductSiteResource::collection($produits));
    }

    public function getSousrayon($id){
        return response()->json(new CategoryResource(Category::find($id)));
    }

    public function getSiteByCityName($name,$fournisseur_id){
        $ville = Ville::where('name',$name)->first();

        if($ville){
            $site = Site::where('ville_id',$ville->id)->where('fournisseur_id',$fournisseur_id)->first();
            return response()->json($site);
        }else{
            return response()->json(Site::where('fournisseur_id',$fournisseur_id)->first());
        }
    }
//$2y$10$MqkfP326zf2YqBkSZeSkhebZV/zT3BEbPUWE27a7E0qP5qo8Sksb6

}
