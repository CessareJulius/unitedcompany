<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Mostrar {{$venta->id}}</title>
</head>
<body>

    
            <h3/>Venta Nº{{$venta->id}}</h3>
            <label for="fecha" style="float: right;">Fecha de venta: <b>{{$venta->fecha_hora}}</b> </label>
            <p>Nº de Factura: <b>  {{$venta->nro_factura}}</b></p>
             
             
            
             
                <label for="nombrecliente">Cliente: <b>{{$venta->nombrecliente}}</b></label>
            
            
                <label for="cedulacliente">Cédula: <b>{{$venta->cedulacliente}}</b></label>
            

            
       
                <table >   
                    <thead style="background-color: #3C8DBC; color: white;">
                        <tr>
                            <th>Fármaco</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        
                            <th>SubTotal</th>
                        </tr>
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
                        <th id="total" style="text-align:center">Total: {{$total}} Bsf.</th>
                        

                    </tfoot>
                </table>
               

<style>

thead:before, thead:after { display: none; }
tbody:before, tbody:after { display: none; }
body {
  font-family: 'Source Sans Pro',sans-serif;
  
}
table {
page-break-inside: auto;
  width: 100%;
  margin-top: 20px;
  
}
table tr {
  
  text-align: center;
  
}
table tbody tr {
  height: 40px;
}
table tbody tr:nth-child(2n+1) {
  background-color: lightgray;
}
table tfoot {
   background-color: #3C8DBC;
  color: white;
}

</style>

    
</body>
</html>