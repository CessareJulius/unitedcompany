<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
     <!-- Bootstrap 3.3.5 -->
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  

    <title>Inventario de Medicamentos</title>
</head>
<body>

        <p style="float: right;">Fecha: {{Carbon\Carbon::now()}}</p>
        <h1 style="text-align: center">Inventario General de Fármacos</h1>
        
         <table >   
            <thead style="background-color: #3C8DBC; color: white;">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Presentación</th>
                <th>Cantidad</th>
                <th>Precio Venta</th>
                <th>Precio compra</th>
            </tr>
          </thead>
        <tbody>
            @foreach($inventario as $fila) 

                <tr>
                    <td>{{$fila->id}}</td>
                    <td>{{$fila->nombre}}</td>
                    <td>{{$fila->codigo}}</td>
                    <td>{{$fila->presentacion}}</td>
                    <td>{{$fila->cantidad}}</td>
                    <td>{{$fila->precio_venta}}</td>
                    <td>{{$fila->precio_compra}}</td>
                    
                  

                </tr>

            @endforeach

        </tbody>

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