@extends('app.clientarea')

@section('contenido')
    
  
    <div class="rosw">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                
            <div class="panel panel-primary">

                <div class="panel-heading"><h3 class="text-center">Escoge el tipo de espacio a reservar</h3></div>           
                <div class="panel-body">
                        <div class="text-center">
                        <div class="col-sm-3 col-xs-12">
                            <div class="menu-item">
                                <div class="menu-item-content">
                                    <a href="{{route('clientes.index')}}">
                                        <span class="menu-item-icon"><span class="fa fa-call"></span></span>
                                        <h5>Llamadas</h5>
                                    </a> 
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="menu-item">
                                <div class="menu-item-content">
                                    <a href="{{route('reservas.index')}}">
                                        <span class="menu-item-icon"><span class="fa fa-calendar"></span></span>
                                        <h5>Reservas</h5>
                                    </a> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="menu-item">
                                <div class="menu-item-content">
                                    <a href="">
                                        <span class="menu-item-icon"><span class="fa fa-briefcase"></span></span>
                                        <h5>Contratos</h5>
                                    </a> 
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="menu-item">
                                <div class="menu-item-content">
                                    <a href="{{route('users.index')}}">
                                        <span class="menu-item-icon"><span class="fa fa-user"></span></span>
                                        <h5>Usuarios</h5>
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
       

     
                <!--End of Tawk.to Script-->
       
    
@endsection