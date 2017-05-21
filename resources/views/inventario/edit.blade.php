@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <h3>Editar fármaco al inventario</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'PATCH','url'=>['inventario',$inventario->id]]) !!}
        
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="farmaco">Código</label>                        
                        <select name="farmaco" id="" class="selectpicker showtick showmenuarrow" data-live-search="true" data-width="100%" disabled>
                            
                                <option value="{{$inventario->id}}" selected>[{{$inventario->codigo}}] {{$inventario->nombre}} {{$inventario->presentacion}}</option>
                            

                        </select>
                        
                    </div>
                </div>
            

                <div class="form-group">
                    <label for="cantidad">Cantidad</label><input type="number" value="{{$inventario->cantidad}}" class="form-control" placeholder="Cantidad" name="cantidad">
                    
                </div>

                <div class="form-group">
                    <label for="precio_venta">Precio Venta</label><input type="number" value="{{$inventario->precio_venta}}" class="form-control" placeholder="Precio de venta" name="precio_venta">
                    
                </div>  

                <div class="form-group">
                    <label for="precio-compra">Precio Compra</label><input type="number" value="{{$inventario->precio_venta}}" class="form-control" placeholder="Precio de venta" name="precio_compra">
                    
                </div>  

                


                <button type="submit" class="btn btn-primary">Editar</button>               
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