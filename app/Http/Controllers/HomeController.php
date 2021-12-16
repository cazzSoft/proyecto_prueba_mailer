<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    /**
     * ?Create a new controller instance.
     *!error
     **importante
     * @return void
     */
    public function __construct()
    {   
       
        // $this->middleware('auth');
         // $this->middleware('validarUser');
    }

    
    public function index()
    {
       
        $listaUser=User::with('ciudad')->get();
        return view('home',['lista_user'=>$listaUser]);
    }

    public function update(Request $request ,$id)
    {

       
    }

    public function show($id)
    {
        
    }


}
