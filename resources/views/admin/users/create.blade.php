@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
            <h3>Crear nuevo usuario</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'POST','url'=>'admin/users']) !!}
        {{Form::token()}}

                
                
                <div class="form-group">
                    <div class="input-group">
                        <label for="name">Nombre</label><input type="text" value="{{old('name')}}" class="form-control" placeholder="Nombre" name="name">
                    </div>
                </div>
            
                   
                <div class="form-group">
                    <div class="input-group">
                        <label for="user">Usuario</label><input type="text" value="{{old('user')}}" class="form-control" placeholder="Usuario" name="user">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <label for="correo">Correo</label><input type="text" value="{{old('email')}}" class="form-control" placeholder="Correo" name="email">
                    </div>
                </div>
            

                
                
                <div class="form-group">
                    <div class="input-group">
                        <label for="password">Contraseña</label><input type="password" value="{{old('password')}}" class="form-control" placeholder="Contraseña" name="password">
                    </div>
                </div>

                 <div class="form-group">
                    <div class="input-group">
                        <label for="password-confirm">Confirmar Contraseña</label><input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label for="tipo">Tipo de Usuario: </label>
                        <select name="tipo" id="" class="form-control">
                            @foreach($roles as $role) 
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endforeach

                            
                        </select>

                    </div>
                </div>
            

                

                
                <button type="submit" class="btn btn-primary">Agregar</button>
                
                <a href="{{url('users')}}" class="btn btn-danger">Regresar</a>
            </div>

                
            
        {!! Form::close() !!}

        </div>
    </div>

    
@endsection