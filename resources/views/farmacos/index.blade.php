@extends('app.admin')

@section('contenido')


    <div class="container">
        <div class="row">
            {!! Form::open(['url'=>'/farmacos','method'=>'GET','autocomplete'=>'off','role'=>'search']); !!}
                    <div class="col-sm-11">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="buscar" class="form-control" placeholder="Buscar Ej: Atamel" value="{{$buscar}}">
                                <span class="input-group-btn"><button class="btn btn-primary">Buscar</button></span>
                            </div>
                        </div>
                    </div>

                
            {!! Form::close() !!}
        </div>
    </div>
    
    @if(count($farmacos) <1 && strlen($buscar)>0)
    <h3>No se encontraron artículos para {{$buscar}}</h3>
    @else
    @if(strlen($buscar)>0) <h3>Resultados de la búsqueda de: {{$buscar}}</h3>@endif
    <h1>Lista de Fármacos <a href="{{action('FarmacosController@create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</a></h1>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>Nombre</th>
            <th>Presentación</th>
            <th>Código</th>
            
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($farmacos as $fila) 

                <tr>
                    <td>{{$fila->nombre}}</td>
                    <td>{{$fila->presentacion}}</td>
                    <td>{{$fila->codigo}}</td>
                    
                    <td>
                        <a class="btn btn-primary" href="{{action('FarmacosController@edit',['id'=>$fila->id])}}">Editar</a>
                        <a class="btn btn-danger" onclick="$('#modal-delete-{{$fila->id}}').modal('show')">Eliminar</a>
                    </td>

                </tr>

                @include('farmacos.modal')

            @endforeach

        </tbody>

    </table>
    @endif
@endsection