	
<!--Formulario USUARIO MODAL-->
<div class="modal fade bd-example-modal-xl"  id="agregar_institucion_modal">

	 <div class="modal-dialog modal-dialog-scrollable " style="max-width: 1340px!important;">

	 	<div id="resultados_ajax_institucion"></div>

		<div class="modal-content">
		    <div class="modal-header">

        	<h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-home"></i>&nbsp; Añadir Instituciones</h5>

        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>

      		</div>
      		<!--Modal body-->
      		<div class="modal-body">
      			
      			<div class="table-responsive">
					<table id="agregar_institucion_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
					  <thead>
					  	<th>Institucion</th>
					  	<th>Nivel</th>
					  	<th>Agregar</th>
					  </thead>
					  <tbody>
					  </tbody>
					  <tfoot>
              <th>Institucion</th>
              <th>Nivel</th>
              <th>Agregar</th>
					  </tfoot>
					</table>
				</div>
      		</div>
      		<!--Fin del modal body-->
      		<div class="modal-footer">
      			<button class=" btn btn-danger float-right" data-dismiss="modal">Cerrar</button>
      		</div>
		</div>
 	</div>

</div>
