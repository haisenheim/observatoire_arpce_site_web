<?php

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
        Route::get('/','FrontController@index')->name('accueil');
        Route::get('/data','FrontController@getData')->name('data');
        Route::get('/dashboard','FrontController@getDashboard')->name('dashboard');
        Route::get('/blog','FrontController@getBlog')->name('blog');
        Route::get('/about','FrontController@getAbout')->name('about');
        Route::get('/faq','FrontController@getFaq')->name('faq');
        Route::get('/rapports','FrontController@getRapports')->name('rapports');
        Route::get('/textes','FrontController@getTextes')->name('textes');
        Route::get('/bonnes-pratiques','FrontController@getPratiques')->name('pratiques');
        Route::get('/article/{token}','FrontController@getArticle')->name('article');
        Route::get('/contact','FrontController@getContactForm')->name('contact');
        Route::post('/sendcontact','FrontController@sendContact')->name('send-contact');
    });

Auth::routes();
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::prefix('account')
    ->namespace('App\Http\Controllers\Account')
    ->middleware(['auth'])
    ->name('account.')
    ->group(function(){
        Route::resource('rapports', 'RapportController');
        Route::resource('fiches', 'FicheController');
        Route::get('fiche/save', 'FicheController@save')->name('save-fiche');
        Route::post('/fiche/datacenter','FicheController@addDatacenter')->name('fiche-datacenter');
        Route::resource('datacenters', 'DatacenterController');
        Route::get('/profil','ProfilController@index')->name('profil');
        Route::post('/profil','ProfilController@store')->name('save-profil');
    });




