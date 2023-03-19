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
Route::post('/add' , 'SocietyController@store');
Route::get('/society/create' , 'SocietyController@create');
Route::post('/login' , 'UserController@login');
Route::get('/home', 'SocietyController@home');
// Route::get('/lala', 'PagesController@goto');
