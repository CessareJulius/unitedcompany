@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
            <h3>Crear nuevo cliente</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'POST','url'=>'admin/clientes']) !!}
        {{Form::token()}}

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="user">Usuario</label><input type="text" value="{{old('user')}}" class="form-control" placeholder="Usuario" name="user">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="apellidos">Nombres</label><input type="text" value="{{old('nombres')}}" class="form-control" placeholder="Nombre" name="nombres">
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="apellidos">Apellidos</label><input type="text" value="{{old('apellidos')}}" class="form-control" placeholder="Nombre" name="apellidos">
                        </div>
                    </div>
               </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="apellidos">Teléfono</label><input type="number" value="{{old('telefono')}}" class="form-control" placeholder="Teléfono" name="telefono">
                        </div>
                    </div>
               </div>
                
                    
                    <div class="form-group">
                        
                        <div class="col-sm-3">
                             <label for="">Doc:</label>
                            <select name="doc" id="" class="form-control">
                                <option value="RUN" selected>RUN</option>
                                <option value="RUN" selected>RUN</option>
                            </select>
                        </div>
                        
                        <div class="col-sm-9">
                            <div class="input-group">
                                <label for="num_doc"> Num</label><input type="text" value="{{old('num_doc')}}" class="form-control" placeholder="Usuario" name="num_doc">
                            </div>
                        </div>
                    </div>
               

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="direccion">Direccion</label><textarea class="form-control" name="direccion" id="" cols="30" rows="5">{{old('direccion')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="correo">Correo</label><input type="text" value="{{old('email')}}" class="form-control" placeholder="Correo" name="email">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="password">Contraseña</label><input type="password" value="{{old('password')}}" class="form-control" placeholder="Contraseña" name="password">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="password-confirm">Confirmar Contraseña</label><input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                        </div>
                    </div>
                </div>
                

                
                <button type="submit" class="btn btn-primary">Agregar</button>
                
                <a href="{{url('users')}}" class="btn btn-danger">Regresar</a>
            </div>

                
            
        {!! Form::close() !!}

        </div>
    </div>

    
@endsection