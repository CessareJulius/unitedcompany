@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <h3>Ingreso Nº{{$ingreso->id}}</h3>
            <div class="form-group">
                <label for="nro_factura">Nº de Factura: <input type="number" disabled value="{{$ingreso->nro_factura}}"></label>
            </div>
            <label for="fecha">Fecha de ingreso: <b>{{$ingreso->fecha_hora}}</b> </label>
                <div class="pull-right">
                    <div class="form-group">
                        <a href="{{action('IngresoController@pdfDetalleIngreso',['id'=>$ingreso->id] )}}" class="btn btn-primary"><span class="fa fa-list"></span> Generar PDF</a>
                    </div>
                </div>
                <table class="table table-bordered table-condensed table-striped" id="tingreso">   
                    <thead style="background-color: #3C8DBC; color: white;">
                        <th>ID</th>
                        <th>Fármaco</th>
                        <th>Cantidad</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        
                        <th>SubTotal</th>
                        
                    </thead>

                    <tbody>
                        @foreach($detalleingreso as $de)
                            <tr>
                                <td>{{$de->id}}</td>
                                <td>{{$de->nombre}}</td>
                                <td>{{$de->cantidad}}</td>
                                <td>{{$de->precio_compra}}</td>
                                <td>{{$de->precio_venta}}</td>
                                <td>{{$de->precio_compra*$de->cantidad}}</td>
                            </tr>
                        @endforeach
                        

                    </tbody>

                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="total">{{$total}} Bsf.</th>
                        

                    </tfoot>
                </table>
                {{$detalleingreso->render()}}
            
                <div class="form-group">
                    <a href="{{route('ingreso.index')}}" class="btn btn-primary">Regresar</a>
                </div>
            
        

        </div>
    </div>



@endsection