@extends('app.admin')

@section('contenido')

        <div class="row">
            {!! Form::open(['url'=>'/clientes','method'=>'GET','autocomplete'=>'off','role'=>'search']); !!}
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
    
    @if(count($clientes) <1 && strlen($buscar)>0)
    <h3>No se encontraron usuarios para {{$buscar}}</h3>
    @else
    @if(strlen($buscar)>0) <h3>Resultados de la búsqueda de: {{$buscar}}</h3>@endif
    <h1>Lista de Clientes <a href="{{action('clienteController@create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</a></h1>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Documento</th>
            <th>Direccion</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Acciones</th>
            
        </thead>
        <tbody>
            @foreach($clientes as $fila) 

                <tr>
                    <td>{{$fila->nombres}}</td>
                    <td>{{$fila->apellidos}}</td>
                    <td>{{$fila->doc.' '.$fila->num_doc}}</td>
                    <td>{{$fila->direccion}}</td>    
                    <td>{{$fila->user->email}}</td>    

                    <td>{{$fila->telefono}}</td>     
                    
                    <td>
                        <a class="btn btn-primary" href="{{action('clienteController@edit',['id'=>$fila->id])}}">Editar</a>
                        <a class="btn btn-danger" onclick="$('#modal-delete-{{$fila->id}}').modal('show')">Eliminar</a>
                    </td>

                </tr>
                @include('admin.clientes.modal')
            @endforeach

        </tbody>

    </table>

    <div class="col-sm-12">{{$clientes->render()}}</div>
    @endif
@endsection