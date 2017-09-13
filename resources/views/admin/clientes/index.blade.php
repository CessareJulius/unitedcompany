@extends('app.admin')

@section('contenido')   

        @if(Session::has('alert'))
            <div class="alert alert-{{Session::get('alert')['tipo']}}">
                <p>{{Session::get('alert')['mensaje']}}</p>
            </div>
        @endif

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

    <table class="table table-responsive table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>Fecha Nac</th>
            <th>Direccion</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Membresía</th>
            <th>Acciones</th>
            
        </thead>
        <tbody>
            @foreach($clientes as $fila) 

                    <tr>
                    <td>{{$fila->id}}</td>
                    <td>{{$fila->user}}</td>
                    <td>{{$fila->name}}</td>
                    <td>{{$fila->lastname}}</td>
                    <td>{{$fila->dni}}</td>
                    <td>{{$fila->birthday}}</td>
                    <td>{{$fila->address}}</td>    
                    <td>{{$fila->email}}</td>    
                    <td>{{$fila->phone}}</td>    
                    <td><a href="#" onclick="$('#modal-membresia-{{$fila->id}}').modal('show')">@if (!$fila->membership) Sin suscripción @else {{$membresias[$fila->membership["membership_id"]]}} @endif</a></td> 
                    
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