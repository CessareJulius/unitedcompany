@extends('app.clientarea')

@section('contenido')



    <h3 class="text-center">Ver proyecto</h3> 
    <h1 class="text-center">{{$proyecto->titulo}}</h1>
    <div class="col-sm-6 col-xs-12">
        <fieldset disabled="disabled">
                <legend>Idea de Negocio</legend>
                <div class="col-sm-12">
                    {{$proyecto->idea_negocio}}
                </div>
        </fieldset>
    </div> 
    <div class="col-sm-6 col-xs-12">
        <fieldset disabled="disabled">
            <legend>Objetivo del Proyecto</legend>
            <div class="col-sm-12">
                {{$proyecto->objetivo}}
            </div>
        </fieldset>
    </div>
    <div class="col-sm-6 col-xs-12">
        <fieldset disabled="disabled">
            <legend>Presupuesto</legend>
            <div class="col-sm-12">
                {{$proyecto->presupuesto}}
            </div>
        </fieldset>
    </div>

    <div class="col-sm-6 col-xs-12">
        <fieldset disabled="disabled">
            <legend>Herramientas con las que cuenta</legend>
            <div class="col-sm-12">
                {{$proyecto->herramientas}}
            </div>
        </fieldset>
    </div>

    <div class="col-sm-6 col-xs-12">
        
        <fieldset disabled="disabled">
            <legend>Ubicación</legend>
            <div class="col-sm-12">
                {{$proyecto->ubicacion}}
            </div>
        </fieldset>
    </div>
    


@endsection