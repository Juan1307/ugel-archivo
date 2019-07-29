<?php 
//llamamos a la conexion
  require_once("../config/conexion.php");
  //verifica si existe la sesion 
  if (isset($_SESSION["ndni"])) {
  //$salida = array_slice($_SESSION,-3, 1); indica el puntero para que muestre esos datos hacia adelante con offset

    require_once("../modelos/Resolucion.php");
    require_once("../modelos/Usuarios.php");
    require_once("../modelos/Instituciones.php");
    require_once("../modelos/Control.php");

      //instanciamos las clases correspondientes

    $resolucion = new Resolucion();
    $usuarios = new Usuarios();
    $institucion = new Instituciones();
    $control = new Control();
?>

<?php require_once("includes/header.php");?>

<?php require_once("includes/navbar.php"); ?>
  <!--Container fluid -->
    <div class="container-fluid">
        <!-- Titulo de HOME -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

          <h1 class="h3 mb-0 text-gray-800">Bienvenido(a) &nbsp; <strong><?php echo $_SESSION["usuario"];?></strong></h1>
          </div>

          <!-- GENERAL COL -->
          <div class="row">

            <!-- RESOLUCIONES -->
            <div class="col-xl-3 col-md-6 mb-4">
              
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">    
                      <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">Resoluciones</div>
                      <div class="Contar h5 mb-0 font-weight-bold text-gray-800 "><?php echo $resolucion->get_filas_resolucion(); ?></div>
                    </div>
                    <div class="col-auto">
                      <a href="<?php echo Conectar::ruta()?>vistas/resolucion.php"><i class="fas fa-book fa-2x text-primary animated infinite pulse delay-2s"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>

            <!-- USUARIOSS -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">Usuarios</div>
                      <div class="Contar h5 mb-0 font-weight-bold text-gray-800"><?php echo $usuarios->get_filas_usuarios(); ?></div>
                    </div>
                    <div class="col-auto">
                      <a href="<?php echo Conectar::ruta()?>vistas/usuarios.php"><i class="fas fa-users fa-2x text-warning animated infinite pulse delay-2s"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                        <!-- USUARIOSS -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-info text-uppercase mb-1">Institución</div>
                      <div class="Contar h5 mb-0 font-weight-bold text-gray-800"><?php echo $institucion->get_filas_institucion(); ?></div>
                    </div>
                    <div class="col-auto">
                      <a href="<?php echo Conectar::ruta()?>vistas/institucion.php"><i class="fa fa-home fa-2x text-info animated infinite pulse delay-2s"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- ACTIVOS -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-success text-uppercase mb-1">Control</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="Contar h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $control->get_filas_control(); ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="<?php echo Conectar::ruta()?>vistas/control.php"><i class="fas fa-sync-alt fa-2x text-success animated infinite pulse delay-2s"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <!-- FIN GENERAL COL -->


          <!--GRAFICOS COL -->
          <div class="row">

            <!--Grafico BARRAS-->
            <div class="col-xl-6 col-lg-6">

              <!-- Contenido Barras -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Resolución General<a href="reportes_resolucion.php"><button class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-file-alt"></i></button></a></h6>
                </div>
                <div class="card-body">

                <div class="form-row">

                    <div class="form-group col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                         <thead class="thead-dark ">
                            <th>Datos - Detalle</th>
                            <th>Cantidad</th>
                          </thead>
                          <tbody>
                            <tr  class="table-success">
                              <th>Registrados</th>
                              <th><?php echo $resolucion->get_filas_resolucion(); ?></th>
                            </tr>
                            <tr  class="table-success">
                              <th>Activos</th>
                              <th><?php echo $resolucion->get_filas_resolucion_activos(); ?></th>
                            </tr>
                            <tr  class="table-danger">
                              <th>Inactivos</th>
                              <th><?php echo $resolucion->get_filas_resolucion_inactivos(); ?></th>
                            </tr>
                            <tr  class="table-success">
                              <th>Entregados</th>
                              <th><?php echo $resolucion->get_filas_detresolucion_entregados(); ?></th>
                            </tr>
                            <tr  class="table-danger">
                              <th>Por entregar</th>
                              <th><?php echo $resolucion->get_filas_detresolucion_por_entregar(); ?></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
                  </div>
                  <!---Fin del row-->

                </div>
              </div>
              <!-- Fin Contenido Barras -->

            </div>
            <!-- Fin Grafico BARRAS -->
            <div class="col-xl-6 col-lg-6">

              <!-- Contenido Barras -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Control General 
                    <a href="reportes_control.php"><button class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-file-alt"></i></button></a></h6>
                </div>

                <div class="card-body">

                  <div class="form-row">

                    <div class="form-group col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                          <thead class="thead-dark">
                            <th>Datos - Detalle</th>
                            <th>Cantidad</th>
                          </thead>
                          <tbody>
                            <tr class="table-success">
                              <th>Registrados</th>
                              <th><?php echo $control->get_filas_control(); ?></th>
                            </tr>
                            <tr class="table-success">
                              <th>Entregados</th>
                              <th><?php echo $control->get_filas_control_entregados(); ?></th>
                            </tr>
                            <tr class="table-danger">
                              <th>Por Entregar</th>
                              <th><?php echo $control->get_filas_control_por_entregar(); ?></th>
                            </tr>
                            <tr class="table-success">
                              <th>Recibidos</th>
                              <th><?php echo $control->get_filas_detcontrol_recibidos(); ?></th>
                            </tr>
                            <tr class="table-danger">
                              <th>Enviados</th>
                              <th><?php echo $control->get_filas_detcontrol_enviados(); ?></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                  <!---Fin del row-->
                </div>
              </div>
              <!-- Fin Contenido Barras -->
            </div>
            <!-- Fin Grafico BARRAS -->
          </div>
          <!-- FIN GRAFICOS COL -->

        </div>
        <!-- /.container-fluid -->  

  <?php require_once("includes/footer.php"); ?>  

  <script type="text/javascript">
    $('.Contar').each(function () {
      var $this = $(this);
      jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
        duration: 6000,
        easing: 'swing',
        step: function () {
          $this.text(Math.ceil(this.Counter));
        }
      });
    });
  </script>

  <?php 

    } else {

      //lo envia a logearse o a iniciar sesion
      header("Location:".Conectar::ruta()."index.php");
      exit();

    }

   ?>