@extends('app.clientarea')

@section('contenido')

    
  
    @if(Session::has('alert')) 

        <div class="alert alert-{{Session::get('alert')['tipo']}}" id="alert">
            {{Session::get('alert')['mensaje']}}
        </div>
        <script>
            
        </script>
    @endif
    <h1>Lista de pagos</h1>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <thead>
            <th>ID</th>
            <th>Razón de Pago</th>            
            <th>Fecha de Solicitud</th>
            <th>Estado</th>
            <th>Acciones</th>
            
        </thead>
        <tbody>
            @foreach($pagos as $fila) 

                <tr>
                    <td>{{$fila->id}}</td>
                    <td>{{$fila->razon_pago}}</td>
                    <td>{{$fila->fecha_solicitud}}</td>    
                    <td>{{$status[$fila->status]}}</td>
  
                    
                    <td>
                        
                    </td>

                </tr>
                
            @endforeach

        </tbody>

    </table>

@endsection