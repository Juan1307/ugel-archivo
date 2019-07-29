<?php 
  //llamamos a la conexion para session
  require_once("../config/conexion.php");
    //verificamos la session
    if (isset($_SESSION["ndni"])) {
      
 ?>

<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navbar.php"); ?>
	
<div class="container-fluid">
  <!--Para mostrar los mensajes del ajax en resolucion-->


     	<h1 class="h3 mb-2 text-gray-800">Sección - Resolución</h1>
        <p>Esta sección esta desarrollada en base al módulo de detalle - control, aquí se realizan solo consultas generales para control.</p> 

  	<!--Para Resolucion Activo-->
  	<div class="form-row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header">
              
             <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-folder"></i>&nbsp;Consulta todas las entregas
              <a href="control.php">
              <button class="btn btn-primary float-right" id="add_button_usuarios"><i class="fas fa-folder-plus"></i></button>
              </a>
             </h5>
             
            </div>
              <div class="card-body">
                <div class="table-responsive">
                <table id="control_detalle_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>RES</th>
                        <th>Emision</th>
                        <th>Area</th>
                        <th>Responsable</th>
                        <th>Folios</th>    
						            <th>Entrega</th>
                        <th>Estado/E</th>
                        <th>Recepcion</th>
                        <th>Estado/R</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>RES</th>
                        <th>Emision</th>
                        <th>Area</th>
                        <th>Responsable</th>
                        <th>N° Folios</th>    
                        <th>Entrega</th>
                        <th>Estado/E</th>
                        <th>Recepcion</th>
                        <th>Estado/R</th>
                       </tr>
                  </tfoot>
                  <tbody>
                    
                  </tbody>
                 </table>
              </div>
              </div>
          </div>
        </div>
  </div>

<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/control_detalle.js"></script>

<?php 

  } else {

    header("Location:".Conectar::ruta()."index.php");
    exit();
  }

?>