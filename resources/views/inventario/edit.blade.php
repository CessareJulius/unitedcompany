@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
            <h3>Editar fármaco del inventario</h3>
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
        {{Form::token()}}
                
                <div class="form-group">
                    <div class="input-group">
                        <label for="nombre">Nombre</label><input type="text" value="{{$inventario->nombre}}" class="form-control" placeholder="Nombre" name="nombre" disabled>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <label for="codigo">Código</label><input type="text" value="{{$inventario->codigo}}" class="form-control" placeholder="Código" name="codigo" disabled>
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="input-group">
                        <label for="presentacion">Presentación</label><input type="text" value="{{$inventario->presentacion}}" class="form-control" placeholder="Presentacion" name="presentacion" disabled>
                    </div>
                </div>

                
                <div class="form-group">
                    <div class="input-group">
                        <label for="presentacion">Presentación</label><input type="text" value="{{$inventario->presentacion}}" class="form-control" placeholder="Presentacion" name="presentacion" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="cantidad">Cantidad</label><input type="number" value="{{$inventario->cantidad}}" class="form-control" placeholder="Cantidad" name="cantidad">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="precio_venta">Precio Venta</label><input type="number" value="{{$inventario->precio_venta}}" class="form-control" placeholder="Precio de venta" name="precio_venta">
                    </div>
                </div>  

                <div class="form-group">
                    <div class="input-group">
                        <label for="precio-compra">Precio Compra</label><input type="number" value="{{$inventario->precio_compra}}" class="form-control" placeholder="Precio de venta" name="precio_compra">
                    </div>
                </div>  

                


                <button type="submit" class="btn btn-primary">Editar</button>               
                <a href="{{url('inventario')}}" class="btn btn-danger">Regresar</a>
            </div>
            
        {!! Form::close() !!}

        </div>
    </div>

    
@endsection