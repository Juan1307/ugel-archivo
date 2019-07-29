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

      <h1 class="h3 mb-2 text-gray-800">Sección - Control</h1>
        <p>Esta sección esta desarrollada en base al módulo de control, aqui se realizan todos los procesos para control por año y mes.</p>

      <div id="resultados_ajax_control"></div>
    <!--Para Resolucion Activo-->
    <div class="form-row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header">
              
             <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-share-square"></i>&nbsp;Consulta Fecha Control
              <a href="control.php">
              <button class="btn btn-primary float-right" id="add_button_usuarios"><i class="fab fa-telegram-plane"></i></button>
              </a>
             </h5>
              
            </div>
            
            <!--Abrimos el modal para detalle-->
            <?php require_once("modal/control_detalle.php"); ?>
            <!--Abrimos el modal para detalle-->

              <div class="card-body">

                <div class="form-row">

                  <div class="form-group col-sm">
                    <select class="form-control" name="mes" id="mes">
                      <option selected value="">Mes</option>
                      <option value="01">Enero</option>
                      <option value="02">Febrero</option>
                      <option value="03">Marzo</option>
                      <option value="04">Abril</option>
                      <option value="05">Mayo</option>
                      <option value="06">Junio</option>
                      <option value="07">Julio</option>
                      <option value="08">Agosto</option>
                      <option value="09">Septiembre</option>
                      <option value="10">Octubre</option>
                      <option value="11">Noviembre</option>
                      <option value="12">Diciembre</option>
                    </select>
                  </div>

                  <div class="form-group col-sm">
                    <select class="form-control" name="ano" id="ano">
                      <option selected value="">Año</option>
                      <option value="2010">2010</option>
                      <option value="2011">2011</option>
                      <option value="2012">2012</option>
                      <option value="2013">2013</option>
                      <option value="2014">2014</option>
                      <option value="2015">2015</option>
                      <option value="2016">2016</option>
                      <option value="2017">2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                      <option value="2026">2026</option>
                      <option value="2027">2027</option>
                      <option value="2028">2028</option>
                      <option value="2029">2029</option>
                      <option value="2030">2030</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <button type="button" id="btn_control_fecha" class="btn btn-success"><i class="fas fa-search"></i>&nbsp; Consultar</button>
                  </div>
                  <div class="form-group col-md-8"></div>
                </div>

                <div class="table-responsive">
                <table id="control_fecha_data" class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Ver</th>
                        <th>Area</th>
                        <th>Responsable</th>
                        <th>Nº Folios</th>
                        <th>Entrega</th>
                        <th>Estado</th>    
                        <th>Editar</th>
                        <th>E/E</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Ver</th>
                        <th>Area</th>
                        <th>Responsable</th>
                        <th>Nº Folios</th>
                        <th>Entrega</th>
                        <th>Estado</th>                        
                        <th>Editar</th>
                        <th>E/E</th>
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
<div id="controlModal" class="modal fade">

  <div class="modal-dialog">
    <form method="POST" id="control_form">
      <div class="modal-content">

        <div class="modal-header">
          <h5>Editar Entrega</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="form-row">  
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
            <div class="form-group col-md-6">
              <label>N° Folios:</label>
              <input type="text" id="nfolios" name="nfolios" class="form-control" placeholder="N° Folios" required pattern="[0-9]{1,5}" maxlength="5">
            </div>  
            <div class="form-group col-md-12">
              <label>Responsable:</label>
              <select id="id_personal" name="id_personal" class="form-control selectpicker" data-live-search="true"></select>
            </div>
            <div class="form-group col-md-6">
              <label>Estado</label>
                <select class="form-control" name="est" id="est" required>
                  <option value="">---Seleccionar Estado---</option>
                  <option value="0">Por entregar</option>
                  <option value="1">Entregado</option>
                </select>
            </div>
            <div class="form-group col-md-6">
              <label>Fecha Entrega:</label>
              <input type="text" name="f_entrega" id="f_entrega" data-target="#f_entrega" class="form-control" placeholder="Entrega" required>    
            </div>        
          </div>
        </div>

        <div class="modal-footer">
        <!--Envio del campo oculto-->
        <input type="hidden" name="id_control" id="id_control">

          <button type="submit" name="action" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" onclick="limpiar_control()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"  aria-hidden="true"></i>&nbsp;Cancelar</button>

        </div>  

      </div>
    </form>
  </div>
</div>

<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/control.js"></script>
<script type="text/javascript" src="js/control_detalle.js"></script>

<?php 

  } else {

    header("Location:".Conectar::ruta()."index.php");
    exit();
  }

?>