<?php

namespace App\Http\Controllers;

use App\CiudadModel;
use App\Http\Requests\StoreUsuario;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Http\Requests\StoreUsuarioUd;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 123456qQ-q
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuario $request)
    {
         
        //calculamos la edad
        $edad = Carbon::parse($request->fecha_na)->age;
       if($edad>=18){
            //registro ciudad
            $saveCiudad=new CiudadModel();
            $saveCiudad->description=$request->ciudad;
            // $saveCiudad->save();
            if($saveCiudad->save()){
                //registro usuario
                $user= User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'num_celular' => $request['num_celular'],
                    'idciudad' => $saveCiudad->idciudad,
                    'dni' => $request['dni'],
                    'fecha_na' => $request->fecha_na,
                    'codigo_ci' => $request['codigo_ci'],
                    'tipo_user' => 'US',
                    'password' => Hash::make($request['password']),
                ]);
                return back()->with(['infoC' => 'Datos ingresados con exito.', 'estado' => 'success']);
            }
            
       }else{
            return back()->with(['infoC' => 'El campo fecha de nacimiento es menor de edad.', 'estado' => 'error'])->withInput();
       }
       return 2;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $consulta = User::with('ciudad')->find(decrypt($id));
            return response()->json([
                'jsontxt' => ['msm' => 'success', 'estado' => 'success'],
                'request' => $consulta,
            ], 200);
        } catch (\Throwable $th) {
            Log::error("UsuarioController => edit " . $th->getMessage());
            return response()->json([
                'jsontxt' => ['msm' => 'Lo sentimos algo salio mal..', 'estado' => 'error']
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUsuarioUd $request, $id)
    {
        //calculamos la edad  
          return  $edad = Carbon::parse($request->fecha_na)->age;
           if($edad>=18){
                $user= User::find(decrypt($id));
                if(isset($user->idciudad)){
                    $saveCiudad= CiudadModel::find($user->idciudad);  
                     $saveCiudad->description=$request->ciudad;     
                    if( $saveCiudad->save()){

                        //update user
                        $user->name=$request['name'];
                        // $user->email=$request['email'];
                        $user->num_celular=$request['num_celular'];
                        $user->idciudad=$saveCiudad->idciudad;
                        // $user->dni=$request['dni'];
                        $user->fecha_na=$request->fecha_na;
                        $user->codigo_ci=$request['codigo_ci'];
                        if($request['password']!=null){
                            $user->password=Hash::make($request['password']);
                        }
                       
                        $user->save();
                         return back()->with(['infoC' => 'Datos Actualizado con exito.', 'estado' => 'success']);
                     }
                }
                
           }else{
                return back()->with(['infoC' => 'El campo fecha de nacimiento es menor de edad.', 'estado' => 'error'])->withInput();
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 11111qeWE-
     */
    public function destroy($id)
    {
        try {

                $consulta = User::find(decrypt($id));

                if ($consulta->delete()) {
                    return back()->with(['infoC' => 'Se ha eliminado con éxito', 'estado' => 'success']);
                } else {
                    return back()->with(['infoC' => 'Lo sentimos, no se pudo eliminar dato relacionado con otro registro', 'estado' => 'waning']);
                }
        } catch (\Throwable $th) {
            Log::error("UsuarioController Error destroy " . $th->getMessage());
            return back()->with(['infoC' => 'Lo sentimos, no se pudo eliminar dato relacionado con otro registro', 'estado' => 'warning']);

        }
    }
}
