@extends('app.clientarea')


@section('contenido')

    <div class="containedr">
        <div class="row">
            <h3 class="text-center">Usted no cuenta con una membresía, escoja algunos de nuestros planes</h3>
        </div>

        <div class="row">
            
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center">GOLD</h2>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li>Próximamente</li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="text-center">BRONCE</h2>
                    </div>

                    <div class="panel-body">
                        <ul>
                            <li>Presentación de proyectos</li>
                            <li>Asistencia profesional e inmediata</li>
                        </ul>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <a href="{{action('clientarea\membershipController@store',['id'=>3])}}" class="btn btn-primary">Contratar</a>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center">SILVER</h2>
                    </div>

                    <div class="panel-body">
                        <ul>
                            <li>Próximamente</li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection