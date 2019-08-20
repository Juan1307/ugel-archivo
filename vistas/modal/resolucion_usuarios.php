	
<!--Formulario USUARIO MODAL-->
<div class="modal fade bd-example-modal-xl"  id="listar_usuarios_modal">

	 <div class="modal-dialog modal-dialog-scrollable " style="max-width: 1340px!important;">

	 	<div id="resultados_ajax_usuarios"></div>

		<div class="modal-content">
		    <div class="modal-header">

        	<h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-user-plus"></i>&nbsp; Añadir Usuarios</h5>

        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>

      		</div>
      		<!--Modal body-->
      		<div class="modal-body">

      			<button class="btn btn-success float-right" id="add_button_usuarios" onclick="limpiar_usuario()" data-toggle="modal" data-target="#usuariosModal"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
      			
      			<div class="table-responsive">
					<table id="resolucion_usuarios_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
					  <thead>
					  	<th>Apellidos</th>
					  	<th>Nombres</th>
					  	<th>Dni</th>
					  	<th>Carnet</th>
					  	<th>Contacto</th>
					  	<th>Agregar</th>
					  	<th>Editar</th>
					  </thead>
					  <tbody>
					  </tbody>
					  <tfoot>
					  	<th>Apellidos</th>
					  	<th>Nombres</th>
					  	<th>Dni</th>
					  	<th>Carnet</th>
					  	<th>Contacto</th>
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
<div id="usuariosModal" class="modal fade">

	 	<div class="modal-dialog">
	 		<form method="POST" id="usuarios_form">
 			  <div class="modal-content">

 				<div class="modal-header">
 					<h5 class="modal-title">Agregar usuario</h5>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>

 				<div class="modal-body">

          <div class="form-row">
            
            <div class="form-group col-md-12">
              <label>Apellidos:</label>
              <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñÑÁÉÍÓÚ\s]{0,50}$" maxlength="50">
            </div>
            <div class="form-group col-md-12">
              <label>Nombres:</label>
              <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" required pattern="^[a-zA-Z_áéíóúñÑÁÉÍÓÚ\s]{0,30}$" maxlength="30">
            </div>
            <div class="form-group col-md-6">
              <label>Nro de DNI:</label>
              <input type="text" name="ndni" id="ndni" class="form-control" placeholder="Doc Identidad" pattern="[0-9]{8}" maxlength="8">
            </div>
            <div class="form-group col-md-6">
              <label>C. Extranjeria:</label>
              <input type="text" name="carnet" id="carnet" class="form-control" placeholder="Nro Carnet" onkeyup="this.value=num(this.value)" maxlength="15">
            </div>
            <div class="form-group col-md-12">
              <label>Contacto:</label>
              <input type="text" name="contacto" id="contacto" class="form-control" placeholder="Cell/Telf" pattern="[0-9]{7,9}" maxlength="9">    
            </div>

          </div>
          
				</div>
   				<div class="modal-footer">

 				<input type="hidden" name="id_usuario" id="id_usuario">

 				<button type="submit" name="action" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

 				<button type="button" onclick="limpiar_usuario()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>

 				</div>
 			  </div>
 			</form>
 		  </div>

</div>