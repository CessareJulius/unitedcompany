@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <div class="row">
                <div class="col-sm-6"> <h3>Venta Nº{{$venta->id}}</h3></div>
                <div class="col-sm-6"><div class="pull-right"><label for="fecha">Fecha de venta: <b>{{$venta->fecha_hora}}</b> </label></div></div>
            </div>
            <div class="form-group">
                <label for="nro_factura">Nº de Factura: <input type="number" disabled value="{{$venta->nro_factura}}"></label>
            </div>
             <div class="form-group">
                <label for="nro_factura">Cliente: <input type="text" disabled value="{{$venta->nombrecliente}}"></label>
            </div>
            <div class="form-group">
                <label for="nro_factura">Cédula: <input type="text" disabled value="{{$venta->cedulacliente}}"></label>
            </div>
            
                <div class="pull-right">
                    <div class="form-group">
                        <a href="{{action('VentaController@pdfDetalleVenta',['id'=>$venta->id] )}}" class="btn btn-primary"><span class="fa fa-list"></span> Generar PDF</a>
                    </div>
                </div>
                <table class="table table-bordered table-condensed table-striped" id="tventa">   
                    <thead style="background-color: #3C8DBC; color: white;">
                        
                        <th>Fármaco</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        
                        <th>SubTotal</th>
                        
                    </thead>

                    <tbody>
                        @foreach($detalleventa as $de)
                            <tr>
                                
                                <td>{{$de->nombre}}</td>
                                <td>{{$de->cantidad}}</td>
                                <td>{{$de->precio_venta}}</td>
                                <td>{{$de->precio_venta*$de->cantidad}}</td>
                            </tr>
                        @endforeach
                        

                    </tbody>

                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                    
                        <th id="total">{{$total}} Bsf.</th>
                        

                    </tfoot>
                </table>
                
            
                <div class="form-group">
                    <a href="{{route('venta.index')}}" class="btn btn-primary">Regresar</a>
                </div>
            
        

        </div>
    </div>



@endsection