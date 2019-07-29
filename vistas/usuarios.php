<?php 
//importamos la conexion
  require_once("../config/conexion.php");
  //verifivcamos si existe la session -- se recomienda usar el dato unico en el modulo
  if (isset($_SESSION["ndni"])) {
    
 ?>

<?php require_once("includes/header.php");?>
<?php require_once("includes/navbar.php"); ?>
<div class="container-fluid">

 	<div id="resultados_ajax_usuarios"></div>

    <h1 class="h3 mb-2 text-gray-800">Sección - Usuarios</h1>
      <p>Esta sección es la parte general en base al módulo usuarios, aquí se realizan todos los procesos para los usuarios.</p>
      <!-- Tabla USUARIOS -->
      <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i>Info Usuarios<button class="btn btn-success float-right" id="add_button_usuarios" onclick="limpiar_usuario()" data-toggle="modal" data-target="#usuariosModal"><i class="fa fa-user-plus" aria-hidden="true"></i></button></h5>
            </div>
            <div class="card-body">     
              <div class="table-responsive">
                <table id="usuarios_data" class="table table-bordered  table-hover" width="100%" cellspacing="0">
                	<thead>
                	  	<tr>
	                      <th>Apellidos</th>
	                      <th>Nombres</th>
	                      <th>Dni</th>
                        <th>Carnet</th>
	                      <th>Contacto</th>
                        <th>Editar</th>
                      </tr>
                	</thead>
                	<tfoot>
                		<tr>
	                      <th>Apellidos</th>
	                      <th>Nombres</th>
	                      <th>Dni</th>
                        <th>Carnet</th>
	                      <th>Contacto</th>
	                      <th>Editar</th>
                      	</tr>
                	</tfoot>
                	<tbody>
                		
                	</tbody>
                 </table>
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
              <input type="text" name="carnet" id="carnet" class="form-control" placeholder="Nro Carnet" pattern="[0-9]{10,15}" maxlength="15">
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
<?php require_once("includes/footer.php");?>

<script type="text/javascript" src="js/resolucion_usuarios/usuarios.js"></script>

<?php
//PARA LOGIN 
  }else{
    header("Location:".Conectar::ruta()."index.php");
   exit();
  }
?>
