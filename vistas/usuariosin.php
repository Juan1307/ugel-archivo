<?php 
  //llamamos a la conexion 
  require_once("../config/conexion.php");

    if (isset($_SESSION["ndni"])) {

?>
<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navbar.php"); ?>

<div class="container-fluid">

  <div id="usuariosin_ajax"></div>

	 <h1 class="h3 mb-2 text-gray-800">Sección - Usuarios</h1>
      <p>Esta sección es una sub-parte en base al módulo usuarios, aquí se realizan sub-procesos para los usuarios.</p>
      <!--Usuarios Incompletos Tabla-->
          <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i>Info Usuarios Incompletos</h5>
            </div>

            <div class="card-body">     
              <div class="table-responsive">
                <table id="usuariosin_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                	<thead>
                	  	<tr>
	                      <th>Apellidos</th>
	                      <th>Nombres</th>
	                      <th>Dni</th>
	                      <th>Carnet</th>
	                      <th>Contacto</th>
                        <th>Acciones</th>
                      </tr>
                	</thead>
                	<tfoot>
                		<tr>
	                      <th>Apellidos</th>
	                      <th>Nombres</th>
	                      <th>Dni</th>
	                      <th>Carnet</th>
	                      <th>Contacto</th>
                        <th>Acciones</th>
                      	</tr>
                	</tfoot>
                	<tbody>
                	</tbody>
                 </table>
              </div>
            </div>
        </div>
</div>
<!--Formulario USUARIOSIN MODAL-->

<div id="usuariosinModal" class="modal fade">
  <div class="modal-dialog">
    <form method="POST" id="usuariosin_form">
      <div class="modal-content">

        <div class="modal-header">
          <h5> Completar Usuarios</h5>
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
              <label>Nro de DNI: </label>
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

        </div><!--Fin Body Card-->
        <div class="modal-footer">

          <input type="hidden" name="id_usuario" id="id_usuario">

          <button type="submit" name="action" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" class="btn btn-danger" onclick="limpiar()" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>

        </div>

      </div>
    </form>
    
  </div>
  
</div>

<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/usuarios/usuariosin.js"></script>

<?php
  }else{
    //nos lleva al login
    header("Location:".Conectar::ruta()."index.php");
    exit();
 }
 ?>
