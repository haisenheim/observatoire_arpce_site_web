<?php

namespace App\Http\Controllers;

use App\Mail\SendContactMail;
use App\Models\Article;
use App\Models\Category;
use App\Models\Entreprise;
use App\Models\Faq;
use App\Models\Form;
use App\Models\Indicateur;
use App\Models\Param;
use App\Models\Pratique;
use App\Models\Rapport;
use App\Models\Source;
use App\Models\Tag;
use App\Models\Texte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Front/index');
    }

    public function getData(){
        $id = request()->id;

        $source = Source::find(1);
        $forms = Form::where('active',1)->get();
        if($id){
            $forms = $forms->where('entreprise_id',$id);
        }
        $groups = $forms->groupBy('annee');
        $qt_eau = [];
        foreach($groups as $k=>$v){
            $qt_eau[$k] = $v->reduce(function($carry,$item){
                return $carry + $item->qt_eau;
            });
        }
        $energie_elec = [];
        foreach($groups as $k=>$v){
            $energie_elec[$k] = $v->reduce(function($carry,$item){
                return $carry + $item->energie_elec;
            });
        }

        $emissions = [];
        foreach($groups as $k=>$v){
            $emissions[$k] = $v->reduce(function($carry,$item){
                return $carry + $item->emission;
            })/count($v);
        }
        //$eau = $qt_eau/count($forms);
        return response()->json(['elec'=>$energie_elec,'qt_eau'=>$qt_eau,'ges'=>$emissions,'source'=>$source]);
    }

    public function getDashboard(){
        $source = Source::find(1);
        $entreprises = Entreprise::where('active',1)->get();
        $name = request()->name;
        if($name){
            $entreprise = Entreprise::where('name',$name)->first();
            return view('Front/donnees_operateur')->with(compact('entreprises','entreprise','source'));
        }

        return view('Front/donnees')->with(compact('entreprises','source'));
    }

    public function getBlog(){
        $rapports = Rapport::all();
        $categories = Category::all();
        $articles = Article::where('active',1)->paginate(1);
        $tags = Tag::all();
        return view('Front/blog')->with(compact('rapports','tags','categories','articles'));
    }

    public function getAbout(){
        $param = Param::find(1);
	    return view('Front/about')->with(compact('param'));
    }

    public function getFaq(){
        $faqs = Faq::all();
	    return view('Front/faq')->with(compact('faqs'));
    }

    public function getRapports(){
        $rapports = Rapport::orderBy('created_at','DESC')->where('active',1)->paginate(10);
	    return view('Front/rapports')->with(compact('rapports'));
    }

    public function getTextes(){
        $textes = Texte::orderBy('created_at','DESC')->where('active',1)->paginate(10);
        return view('Front/textes')->with(compact('textes'));
    }

    public function getPratiques(){
        $pratiques = Pratique::orderBy('created_at','DESC')->where('active',1)->paginate(10);
	return view('Front/pratiques')->with(compact('pratiques'));
    }

    public function getArticle($token){
        $article = Article::where('token',$token)->first();
        $tags = Tag::all();
        $categories = Category::all();
        return view('Front/blog-single')->with(compact('article','tags','categories'));
    }

    public function getContactForm(){
        return view('Front/contact');
    }

    public function sendContact(){
        $data= request()->all();
        Mail::to('clementessomba@alliages-tech.com')
        ->send(new SendContactMail($data));
        Mail::to('natsy.bouitiviaudo@sbv-consulting.cg')
            ->send(new SendContactMail($data));
            Mail::to('danielle.ouanounga@arpce.cg')
            ->send(new SendContactMail($data));
            Mail::to('pascal.mouandza@arpce.cg')
            ->send(new SendContactMail($data));
        return back();
    }
}
