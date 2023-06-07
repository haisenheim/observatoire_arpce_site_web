<?php

use App\Http\Controllers\OperateurController;
use App\Models\Indicateur;
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
    //dd($sec1);
	return view('Front/index')->with(compact('sec1','sec2','sec3'));
})->middleware('active');

Route::get('/data',function(){
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
    return response()->json(['sec1'=>$sec1,'sec2'=>$sec2,'sec3'=>$sec3]);
});

Route::get('/about', function () {
	return view('Front/about');
})->middleware('active');

Route::get('/blog', function () {
	return view('Front/blog');
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
        Route::get('/profil','ProfilController@index');
        Route::post('/profil','ProfilController@store');
        Route::resource('articles', 'ArticleController');

    });




Route::get('/print/{id}',[OperateurController::class,'print']);


