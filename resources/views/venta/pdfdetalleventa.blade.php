<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
        body {
            max-width:800px;
        }
    .invoice-box{
        
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        
        font-size:16px;
        line-height:24px;
        font-family: Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        
        
    }
    
    .invoice-box table tr td:nth-child(2){
        
        text-align: center;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    
    .factura-cliente {
        border: 1px solid black;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="img/logo.png" width="100px; height: 100px" alt="">
                            </td>
                            
                            <td style="text-align: right">
                                Farmacia Sathya,C.A <br>
                                
                                Calle Comercio C/C Juan Bolívar y Villegas<br>
                                 Sector Centro. Municipio Zamora <br>
                                Villa de Cura, Edo. Aragua<br>
                                RIF. J30274659-0
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information ">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <b>Factura N°:</b> {{$venta->nro_factura}}
                                <span style="float: right"><b>Fecha y Hora: </b> {{$venta->fecha_hora}}</span>

                                
                                
                                
                            </td>
                        </tr>
                        <tr class="factura-cliente">
                             
                            <td>
                                <b>Nombre y Apellido: </b> <span style="">{{$venta->nombrecliente}}</span><br>
                                <b>Cédula:</b> <span style="">{{$venta->cedulacliente}}</span>
                                
                            </td>
                            
                            
                        </tr>
                    </table>
                </td>
            </tr>
          
          
            
            <tr class="heading">
                <td>
                    Cantidad
                </td>
                
                <td>
                    Descripción
                </td>
                
                 <td>
                    Precio
                </td>
                
                <td>
                    TOTAL
                </td>
                
            </tr>
            
           
            
                  @foreach($detalleventa as $de)
                            <tr>
                                
                                <td>{{$de->cantidad}}</td>
                                <td>{{$de->nombre}}</td>
                                <td>{{$de->precio_venta}}</td>
                                <td>{{$de->precio_venta*$de->cantidad}}</td>
                            </tr>
                        @endforeach
  
            
            <tr class="total" >
                <td></td>
                <td></td>
                <td><b>Sub-Total:</b></td>
                
                <td>
                    <span style="float: right;">{{$total}} Bsf.</span>
                </td>
            </tr>
                 
            <tr class="total" >
                <td></td>
                <td></td>
                <td><b>IVA 12%:</b> </td>
                
                <td>
                     <span style="float: right;">{{$total*0.12}} Bsf.</span>
                </td>
            </tr>
            <tr class="total" >
                <td></td>
                <td></td>
                <td><b>TOTAL:</b> </td>
                
                <td>
                   <span style="float: right;">{{$total*0.12+$total}} Bsf.</span>
                </td>
            </tr>
        </table>

    </div>
</body>
</html>