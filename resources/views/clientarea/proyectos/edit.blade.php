
@extends('app.clientarea')

@section('contenido')
    
    <div>
        <div class="col-sm-12">
            <h3>Editar Proyecto</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


        {!! Form::open(['method'=>'PATCH','url'=>['clientarea/proyectos',$proyecto->id]]) !!}
        {{Form::token()}}

               
                <fieldset>
                    <legend>Datos del proyecto</legend>
                </fieldset>

                <div class="col-sm-12 col-xs-12">
                    <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }} ">
                        <div class="input-group">
                            <label for="titulo"></label>
                            <label for="titulo">Título del Proyecto</label><textarea class="form-control" name="titulo" id="" cols="140" rows="1">{{$proyecto->titulo}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="old">
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('idea_negocio') ? ' has-error' : '' }}">
                        <div class="input-group">
                                <label for="idea_negocio">Idea del Negocio</label><textarea class="form-control" name="idea_negocio" id="" cols="90" rows="5">{{$proyecto->idea_negocio}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('objetivo') ? ' has-error' : '' }}">
                        <div class="input-group">
                                <label for="objetivo">Objetivo del Proyecto</label><textarea class="form-control" name="objetivo" id="" cols="90" rows="5">{{$proyecto->objetivo}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    
                    <div class="form-group{{ $errors->has('presupuesto') ? ' has-error' : '' }}">
                    <label for="presupuesto">Presupuesto del proyecto</label>
                        <div class="input-group">
                            
                            <input type="number"  class="form-control" placeholder="Ej. 100000" name="presupuesto" value="{{$proyecto->presupuesto}}">
                            <span class="input-group-addon"><strong>S/.</strong></span>
                        </div>
                    </div>
                </div>

                    <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('herramientas') ? ' has-error' : '' }}">
                        <div class="input-group">
                                <label for="herramientas">Herramientas que cuenta para el proyecto</label><textarea class="form-control" name="herramientas" id="" cols="90" rows="5">{{$proyecto->herramientas}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">

                </div>


                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('ubicacion') ? ' has-error' : '' }}">
                        
                    
                        <div class="input-group">
                            <label for="ubicacion"> Ubicación del proyecto</label><input type="text" value="{{$proyecto->ubicacion}}" class="form-control" placeholder="Ej. Lima" name="ubicacion">
                        </div>
                    
                    </div>
                </div>


                

                
                
                <div class="form-group">

                    <div class="pull-left"><a href="{{url('users')}}" class="btn btn-danger">Regresar</a></div>
                    <div class="pull-right"></div><button type="submit" class="btn btn-primary">Editar Proyecto</button></div>

                </div>
            </div>

                
            
        {!! Form::close() !!}

        </div>
    </div>

    
@endsection
