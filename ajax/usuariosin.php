<?php 
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//llamamos a la conexion
	require_once("../config/conexion.php");
	//llamamos los metodos para AGREGAR Y MOSTRAR

	require_once("../modelos/Usuarios.php");
	//intanciamos la clase Usuario 
	$usuarios = new Usuarios();
	//variables para Post

	$nombres = isset($_POST["nombres"]);
	$apellidos = isset($_POST["apellidos"]);
	$ndni = isset($_POST["ndni"]);
	$carnet = isset($_POST["carnet"]);
	$contacto = isset($_POST["contacto"]);
	$id_usuario = isset($_POST["id_usuario"]);

	switch ($_GET["op"]) //indicamos el parametro que enviamos de ajax
	{
		//PARA EDITAR
		case 'editar':

			$datos = $usuarios->get_usuarios_dni($_POST["ndni"]); //Para DNI
			
			$datos1 = $usuarios->get_usuarios_carnet($_POST["carnet"]); //Para CARNET
			
			if (!empty($_POST["ndni"]) and !empty($_POST["carnet"])) {
								
					$warnings[]="Porfavor ingrese solo <strong> DNI o CARNET .</strong>";

					$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);
				}
				//DNI vacio
				elseif (empty($_POST["ndni"]) and empty($_POST["carnet"])) {

					$messages[]="Usuario actualizado correctamente ";
					
					$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);
				}
				//CARNET existente
				elseif (empty($_POST["ndni"])) {

					//PARA CARNET
					if (is_array($datos1)==true and count($datos1)>0) {

						$errors[]="El <strong>CARNET ".$_POST["carnet"]."</strong> ingresado ya existe";

						$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);
							
					}else{

						$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);
		
						$messages[]="Usuario con <strong>CARNET ".$_POST["carnet"]."</strong> actualizado correctamente";
					}
				}
				//DNI existente
				elseif (empty($_POST["carnet"])) {
						
					if (is_array($datos)==true and count($datos)>0) {

						$errors[]="El <strong>DNI ".$_POST["ndni"]."</strong> ingresado ya existe";

						$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);
						
					}

					else{
							
						$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);
							//Edita los usuarios correctamente
						$messages[]="Usuario con <strong>DNI ".$_POST["ndni"]."</strong> actualizado correctamente";				

					}
				}
		//para messages
		if (isset($messages)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-success fixed-top" role="alert">
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
			<div class="animated bounceOut delay-3s alert alert-danger  fixed-top" role="alert">
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
			<div class="animated bounceOut delay-3s alert alert-warning fixed-top" role="alert">
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

		//PARA MOSTRAR
		case 'mostrar':

			$datos = $usuarios->get_usuarios_id($_POST["id_usuario"]);

			if (is_array($datos)==true and count($datos)>0) {
				
			foreach ($datos as $row) {
					
				$output["nombres"]=$row["nombres"];
				$output["apellidos"]=$row["apellidos"];
				$output["ndni"]=$row["ndni"];
				$output["carnet"]=$row["carnet"];
				$output["contacto"]=$row["contacto"];

					echo json_encode($output);		
				
				}

			}else{

				$errors[]="El usuario no existe";

			}
		//para errors
		if (isset($errors)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-danger  fixed-top" role="alert">
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
		break;
		
		//PARA LISTAR
		case 'listar':

			$datos = $usuarios->get_usuarios_in_dni_carnet();

			$data = Array();

			foreach ($datos as $row) {
				
				$sub_array = array();

				$sub_array[]=$row["apellidos"];
				$sub_array[]=$row["nombres"];
				$sub_array[]=$row["ndni"];
				$sub_array[]=$row["carnet"];
				$sub_array[]=$row["contacto"];

					$sub_array[]='<button type="button" onclick="mostrar('.$row["id_usuario"].');" id="'.$row["id_usuario"].'" class="btn btn-primary btn-md update"><i class="far fa-edit"></i> Completar </button>';

				$data[]=$sub_array;
			}
			$results = array(

			//con los datos de data[] lo asignamos al datatable

				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data

			);

			echo json_encode($results);//recojemos los resultados en json_encode

		break;
	}
}

else{

    header("Location:../error.php");
    exit();

  }
	
 ?>