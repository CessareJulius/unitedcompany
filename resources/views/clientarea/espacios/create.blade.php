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

        {!! Form::open(['method'=>'POST','url'=>'admin/espacios']) !!}
        {{Form::token()}}

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="user">Nombre del Espacio</label><input type="text" value="{{old('nombre')}}" class="form-control" placeholder="Nombre" name="nombre">
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
                            <label for="direccion">Observaciones</label><textarea class="form-control" name="observaciones" id="" cols="30" rows="5">{{old('observaciones')}}</textarea>
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