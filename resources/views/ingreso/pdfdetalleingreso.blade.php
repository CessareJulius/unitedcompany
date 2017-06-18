<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
     <!-- Bootstrap 3.3.5 -->
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  

    <title>Mostrar {{$ingreso->id}}</title>
</head>
<body>

    
            <h3>Ingreso Nº{{$ingreso->id}}</h3>
            
                <p>Nº de Factura: <b>  {{$ingreso->nro_factura}}</b></p>
            
            <label for="fecha">Fecha de ingreso: <b>{{$ingreso->fecha_hora}}</b> </label>
       
                <table >   
                    <thead style="background-color: #3C8DBC; color: white;">
                        <tr>
                            <th>Fármaco</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                        
                            <th>SubTotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($detalleingreso as $de)
                            <tr>
                                
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
                        <th id="total">{{$total}} Bsf.</th>
                        

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