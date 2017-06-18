@extends('app.admin')

@section('contenido')
    
    <div class="container">

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                
            <div class="panel panel-primary">

                <div class="panel-heading"><h3>Menú de opciones</h3></div>           
                <div class="panel-body">
                    <div class="col-sm-2 col-xs-12">
                        <div class="menu-item">
                            <div class="menu-item-content">
                                <a href="{{route('venta.index')}}">
                                    <span class="menu-item-icon"><span class="fa fa-shopping-cart"></span></span>
                                    <h5>Ventas</h5>
                                </a> 
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="menu-item">
                            <div class="menu-item-content">
                                <a href="{{route('ingreso.index')}}">
                                    <span class="menu-item-icon"><span class="fa fa-th"></span></span>
                                    <h5>Ingresos</h5>
                                </a> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="menu-item">
                            <div class="menu-item-content">
                                <a href="{{route('venta.index')}}">
                                    <span class="menu-item-icon"><span class="fa fa-th"></span></span>
                                    <h5>Inventario</h5>
                                </a> 
                            </div>
                        </div>
                    </div>

                </div> 
            </div>
        </div>
    </div>

    </div>

    <style>
        .menu-item {
            margin: 20px;
            text-align: center;
            background-color: #337ab7;
            color: white;
            padding-bottom: 8px;
            border-radius: 5px;
        }
        .menu-item a {
            text-decoration: none;
            color: white;
        }
        .menu-item-icon {
            
            font-size: 50px;
        }
        .menu-item h5 {
            font-size: 15px;
            font-weight: bold;
        }
        
    </style>
       
    
@endsection