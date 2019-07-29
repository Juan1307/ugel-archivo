<?php 

//llamamos a la conexion
	require_once("../config/conexion.php");
	//llamamos a la clase
	require_once("../modelos/Admin.php");

	if (isset($_SESSION["ndni"])) {
 	//instanciamos la clase
 	$admin = new Admin();
 	//declaramos las variables  las cuales se van a ingresar por formulario
 	$usuario=isset($_POST["usuario"]);
 	$ndni=isset($_POST["ndni"]);
 	$password=isset($_POST["password"]);
 	$password1=isset($_POST["password1"]);
 	$id_admin=isset($_POST["id_admin"]);

 	switch ($_GET["ad"]) {

 		case 'guardar':

			$datos1 = $admin->filter_user($_POST["usuario"]);
 			$datos = $admin->filter_ndni($_POST["ndni"]);
			//si esta vacio el id del admin entra a la condicion
 			$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
			
			if (empty($_POST["id_admin"])) {

				//inicio condicion
 			    if (is_array($datos)==true and count($datos)>0 ) {
 				
 					$warnings[]="El admin ya existe";

 				}elseif (is_array($datos1)==true and count($datos1)>0) {

 					$warnings[]="El admin ya existe";
 				
 				}elseif(empty($_POST["usuario"]) or empty($_POST["ndni"]) or empty($_POST["password"]) or empty($_POST["password1"]) ) {
 				 
 					$errors[]="Porfavor rellene los campos";

		 		}else{

		 			if (password_verify($_POST["password1"], $hash)) {
		 						
		 				$admin->agregar_admin($usuario,$ndni,$hash);//le enviamos el hash  					

		 				$messages[]="El admin se registro correctamente";

		 			} else {
		 					
		 				if (empty($_POST["password1"]) and empty($_POST["password"])) {
		 						//mensaje de error
		 					$errors[]="Porfavor rellene los campos";

		 				}else{

		 					$errors[]="Las contraseñas no coinciden";
		 				}
		 			}
 				}//fin condicion
 			//fin del if
 			} 
 			//para messages
		if (isset($messages)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-success fixed-top" id="messages" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<p class="text-center">
					<strong><i class="fas fa-check-circle"></i>&nbsp;¡Conforme!</strong>&nbsp;
					<?php
					foreach($messages as $message) {
						echo $message;
					}
					?>
				</p>
			</div>
			<?php				
			}
		//para errors
		if (isset($errors)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-danger  fixed-top" id="errors" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<p class="text-center">
					<strong><i class="fas fa-exclamation-circle"></i>&nbsp;¡Error!</strong>&nbsp;
					<?php
					foreach($errors as $error) {
						echo $error;
						}
					?>
				</p>
			</div>
			<?php				
			}
		//para warnings
		if (isset($warnings)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-warning fixed-top" id="warnings" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<p class="text-center">
					<strong><i class="fas fa-exclamation-triangle"></i>&nbsp;¡Alerta!</strong>&nbsp;
					<?php 
					foreach ($warnings as $warning ) {
						echo $warning;
					}
					 ?>
				</p>
			</div>
			<?php 
		}
 		break;

 		case 'listar':

 			$datos=$admin->get_admin();

 			$data = Array();

 			foreach ($datos as $row) {
 				
 				$sub_array = array();

 				$sub_array[] = $row["id_admin"];
 				$sub_array[] = $row["usuario"];
 				$sub_array[] = $row["ndni"];

				$data[]=$sub_array;
 			}
 			//en un array asociativo le asignamos data[]

 			$results = Array(
 				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);

			echo json_encode($results);//recojemos los resultados en json_encode

 		break;

 		case 'listarver':

 			$datos=$admin->get_admin();

 			$data = Array();

 			foreach ($datos as $row) {
 				
 				$sub_array = array();

 				$sub_array[] = $row["id_admin"];
 				$sub_array[] = $row["usuario"];

				$data[]=$sub_array;
 			}
 			//en un array asociativo le asignamos data[]

 			$results = Array(
 				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);

			echo json_encode($results);//recojemos los resultados en json_encode

 		break;
 	}

	}

else{

    header("Location:../error.php");
    exit();

  }
  
 ?>