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
Route::get('/testE' , 'EcritureController@create');

Route::post('/testEP', 'EcritureController@store');

Route::post('/add' , 'SocietyController@store');
Route::get('/society/create' , 'SocietyController@create');
Route::post('/login' , 'UserController@login');
Route::get('/home', 'SocietyController@home');

// Tiers routes
Route::get('/tiers-list/{pages?}', 'TiersController@index');
Route::get('/tiers-By-Id/{id}', 'TiersController@getById');
Route::post('/tiers-insert', 'TiersController@store');
Route::get('/tiers-insertion', 'TiersController@create');
Route::get('/tiers-delete/{id}', 'TiersController@destroy');
Route::get('/tiers-update_tiers/{idtiers}', 'TiersController@edit');
Route::post('/tiers-update', 'TiersController@update');

// Route::get('/devise-list', 'DeviseController@getAll');
// Route::get('/devise-By-Id/{id}', 'DeviseController@getById');
// Route::post('/devise-insert', 'DeviseController@insert');
// Route::get('/devise-insertion', 'DeviseController@insertion');
// Route::get('/devise-delete/{id}', 'DeviseController@delete');
// Route::get('/devise-update_devise/{iddevise}/{nom}', 'DeviseController@update_devise');
// Route::post('/devise-update', 'DeviseController@update');

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
Route::get('/plan-list/{pages?}', 'CompteController@index');
Route::get('/plan-By-Numero/{numero}', 'CompteController@getBynumero');
Route::get('/plan-By-Libelle/{libelle}', 'CompteController@getBylibelle');
Route::post('/plan-insert', 'CompteController@store');
Route::get('/plan-insertion', 'CompteController@create');
Route::get('/plan-insertion-csv', 'CompteController@import');
Route::post('/plan-insertion-csv-import', 'CompteController@importCSV');
Route::get('/plan-delete/{idplan}', 'CompteController@destroy');
Route::get('/plan-update_plan/{idplan}', 'CompteController@edit');
Route::post('/plan-update', 'CompteController@update');
Route::get('/TestGet/{pages?}', 'CompteController@TestGet');

// Codes Journaux
Route::get('/journal/{pages?}' , 'EcritureController@index')->name('plans');
Route::get('/journal/{month}' , 'EcritureController@show');
Route::get('/journaux-list/{pages?}', 'JournalController@index');
Route::get('/journaux-By-Code/{code}', 'JournalController@show');
Route::get('/journaux-By-Libelle/{libelle}', 'JournalController@getBylibelle');
Route::post('/journaux-insert', 'JournalController@store');
Route::get('/journaux-insertion', 'JournalController@create');
Route::get('/journaux-delete/{idjournaux}', 'JournalController@destroy');
Route::get('/journaux-update_journaux/{idjournaux}', 'JournalController@edit');
Route::post('/journaux-update', 'JournalController@update');

// Grand Livre mila tenenina hoe fonction inona
// Aleo ny journal no igerer azy
Route::get('/books/{page?}', 'BookController@Index');
Route::get('/books/Show/{compte}', 'BookController@Show');
// Route::post('/journaux-update', 'JournalController@update');

Route::get('/operation-list', 'OperationController@getAll');
Route::get('/operation-By-Id/{id}', 'OperationController@getById');
Route::get('/operation-insert', 'OperationController@create');
Route::get('/operation-insertion', 'OperationController@insertion');
Route::get('/operation-delete/{id}', 'OperationController@delete');
Route::get('/operation-update_operation/{idoperation}/{idecriture}/{numpiece}/{compte}/{tiers}/{libelle}/{debit}/{credit}', 'OperationController@update_operation');
Route::post('/operation-update', 'OperationController@update');
Route::get('/operation-csv', 'OperationController@import');
Route::post('/operation-import-csv', 'OperationController@importCSV');

Route::get('/balance', 'BalanceController@getAll');
Route::get('/bilan', 'BilanController@getBilan');

//Recherche
Route::get('/search_compte', 'CompteController@search');
Route::get('/recherche_compte', 'CompteController@recherche');

Route::get('/search_journal', 'JournalController@search');
Route::get('/recherche_journal', 'JournalController@recherche');

Route::get('/search_tiers', 'TiersController@search');
Route::get('/recherche_tiers', 'TiersController@recherche');

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

Route::get('back' , function(){
	return back();
});

Route::get( '/add-produit' , 'ProduitController@ajout' );
Route::get( '/add-percentage/{page?}' , 'ProduitController@addPercent' );

// Route::get('/lala', 'PagesController@goto');


//Produit
Route::get('/percentage', 'ProduitController@liste_pourcentage_produit');
Route::get('/produit_form', 'ProduitController@insert_form');
Route::post('/produit-insert', 'ProduitController@Store');
Route::get('/produit-list/{pages?}', 'ProduitController@index');
Route::get('/produit-delete/{idproduit}', 'ProduitController@remove');
Route::get('/produit-modifier/{idproduit}', 'ProduitController@modifier');
Route::post('/produit-update', 'ProduitController@update');

Route::post('/produit-modif', 'ProduitController@insertAndUpdate');

Route::get('/produit-present/{idcharge}', 'ProduitController@getproduitpresent');

//charge
Route::get('/produit-by-charge/{idcharge}', 'ProduitController@getproduitbycharge');
Route::get('/insertion-pourcentageproduit/{idproduit}/{idcharge}/{pourcentage}', 'ProduitController@insertpourcentageproduit');
Route::get('/update-pourcentageproduit/{idproduit}/{idcharge}/{pourcentage}', 'ProduitController@updatepourcentageproduit');
Route::get('/insertion-pourcentagecentre/{idproduit}/{idcharge}/{idcentre}/{pourcentage}', 'ProduitController@insertpourcentagecentre');
Route::get('/update-pourcentagecentre/{idproduit}/{idcharge}/{idcentre}/{pourcentage}', 'ProduitController@updatepourcentagecentre');
Route::get('/centre-by-produit/{idcharge}/{idproduit}', 'ProduitController@getcentrebyproduit');
Route::get('/produit-centre/{idcharge}/{idproduit}', 'ProduitController@getproduitcentre');
Route::get('/produit-centre-pourcentage/{idcharge}', 'ProduitController@getproduitcentrebycharge');

//centre
Route::get('/centre_form', 'CentreController@insert_form');
Route::post('/centre-insert', 'CentreController@insert');
Route::get('/centre-list/{pages?}', 'CentreController@index');
Route::get('/centre-delete/{idcentre}', 'CentreController@remove');
Route::get('/centre-modifier/{idcentre}', 'CentreController@modifier');
Route::post('/centre-update', 'CentreController@update');
Route::get('/update-percentage', 'CentreController@modifier_pourcentage');

//COut
Route::get('/insert-cout/{idcharge}/{montant}/{variable}/{fixe}/{date_operation}', 'CoutController@insertion_cout_produit');