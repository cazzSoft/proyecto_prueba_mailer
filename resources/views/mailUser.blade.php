@extends('mailerPrincipal')
@section('title','MAILS')

{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Datatables',true)

{{-- cuerpo de la pagina --}}
@section('contenido')

    @section('content_header')
        <h1>Gestion de Mails</h1>
    @stop

    @if(auth()->user()->tipo_user=='US')
       {{-- formulario para crear y enviar mails --}}
       <div class="card card-success card-outline">
         <div class="card-header">
             <h3 class="card-title">Email</h3>
         </div>

           <form id="frm_email" method="POST" action="{{ url('gestion/mail') }}" enctype="multipart/form-data"
               class="form-horizontal form-label-left">
               {{ csrf_field() }}
               <input id="method_" type="hidden" name="_method" value="POST">
               <div class="card-body">
                   <div class="form-group">
                       <label for="exampleInputEmail1">Para <span class="text-red">*</span></label>
                       <input type="email" class="form-control  @error('destino') is-invalid @enderror " 
                           id="destino" name="destino" value="{{ old('destino') }}" placeholder="Para" required>
                       {!! $errors->first('destino', '<small style="color:red;">*:message <br></small>') !!}
                   </div>

                   <div class="form-group">
                       <label for="exampleInputEmail1">Asunto</label>
                       <input class="form-control  @error('destino') is-invalid @enderror" name="asunto" id="asunto" placeholder="Agregar un asunto" value="{{ old('asunto') }}">
                        {!! $errors->first('asunto', '<small style="color:red;">*:message <br></small>') !!}
                   </div>

                   <div class="form-group mt-4">
                       {{-- <label for="exampleInputEmail1">Atributo</label> --}}
                           <div class="form-group">
                             <textarea class="form-control @error('destino') is-invalid @enderror" id="cuerpo" placeholder="Cuerpo del mensaje" name="cuerpo" rows="3" value="{{ old('cuerpo') }}"></textarea>
                              {!! $errors->first('cuerpo', '<small style="color:red;">*:message <br></small>') !!}
                           </div>
                   </div>

               </div>
               <div class="card-footer">
                   <button type="submit" class="btn btn-primary " id="btn_email"><i class="fa fa-paper-plane"></i>  Enviar</button>
               </div>
           </form>
       </div> 

    @endif
    
    {{-- lista de mails creados --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-list"></i> Lista Mails</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">

            <table  class="data_table table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Destino</th>
                        <th>Asunto</th>
                        <th>Descripción </th>
                        <th width="30px">Estado</th>
                         <th>Opciones </th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($lista_mail))
                        @foreach ($lista_mail as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->destino }}</td>
                                <td>{{ $item['asunto'] }}</td>
                                <td>{{ $item['cuerpo'] }}</td>
                                @if ($item['estado'])
                                    <td class="text-center text-success bz-success"><i class="fa fa-check "></i>Enviado </td>
                                @else
                                    <td class="text-center text-danger bz-danger"> <i class="fa fa-times"></i>No enviado </td>
                                @endif

                                <td class="text-center" style="vertical-align: middle;">
                                    <button type="button" class="btn btn-sm btn-info" onclick="obtenerFirst('{{$item->idmails_encrypt}}')"><i class="fa fa-eye"></i> </button>
                                    </div> 
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


    {{-- modal --}}
    <!-- Button trigger modal -->
    
    <!-- Modal -->
    <div class="modal fade" id="modalMails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalle mails</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="txtModal">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary "  data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Seccion para insertar CSS--}}
    @section('include_css') 

    @stop   
 
    {{-- Seccion para insertar js--}}
    @section('include_js')
      {{-- Mensaje de informacion --}}
      @if(session()->has('infoE'))
         <script >
           mostrar_toastr('{{session('infoE')}}','{{session('estado')}}')
         </script>
      @endif

      <script src="{{asset('/js/mails.js')}}"></script>
    @stop
    

 @stop
