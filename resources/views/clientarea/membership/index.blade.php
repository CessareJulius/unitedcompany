@extends('app.clientarea')

@section('contenido')

    @if(Session::get('membership')=='inactivo')
        <div class="j">
            <div class="alert alert-danger">
                <p>Su membresía está inactiva, por favor verifique</p>
            </div>
        </div>
    @endif
    
    <div class="pull-left">
        <a href="{{route('clientarea.index')}}" class="btn btn-primary">Regresar</a>
    </div>
    <div class="col-sm-6 col-sm-offset-2">

        <div class="panel panel-{{($membership->status=='Suspendido' || $membership->status='Expirado') ? 'warning' : 'primary'}} ">
            <div class="panel-heading">
                <h3 class="text-center">Membresía Activa: {{$membership->membership["tipo"]}}</h3>
            </div>

            <div class="panel-body">
                <p>Estado: <strong>{{$membership["status"]}}</strong></p>
                <p>Fecha de Suscripción: <strong>{{$membership["fecha_suscripcion"]}} ({{\Carbon\Carbon::parse($membership["fecha_suscripcion"])->diffForHumans()}})</strong></p>
                <p>Fecha de expiración: <strong>{{$membership["expiration"]}} ({{\Carbon\Carbon::parse($membership["expiration"])->diffForHumans()}})</strong></p>

                @if($membership->status='Expirado')
                    <div class="col-sm-4 col-sm-offset-4">
                        <a href="{{route('clientarea.membership.renovation')}}" class="btn btn-success">Renovar Suscripción</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
