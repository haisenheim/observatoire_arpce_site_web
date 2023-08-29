<?php

use App\Http\Controllers\OperateurController;
use App\Mail\SendContactMail;
use App\Mail\SendEmail;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $indicateurs = Indicateur::all();
    $electricite = $indicateurs->where('type_id',1);
    $eau = $indicateurs->where('type_id',2);
    $ges = $indicateurs->where('type_id',3);
    $grp1 = $electricite->groupBy('annee');
    $grp2 = $eau->groupBy('annee');
    $grp3 = $ges->groupBy('annee');
    $sec1 = $grp1->map(function($k){
        return $k->reduce(function($carry,$item){
            return $carry + $item->valeur;
        });
    });
    $sec2 = $grp2->map(function($k){
        return $k->reduce(function($carry,$item){
            return $carry + $item->valeur;
        });
    });
    $sec3 = $grp3->map(function($k){
        return $k->reduce(function($carry,$item){
            return $carry + $item->valeur;
        });
    });
    $source = Source::find(1);
    //dd($sec1);
	return view('Front/index')->with(compact('sec1','sec2','sec3','source'));
})->middleware('active');

Route::get('/data',function(){
   // $indicateurs = Indicateur::all();
    //$electricite = $indicateurs->where('type_id',1);
   // $eau = $indicateurs->where('type_id',2);
    //$ges = $indicateurs->where('type_id',3);
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
});

Route::get('/dashboard', function () {
    $source = Source::find(1);
    $entreprises = Entreprise::where('active',1)->get();
    $name = request()->name;
    if($name){
        $entreprise = Entreprise::where('name',$name)->first();
        return view('Front/donnees_operateur')->with(compact('entreprises','entreprise','source'));
    }

	return view('Front/donnees')->with(compact('entreprises','source'));
})->middleware('active');



Route::get('/blog', function () {
    $rapports = Rapport::all();
    $categories = Category::all();
    $articles = Article::where('active',1)->paginate(1);
    $tags = Tag::all();
	return view('Front/blog')->with(compact('rapports','tags','categories','articles'));
})->middleware('active');

Route::get('/about', function () {
    $param = Param::find(1);
	return view('Front/about')->with(compact('param'));
})->middleware('active');

Route::get('/faq', function () {
    $faqs = Faq::all();
	return view('Front/faq')->with(compact('faqs'));
})->middleware('active');

Route::get('/rapports', function () {
    $rapports = Rapport::orderBy('created_at','DESC')->where('active',1)->paginate(10);
	return view('Front/rapports')->with(compact('rapports'));
})->middleware('active');

Route::get('/textes', function () {
    $textes = Texte::orderBy('created_at','DESC')->where('active',1)->paginate(10);
	return view('Front/textes')->with(compact('textes'));
})->middleware('active');

Route::get('/bonnes-pratiques', function () {
    $pratiques = Pratique::orderBy('created_at','DESC')->where('active',1)->paginate(10);
	return view('Front/pratiques')->with(compact('pratiques'));
})->middleware('active');

Route::get('/article/{token}', function ($token) {
    $article = Article::where('token',$token)->first();
    $tags = Tag::all();
    $categories = Category::all();
	return view('Front/blog-single')->with(compact('article','tags','categories'));
})->middleware('active');

Route::get('/contact', function () {
	return view('Front/contact');
})->middleware('active');

Route::post('/sendcontact',function(){
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
});


Route::post('send-email', function(){

    $data = [
        'name'=>request()->name,
        'email'=>request()->email,
        'message'=>request()->message,
        'subject'=>request()->subject,
    ];

    Mail::to("clementessomba@gmail.com")->send(new SendEmail($data));

    //dd("Mail Sent Successfully!");
    request()->session()->flash('success','Message envoye avec succes');

});



Auth::routes();
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth','admin'])
    ->name('admin.')
    ->group(function(){
        Route::get('/dashboard','DashboardController@index');
        Route::resource('entreprises', 'EntrepriseController');
        Route::resource('articles', 'ArticleController');
        Route::post('article/tag', 'ArticleController@addTag');
        Route::post('article/update', 'ArticleController@save');
        Route::get('fiches/{token}', 'DashboardController@showFiche');
        Route::get('fiche/export/{token}', 'DashboardController@exportFiche');
        Route::get('article/enable/{id}', 'ArticleController@enable');
        Route::get('article/disable/{id}', 'ArticleController@disable');
        Route::get('fiche/save', 'DashboardController@saveFiche');

        Route::resource('faqs', 'FaqController');
        Route::get('faq/enable/{id}', 'FaqController@enable');
        Route::get('faq/disable/{id}', 'FaqController@disable');

        Route::get('communes', 'CommuneController@index');
        Route::post('communes', 'CommuneController@store');
        Route::get('indicateurs', 'IndicateurController@index');
        Route::post('indicateurs', 'IndicateurController@store');
        Route::get('params', 'ParamController@index');
        Route::post('params', 'ParamController@store');
        Route::get('rapports', 'RapportController@index');
        Route::get('categories', 'CategoryController@index');
        Route::post('categories', 'CategoryController@store');
        Route::get('tags', 'TagController@index');
        Route::post('tags', 'TagController@store');
        Route::resource('slides', 'SlideController');
        Route::resource('blog', 'BlogController');
        Route::resource('about', 'AboutController');
        Route::resource('users', 'UserController');
        Route::get('user/enable/{token}', 'UserController@enable');
        Route::get('user/disable/{token}', 'UserController@disable');

    });
//Route::get('/', [OperateurController::class,'index']);
Route::prefix('account')
    ->namespace('App\Http\Controllers\Account')
    ->middleware(['auth'])
    ->name('account.')
    ->group(function(){
        Route::resource('rapports', 'RapportController');
        Route::resource('fiches', 'FicheController');
        Route::get('fiche/save', 'FicheController@save');
        Route::post('/fiche/datacenter','FicheController@addDatacenter');
        Route::resource('datacenters', 'DatacenterController');
        Route::get('/profil','ProfilController@index');
        Route::post('/profil','ProfilController@store');
        Route::resource('articles', 'ArticleController');
    });

Route::get('/print/{id}',[OperateurController::class,'print']);


