<?php 
  //llamamos a la conexion para session
  require_once("../config/conexion.php");
    //verificamos la session
    if (isset($_SESSION["ndni"])) {
      
 ?>

<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navbar.php"); ?>
	
<div class="container-fluid">

     	<h1 class="h3 mb-2 text-gray-800">Sección - Resolución - Usuarios</h1>
        <p>Esta es sección esta desarrollada en base al módulo de detalle - resolución, aquí se realizan solo consultas generales para la resolución.</p> 

  	<!--Para Resolucion Activo-->
  	<div class="form-row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header">
              
             <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-folder"></i>&nbsp;Consulta todas las resoluciones
              <a href="resolucion.php">
              <button class="btn btn-primary float-right"><i class="fas fa-folder-plus"></i></button>
              </a>
             </h5>
             
            </div>
              <div class="card-body">
                <div class="table-responsive">
                <table id="resolucion_detalle_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>RES</th>
                        <th>PRO</th>
                        <th>Motivo</th>
						            <th>Emisión</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Dni</th>
                        <th>Carnet</th>
                        <th>Entrega</th>
                        <th>Estado</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>RES</th>
                        <th>PRO</th>
                        <th>Motivo</th>
                        <th>Emisión</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Dni</th>
                        <th>Carnet</th>
                        <th>Entrega</th>
                        <th>Estado</th>
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

<script type="text/javascript" src="js/resolucion_usuarios/resolucion_detalle.js"></script>

<?php 

  } else {

    header("Location:".Conectar::ruta()."index.php");
    exit();
  }

?>