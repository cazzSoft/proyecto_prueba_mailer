<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


//ruta login
    Route::get('/', function () {
        return view('auth.login'); 
    });
   

//ruta del home page 
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
   
//GESTION CATALOGO
    Route::prefix('gestion')->group(function () {
        Route::resource('/mail', 'MailsController')->middleware('auth');
    });


// rutas auth
Auth::routes();




