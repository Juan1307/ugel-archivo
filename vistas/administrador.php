<?php 
//importamos la conexion
  require_once("../config/conexion.php");
  //verifivcamos si existe la session -- se recomienda usar el dato unico en el modulo
  if (isset($_SESSION["usuario"]) and $_SESSION["usuario"]=="master" ) {
    
 ?>

<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navbar.php"); ?>

<div class="container-fluid">

 	<div id="resultados_ajax_administrador"></div>

    <h1 class="h3 mb-2 text-gray-800">Sección - Administrador</h1>
      <p>Esta sección es la parte general en base al módulo admin, aquí se realizan todos los procesos para los administradores.</p>
      <!-- Tabla USUARIOS -->
      <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i>Info Admin<button class="btn btn-success float-right" id="add_button_administrador" onclick="limpiar()" data-toggle="modal" data-target="#administradorModal"><i class="fa fa-user-plus" aria-hidden="true"></i></button></h5>
            </div>
            <div class="card-body">     
              <div class="table-responsive">
                <table id="administrador_data" class="table table-bordered  table-hover" width="100%" cellspacing="0">
                	<thead>
                	  	<tr>
                	  	  <th>INDICE - ID</th>
	                      <th>Usuario</th>
	                      <th>Dni</th>
                      </tr>
                	</thead>
                	<tfoot>
                		<tr>
                	  	  <th>INDICE - ID</th>
	                      <th>Usuario</th>
	                      <th>Dni</th>
                    </tr>
                	</tfoot>
                	<tbody>
                		
                	</tbody>
                 </table>
              </div>
            </div>
      
      </div>   
</div>

<!--Formulario USUARIO MODAL-->
<div id="administradorModal" class="modal fade">

	 	<div class="modal-dialog">

	 		<form method="POST" id="administrador_form">
 			  <div class="modal-content">

 				<div class="modal-header">
 					<h5 class="modal-title">Agregar Admin</h5>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>

 				<div class="modal-body">

		        <div class="row">
              <div class="col-md-12">
                  <label>Usuario</label>
                  <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required pattern="[a-zA-Z0-9ñÑ_-]{5,15}"  maxlength="15" onkeyup="this.value=NumText1(this.value) " ><br>
              </div>

              <div class="col-md-12">
                <label>DNI</label>
                <input type="text" name="ndni" id="ndni" class="form-control" placeholder="Doc Identidad" required pattern="[0-9]{8}" disabled maxlength="8"><br>
              </div>

              <div class="col-md-6">
                <label>Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" pattern="[a-zA-Z0-9ñÑ_-]{5,15}" maxlength="15" onkeyup="this.value=NumText1(this.value)" oninvalid="setCustomValidity('Este campo solo puede contener caracteres como : a-z , A-Z y 0-9 / Con un mínimo obligatorio de 5 caracteres.')"oninput="setCustomValidity('')"><br>
              </div>
              <div class="col-md-6">
                <label>Repetir contraseña</label>
                <input type="password" name="password1" id="password1" class="form-control" placeholder="Contraseña" required pattern="[a-zA-Z0-9ñÑ_-]{5,15}" maxlength="15" onkeyup="this.value=NumText1(this.value)" oninvalid="setCustomValidity('Este campo solo puede contener caracteres como : a-z , A-Z y 0-9 / Con un mínimo obligatorio de 5 caracteres.')"oninput="setCustomValidity('')">
              </div>
            </div>
          
				</div>
   				<div class="modal-footer">

 				<input type="hidden" name="id_admin" id="id_admin">

 				<button type="submit" name="action" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

 				<button type="button" onclick="limpiar()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>

 				</div>
 			  </div>
 			</form>
 		  </div>

</div>
<?php require_once("includes/footer.php");?>

<script type="text/javascript" src="js/administrador.js"></script>

  <script>
    function NumText1(string){
    //solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890_-';//Caracteres validos
  
      for (var i=0; i<string.length; i++) //para i en 0
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
  }
  </script>
<?php
  //PARA LOGIN 
  }else{
    header("Location:".Conectar::ruta()."index.php");
   exit();
  }
?>

