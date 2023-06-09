<?php

use App\Http\Controllers\OperateurController;
use App\Models\Indicateur;
use App\Models\Rapport;
use App\Models\Source;
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
    $indicateurs = Indicateur::all();
    $electricite = $indicateurs->where('type_id',1);
    $eau = $indicateurs->where('type_id',2);
    $ges = $indicateurs->where('type_id',3);
    $source = Source::find(1);
    return response()->json(['elec'=>$electricite,'eau'=>$eau,'ges'=>$ges,'source'=>$source]);
});

Route::get('/dashboard', function () {
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
	return view('Front/about')->with(compact('sec1','sec2','sec3','source'));
})->middleware('active');

Route::get('/blog', function () {
    $rapports = Rapport::all();
	return view('Front/blog')->with(compact('rapports'));
})->middleware('active');

Route::get('/contact', function () {
	return view('Front/contact');
})->middleware('active');



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
        Route::get('communes', 'CommuneController@index');
        Route::post('communes', 'CommuneController@store');
        Route::get('indicateurs', 'IndicateurController@index');
        Route::post('indicateurs', 'IndicateurController@store');
        Route::get('params', 'ParamController@index');
        Route::post('params', 'ParamController@store');
        Route::get('categories', 'CategoryController@index');
        Route::post('categories', 'CategoryController@store');
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
        Route::post('/fiche/datacenter','FicheController@addDatacenter');
        Route::resource('datacenters', 'DatacenterController');
        Route::get('/profil','ProfilController@index');
        Route::post('/profil','ProfilController@store');
        Route::resource('articles', 'ArticleController');

    });




Route::get('/print/{id}',[OperateurController::class,'print']);


