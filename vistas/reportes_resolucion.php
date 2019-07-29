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
      
      $datosc = $resolucion->get_resolucion_reporte_general_entregados();
      $datosd = $resolucion->get_resolucion_reporte_general_por_entregar();
      //$datos_ano = $resolucion->total_resolucion_año();
?>

<?php require_once("includes/header.php"); ?>

<?php require_once("includes/navbar.php"); ?>
  <!--Container fluid -->
    <div class="container-fluid">
        <!-- Titulo de HOME -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

          <h1 class="h3 mb-0 text-gray-800">Seccion Reportes </h1>

        </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-file-alt"></i>&nbsp;Resolución <a href="reportes_resolucion_pdf.php"><button class=" btn btn-sm btn-primary shadow-sm float-right" ><i class="fas fa-print"></i> Imprimir</button></a> 
                </h5> 
              </div>

                <div class="card-body">
                  <div class="form-row">

                    <div class="col-md-6">
                      
                      <p class="m-0 font-weight-bold text-success">RES Activos <i class="fas fa-check-circle"></i></p> <br>
                    <div class="table-responsive-sm">
                      <table class="table table-sm table-bordered  table-hover" width="100%" cellspacing="0">
                      <thead class="table-success">
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total</th>
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
                          <td><?php echo $fecha_mes; ?></td>
                          <td><?php echo $datosa[$i]["total"]; ?></td>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>
                    <hr/>
                  <p class="m-0 font-weight-bold text-danger">RES Inactivos <i class="fas fa-exclamation-circle"></i></p> <br>
                    <div class="table-responsive-sm">
                      <table class="table table-sm table-bordered  table-hover" width="100%" cellspacing="0">
                      <thead class="table-danger">
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total</th>
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
                          <td><?php echo $fecha_mes_b; ?></td>
                          <td><?php echo $datosb[$i]["total"]; ?></td>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>

                  </div><!--Fin col-->  

                  <div class="col-md-6">
                      
                   <p class="m-0 font-weight-bold text-success">RES R - E <i class="fas fa-check-circle"></i></p> <br>
                    <div class="table-responsive-sm">
                      <table class="table table-sm table-bordered  table-hover" width="100%" cellspacing="0">
                      <thead class="table-success">
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tfoot>
                      </tfoot>
                      <tbody>

                        <?php 
                          for ($i=0; $i < count($datosc) ; $i++) { 
                            
                            $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                            $fecha_c=$datosc[$i]["mes"];

                            $fecha_mes_c=$meses[date("n",strtotime($fecha_c))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosc[$i]["ano"]; ?></td>
                          <td><?php echo $datosc[$i]["numero_mes"]; ?></td>
                          <td><?php echo $fecha_mes_c; ?></td>
                          <td><?php echo $datosc[$i]["total"]; ?></td>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>
                  <hr/>
                  <p class="m-0 font-weight-bold text-danger">RES P - E <i class="fas fa-exclamation-circle"></i></p> <br>
                    <div class="table-responsive-sm">
                      <table class="table table-sm table-bordered table-hover" width="100%" cellspacing="0">
                      <thead class="table-danger">
                        <tr>
                          <th>Año</th>
                          <th>Nº Mes</th>
                          <th>Mes</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tfoot>
                      </tfoot>
                      <tbody>

                        <?php 
                          for ($i=0; $i < count($datosd) ; $i++) { 
                            
                            $meses_d=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                            $fecha_d=$datosd[$i]["mes"];

                            $fecha_mes_d=$meses_d[date("n",strtotime($fecha_d))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosd[$i]["ano"]; ?></td>
                          <td><?php echo $datosd[$i]["numero_mes"]; ?></td>
                          <td><?php echo $fecha_mes_d; ?></td>
                          <td><?php echo $datosd[$i]["total"]; ?></td>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>

                  </div><!--Fin col-->                          
                </div><!--Fin row-->

            </div><!--Fin de card body-->
            
        </div><!--Fin card Shadow-->

      </div><!--Fin Container Fluid-->


  <?php require_once("includes/footer.php"); ?>
  <?php 

    } else {

      //lo envia a logearse o a iniciar sesion
      header("Location:".Conectar::ruta()."index.php");
      exit();

    }

   ?>