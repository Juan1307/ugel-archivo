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

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="../public/img/logo.png" type="image/x-icon">
  <title>Ugel System</title>

  <!-- Custom fonts for this template-->
  <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

  <!--Container fluid -->
    <div class="container-fluid">
        <!-- Titulo de HOME -->
        <div class="row">
          <div class="form-group col-md-5"></div>
            
          <div class="form-group col-md-4">
            <h1 class="h4 mb-0 text-gray-800">Reporte Resolución - G</h1>
          </div>

          <div class="form-group col-md-3"></div>
        </div>
        <div class="row">
            <div class=" col-md-6">
              <h1 class="h5 mb-0 text-primary"> <i class="fas fa-user"></i>&nbsp; Datos Personales</h1><hr/>
              <h6><strong>Usuario:</strong> <?php echo $_SESSION["usuario"] ?></h6>
              <h6><strong>N° DNI :</strong> <?php echo $_SESSION["ndni"] ?></h6>
              <h6><strong>Fecha y Hora:</strong> <?php echo $fecha = date ('Y-m-d'); ?></h6>
            </div>
            <div class=" col-md-6">
              <h1 class="h5 mb-0 text-primary"><i class="fas fa-building"></i>&nbsp; Datos - Institución</h1><hr/>
              <h6><strong>Institución:</strong> Ugel Cajamarca</h6>
              <h6><strong>RUC        :</strong> 20491617943</h6>
              <h6><strong>Dirección  :</strong> Jr. Los Pinos 1166 - Cruce a Santa Bárbara</h6>
            </div>
        </div>
        <hr/>
                <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-file-alt"></i>&nbsp;Información de Estados <a href="reportes_resolucion_pdf.php" class="float-right" id="print_resolucion"> <i class="fas fa-print"></i></a> 
                </h5> <br>

                  <div class="form-row">

                    <div class="form-group col-md-6">
                      
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

                            $fecha=$datosa[$i]["mesa"];

                            $fecha_mes=$meses[date("n",strtotime($fecha))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosa[$i]["anoa"]; ?></td>
                          <td><?php echo $datosa[$i]["numero_mesa"]; ?></td>
                          <td><?php echo $fecha_mes; ?></td>
                          <td><?php echo $datosa[$i]["totala"]; ?></td>
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

                            $fecha_b=$datosb[$i]["mesb"];

                            $fecha_mes_b=$meses[date("n",strtotime($fecha_b))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosb[$i]["anob"]; ?></td>
                          <td><?php echo $datosb[$i]["numero_mesb"]; ?></td>
                          <td><?php echo $fecha_mes_b; ?></td>
                          <td><?php echo $datosb[$i]["totalb"]; ?></td>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>

                  </div><!--Fin col-->  

                  <div class="form-group col-md-6">
                      
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

                            $fecha_c=$datosc[$i]["mesc"];

                            $fecha_mes_c=$meses[date("n",strtotime($fecha_c))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosc[$i]["anoc"]; ?></td>
                          <td><?php echo $datosc[$i]["numero_mesc"]; ?></td>
                          <td><?php echo $fecha_mes_c; ?></td>
                          <td><?php echo $datosc[$i]["totalc"]; ?></td>
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

                            $fecha_d=$datosd[$i]["mesd"];

                            $fecha_mes_d=$meses_d[date("n",strtotime($fecha_d))-1];

                        ?> 
                        <tr>
                          <td><?php echo $datosd[$i]["anod"]; ?></td>
                          <td><?php echo $datosd[$i]["numero_mesd"]; ?></td>
                          <td><?php echo $fecha_mes_d; ?></td>
                          <td><?php echo $datosd[$i]["totald"]; ?></td>
                        </tr>

                         <?php

                          }

                         ?>
                    
                      </tbody>
                      </table>
                    </div>

                  </div><!--Fin col-->                          
                </div><!--Fin row-->

      </div><!--Fin Container Fluid-->
    <!-- Bootstrap core JavaScript-->

  <script src="../public/vendor/jquery/jquery.min.js"></script>
  <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../public/js/sb-admin-2.min.js"></script>

</body>

</html>

  <script type="text/javascript">

      $("#print_resolucion").click(function () {
        
        printHTML()
        document.addEventListener("DOMContentLoaded",function (event) {
        
        printHTML(); 
        });

      });

      function printHTML() {
        if (window.print) {

          window.print();

        }
      }
  </script>

  <?php 

    } else {

      //lo envia a logearse o a iniciar sesion
      header("Location:".Conectar::ruta()."index.php");
      exit();

    }

   ?>