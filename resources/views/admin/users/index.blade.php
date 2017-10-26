@extends('app.admin')

@section('contenido')


  
    <h1>Lista de Usuarios <a href="{{action('UsersController@create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</a></h1>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($users as $fila) 

                <tr>
                    <td>{{$fila->name}}</td>
                    <td>{{$fila->user}}</td>
                    <td>{{$fila->email}}</td>     
                    <td>{{$fila->roles->first()->display_name}}</td>               
                    <td>
                        <a class="btn btn-primary" href="{{action('UsersController@edit',['id'=>$fila->id])}}">Editar</a>
                        <a class="btn btn-danger" onclick="$('#modal-delete-{{$fila->id}}').modal('show')">Eliminar</a>
                    </td>

                </tr>

                @include('admin.users.modal')

            @endforeach

        </tbody>

    </table>

    <div class="col-sm-12">{{$users->render()}}</div>
 
@endsection