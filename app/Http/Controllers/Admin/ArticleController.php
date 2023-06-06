<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ExtendedController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $articles = Article::all();
        $categories = Category::all();
        return view('/Admin/Articles/index')->with(compact('articles','categories'));
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
        $data['name'] = $request->name;
        $data['body'] = $request->body;
        $data['category_id'] = $request->category_id;
        $data['user_id'] = auth()->user()->id;
        $image = request()->image_uri;
        if($image){
            $path = $this->entityImgCreate($image,'articles',time());
            $data['image_uri'] = $path;
        }
        $slide = Article::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($id)
	{
		$exploitant = Exploitant::find($id);
		return view('/Admin/Exploitants/show')->with(compact('exploitant'));
	}

    public function getParcelle($id){
        $parcelle = Parcelle::find($id);
        return view('/Admin/Exploitants/parcelle')->with(compact('parcelle'));
    }

    public function exportParcelle($id){
        $parcelle = Parcelle::find($id);
        return Excel::download(new PointExport($id), $parcelle->exploitant->name.'_'.$parcelle->name.'_points.xlsx');
    }


}
