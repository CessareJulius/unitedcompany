@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
            <h3>Editar fármaco</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'PATCH','url'=>['farmacos',$farmaco->id]]) !!}
        {{Form::token()}}
                
                <div class="form-group">
                    <div class="input-group">
                        <label for="nombre">Nombre</label><input type="text" value="{{$farmaco->nombre}}" class="form-control" placeholder="Nombre" name="nombre">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <label for="codigo">Código</label><input type="text" value="{{$farmaco->codigo}}" class="form-control" placeholder="Código" name="codigo">
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="input-group">
                        <label for="presentacion">Presentación</label><input type="text" value="{{$farmaco->presentacion}}" class="form-control" placeholder="Presentacion" name="presentacion">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Editar</button>               
                <a href="{{url('farmacos')}}" class="btn btn-danger">Regresar</a>
            </div>
            
        {!! Form::close() !!}

        </div>
    </div>

    
@endsection