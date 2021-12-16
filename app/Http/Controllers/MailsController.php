<?php

namespace App\Http\Controllers;

use App\MailsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Log;

class MailsController extends Controller
{
    
    public function index()
    {
        if(auth()->user()->tipo_user=='US'){
            $listaMail=MailsModel::with('usuario')->where('iduser',auth()->user()->id)->get(); 
        }else{
            $listaMail=MailsModel::with('usuario')->get(); 
        }

          
        return view('mailUser',['lista_mail'=>$listaMail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //función para validar datos
            $request->validate([
                'destino' => 'required|string|email|max:255',
                'asunto' => 'required|string|max:255',
                'cuerpo' => 'required|string',
            ]);
                
             try {    
                //registro en bd email
                    $saveEmail=new MailsModel();
                    $saveEmail->asunto=$request->asunto;
                    $saveEmail->destino=$request->destino;
                    $saveEmail->cuerpo=$request->cuerpo;
                    $saveEmail->iduser=auth()->user()->id;
                    $saveEmail->destino=$request->destino;

                //envio de mail user
                    try {

                        $de=auth()->user()->email;
                        Mail::send('mail.sendEmail', ['data'=>$request,'name_user'=>auth()->user()->name], function ($m) use ($de,$request) {
                            $m->to($request->destino)
                            ->from($de, 'MAILER S.A. ('.$request->asunto.')')
                            ->subject($request->asunto);
                        });

                        $saveEmail->estado='1';

                    } catch (\Throwable $th) {
                        $saveEmail->estado='0';
                    }
                    
                
                //verificacion de save
                    if ($saveEmail->save()) {
                        return back()->with(['infoE' => 'Se ha guardado el mail  con éxito..', 'estado' => 'success']);
                    } else {
                        return back()->with(['infoE' => 'Lo sentimos no se pudo guardar', 'estado' => 'error']);
                    }
        } catch (\Throwable $th ) {
            Log::error("MailsController => store ".$th->getMessage());
            return back()->with(['infoE' => 'Lo sentimos no se pudo guardar', 'estado' => 'error']);
        }
            
    }

    /** givmlafxlzsmedyz
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
                $id=decrypt($id);
                $consul=MailsModel::with('usuario')->where('idmails',$id)->first();
                if(isset($consul)){
                    return response()->json([
                        'jsontxt'=>['msm'=>'success','estado'=>'success'],
                        'request'=>$consul
                    ],200);
                }else{
                  return response()->json([
                      'jsontxt'=>['msm'=>'Lo sentimos no se pudo obtener el dato','estado'=>'error'],
                      'request'=>null,
                  ],500);  
                }
                

        } catch (\Throwable $th) {
            Log::error("MailsController => edit ".$th->getMessage());
            return response()->json([
                'jsontxt'=>['msm'=>'Lo sentimos no se pudo obtener el dato','estado'=>'error'],
                'request'=>null,
            ],500);
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
