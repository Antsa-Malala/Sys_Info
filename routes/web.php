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
<<<<<<< HEAD

Route::post('/login' , 'UserController@login');
=======
Route::post('/login' , 'UserControler@login');
Route::get('/home', 'SocietyController@home');


>>>>>>> 33e7f8c36a4471e1d8548430d83908791b415f7b
// Route::get('/lala', 'PagesController@goto');
