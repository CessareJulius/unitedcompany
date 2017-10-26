<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$fila->id}}">
	{{Form::open(['action'=>['proyectoController@destroy',$fila->id],'method'=>'delete'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Proyecto</h4>
			</div>
			<div class="modal-body">
				<p>¿Desea eliminar el proyecto}}?</p>
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
role="dialog" tabindex="-1" id="modal-show-{{$fila->id}}">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Ver Proyecto</h4>
			</div>
			<div class="modal-body">
				

			 
				<h1 class="text-center">{{$fila->titulo}}</h1>
				<div class="col-sm-12 col-xs-12">
					<fieldset disabled="disabled">
							<legend>Idea de Negocio</legend>
							<div class="col-sm-12">
								<p>{{$fila->idea_negocio}}<p>
							</div>
					</fieldset>
				</div> 
				<div class="col-sm-12 col-xs-12">
					<fieldset disabled="disabled">
						<legend>Objetivo del fila</legend>
						<div class="col-sm-12">
							<p>{{$fila->objetivo}}<p>
						</div>
					</fieldset>
				</div>
				<div class="col-sm-12 col-xs-12">
					<fieldset disabled="disabled">
						<legend>Presupuesto</legend>
						<div class="col-sm-12">
							<p>{{$fila->presupuesto}}<p>
						</div>
					</fieldset>
				</div>

				<div class="col-sm-12 col-xs-12">
					<fieldset disabled="disabled">
						<legend>Herramientas con las que cuenta</legend>
						<div class="col-sm-12">
							<p>{{$fila->herramientas}}<p>
						</div>
					</fieldset>
				</div>

				<div class="col-sm-12 col-xs-12">
					
					<fieldset disabled="disabled">
						<legend>Ubicación</legend>
						<div class="col-sm-12">
							<p>{{$fila->ubicacion}}<p>
						</div>
					</fieldset>
				</div>
    


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	

</div>