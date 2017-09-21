@extends('app.clientarea')

@section('contenido')
    
    <div>
        <div class="col-sm-12">
            <h3>Crear nuevo cliente</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'POST','url'=>'clientarea/proyectos']) !!}
        {{Form::token()}}

               
                <fieldset>
                    <legend>Datos del proyecto</legend>
                </fieldset>

                <div class="col-sm-12 col-xs-12">
                    <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }} ">
                        <div class="input-group">
                            <label for="titulo"></label>
                            <label for="titulo">Título del Proyecto</label><textarea class="form-control" name="titulo" id="" cols="140" rows="1">{{old('titulo')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="old">
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('idea_negocio') ? ' has-error' : '' }}">
                        <div class="input-group">
                                <label for="idea_negocio">Idea del Negocio</label><textarea class="form-control" name="idea_negocio" id="" cols="90" rows="5">{{old('idea_negocio')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('objetivo') ? ' has-error' : '' }}">
                        <div class="input-group">
                                <label for="objetivo">Objetivo del Proyecto</label><textarea class="form-control" name="objetivo" id="" cols="90" rows="5">{{old('objetivo')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    
                    <div class="form-group{{ $errors->has('presupuesto') ? ' has-error' : '' }}">
                    <label for="presupuesto">Presupuesto del proyecto</label>
                        <div class="input-group">
                            
                            <input type="number"  class="form-control" placeholder="Ej. 100000" name="presupuesto" value="{{old('presupuesto')}}">
                            <span class="input-group-addon"><strong>S/.</strong></span>
                        </div>
                    </div>
                </div>

                    <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('herramientas') ? ' has-error' : '' }}">
                        <div class="input-group">
                                <label for="herramientas">Herramientas que cuenta para el proyecto</label><textarea class="form-control" name="herramientas" id="" cols="90" rows="5">{{old('herramientas')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">

                </div>


                <div class="col-sm-6 col-xs-12">
                    <div class="form-group{{ $errors->has('ubicacion') ? ' has-error' : '' }}">
                        
                    
                        <div class="input-group">
                            <label for="ubicacion"> Ubicación del proyecto</label><input type="text" value="{{old('ubicacion')}}" class="form-control" placeholder="Ej. Lima" name="ubicacion">
                        </div>
                    
                    </div>
                </div>


                

                
                
                
                <div class="pull-left"><a href="{{url('users')}}" class="btn btn-danger">Regresar</a></div>
                <div class="pull-right"></div><button type="submit" class="btn btn-primary">Enviar Proyecto</button></div>
            </div>

                
            
        {!! Form::close() !!}

        </div>
    </div>

@push('scripts')
    <link rel="stylesheet" href="{{asset('front/css/bootstrap-datepicker3.min.css')}}">
    <script src="{{asset('front/js/bootstrap-datepicker.js')}}"></script>
    <script>
     


            $('[type="date"]').datepicker({
                 format: "yyyy-mm-dd",
                    language: "es",
                    autoclose: true
                        }
                            
            );

        
    </script>

@endpush
    
@endsection
