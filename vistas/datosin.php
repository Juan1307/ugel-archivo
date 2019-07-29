<?php 
  require_once("../config/conexion.php");

  if (isset($_SESSION["ndni"])) {

 ?>
 
<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navbar.php"); ?>

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Datos - Internos</h1>

        <p>Esta sección está desarrollada en base al módulo resolución, aquí se realizan algunos de los sub-procesos para resolución.</p>

	  <div class="row">


      <div class="col-md-6">
          <!--Para los resultados-->
          <div id="resultados_ajax_area"></div>
            <!-- Para Area -->
          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder-plus"></i>&nbsp;Oficina<button class="btn btn-success float-right" id="add_button_area"  onclick="limpiara()" data-toggle="modal" data-target="#areaModal"><i class="fas fa-plus" aria-hidden="true"></i></button></h5>
            </div>
            <div class="card-body">     
              <div class="table-responsive">
                <table id="area_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Área - Oficina</th>
                        <th>Acciones</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Área - Oficina</th>
                        <th>Acciones</th>
                        </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                 </table>
              </div>
            </div>
          </div>
      <!--Fin Area-->
      </div><!--end col area-->
      <!--Modal Area-->
      <div id="areaModal" class="modal fade">
        <div class="modal-dialog">
        <form method="POST" id="area_form">
          <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-titlea">Agregar Oficina</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">

            <label>Nombre del Área - Oficina:</label>
            <input type="text" name="nombre" id="nombre" onkeyup="this.value=NumText(this.value)" class="form-control" placeholder="Nombre" required maxlength="50">

          </div>
          <div class="modal-footer">

          <input type="hidden" name="id_area" id="id_area">

          <button type="submit" name="actiona" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" onclick="limpiara()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>

          </div>
          </div>
        </form>
        </div>
      </div>
      <!--F Modal Area-->

      <div class="col-md-6">
          <!--Para los resultados-->
          <div id="resultados_ajax_motivo"></div>
            <!-- Para Motivo -->
          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder-plus"></i>&nbsp;Motivo<button class="btn btn-success float-right" id="add_button_motivo"  onclick="limpiarm()" data-toggle="modal" data-target="#motivoModal"><i class="fas fa-plus" aria-hidden="true"></i></button></h5>
            </div>
            <div class="card-body">     
              <div class="table-responsive">
                <table id="motivo_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Motivo - Descripción</th>
                        <th>Acciones</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Motivo - Descripción</th>
                        <th>Acciones</th>
                        </tr>
                  </tfoot>
                  <tbody>
                    
                  </tbody>
                 </table>
              </div>
            </div>
          </div>
      <!--Fin Motivo -->
      </div><!--end col motivo-->
      <!--Modal motivo-->
      <div id="motivoModal" class="modal fade">
        <div class="modal-dialog">
        <form method="POST" id="motivo_form">
          <div class="modal-content">

           <div class="modal-header">
            <h5 class="modal-titlem">Agregar Motivo</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">

            <label>Descripción del motivo:</label>
            <input type="text" name="descripcion" id="descripcion" onkeyup="this.value=NumText(this.value)" class="form-control" placeholder="Descripción" required maxlength="100">

          </div>
          <div class="modal-footer">

          <input type="hidden" name="id_motivo" id="id_motivo"/>

          <button type="submit" name="actionm" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" onclick="limpiarm()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>
          </div>
          </div>
        </form>
        </div>
      </div>
      <!--F Modal Motivo-->
    </div>

</div><!-- FIN Container fluis -->

<?php require_once("includes/footer.php");?>

<script type="text/javascript" src="js/area.js"></script>
<script type="text/javascript" src="js/motivo.js"></script>

<script>
    function NumText(string){//solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ/1234567890°_-() ';//Caracteres validos
  
      for (var i=0; i<string.length; i++) //para i en 0
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
  }
  </script>
<?php
 
}else{

  header("Location:".Conectar::ruta()."index.php");
  exit();

 }

 ?>

