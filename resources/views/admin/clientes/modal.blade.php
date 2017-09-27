<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$fila->id}}">
	{{Form::open(['action'=>['clienteController@destroy',$fila->id],'method'=>'delete'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Cliente</h4>
			</div>
			<div class="modal-body">
				<p>¿Desea eliminar el cliente {{$fila->nombres}}?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>

<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-membresia-{{$fila->id}}">
	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Editar Membresía</h4>
			</div>
			<div class="modal-body">
				<fieldset>
					<legend>Activar o cambiar membresía</legend>
					 @if (!$fila->membership) 
					 	<p>Membresía actual: <b>Sin suscripción </b></p>
					 @else 
					    <p >Membresía actual: <b @if ($fila->membership["status"]=='Suspendido') style="color: red;" @endif>{{$membresias[$fila->membership["membership_id"]]}} ({{$fila->membership["status"]}})</b></p>
						<p>Fecha de suscripción: <b>{{$fila->membership["fecha_suscripcion"]}} ({{\Carbon\Carbon::parse($fila->membership["fecha_suscripcion"])->diffForHumans()}})</b></p>
						<p>Expiración: <b>{{$fila->membership["expiration"]}} ({{\Carbon\Carbon::parse($fila->membership["expiration"])->diffForHumans()}})</b></p>
					@endif


					<div class="form-group">
					{{Form::open(['action'=>['membershipController@store',$fila->id],'method'=>'post'])}}
						<label for="">Cambiar membresía a:</label>
						<select name="membresia" id="membresia" class="form-control">
							<option value="0">NINGUNA</option>
							 @foreach($m as $l) 
								
							 	<option value="{{$l->id}}"  @if($fila->membership["membership_id"]==$l->id) selected @endif >{{$membresias[$l->id]}}</option>
								
							 @endforeach
						</select>
						

					</div>

					<div class="form-group">
							<div class="pull-right">
								<button type="submit" class="btn btn-primary">Cambiar Suscripción</button>
							</div>
						</div>
					{{Form::Close()}}
					@if ($fila->membership) 

						<div class="" id="">
							<div class="form-group">
								@if($fila->membership["status"]=='Expirado')
									<a href="{{route('admin.membership.renovation',$fila->id)}}" class="btn btn-success" >Renovar</a> 
								@endif
								<button type="button" onclick=" $('#extender-{{$fila->id}}').toggle();" class="btn btn-primary" >Extender</button> 
								@if ($fila->membership["status"]=='Activo') 
									<a onclick="sus({{$fila->id}})"  href="{{action('membershipController@suspend',['id'=>$fila->id])}}" class="btn btn-danger" >Suspender </a>
								@elseif($fila->membership["status"]=='Suspendido') 
									<a onclick="sus({{$fila->id}})"  href="{{action('membershipController@unsuspend',['id'=>$fila->id])}}" class="btn btn-danger" >Quitar Suspensión</a>
								@endif
								<a onclick="el({{$fila->id}})" href="{{action('membershipController@delete',['id'=>$fila->id])}}" class="btn btn-warning" >Eliminar </a>
							</div>
							<div id="extender-{{$fila->id}}" class="col-sm-12" style="display: none;">

								{{Form::open(['action'=>['membershipController@extend',$fila->id],'method'=>'post'])}}
								<div class="form-group">
									<div class="input-group">
                                        
									    <input type="number" name="dias" class="form-control" value="30" placeholder="Días a extender">
                                        <span class="input-group-btn"><button class="btn btn-primary" type="submit">Aceptar</button></span>
                                    </div>
								</div>
								{{Form::Close()}}
							</div>
						
						</div>

					@endif
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				
			</div>
		</div>
	</div>


</div>