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

//ruta para iniciar session
    Route::get('/', function () {
        return view('auth.login'); 
    })->middleware('validarUser');


//rutas permitida inicio de seccion
    Route::group(['middleware'=>'auth'],function (){
       
        //ruta del home page 
        Route::get('/home', 'HomeController@index')->name('home')->middleware('validarUser');

       //ruta para gestion mail y usuarios
        Route::prefix('gestion')->group(function () {
            Route::resource('/mail', 'MailsController');
            Route::get('/mails', 'MailsController@email');
            Route::resource('/usuario', 'UsuarioController')->middleware('validarUser');
        });


    });



// rutas auth
    Auth::routes();




