@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <h3>Agregar fármaco al inventario</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'POST','url'=>'inventario']) !!}
        {{Form::token()}}
                
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="farmaco">Código</label>                        
                        <select name="farmaco" id="" class="selectpicker showtick showmenuarrow" data-live-search="true" data-width="100%">
                            @foreach($farmacos as $farmaco)
                                <option value="{{$farmaco->id}}">[{{$farmaco->codigo}}] {{$farmaco->nombre}} {{$farmaco->presentacion}}</option>
                            @endforeach

                        </select>
                        
                    </div>
                </div>
            

                <!--div class="form-group">
                        <label for="nombre">Nombre</label><input type="text" value="" class="form-control" placeholder="Nombre" name="nombre" disabled>
                </div>
                
                
                <div class="form-group">
                    <label for="codigo">Código</label><input type="text" value="" class="form-control" placeholder="Código" name="codigo" disabled>
                    
                </div>
            
                <div class="form-group">
                    <label for="presentacion">Presentación</label><input type="text" value="" class="form-control" placeholder="Presentacion" name="presentacion" disabled>
                    
                </div>

                
                <div class="form-group">
                    <label for="presentacion">Presentación</label><input type="text" value="" class="form-control" placeholder="Presentacion" name="presentacion" disabled>
                    
                </div-->

                <div class="form-group">
                    <label for="cantidad">Cantidad</label><input type="number" value="" class="form-control" placeholder="Cantidad" name="cantidad">
                    
                </div>

                <div class="form-group">
                    <label for="precio_venta">Precio Venta</label><input type="number" value="" class="form-control" placeholder="Precio de venta" name="precio_venta">
                    
                </div>  

                <div class="form-group">
                    <label for="precio-compra">Precio Compra</label><input type="number" value="" class="form-control" placeholder="Precio de venta" name="precio_compra">
                    
                </div>  

                


                <button type="submit" class="btn btn-primary">Agregar</button>               
                <a href="{{url('inventario')}}" class="btn btn-danger">Regresar</a>
            </div>
            
        {!! Form::close() !!}

        </div>
    </div>


    @push('scripts')
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script>
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });
</script>
    @endpush
    
@endsection