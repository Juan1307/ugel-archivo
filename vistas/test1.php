<?php 
  //llamamos a la conexion para session
  require_once("../config/conexion.php");
    //verificamos la session
    if (isset($_SESSION["ndni"])) {
      //llamamos a la clase de Area
      require_once("../modelos/Area.php");

      $area = new Area();

        $ar = $area->get_area();//traemos las areas
 ?>

<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navbar.php"); ?>
	
<div class="container-fluid">
  <!--Para mostrar los mensajes del ajax en resolucion-->
      <div id="resultados_ajax_resolucion"></div>

     	<h1 class="h3 mb-2 text-gray-800">Sección - Resolución Usuarios</h1>
        <p>Esta sección esta desarrollada en base al módulo de resolución, aqui se realizan todos los procesos para resolución.</p>

  	<!--Para Resolucion Activo-->
  	<div class="form-row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header">
              
             <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-folder"></i>&nbsp;Todas las Resoluciones
              <a href="resolucion.php">
              <button class="btn btn-primary float-right" id="add_button_usuarios"><i class="fas fa-folder-plus"></i></button>
              </a>
             </h5>
             
            </div>
            
            <!--Abrimos el modal para detalle-->
            <?php require_once("modal/resolucion_detalle.php"); ?>
            <?php require_once("modal/agregar_usuarios.php"); ?>
            <!--Abrimos el modal para detalle-->

              <div class="card-body">
                <div class="table-responsive">
                <table id="resolucion_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Ver</th>
                        <th>RES</th>
                        <th>PRO</th>
                        <th>Motivo</th>
                        <th>Oficina</th>
						            <th>Emision</th>                        
						            <th>Estado</th>
						            <th>Editar</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Ver</th>
                        <th>RES</th>
                        <th>PRO</th>
                        <th>Motivo</th>
                        <th>Oficina</th>
                        <th>Emision</th>                        
                        <th>Estado</th>
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
  </div>

<!--Para Editar Resolucion MODAL-->
<div id="resolucionModal" class="modal fade">

  <div class="modal-dialog">
    <form method="POST" id="resolucion_form">
      <div class="modal-content">

        <div class="modal-header">
          <h5>Editar Resolucion</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="form-row">

            <div class="form-group col-md-3">
              <label>Nº Resolucion:</label>
              <input type="text" name="nresolucion" id="nresolucion" class="form-control" placeholder="Resolucion" required pattern="[0-9]{3,5}" maxlength="5">
            </div>
            <div class="form-group col-md-3">
              <label>Nº Proyecto:</label>
              <input type="text" name="nproyecto" id="nproyecto" class="form-control" placeholder="Proyecto" required pattern="[0-9]{3,5}" maxlength="5">
            </div>  
            <div class="form-group col-md-6">
            <label>Area Oficina:</label>
              <select class="form-control" name="id_area" id="id_area" required>  
                <option value="">---Selecione Area---</option>
                  <?php 
                  for ($i=0; $i < sizeof($ar); $i++) { 
                    ?>
                    <option value="<?php echo $ar[$i]["id_area"]?>"><!--Para el valor que va a tomar value = id_area-->
                      <?php echo $ar[$i]["nombre"]; ?><!--Extraemos el valor que tiene el id_area-->
                    </option>
                  <?php 
                  }//Cierre del for para AREA
                ?>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label>Motivo:</label>
              <select id="id_motivo" name="id_motivo" class="form-control selectpicker" data-live-search="true"></select>
            </div>  
            
            <div class="form-group col-md-6">
              <label>Estado:</label>
                <select class="form-control" name="est" id="est" required>
                  <option value="">---Seleccionar Estado---</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label>Fecha Emision:</label>
              <input type="text" name="f_emision" id="f_emision" data-target="#f_emision" class="form-control" placeholder="Emision" required>    
            </div>        
          </div>
        </div>

        <div class="modal-footer">
        <!--Envio del campo oculto-->
        <input type="hidden" name="id_resolucion" id="id_resolucion">

          <button type="submit" name="action" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" onclick="limpiar()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"  aria-hidden="true"></i>&nbsp;Cancelar</button>

        </div>  

      </div>
    </form>
  </div>
</div>

<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/resolucion.js"></script>
<script type="text/javascript" src="js/resolucion_detalle.js"></script>

<?php 

  } else {

    header("Location:".Conectar::ruta()."index.php");
    exit();
  }

?>