@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <h3>Editar cliente {{$cliente->name}}</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'PATCH','url'=>['admin/clientes',$cliente->id]]) !!}
       
        
        {{Form::token()}}

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <label for="user">Usuario</label><input type="text" value="{{old('user')}}" class="form-control" placeholder="Usuario" name="user">
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <label for="correo">Correo</label><input type="text" value="{{old('email')}}" class="form-control" placeholder="Correo" name="email">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <label for="apellidos">Nombres</label><input type="text" value="{{old('nombres')}}" class="form-control" placeholder="Nombre" name="nombres">
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <label for="apellidos">Apellidos</label><input type="text" value="{{old('apellidos')}}" class="form-control" placeholder="Nombre" name="apellidos">
                        </div>
                    </div>
               </div>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <label for="apellidos">Teléfono</label><input type="number" value="{{old('telefono')}}" class="form-control" placeholder="Teléfono" name="telefono">
                        </div>
                    </div>
               </div>
                
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                        
                     
                        <div class="input-group">
                            <label for="dni"> DNI</label><input type="text" value="{{old('dni')}}" class="form-control" placeholder="DNI" name="dni">
                        </div>
                    
                    </div>
               </div>



               <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                        <label for="birthday" class="col-md-6 control-label">Fecha Nac</label><input id="birthday" type="date" name="birthday" class="form-control md-4" value="{{ old('birthday') }}" required autofocus>

                            @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                        
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <label for="direccion">Direccion</label><textarea class="form-control" name="direccion" id="" cols="90" rows="5">{{old('direccion')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <label for="password">Contraseña</label><input type="password" value="{{old('password')}}" class="form-control" placeholder="Contraseña" name="password">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="password-confirm">Confirmar Contraseña</label><input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                        </div>
                    </div>
                </div>
                

                
                <button type="submit" class="btn btn-primary">Editar</button>
                
                <a href="{{url('admin/clientes')}}" class="btn btn-danger">Regresar</a>
            </div>

                
            
        {!! Form::close() !!}

            
        {!! Form::close() !!}

        </div>
    </div>

    
@endsection