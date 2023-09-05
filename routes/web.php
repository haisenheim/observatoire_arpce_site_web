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

Route::namespace('App\Http\Controllers')
    ->middleware(['active'])
    ->name('front.')
    ->group(function(){
        //Route::get('/dashboard','DashboardController@index');
        Route::get('/','FrontController@index');
        Route::get('/data','FrontController@getData');
        Route::get('/dashboard','FrontController@getDashboard');
        Route::get('/blog','FrontController@getBlog');
        Route::get('/about','FrontController@getAbout');
        Route::get('/faq','FrontController@getFaq');
        Route::get('/rapports','FrontController@getRapports');
        Route::get('/textes','FrontController@getTextes');
        Route::get('/bonnes-pratiques','FrontController@getPratiques');
        Route::get('/article/{token}','FrontController@getArticle');
        Route::get('/contact','FrontController@getContactForm');
        Route::post('/sendcontact','FrontController@sendContact');
    });




Auth::routes();
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

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


