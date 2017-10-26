@extends('app.admin')

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
            <th>Usuario</th>
            <th>Razón de Pago</th>            
            <th>Total</th>
            <th>Fecha de Solicitud</th>
            
            <th>Estado</th>
            <th>Acciones</th>
            
        </thead>
        <tbody>
            @foreach($pagos as $fila) 

                <tr>
                    <td>{{$fila->id}}</td>
                    <td>{{$fila->user->user}}</td>
                    <td>{{$fila->razon_pago}}</td>
                    <td>{{$fila->total}}$</td>
                    <td>{{$fila->fecha_solicitud}} ({{\Carbon\Carbon::parse($fila->fecha_solicitud)->diffForHumans()}})</td>    
                    <td>{{$status[$fila->status]}}</td>
                     
                     <td>
                        @if($fila->status==1) 
                            
                        @endif

                        @if($fila->status==2)
                            <button class="btn btn-primary" onclick="$('#confirmar-{{$fila->id}}').modal('show')">Confirmar Pago</button>
                        @endif

                        @if($fila->status==3)
                            <button class="btn btn-primary" onclick="$('#info-{{$fila->id}}').modal('show')">Ver</button>
                        @endif
                        <button class="btn btn-danger" onclick="$('#eliminar-{{$fila->id}}').modal('show')">Eliminar</button>
                     </td>
                     
                     
                    
              
                </tr>
                
                @include('admin.payments.modal')
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