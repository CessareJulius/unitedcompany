@extends('app.clientarea')

@section('contenido')
    <div class="pull-left">
        <a href="{{route('clientarea.index')}}" class="btn btn-primary">Regresar</a>
    </div>
    <div class="col-sm-4 col-sm-offset-3">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Membresía Activa: {{$membership->membership["tipo"]}}</h3>
            </div>

            <div class="panel-body">
                <p>Fecha de Suscripción: <strong>{{$membership["fecha_suscripcion"]}} ({{\Carbon\Carbon::parse($membership["fecha_suscripcion"])->diffForHumans()}})</strong></p>
                <p>Fecha de expiración: <strong>{{$membership["expiration"]}} ({{\Carbon\Carbon::parse($membership["expiration"])->diffForHumans()}})</strong></p>

            </div>
        </div>
    </div>
@endsection
