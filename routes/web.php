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
    });




