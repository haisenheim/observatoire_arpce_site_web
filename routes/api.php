<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Member\DatacenterController;
use App\Http\Controllers\Api\Member\FicheController;
use App\Http\Controllers\Api\Member\ProfilController;
use App\Http\Controllers\Api\Member\RapportController;
use App\Models\Entreprise;
use App\Models\Indicateur;
use App\Models\Source;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/data',function(){
    $indicateurs = Indicateur::all();
    $electricite = $indicateurs->where('type_id',1);
    $eau = $indicateurs->where('type_id',2);
    $ges = $indicateurs->where('type_id',3);
    $source = Source::find(1);
    return response()->json(['elec'=>$electricite,'eau'=>$eau,'ges'=>$ges,'source'=>$source]);
});

Route::get('/',function(){
    return response()->json('Hello');
})->middleware('allow-cors');

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/signin', 'login');
    Route::post('/auth/register', 'register');
    Route::post('/auth/logout', 'logout');
    Route::post('/auth/refresh', 'refresh');

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();
    $entreprise = Entreprise::find($user->entreprise_id);
    return ['user'=>$user,'entreprise'=>$entreprise];
});

Route::middleware('auth:api')->post('/profil', [ProfilController::class,'store']);
Route::middleware('auth:api')->get('/fiches', [FicheController::class,'index']);
Route::middleware('auth:api')->get('/datacenters', [DatacenterController::class,'index']);
Route::middleware('auth:api')->post('/datacenters', [DatacenterController::class,'store']);
Route::middleware('auth:api')->get('/rapports', [RapportController::class,'index']);
Route::middleware('auth:api')->post('/rapports', [RapportController::class,'store']);
Route::middleware('auth:api')->get('/fiche/{token}', [FicheController::class,'find']);
Route::middleware('auth:api')->post('/fiche', [FicheController::class,'store']);
Route::middleware('auth:api')->post('/fiche/df', [FicheController::class,'addDatacenter']);
Route::middleware('auth:api')->post('/fiche/rdf', [FicheController::class,'removeDatacenter']);
