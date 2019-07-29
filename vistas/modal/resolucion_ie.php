	
<!--Formulario USUARIO MODAL-->
<div class="modal fade bd-example-modal-xl"  id="listar_institucion_modal">

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

      			<button class="btn btn-success float-right" id="add_button_institucion" onclick="limpiar_institucion()" data-toggle="modal" data-target="#institucionModal"><i class="fas fa-plus" aria-hidden="true"></i></button>
      			
      			<div class="table-responsive">
					<table id="resolucion_institucion_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
					  <thead>
					  	<th>Institucion</th>
					  	<th>Nivel</th>
					  	<th>Agregar</th>
					  	<th>Editar</th>
					  </thead>
					  <tbody>
					  </tbody>
					  <tfoot>
              <th>Institucion</th>
              <th>Nivel</th>
              <th>Agregar</th>
              <th>Editar</th>
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



<!--Formulario USUARIO MODAL-->
<div id="institucionModal" class="modal fade">

	 	<div class="modal-dialog">
	 		<form method="POST" id="institucion_form">
 			  <div class="modal-content">

 				<div class="modal-header">
 					<h5 class="modal-title">Agregar Institución</h5>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>

 				<div class="modal-body">

          <div class="form-row">
            
            <div class="form-group col-md-12">
              <label>Institución:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre I - E" required onkeyup="this.value=NumText_ie(this.value)" maxlength="80">
            </div>
            <div class="form-group col-md-12">
              <label>Nivel:</label>
              <select class="form-control" name="nivel" id="nivel" required>
                <option value="" selected>---- Seleccione Nivel ----</option>
                <option value="Inicial">Inicial</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
              </select>
            </div>

          </div>
          
				</div>
   				<div class="modal-footer">

 				<input type="hidden" name="id_institucion" id="id_institucion">

 				<button type="submit" name="action" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

 				<button type="button" onclick="limpiar_institucion()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>

 				</div>
 			  </div>
 			</form>
 		  </div>

</div>