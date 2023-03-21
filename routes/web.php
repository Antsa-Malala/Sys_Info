<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocietyControler;
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

Route::get('/', 'PagesController@index');

Route::get('/test' , 'OperationController@create' )->name('operation');
Route::post('/testAdd' , 'OperationController@store' );
Route::get('/testE' , function (){
	$data['title'] = 'Live formulary';
	return view('pages.addEcriture')->with($data);
});

Route::post('/testEP', 'EcritureController@store');

Route::post('/add' , 'SocietyController@store');
Route::get('/society/create' , 'SocietyController@create');
Route::post('/login' , 'UserController@login');
Route::get('/home', 'SocietyController@home');


Route::get('/tiers-list', 'TiersController@getAll');
Route::get('/tiers-By-Id/{id}', 'TiersController@getById');
Route::post('/tiers-insert', 'TiersController@insert');
Route::get('/tiers-insertion', 'TiersController@insertion');
Route::get('/tiers-delete/{id}', 'TiersController@delete');
Route::get('/tiers-update_tiers/{idtiers}/{numero}/{libelle}', 'TiersController@update_tiers');
Route::post('/tiers-update', 'TiersController@update');

Route::get('/devise-list', 'DeviseController@getAll');
Route::get('/devise-By-Id/{id}', 'DeviseController@getById');
Route::post('/devise-insert', 'DeviseController@insert');
Route::get('/devise-insertion', 'DeviseController@insertion');
Route::get('/devise-delete/{id}', 'DeviseController@delete');
Route::get('/devise-update_devise/{iddevise}/{nom}', 'DeviseController@update_devise');
Route::post('/devise-update', 'DeviseController@update');

Route::get('/user-list', 'UserController@getAll');
Route::get('/user-By-Id/{id}', 'UserController@getById');
Route::post('/user-insert', 'UserController@insert');
Route::get('/user-insertion', 'UserController@insertion');
Route::get('/user-delete/{id}', 'UserController@delete');
Route::get('/user-update_user/{iduser}/{idsociety}/{username}/{password}', 'UserController@update_user');
Route::post('/user-update', 'UserController@update');

// Society Routes
Route::get('/society-list', 'SocietyController@getAll');
Route::get('/society-profile', 'SocietyController@show');
Route::get('/society-By-Id/{id}', 'SocietyController@getById');
Route::post('/society-insert', 'SocietyController@insert');
Route::get('/society-insertion', 'SocietyController@create');
Route::get('/society-delete/{id}', 'SocietyController@delete');
Route::get('/society-update_society/{idsociety}/{nom}/{creation}/{fondateur}/{nif}/{logo}/{date_exercice}/{status}/{telecopie}/{telephone}/{description}/{nifpath}', 'SocietyController@update_society');
Route::post('/society-update', 'SocietyController@update');

Route::get('/location-list', 'LocationController@getAll');
Route::get('/location-By-Id/{id}', 'LocationController@getById');
Route::post('/location-insert', 'LocationController@insert');
Route::get('/location-insertion', 'LocationController@insertion');
Route::get('/location-delete/{id}', 'LocationController@delete');
Route::get('/location-update_location/{idlocation}/{idsociety}/{localisation}/{primaire}', 'LocationController@update_location');
Route::post('/location-update', 'LocationController@update');

Route::get('/exchange-list', 'ExchangeController@getAll');
Route::get('/exchange-By-Id/{id}', 'ExchangeController@getById');
Route::post('/exchange-insert', 'ExchangeController@insert');
Route::get('/exchange-insertion', 'ExchangeController@insertion');
Route::get('/exchange-delete/{id}', 'ExchangeController@delete');
Route::get('/exchange-update_exchange/{idexchange}/{idone}/{idtwo}/{rate}', 'ExchangeController@update_exchange');
Route::post('/exchange-update', 'ExchangeController@update');

// Plan Comptable Mandeha daholo
Route::get('/plan-list', 'CompteController@index');
Route::get('/plan-By-Numero/{numero}', 'CompteController@getBynumero');
Route::get('/plan-By-Libelle/{libelle}', 'CompteController@getBylibelle');
Route::post('/plan-insert', 'CompteController@store');
Route::get('/plan-insertion', 'CompteController@create');
Route::get('/plan-insertion-csv', 'CompteController@import');
Route::post('/plan-insertion-csv-import', 'CompteController@importCSV');
Route::get('/plan-delete/{idplan}', 'CompteController@destroy');
Route::get('/plan-update_plan/{idplan}', 'CompteController@edit');
Route::post('/plan-update', 'CompteController@update');


Route::get('/journaux-list', 'JournauxController@getAll');
Route::get('/journaux-By-Code/{code}', 'JournauxController@getBycode');
Route::get('/journaux-By-Libelle/{libelle}', 'JournauxController@getBylibelle');
Route::post('/journaux-insert', 'JournauxController@insert');
Route::get('/journaux-insertion', 'JournauxController@insertion');
Route::get('/journaux-delete/{idjournaux}', 'JournauxController@delete');
Route::get('/journaux-update_journaux/{idjournaux}/{code}/{libelle}', 'JournauxController@update_journaux');
Route::post('/journaux-update', 'JournauxController@update');

Route::get('/operation-list', 'OperationController@getAll');
Route::get('/operation-By-Id/{id}', 'OperationController@getById');
Route::post('/operation-insert', 'OperationController@insert');
Route::get('/operation-insertion', 'OperationController@insertion');
Route::get('/operation-delete/{id}', 'OperationController@delete');
Route::get('/operation-update_operation/{idoperation}/{idecriture}/{numpiece}/{compte}/{tiers}/{libelle}/{debit}/{credit}', 'OperationController@update_operation');
Route::post('/operation-update', 'OperationController@update');

// download routes

Route::get('download/{filename}' , function($filename){

	$file_path = "uploads/".$filename;
	if( file_exists($file_path) ){
		return Response::download( $file_path , $filename , [
			'Content-Length: '.filesize($file_path)
		]);
	}else{
		exit("The file doesn't exist");
	}


})->where('filename' , '[A-Za-z0-9\-\_\.]+');

// Route::get('/lala', 'PagesController@goto');
