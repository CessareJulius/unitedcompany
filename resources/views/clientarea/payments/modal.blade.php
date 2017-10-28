<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="consignar-{{$fila->id}}">
	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Consignar Pago</h4>
			</div>
			<div class="modal-body">
				<p>Razón de pago: <strong>{{$fila->razon_pago}}</strong></p>
                <p>Total: <strong>{{$fila->total}}S/.</strong></p>
                <p>Fecha de solicitud: <strong>{{$fila->fecha_solicitud}} ({{\Carbon\Carbon::parse($fila->fecha_solicitud)->diffForHumans()}})</strong></p>

                
                <hr>

                <div class="form-group">
                 
                    <!--a  class="btn btn-primary" target="_blank" href="http://paypal.me/unitedcompany/{{$fila->total}}" onclick="paypal({{$fila->id}})">Pagar con paypal</a-->
                    <a  class="btn btn-success" onclick="banco({{$fila->id}})">Pagar con Cuenta Bancaria</a>
                </div>
               
               {{Form::open(['action'=>['clientarea\paymentController@store',$fila->id],'method'=>'get'])}}
                    
                <div id="paypal-{{$fila->id}}" style="display: none;">
                

                    
                    <div class="input-group">
                    
                    

                        <input type="email" class="form-control" placeholder="Introduzca la cuenta paypal">
                        <span class="input-group-btn"><button type="submit" class="btn btn-primary" >Confirmar Pago</button></span>  
                    
                    </div>
                   
                </div>

                  <div id="banco-{{$fila->id}}" style="display: none;">
                

                    <div class="form-group">
                        <img src="{{asset('img/LogoBCP.png')}}" width="150px" height="50px" alt="">
                        <p><strong>Páguese a nombre de:</strong></p>
                        <p><strong>Nombre:</strong> ROJAS JOEL -Y-PERALTA ROMEL-Y-PAIPAY JES</p>
                        <p><strong>Cuenta: </strong>Mancomunada Conjunta</p>
                        <!--p><strong>Número de Identificación:</strong> 123456</p-->
                        <p><strong>Número de Cuenta:</strong> 191-38964190-0-65</p>
                        
                    </div>
                    <div class="input-group">
                    
                    

                        <input type="text" class="form-control" placeholder="Introduzca el numero de referencia del depósito">
                        <span class="input-group-btn"><button type="submit" class="btn btn-primary" >Confirmar Pago</button></span>  
                    
                    </div>
                   
                </div>

                 {{Form::Close()}}
                
                

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				
			</div>
		</div>
	</div>
	

</div>


<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="info-{{$fila->id}}">
	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Consignar Pago</h4>
			</div>
			<div class="modal-body">
                <p>Razón de pago: <strong>{{$fila->razon_pago}}</strong></p>
                <p>Total: <strong>{{$fila->total}}S/.</strong></p>
                <p>Fecha de solicitud: <strong>{{$fila->fecha_solicitud}} ({{\Carbon\Carbon::parse($fila->fecha_solicitud)->diffForHumans()}})</strong></p>
                <p>Estado: <strong>{{$status[$fila->status]}}</strong> </p>
                    <div class="form-group">
                        <p><strong>Páguese a:</strong> </p>
                        <img width="150px" height="50px" src="{{asset('img/LogoBCP.png')}}" alt="">
                        <hr>
                        <p><strong>Nombre:</strong> UnitedCompany</p>
                        <!--p><strong>Número de Identificación:</strong> 123456</p-->
                        <p><strong>Número de Cuenta:</strong> 191-38964190-0-65</p>
                        
                    </div>
                @if($fila->paypal)
                    <p>Pagado por paypal con la cuenta <strong>{{$fila->paypal["cuenta"]}}</strong></p>
                    <p>el <string>{{$fila->fecha_pago}} ({{\Carbon\Carbon::parse($fila->fecha_pago)->diffForHumans()}})</string></p>
                @endif

                @if($fila->cuenta)
                    <p>Pagado por Cuenta bancaria, Referencia: <strong>{{$fila->cuenta["referencia"]}}</strong></p>
                    <p>el <string>{{$fila->fecha_pago}} ({{\Carbon\Carbon::parse($fila->fecha_pago)->diffForHumans()}})</string></p>
                @endif



                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				
			</div>
		</div>
	</div>
</div>

