@extends('app.clientarea')

@section('contenido')   

        @if(Session::has('alert'))
            <div class="alert alert-{{Session::get('alert')['tipo']}}">
                <p>{{Session::get('alert')['mensaje']}}</p>
            </div>
        @endif

    <h1>Lista de Proyectos <a href="{{route('clientarea.proyectos.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Enviar</a></h1>

    <table class="table table-responsive table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>ID</th>
            
            <th>Nombre</th>
            <th>Fecha de postulación</th>
            <th>Acciones</th>
          
            
        </thead>
        <tbody>
            @foreach($proyectos as $fila) 

                    <tr>
                    <td>{{$fila->id}}</td>
                    
                    <td>{{$fila->titulo}}</td>
                    <td>{{$fila->created_at}}</td>
                                        
                    
                    <td>
                        <a class="btn btn-primary"  onclick="$('#modal-show-{{$fila->id}}').modal('show')" >Ver</a>
                        <a class="btn btn-warning" href="{{action('clientarea\proyectoController@edit',['id'=>$fila->id])}}">Editar</a>
                        <a class="btn btn-danger" onclick="$('#modal-delete-{{$fila->id}}').modal('show')">Eliminar</a>
                    </td>

                </tr>
                @include('clientarea.proyectos.modal')
            @endforeach

        </tbody>

    </table>

    <div class="col-sm-12">{{$proyectos->render()}}</div>

@endsection