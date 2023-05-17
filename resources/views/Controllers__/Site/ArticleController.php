<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExtendedController;
use App\Imports\ImportIntoCategory;
use App\Imports\ImportIntoRayon;
use App\Imports\ImportIntoSousRayon;
use App\Models\Article;
use App\Models\ArticleSite;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Rayon;
use App\Models\Sousrayon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ArticleController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rayons = Rayon::all()->where('fournisseur_id',auth()->user()->fournisseur_id);
        return view('/Site/Articles/rayons')->with(compact('rayons'));
    }

    public function getAll()
    {
        //
        $articles = collect();
        $categories = Category::all()->where('fournisseur_id',auth()->user()->fournisseur_id);
        foreach($categories as $cat){
            if($cat->articles->count()){
                $cat->articles->each(function($item) use($articles) {
                    $articles->add($item);
                });

            }
        }
        return view('/Site/Articles/all')->with(compact('articles'));
    }


    public function getCategories_(){
        $categories = Category::all()->load('children');
        $data = [];
        for($i=0; $i<count($categories); $i++){
            $data[$i]['text'] = $categories[$i]->name;
            $data[$i]['children'] = [];
            $children = $categories[$i]->children;
            $categories->except($categories[$i]->id);
            for($j=0; $j<count($children);$j++){
                $data[$i]['children'][$j]['text'] = $children[$j]->name;
                $data[$i]['children'][$j]['children'] = [];
                $childrenj = $children[$j]->children;
                $categories->except($children[$j]->id);
                for($k=0; $k<count($childrenj);$k++){
                    $data[$i]['children'][$j]['children'][$k]['text'] = $childrenj[$k]->name;
                }
            }
        }

        return response()->json($data);
    }

    public function saveCategory(){
        $data = request()->except('_token','photo');
        $data['fournisseur_id'] = auth()->user()->fournisseur_id;
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = 1;
        $data['language_id'] = 1;
        $data['image'] = $this->entityImgCreate(request('photo'),'categories',date('HismdYW'));
        Category::create($data);
        return back();
    }

    public function updateCategory(){
        $data = request()->except('_token','photo');
        $cat = Category::find(request('id'));
        $cat->slug = Str::slug($data['name']);
        $cat->name = $data['name'];
        $cat->is_active = 1;
        $cat->language_id = 1;
        if(request('photo')){
            $cat->image = $this->entityImgCreate(request('photo'),'categories',date('HismdYW'));
        }
        $cat->save();
        return back();
    }

    public function updateArticle(){
        $data = request()->except('_token','photo','name');
        $item = ArticleSite::find($data['id']);
        if($item->article){
            $article = $item->article;
            $article->name = request()->name;
            if(request('photo')){
                $article->image = $this->entityPhotoCreate(request('photo'),'uploads',time().$data['id']);
            }
            $item->article->save();
        }


       // dd($data);

        ArticleSite::updateOrCreate(['id'=>request('id')],$data);
        return back();
    }

    public function publish($id,$val){
       // $id = request('id');
        //$val=request('val');
        $article = Article::find($id);
        $article->is_active = $val;
        $article->save();
        return response()->json('ok');
    }



    public function showGridCategories(){
        $categories = Category::all()->where('fournisseur_id',auth()->user()->fournisseur_id);

        return view('/Site/Articles/categories_gridview')->with(compact('categories'));
    }

    public function getCategories(){
       $categories = Category::where('parent_id',0)->where('fournisseur_id',auth()->user()->fournisseur_id)->get();

       return view('/Site/Articles/categories')->with(compact('categories'));
    }

    public function getCategory($id){

        $category = Category::find($id);
        if($category->fournisseur_id!=auth()->user()->fournisseur_id){
            return back();
        }
        return view('/Site/Articles/categorie')->with(compact('category'));
    }

    public function getSubCategory($id){
        $category = Category::find($id);
        if($category->fournisseur_id!=auth()->user()->fournisseur_id){
            return back();
        }
        $articles = ArticleSite::where('category_id',$id)->where('site_id',auth()->user()->site_id)->get();
        return view('/Site/Articles/sub_categorie')->with(compact('category','articles'));
    }

    public function init(){
        $articles = Article::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        $site_id = auth()->user()->site_id;
        $fid = auth()->user()->fournisseur_id;
        ArticleSite::where('site_id',$site_id)->delete();
        foreach($articles as $article){
            ArticleSite::create([
                'article_id'=>$article->id,
                'category_id'=>$article->category_id,
                'price'=>$article->price,
                'site_id'=>$site_id,
                'fournisseur_id'=>$fid,
                'quantity'=>1,
                'sku'=>$article->sku
            ]);
        }
        return back();
    }


    function page_walk2($collection, $parent_id = FALSE)
    {
    $organized_pages = array();

    $children = array();

    foreach($collection as $index => $page)

    {
        //echo json_encode($page->parent_id==0);
        if ( $page->parent_id == 0) // No, just spit it out and you're done
        {
            $organized_pages[$index] = $page;
        }else{
            dd($page->parent_id);
        }
    }

    return $organized_pages;
    }



    function page_walk($array, $parent_id = FALSE)
    {
    $organized_pages = array();

    $children = array();

    foreach($array as $index => $page)
    {
        if ( $page->parent_id == 0) // No, just spit it out and you're done
        {
            $organized_pages[$index] = $page;
            $children = $page->children;
        }
        else // If it does,
        {
            $organized_pages[$parent_id]['children'][$page->id] = $page?$this->page_walk($page, $parent_id):[];
        }
    }

    return $organized_pages;
    }

    public function getPromotions(){
        $promotions = Promotion::all()->where('fournisseur_id',auth()->user()->fournisseur_id);
        return view('/Site/Articles/promotions')->with(compact('promotions'));
    }

    public function enablePromo($token){
       $promo= Promotion::where('token',$token)->first();
        $promo->active = 1;
        $promo->save();
        return back();
    }

    public function disablePromo($token){
        $promo= Promotion::where('token',$token)->first();
         $promo->active = 0;
         $promo->save();
         return back();
     }

     public function enable($id){
        $promo= ArticleSite::find($id);
         $promo->active = 1;
         $promo->save();
         return back();
     }

     public function disable($id){
         $promo= ArticleSite::find($id);
          $promo->active = 0;
          $promo->save();
          return back();
      }

     public function savePromo(){
        $promo= Promotion::find(request()->id);
         $promo->price = request()->price;
         $promo->save();
         return back();
     }

     public function storePromotion($id){
        $data['fournisseur_id'] = auth()->user()->fournisseur_id;
        $data['article_id'] = $id;
        $data['token'] = sha1(time() . $id);
        Promotion::create($data);
         return back();
     }



     public function getCategory_($id){
        $first = Category::find($id);
        //dd($first->articles);
        $categories = Category::all()->where('parent_id',0);
        return view('/Site/Articles/categories')->with(compact('categories','first'));
    }

    public function showCategories(){
        return view('/Site/Articles/categories');
    }

    public function getRayon($token)
    {
        //
        $rayon = Rayon::where('token',$token)->first();
        return view('/Site/Articles/rayon')->with(compact('rayon'));
    }

    public function saveRayon(){
        $token = sha1(auth()->user()->id.date('hismdY'));
        $data = [
            'name'=>request('name'),
            'fournisseur_id'=>auth()->user()->fournisseur_id,
            'token'=>$token,
        ];
        if(request('photo')){
            $data['image'] = $this->entityImgCreate(request('photo'),'rayons',date('HismdYW'));
        }
        Rayon::create($data);
        return back();
    }

    public function saveSousRayon(){
        $token = sha1(auth()->user()->id.date('hismdY'));
       $data = [
        'name'=>request('name'),
        'rayon_id'=>request('rayon_id'),
        'fournisseur_id'=>auth()->user()->fournisseur_id,
        'token'=>$token,
       ];
        if(request('photo')){
            $data['image'] = $this->entityImgCreate(request('photo'),'sousrayons',date('HismdYW'));
        }

        Sousrayon::create($data);
        return back();
    }

    public function save(){

        $data = [
            'price'=>request('price'),
        ];
        if(request('photo')){
            $data['image'] = $this->entityImgCreate(request('photo'),'articles',request('id'));
        }

        Article::updateOrCreate(['id'=>request('id')],$data);
        return back();
    }


    public function getSousRayon($token)
    {
        //
        $rayon = Sousrayon::where('token',$token)->first();
        return view('/Site/Articles/sousrayon')->with(compact('rayon'));
    }

    public function importIntoRayon(){
        $id = request('rayon_id');
        Excel::import(new ImportIntoRayon($id), request()->file('file_to_upload'));
        return back()->with('success', 'Excel Imported.');
    }

    public function importIntoSousRayon($id){
        Excel::import(new ImportIntoSousRayon($id), request()->file('file_to_upload'));
        return back()->with('success', 'Excel Imported.');
    }

 /*   public function importIntoCategory(){
        $id = request('category_id');
        $pp = isset(request('pp'))?1:0;
        Excel::import(new ImportIntoCategory($id,$pp), request()->file('file_to_upload'));
        return back()->with('success', 'Excel Imported.');
    } */



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
	public function show($sku)
	{
        $article = Article::where('sku',$sku)->first();
		return view('/Site/Articles/show')->with(compact('article'));
	}


}
