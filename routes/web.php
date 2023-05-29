<?php

use App\Http\Controllers\OperateurController;
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
	return view('Front/index');
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
        Route::resource('formations', 'FormationController');
        Route::resource('domaines', 'DomaineController');
        Route::resource('regions', 'RegionController');
        Route::resource('formations', 'FormationController');
        Route::resource('activites', 'ActiviteController');
        Route::resource('cooperatives', 'CooperativeController');
        Route::resource('gics', 'GicController');
        Route::resource('producteurs', 'ExploitantController');
        Route::get('parcelle/{id}','ExploitantController@getParcelle');
        Route::get('parcelle/export/{id}','ExploitantController@exportParcelle');
        Route::resource('agents', 'AgentController');
        Route::resource('zones', 'ZoneController');
        Route::resource('users', 'UserController');
        Route::get('/photos/upload','ExploitantController@showUploadForm');
        Route::post('/photos/upload','ExploitantController@upload');
        Route::get('user/enable/{token}', 'UserController@enable');
        Route::get('user/disable/{token}', 'UserController@disable');

    });
//Route::get('/', [OperateurController::class,'index']);

Route::get('/print/{id}',[OperateurController::class,'print']);


