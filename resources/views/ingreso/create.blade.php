@extends('app.admin')

@section('contenido')
    
    <div>
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <h3>Nuevo ingreso</h3>
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {!! Form::open(['method'=>'POST','url'=>'ingreso']) !!}
        {{Form::token()}}
                
                <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="Número de factura">
                            Nro de Factura: <input type="number" class="form-control" placeholder="Ej: 347232" name="nro_factura" value="{{$nro_factura}}" disabled>
                        </label>
                        
                    </div>
                </div>
                </div>
            
            <div class="row">
                <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="farmaco">Fármaco: 
                                            <select  id="pidfarmaco" class="form-control  showtick showmenuarrow" data-live-search="true" data-width="100%">
                                                @foreach($farmacos as $farmaco)                                            
                                                    <option value="{{$farmaco->id}}">[{{$farmaco->codigo}}] {{$farmaco->nombre}} {{$farmaco->presentacion}}</option>
                                                @endforeach

                                            </select>
                                        </label>
                                    </div>
                                </div>

                                 <div class="col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad: 
                                            <input type="number" class="form-control" id="pidcantidad" placeholder="Cantidad..." >
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="pidprecio_compra">P. Compra: 
                                            <input type="number" class="form-control" id="pidprecio_compra" placeholder="P. Compra" >
                                        </label>
                                    </div>
                                </div>

                                 <div class="col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="pidprecio_venta">P. Venta: 
                                            <input type="number" class="form-control" id="pidprecio_venta" placeholder="P. Venta" >
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-xs-12">
                                
                                        <div class="form-group">
                                            <label for=""><button class="btn btn-primary" type="button" id="pidagregar">Agregar</button></label>
                                        </div>
                                </div>

                                <table class="table table-bordered table-condensed table-striped" id="tingreso">   
                                    <thead style="background-color: #3C8DBC; color: white;">
                                        <th>Acciones</th>
                                        <th>Fármaco</th>
                                        <th>Cantidad</th>
                                        <th>Precio Compra</th>
                                        <th>Precio Venta</th>
                                        <th>SubTotal</th>
                                        
                                    </thead>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th id="total">0.0 Bsf</th>

                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>



                


                <div class="pull-right" id="guardar">
                    <button type="submit" class="btn btn-primary">Agregar</button>               
                    <a href="{{url('inventario')}}" class="btn btn-danger">Regresar</a>
                </div>
            </div>
            
        {!! Form::close() !!}

        </div>
    </div>


    @push('scripts')
        
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script>
        
        $(document).ready(function() {
            $('#pidagregar').click(function(e) {
                e.preventDefault();
                agregar();
            });
        });
        var cont=0,total=0,subtotal=[];
        $('#guardar').hide();

        function agregar() {
            idfarmaco = $("#pidfarmaco").val();
            farmaco = $("#pidfarmaco option:selected").text();
            cantidad = $("#pidcantidad").val();
            precio_compra=$("#pidprecio_compra").val();
            precio_venta=$("#pidprecio_venta").val();

            if(idfarmaco!="" && cantidad!="" && cantidad >0 && precio_compra!="" && precio_venta!="") {
              


                    
                    subtotal[cont]=(cantidad*precio_compra);
                    total=total+subtotal[cont];
                    
                    //var fila='<tr><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+')"></button></td><td><input type="hidden" name="idfarmaco[]" value="'+idfarmaco+'">'+farmaco+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="number" name="precio_compra[]" value"'+precio_compra+'">'+precio_compra+'</td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'">'+precio_venta+'</td></tr>';
                    //ES6:
                    var fila=`<tr id="fila${cont}">
                    <td>
                        <button type="button" class="btn btn-danger" onclick="eliminar('${cont}')">X</button>
                    </td>
                    <td>
                        <input class="form-control" type="hidden" name="idfarmaco[]" value="${idfarmaco}"><b>${farmaco}</b>
                    </td>
                    <td>
                        <input class="form-control" type="number" name="cantidad[]" value="${cantidad}">
                    </td>
                    <td>
                        <input class="form-control" type="number" name="precio_compra[]" value="${precio_compra}">
                    </td>
                    
                    <td>
                        <input class="form-control" type="number" name="precio_venta[]" value="${precio_venta}">
                    </td>
                    
                    <td>
                    <b>${subtotal[cont]}</b>
                    </td>
                    </tr>`;
                    $("#total").html(`Total: ${total} Bsf.`);
                    $("#tingreso").append(fila);
                    evaluar();
                    limpiar();
                    $("#pidfarmaco").focus();
                
            }

            
        }

        //Bootstrap-select
        $('#pidfarmaco').selectpicker({
            style: 'btn-info',
            size: 4
        });

        function limpiar() {
            $("#pidfarmaco").trigger('chosen:update');
            $("#pidcantidad").val("");
            $("#pidprecio_compra").val("");
            $("#pidprecio_venta").val("");
        }
        function evaluar() {
            if (total>0) {
                $("#guardar").show();
            }else {
                $("#guardar").hide();
            }
        }

        function eliminar(i) {
            total=total-subtotal[i];
            $("#total").html(`Total: ${total} Bsf.`);
            $("#fila"+i).fadeOut(function(){
               $(this).remove();
            });
            evaluar();
        }
</script>
    @endpush
    
@endsection