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
       
        $this->middleware('auth');
    }

    
    public function index()
    {
       
        return view('home');
    }

    public function update(Request $request ,$id)
    {

       
    }

    public function show($id)
    {
        
    }


}
