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
                 
                    <a  class="btn btn-primary" target="_blank" href="http://paypal.me/unitedcompany/{{$fila->total}}" onclick="paypal({{$fila->id}})">Pagar con paypal</a>
                    </div>
                
                <div id="paypal-{{$fila->id}}" style="display: none;">
                    {{Form::open(['action'=>['clientarea\paymentController@store',$fila->id],'method'=>'get'])}}
                    

                    
                    <div class="input-group">
                    
                    

                        <input type="email" class="form-control" placeholder="Introduzca la cuenta paypal">
                        <span class="input-group-btn"><button type="submit" class="btn btn-primary" >Confirmar Pago</button></span>  
                    
                    </div>
                    {{Form::Close()}}
                </div>
                

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				
			</div>
		</div>
	</div>
	

</div>


<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="confirmar-{{$fila->id}}">
	
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

                <hr>
                @if($fila->paypal)
                    <p>Pagado por paypal con la cuenta <strong>{{$fila->paypal["cuenta"]}}</strong></p>
                    <p>el <string>{{$fila->fecha_pago}} ({{\Carbon\Carbon::parse($fila->fecha_pago)->diffForHumans()}})</string></p>
                    
                @endif
				
				@if($fila->cuenta)
                    <p>Pagado por Cuenta bancaria, Referencia: <strong>{{$fila->cuenta["referencia"]}}</strong></p>
                    <p>el <string>{{$fila->fecha_pago}} ({{\Carbon\Carbon::parse($fila->fecha_pago)->diffForHumans()}})</string></p>
					<!--a href="{{action('paymentController@confirmar',['id'=>$fila->id])}}" class="btn btn-primary">Confirmar Pago</a-->
                @endif
                
                
                <a href="{{action('paymentController@confirmar',['id'=>$fila->id])}}" class="btn btn-primary">Confirmar Pago</a>
                
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

                @if($fila->paypal)
                    <p>Pagado por paypal con la cuenta <strong>{{$fila->paypal["cuenta"]}}</strong></p>
                    <p>el <string>{{$fila->fecha_pago}} ({{\Carbon\Carbon::parse($fila->fecha_pago)->diffForHumans()}})</string></p>
                @endif

                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="eliminar-{{$fila->id}}">
	{{Form::open(['action'=>['paymentController@destroy',$fila->id],'method'=>'delete'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Pago</h4>
			</div>
			<div class="modal-body">
				<p>¿Desea eliminar este pago?</p>
                <p>Ten en claro que este pago puede estar ya consignado por parte del usuario y al hacer esto eliminas los registros</p>
			</div>                        
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>