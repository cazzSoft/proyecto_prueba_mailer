@extends('mailerPrincipal')
@section('title','ADMIN')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Datatables',true)

{{-- cuerpo de la pagina --}}
@section('contenido')

    @section('content_header')
        <h1>Gestion de usuario</h1>
    @stop
       {{-- formulario para crear usuarios --}}
       <div class="row">
         <div class="col-3"></div>
         <div class="col-6">
           <div class="card card-success card-outline  ">
             <div class="card-header">
                 <h3 class="card-title">Email</h3>
             </div>

               <form id="frm_user" method="POST" action="{{ url('gestion/usuario') }}" enctype="multipart/form-data"
                   class="form-horizontal form-label-left">
                   {{ csrf_field() }}
                   <input id="method_u" type="hidden" name="_method" value="POST">
                   <div class="card-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nombres <span class="text-red">*</span></label>
                          <input type="text" class="form-control  @error('name') is-invalid @enderror " 
                              id="name" name="name" value="{{ old('name') }}" placeholder="Nombres" >
                          {!! $errors->first('name', '<small style="color:red;">*:message <br></small>') !!}
                      </div>
                      <div class="form-group">
                           <label for="exampleInputEmail1">Email <span class="text-red">*</span></label>
                           <input type="email" class="form-control  @error('email') is-invalid @enderror " 
                               id="email" name="email" value="{{ old('email') }}" placeholder="Para" >
                           {!! $errors->first('email', '<small style="color:red;">*:message <br></small>') !!}
                      </div>

                      <div class="form-group">
                         <label>Seleccione País <span class="text-red">*</span></label>
                         <select class="select2 form-control form-control-sm  @error('pais') is-invalid @enderror" name="pais" id="pais"  data-placeholder="Buscar Pais"  value="{{ old('pais') }}">
                          <option></option>
                         </select>
                      </div>
                      <div class="form-group">
                         <label>Seleccione estados <span class="text-red">*</span></label>
                         <select class="select2 form-control form-control-sm  @error('estados') is-invalid @enderror" name="" id="estados"  data-placeholder="Buscar estados"  value="{{ old('estados') }}">
                          <option> </option>
                         </select>
                      </div>
                      <div class="form-group">
                         <label>Seleccione ciudad <span class="text-red">*</span></label>
                         <select class="select2 form-control form-control-sm  @error('ciudad') is-invalid @enderror" name="ciudad" id="ciudad"  data-placeholder="Buscar ciudad"  value="{{ old('ciudad') }}" >
                          <option></option>
                         </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Num. Celular <span class="text-red">*</span></label>
                          <input type="text" max="10" class="form-control  @error('num_celular') is-invalid @enderror " 
                              id="num_celular" name="num_celular" value="{{ old('num_celular') }}" placeholder="Num. Celular" >
                          {!! $errors->first('num_celular', '<small style="color:red;">*:message <br></small>') !!}
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Cédula <span class="text-red">*</span></label>
                          <input type="text" max="11" class="form-control  @error('dni') is-invalid @enderror " 
                              id="dni" name="dni" value="{{ old('dni') }}" placeholder="Cédula" >
                          {!! $errors->first('dni', '<small style="color:red;">*:message <br></small>') !!}
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Fecha nacimiento <span class="text-red">*</span></label>
                          
                          <input type="date" class="form-control  @error('fecha_na') is-invalid @enderror " 
                              id="fecha_na" name="fecha_na" value="{{ old('fecha_na') }}" placeholder="Fecha nacimiento" >
                          {!! $errors->first('fecha_na', '<small style="color:red;">*:message <br></small>') !!}
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Código ciudad <span class="text-red">*</span></label>
                          <input type="number" mix="1" class="form-control  @error('codigo_ci') is-invalid @enderror " 
                              id="codigo_ci" name="codigo_ci" value="{{ old('codigo_ci') }}" placeholder="Código ciudad" >
                          {!! $errors->first('codigo_ci', '<small style="color:red;">*:message <br></small>') !!}
                      </div>

                      <div class="form-group ">
                          <label for="password">Password <span class="text-red">*</span></label>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                              {!! $errors->first('password', '<small style="color:red;">*:message <br></small>') !!}
                      </div>

                      <div class="form-group ">
                          <label for="password-confirm" >{{ __('Confirm Password') }} <span class="text-red">*</span></label>
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                      </div>

                   </div>
                   <div class="card-footer">
                       <button type="submit" class="btn btn-primary " id="btn_u"><i class="fa fa-paper-plane"></i>  Enviar</button>
                       <button type="reset" class="btn btn-warning " id="btn_can"> <i
                        class="fa fa-times"></i>Cancelar</button>
                   </div>
               </form>
           </div>
         </div>
       </div>

       {{-- lista de usuarios creados --}}
       <div class="card card-info">
           <div class="card-header">
               <h3 class="card-title"><i class="fa fa-list"></i> Registro de Usuario</h3>
           </div>
           <!-- /.card-header -->
           <div class="card-body table-responsive">

               <table  class="data_table table table-sm table-bordered table-striped">
                   <thead>
                       <tr>
                           <th>#</th>
                           <th>Cédula</th>
                           <th>Nombre</th>
                           <th>Email</th>
                           <th>ciudad </th>
                           <th>Celular</th>
                           <th>Fecha na.</th>
                           <th>Edad</th>
                           <th>Cod. ciudad</th>
                          <th width="30px">Opciones </th>
                       </tr>
                   </thead>
                   <tbody>
                       @if (isset($lista_user))
                           @foreach ($lista_user as $key => $item)
                               <tr>
                                   <td>{{ $key + 1 }}</td>
                                   <td>{{ $item->dni }}</td>
                                   <td>{{ $item['name'] }}</td>
                                   <td>{{ $item['email'] }}</td>
                                   <td>@if(isset($item['ciudad']['description'])) {{$item['ciudad']['description']}} @endif </td>
                                   <td>{{ $item['num_celular'] }}</td>
                                   <td>{{ $item['fecha_na'] }}</td>
                                   <td>{{ \Carbon\Carbon::parse($item->fecha_na)->diff(\Carbon\Carbon::now())->format('%y years')}} </td>
                                   <td>{{ $item['codigo_ci'] }}</td>
                                   <td class="text-center" style="vertical-align: middle;">
                                      <form method="POST"  class="frm_eliminar" action="{{url('gestion/usuario/'.encrypt($item->id) )}}"  enctype="multipart/form-data">

                                          <div class="btn-group btn-group-sm">
                                              {{ csrf_field() }}
                                              <input type="hidden" name="_method" value="DELETE">
                                              <a href="#frm_user" class="btn btn-sm btn-primary "
                                                  onclick="editar_user('{{ encrypt($item->id) }}')"><i
                                                      class="fa fa-edit"></i> </a>
                                              @if(auth()->user()->tipo_user!=$item->tipo_user)
                                                <button type="button" class="btn btn-sm btn-danger"
                                                  onclick="btn_eliminar_user(this)"><i class="fa fa-trash"></i> </button>
                                              @endif
                                          </div>

                                      </form> 
                                   </td>

                               </tr>
                           @endforeach
                       @endif
                   </tbody>
               </table>
           </div>
           <!-- /.card-body -->
       </div>
    @section('include_css') 

      
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
      <script >
         $('.select2').select2();
      </script>
      <script src="{{asset('/js/usuario.js')}}"></script>
     {{-- Mensaje de informacion --}}
     @if(session()->has('infoC'))
        <script >
          mostrar_toastr('{{session('infoC')}}','{{session('estado')}}')
        </script>
     @endif
    @stop
    


 @stop
