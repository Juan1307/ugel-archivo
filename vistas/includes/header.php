<?php 
  //llamamos a la conexion
  require_once("../config/conexion.php");

  if(isset($_SESSION["ndni"])){

 ?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../public/img/logo.png" type="image/x-icon">

  <title>UGEL System </title>

  <!-- Custom fonts for this template-->
  <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
  <link href="../public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!--Buttons Datables-->
  <link href="../public/vendor/datatables/buttons/buttons.bootstrap4.min.css" rel="stylesheet" >
  <!--Para el alertify-->
  <link rel="stylesheet" type="text/css" href="../public/alertify/css/alertify.min.css">
  <link rel="stylesheet" type="text/css" href="../public/alertify/css/themes/default.min.css">
  <!--Para el datepicker-->
  <link href="../public/datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
  <!--Para las animaciones-->
  <link rel="stylesheet" type="text/css" href="../public/css/animate.css">
  <!--Para el select-->
  <link rel="stylesheet" type="text/css" href="../public/select/bootstrap-select.min.css">
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon ">
          <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">UGEL Sys <sup>0.5</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="home.php">
          <i class="fa fa-home"></i>
          <span>Inicio - Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        PRIMARIO
      </div>
<!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user"></i>
          <span>&nbsp;RES - Usuarios</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="datosin.php"><i class="fas fa-flag"></i> Oficina - Motivo</a>
            <h6 class="collapse-header text-primary">USUARIOS :</h6>
            <a class="collapse-item" href="resolucion.php">Agregar - Resolución</a>            
            <a class="collapse-item" href="resolucion_consulta.php">Consulta - Resolución</a>
            <a class="collapse-item" href="resolucion_detalle.php">C / Todo - Resolución</a>
            <a class="collapse-item" href="resolucion_listar.php">Listar - Resoluciones</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
          <i class="fas fa-home"></i>
          <span>RES - Institución</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="datosin.php"><i class="fas fa-flag"></i> Oficina - Motivo</a>
            <h6 class="collapse-header text-primary">INSTITUCIÓN :</h6>
            <a class="collapse-item" href="resolucion_ie.php">Agregar - Resolución</a>            
            <a class="collapse-item" href="resolucion_consulta_ie.php">Consulta - Resolución</a>
            <a class="collapse-item" href="resolucion_detalle_ie.php">Entregados</a>
            <a class="collapse-item" href="resolucion_detalle_ie_sn.php">Por entregar</a>
            <a class="collapse-item" href="resolucion_listar_ie.php">Listar - Resoluciones</a>

          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-users"></i>
          <span>Emisores</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header text-primary">USUARIOS :</h6>
            <a class="collapse-item" href="usuarios.php">Agregar - Usuarios</a>
            <a class="collapse-item" href="usuariosin.php">Usuarios - Incompletos</a>
            <h6 class="collapse-header text-primary">INSTITUCIÓN :</h6>
            <a class="collapse-item" href="institucion.php">Agregar - Ínstituciones</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsethree" aria-expanded="true" aria-controls="collapsethree">
          <i class="fas fa-fw fa-search"></i>
          <span>Control</span>
        </a>
        <div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="datosin.php"><i class="fas fa-flag"></i> Oficina - Motivo</a>
            <h6 class="collapse-header text-primary">PERSONAL :</h6>
            <a class="collapse-item" href="personal.php">Agregar - Personal</a>
            <h6 class="collapse-header text-primary">CONTROL :</h6>
            <a class="collapse-item" href="control.php">Realizar Entrega</a>
            <a class="collapse-item" href="control_consulta.php">C / Fecha - Control</a>
            <a class="collapse-item" href="control_detalle.php">C / Todo - Control</a>
            <a class="collapse-item" href="control_listar.php">Listar - Control</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        SECUNDARIO
      </div>

      <!-- Nav Item - Pages Collapse Menu 
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Reportes</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sección R:</h6>
            <a class="collapse-item" href="reportes_resolucion.php">Reporte - Resolución</a>
            <a class="collapse-item" href="reportes_control.php">Reporte - Control</a>

          </div>
        </div>
      </li>-->
      <?php 

        if (isset($_SESSION["usuario"]) and $_SESSION["usuario"]=="master") {
          
          echo '<li class="nav-item">
                  <a class="nav-link" href="administrador.php">
                    <i class="fa fa-user"></i>
                    <span>Administrador</span>
                  </a>
                </li>';
        } 
        
       ?>
     

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <?php
     
     } else {

        header("Location:".Conectar::ruta()."error.php");
        exit();
     }
  ?>
