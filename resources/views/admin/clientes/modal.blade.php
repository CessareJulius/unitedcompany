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
	{{Form::open(['action'=>['clienteController@membresia',$fila->id],'method'=>'post'])}}
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
					    <p>Membresía actual: <b>{{$membresias[$fila->membership["membership_id"]]}}</b></p>
						<p>Fecha de suscripción: <b>{{$fila->membership["fecha_suscripcion"]}} ({{\Carbon\Carbon::parse($fila->membership["fecha_suscripcion"])->diffForHumans()}})</b></p>
						<p>Expiración: <b>{{$fila->membership["expiration"]}} ({{\Carbon\Carbon::parse($fila->membership["expiration"])->diffForHumans()}})</b></p>
					@endif


					<div class="form-group">
						<label for="">Cambiar membresía a:</label>
						<select name="membresia" id="membresia" class="form-control">
							<option value="0">NINGUNA</option>
							 @foreach($m as $l) 
								
							 	<option value="{{$l->id}}"  @if($fila->membership["membership_id"]==$l->id) selected @endif >{{$membresias[$l->id]}}</option>
								
							 @endforeach
						</select>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>