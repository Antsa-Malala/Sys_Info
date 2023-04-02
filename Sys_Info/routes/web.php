<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/devise-list', 'App\Http\Controllers\DeviseController@getAll');
Route::get('/devise-By-Id/{id}', 'App\Http\Controllers\DeviseController@getById');
Route::get('/devise-insert/{nom}', 'App\Http\Controllers\DeviseController@insert');
Route::get('/devise-delete/{id}', 'App\Http\Controllers\DeviseController@delete');
Route::get('/devise-update/{id}/{nom}', 'App\Http\Controllers\DeviseController@update');

Route::get('/user-list', 'App\Http\Controllers\UserController@getAll');
Route::get('/user-By-Id/{id}', 'App\Http\Controllers\UserController@getById');
Route::get('/user-insert/{idSociety}/{username}/{password}', 'App\Http\Controllers\UserController@insert');
Route::get('/user-delete/{id}', 'App\Http\Controllers\UserController@delete');
Route::get('/user-update/{id}/{idSociety}/{username}/{password}', 'App\Http\Controllers\UserController@update');

Route::get('/society-list', 'App\Http\Controllers\SocietyController@getAll');
Route::get('/society-By-Id/{id}', 'App\Http\Controllers\SocietyController@getById');
Route::get('/society-insert/{nom}/{creation}/{fondateur}/{nif}/{logo}/{date_exercice}/{status}/{telecopie}/{telephone}', 'App\Http\Controllers\SocietyController@insert');
Route::get('/society-delete/{id}', 'App\Http\Controllers\SocietyController@delete');
Route::get('/society-update/{id}/{nom}/{creation}/{fondateur}/{nif}/{logo}/{date_exercice}/{status}/{telecopie}/{telephone}', 'App\Http\Controllers\SocietyController@update');

Route::get('/location-list', 'App\Http\Controllers\LocationController@getAll');
Route::get('/location-By-Id/{id}', 'App\Http\Controllers\LocationController@getById');
Route::get('/location-insert/{idSociety}/{localisation}/{primaire}', 'App\Http\Controllers\LocationController@insert');
Route::get('/location-delete/{id}', 'App\Http\Controllers\LocationController@delete');
Route::get('/location-update/{id}/{idSociety}/{localisation}/{primaire}', 'App\Http\Controllers\LocationController@update');

Route::get('/exchange-list', 'App\Http\Controllers\ Controller@getAll');
Route::get('/exchange-By-Id/{id}', 'App\Http\Controllers\ExchangeController@getById');
Route::get('/exchange-insert/{idOne}/{idtwo}/{rate}', 'App\Http\Controllers\ExchangeController@insert');
Route::get('/exchange-delete/{id}', 'App\Http\Controllers\ExchangeController@delete');
Route::get('/exchange-update/{id}/{idone}/{idtwo}/{rate}', 'App\Http\Controllers\ExchangeController@update');

Route::get('/plan-list', 'App\Http\Controllers\PlanController@getAll');
Route::get('/plan-By-Numero/{numero}', 'App\Http\Controllers\PlanController@getBynumero');
Route::get('/plan-By-Libelle/{libelle}', 'App\Http\Controllers\PlanController@getBylibelle');
Route::get('/plan-insert/{numeroCompte}/{libelle}', 'App\Http\Controllers\PlanController@insert');
Route::get('/plan-deletenumero/{numero}', 'App\Http\Controllers\PlanController@deletenumero');
Route::get('/plan-deletelibelle/{libelle}', 'App\Http\Controllers\PlanController@deletelibelle');
Route::get('/plan-updatenumero/{numero}/{libelle}', 'App\Http\Controllers\PlanController@updatenumero');
Route::get('/plan-updatelibelle/{numero}/{libelle}', 'App\Http\Controllers\PlanController@updatelibelle');

Route::get('/tiers-list', 'App\Http\Controllers\TiersController@getAll');
Route::get('/tiers-By-Id/{id}', 'App\Http\Controllers\TiersController@getById');
Route::get('/tiers-insert/{idCompte}/{numero}/{libelle}', 'App\Http\Controllers\TiersController@insert');
Route::get('/tiers-delete/{id}', 'App\Http\Controllers\TiersController@delete');
Route::get('/tiers-update/{id}/{idCompte}/{numero}/{libelle}', 'App\Http\Controllers\TiersController@update');

Route::get('/journaux-list', 'App\Http\Controllers\JournauxController@getAll');
Route::get('/journaux-By-Code/{code}', 'App\Http\Controllers\JournauxController@getBycode');
Route::get('/journaux-By-Libelle/{libelle}', 'App\Http\Controllers\JournauxController@getBylibelle');
Route::get('/journaux-insert/{code}/{libelle}', 'App\Http\Controllers\JournauxController@insert');
Route::get('/journaux-deletecode/{code}', 'App\Http\Controllers\JournauxController@deletecode');
Route::get('/journaux-deletelibelle/{libelle}', 'App\Http\Controllers\JournauxController@deletelibelle');
Route::get('/journaux-updatecode/{code}/{libelle}', 'App\Http\Controllers\JournauxController@updatecode');
Route::get('/journaux-updatelibelle/{code   }/{libelle}', 'App\Http\Controllers\JournauxController@updatelibelle');