<?php

use App\Http\Controllers\OperateurController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Indicateur;
use App\Models\Rapport;
use App\Models\Source;
use App\Models\Tag;
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
    return redirect('login');
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
        Route::get('article/enable/{id}', 'ArticleController@enable');
        Route::get('article/disable/{id}', 'ArticleController@disable');
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
        Route::post('/fiche/datacenter','FicheController@addDatacenter');
        Route::resource('datacenters', 'DatacenterController');
        Route::get('/profil','ProfilController@index');
        Route::post('/profil','ProfilController@store');
        Route::resource('articles', 'ArticleController');

    });




Route::get('/print/{id}',[OperateurController::class,'print']);


