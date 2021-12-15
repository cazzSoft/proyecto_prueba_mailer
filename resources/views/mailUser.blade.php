@extends('mailerPrincipal')
@section('title','HOME')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',false)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.daterangepicker',false)

{{-- cuerpo de la pagina --}}
@section('contenido')

    @section('content_header')
        <h1>Gestion de Mails</h1>
    @stop
       <div class="card">

         <div class="card-header">
            <div class="row">
              <div class="col-md-4">
                
              </div>
              <div class="col-md-8 text-right">
               
              </div>
            </div>
         </div>
         
          <div class="card-body table-responsive">
            
          </div>
        
       </div>
       <!-- Modal -->
       <div class="modal fade" id="modal-default">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="modal-title">Ayudemos a Samu! <i class="fa fa-smile-beam"></i></h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               
             </div>
           </div>
           <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
       </div>
    @section('include_css') 

      
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
    
     
     
    @stop
    

 @stop
