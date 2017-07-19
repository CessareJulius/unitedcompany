@extends('app.admin')

@section('contenido')

        <div class="row">
            {!! Form::open(['url'=>'/espacios','method'=>'GET','autocomplete'=>'off','role'=>'search']); !!}
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="buscar" class="form-control" placeholder="Buscar..." value="{{$buscar}}">
                                <span class="input-group-btn"><button class="btn btn-primary">Buscar</button></span>
                            </div>
                        </div>
                    </div>

                
            {!! Form::close() !!}
        </div>
    
    @if(count($espacios) <1 && strlen($buscar)>0)
    <h3>No se encontraron usuarios para {{$buscar}}</h3>
    @else
    @if(strlen($buscar)>0) <h3>Resultados de la búsqueda de: {{$buscar}}</h3>@endif
    <h1>Lista de espacios disponibles <a href="{{action('espacioController@create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</a></h1>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>Nombre</th>
            <th>Direccion</th>            
            <th>Observaciones</th>
            <th>Acciones</th>
            
        </thead>
        <tbody>
            @foreach($espacios as $fila) 

                <tr>
                    <td>{{$fila->nombre}}</td>
                    <td>{{$fila->direccion}}</td>    
                    <td>{{$fila->observaciones}}</td>
  
                    
                    <td>
                        <a class="btn btn-primary" href="{{action('espacioController@edit',['id'=>$fila->id])}}">Editar</a>
                        <a class="btn btn-danger" onclick="$('#modal-delete-{{$fila->id}}').modal('show')">Eliminar</a>
                    </td>

                </tr>
                @include('admin.espacios.modal')
            @endforeach

        </tbody>

    </table>

    <div class="col-sm-12">{{$espacios->render()}}</div>
    @endif
@endsection