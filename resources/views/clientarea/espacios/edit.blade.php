@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
            <h3>Editar espacio {{$espacio->nombre}}</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'PATCH','url'=>['admin/espacios',$espacio->id]]) !!}
        {{Form::token()}}

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="user">Nombre del Espacio</label><input type="text" value="{{$espacio->nombre}}" class="form-control" placeholder="Nombre" name="nombre">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            
                            <label for="direccion">Direccion</label><textarea class="form-control" name="direccion" id="" cols="30" rows="5">{{$espacio->direccion}}</textarea>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="direccion">Observaciones</label><textarea class="form-control" name="observaciones" id="" cols="30" rows="5">{{$espacio->observaciones}}</textarea>
                        </div>
                    </div>
               </div>


                
                <button type="submit" class="btn btn-primary">Editar</button>
                
                <a href="{{url('users')}}" class="btn btn-danger">Regresar</a>
            </div>
            
        {!! Form::close() !!}

        </div>
    </div>

    
@endsection