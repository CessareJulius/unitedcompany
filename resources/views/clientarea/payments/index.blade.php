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
                        @if($fila->status==1) 
                            <button class="btn btn-primary" onclick="$('#consignar-{{$fila->id}}').modal('show')">Consignar pago</button>
                        @endif

                        @if($fila->status==2)
                            <button class="btn btn-primary" onclick="$('#info-{{$fila->id}}').modal('show')">Ver</button>
                        @endif

                        @if($fila->status==3)
                            <button class="btn btn-primary" onclick="$('#info-{{$fila->id}}').modal('show')">Ver</button>
                        @endif
                     </td>
                     
                    
              
                </tr>
                
                @include('clientarea.payments.modal')
            @endforeach

        </tbody>

    </table>
    
    @push('scripts')

        <script>
            function paypal(id) {
                confirm('ATENCIÓN]\nSe redirigirá a una página para procesar el pago vía paypal\nDebe regresar a esta para confirmar la transacción');
                $("#paypal-"+id).show().find('input').prop('name','cuenta_paypal');
            }
        </script>
    @endpush
@endsection