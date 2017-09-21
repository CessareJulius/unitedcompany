@extends('app.admin')

@section('contenido')   

        @if(Session::has('alert'))
            <div class="alert alert-{{Session::get('alert')['tipo']}}">
                <p>{{Session::get('alert')['mensaje']}}</p>
            </div>
        @endif

    <h1>Lista de Proyectos de Usuarios</h1>

    <table class="table table-responsive table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Fecha de postulación</th>
            <th>Acciones</th>
          
            
        </thead>
        <tbody>
            @foreach($proyectos as $fila) 

                    <tr>
                    <td>{{$fila->id}}</td>
                    <td>{{$fila->user->user}}</td>
                    <td>{{$fila->titulo}}</td>
                    <td>{{$fila->created_at}}</td>
                                        
                    
                    <td>
                        <a class="btn btn-primary" href="{{action('proyectoController@show',['id'=>$fila->id])}}">Ver</a>
                        <a class="btn btn-warning" href="{{action('proyectoController@edit',['id'=>$fila->id])}}">Editar</a>
                        <a class="btn btn-danger" onclick="$('#modal-delete-{{$fila->id}}').modal('show')">Eliminar</a>
                    </td>

                </tr>
                @include('admin.proyectos.modal')
            @endforeach

        </tbody>

    </table>

    <div class="col-sm-12">{{$proyectos->render()}}</div>

@endsection