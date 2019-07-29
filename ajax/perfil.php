<?php 
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//llamamos a la conexion 
	require_once("../config/conexion.php");

	//llamamos a la clase admin
	require_once("../modelos/Admin.php");
	
	//instanciamos la clase
		$perfil = new Admin();

	//so trae extraen los datos del form especificamente del atributo name del input
	$usuario_perfil = isset($_POST["usuario_perfil"]);
	$ndni_perfil = isset($_POST["ndni_perfil"]);
	$password_perfil = isset($_POST["password_perfil"]);
	$password1_perfil = isset($_POST["password1_perfil"]);
	$id_admin_perfil = isset($_POST["id_admin_perfil"]);

	switch ($_GET["pr"]) {// pr es el parametro que se envia a traves de ajax

		case 'mostrar_perfil':

			$datos = $perfil->get_admin_id_perfil($_POST["id_admin_perfil"]);//reutilizamos el metodo get_admin_id
			//si existe el id lo muestra 
			if (isset($datos)==true and count($datos)>0) {
				
				foreach ($datos as $row) {

					$output["usuario"] = $row["usuario"];
					$output["ndni"] = $row["ndni"];
				}
					echo json_encode($output);//para ajax
			}else{

				$errors[]="El usuario no existe";
			}
		//Para ERRORS
		if (isset($errors)) {
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Error!</strong>
				<?php
				foreach ($errors as $error) {
					echo $error;
				} 
				?>
			</div>
		<?php
		}
		
		break;
		
		case 'editar_perfil':

		$hash = password_hash($_POST["password_perfil"], PASSWORD_DEFAULT);

 			if (password_verify($_POST["password1_perfil"], $hash)) {
 						
 				$perfil->editar_admin_perfil($id_admin_perfil,$hash);//le enviamos el hash  
 			} 	

		break;
	}
}

else{

    header("Location:../error.php");
    exit();

  }
	
 ?>