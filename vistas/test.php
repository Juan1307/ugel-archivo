<?php 
//llamamos a la conexion
  require_once("../config/conexion.php");
  //verifica si existe la sesion 
  if (isset($_SESSION["ndni"])) {
  //$salida = array_slice($_SESSION,-3, 1); indica el puntero para que muestre esos datos hacia adelante con offset

    require_once("../modelos/Resolucion.php");

      $resolucion = new Resolucion();

      $datosa = $resolucion->get_resolucion_reporte_general_activos();
      $datosb = $resolucion->get_resolucion_reporte_general_inactivos();
      //$datos_ano = $resolucion->total_resolucion_año();
?>

<?php require_once("includes/header.php");?>

<?php require_once("includes/navbar.php"); ?>
  <!--Container fluid -->
    <div class="container-fluid">
        <!-- Titulo de HOME -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

          <h1 class="h3 mb-0 text-gray-800">Seccion Reportes </h1>

        </div>

                  <!---Para Resolucion-->
            <div class="form-row">
              
              <div class="col-md-6">

               <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-folder"></i>&nbsp;Resolución<button class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm "></i> Imprimir</button>
                  </h5> 
                </div>

                <div class="card-body">

                  <p class="m-0 font-weight-bold text-success">RES Activos</p> <br>
                    <div class="table-responsive">
                      <table class="table table-bordered  table-hover" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total / E</th>
                        </tr>
                      </thead>
                      <tfoot>
                      </tfoot>
                      <tbody>

                        <?php 
                          for ($i=0; $i < count($datosa) ; $i++) { 
                            
                            $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                            $fecha=$datosa[$i]["mes"];

                            $fecha_mes=$meses[date("n",strtotime($fecha))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosa[$i]["ano"]; ?></td>
                          <td><?php echo $datosa[$i]["numero_mes"]; ?></td>
                          <th><?php echo $fecha_mes; ?></th>
                          <th><?php echo $datosa[$i]["total"]; ?></th>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>

                  <p class="m-0 font-weight-bold text-danger">RES Inactivos</p> <br>
                    <div class="table-responsive">
                      <table class="table table-bordered  table-hover" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total / E</th>
                        </tr>
                      </thead>
                      <tfoot>
                      </tfoot>
                      <tbody>

                        <?php 
                          for ($i=0; $i < count($datosb) ; $i++) { 
                            
                            $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                            $fecha_b=$datosb[$i]["mes"];

                            $fecha_mes_b=$meses[date("n",strtotime($fecha_b))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosb[$i]["ano"]; ?></td>
                          <td><?php echo $datosb[$i]["numero_mes"]; ?></td>
                          <th><?php echo $fecha_mes_b; ?></th>
                          <th><?php echo $datosb[$i]["total"]; ?></th>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>


                </div><!--Fin de card body-->    
              </div><!--Fin col -->

            </div><!--Fin del Resolucion-->

          <div class="col-md-6">
              
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-folder"></i>&nbsp;Control
                  <button class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm "></i> Imprimir</button>
                </h5> 
              </div>

              <div class="card-body">

                 <h4 class="small font-weight-bold">C / Registrados <span class="float-right">0</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 0.0%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>

                <p class="m-0 font-weight-bold text-primary">Entregas - recibidas</p> <br>
                  <div class="table-responsive">
                    <table id="usuarios_data" class="table table-bordered  table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Año</th>
                        <th>Nº Mes</th>
                        <th>Mes</th>
                        <th>Total / E</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Año</th>
                        <th>Nº Mes</th>
                        <th>Mes</th>
                        <th>Total / E</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    
                    </tbody>
                    </table>
                  </div>

                  <p class="m-0 font-weight-bold text-primary">Entregas - enviadas</p> <br>
                    <div class="table-responsive">
                      <table id="usuarios_data" class="table table-bordered  table-hover" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total / E</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total / E</th>
                        </tr>
                      </tfoot>
                      <tbody>
                    
                      </tbody>
                      </table>
                    </div>


                </div><!--Fin de card body-->

            </div><!--Fin col-->              
            
          </div><!--Fin de Control-->

        </div><!--Fin de row-->
 
    </div>


  <?php require_once("includes/footer.php"); ?>

  <?php 

    } else {

      //lo envia a logearse o a iniciar sesion
      header("Location:".Conectar::ruta()."index.php");
      exit();

    }

   ?>