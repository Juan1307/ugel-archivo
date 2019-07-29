<?php 
	//llamamos a la conexion
	require_once("config/conexion.php");
 	//verificamos si existen los datos enviar y el value si que se encuentran en el form 
 		if (isset($_POST["enviar"]) and $_POST["enviar"]=="si") {
 			
 			//lamammos a la clase
 			require_once("modelos/Login.php");

 			//instanciamos la clase Login a la variable $admin
 			$admin = new Login();

 			//llamamos al metodo login de la clase Admin
 			$admin->login();
 		}
 ?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="public/img/logo.png" type="image/x-icon">
  <title>Login</title>
  <!-- Custom fonts for this template-->
  <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="public/css/animate.css">


</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">
      	<!--Saltos de linea-->
      	<br>
      	<br>
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido! a Ugel Archivo</h1>
                  </div> 	
                  <!--LOGIN Y MESANSAJES PERSONALIZADOS-->
                  <?php 
                  if (isset($_GET["m"])) 
                  {
                    switch ($_GET["m"]) 
                    {

                      case '1':
                      ?>
                      <div class="alert alert-danger animated fadeInUp" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Ooops!</strong><p>Usuario y/o Contraseña incorrectos</p>
                      </div>
                      <?php 
                      break;

        
                      case '2':
                      ?>
                      <div class="alert alert-danger animated fadeInUp" role="alert">
                       <button type="button" class="close" data-dismiss="alert">&times;</button>
                       <strong>¡Error!</strong><p>Porfavor Rellene los campos</p>
                      </div>
                      <?php
                      break;
                  }
                }//fin if
                  ?>
                  <form  method="POST">
                    <!--Campos para realizar proceso-->
                    <div class="form-group">
                      <input type="text" name="usuario" id="usuario"  required pattern="[a-zA-Z0-9ñÑ_-]{5,15}"  onkeyup="this.value=NumText(this.value)" class="form-control form-control-user"  placeholder="Ingrese Usuario" maxlength="15" autofocus>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" id="password" required pattern="[a-zA-Z0-9ñÑ_-]{5,15}"  onkeyup="this.value=NumText(this.value)" class="form-control form-control-user"  placeholder="Ingrese Contraseña" maxlength="15">
                    </div>

                   <!--Envio del campo oculto-->
                   <div class="form-group mb-4">
                    <input type="hidden" name="enviar" class="form-control" value="si">
                   </div>
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block" aria-hidden="true"> Iniciar Sesion </button>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="public/vendor/jquery/jquery.min.js"></script>
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="public/js/sb-admin-2.min.js"></script>
  
  <script type="text/javascript">
    function NumText(string){
      var out = '';

      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890_-';
  
      for (var i=0; i<string.length; i++) 
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
  }
  </script>

</body>

</html>