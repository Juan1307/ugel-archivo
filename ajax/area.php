<?php 

require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//importamos la conexion
	require_once("../config/conexion.php");
	//importamos la clase Area
	require_once("../modelos/Area.php");
	//intaciamos la clase area en area

		$area = new Area();
	
	//agregamos las variables que se enviaran por metodo post (formulario)	
	$id_area=isset($_POST["id_area"]);
	$nombre=isset($_POST["nombre"]);

	switch ($_GET["op"]) 
	{
		//PARA AGREGAR Y EDITAR AREA
		case 'guardaryeditar':

			$datos=$area->get_area_nombre($_POST["nombre"]);

				if (empty($_POST["id_area"])) {
					//verificacion para la misma area
					if (is_array($datos)==true and count($datos)==0) {
							
						$area->agregar_area($nombre);

						$messages[]="Area agregada correctamente";
						
					} else {

						$errors[]="El Area ingresada ya existe";
					}
					
					
				} else {

					if (is_array($datos)==true and count($datos)>0) {
						
						$errors[]="El Area ingresada ya existe";

					} else {
											//editar area
						$area->editar_area($id_area,$nombre);

						$messages[]="Area actualizada correctamente";

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
		break;

		//PARA MOSTRAR
		case 'mostrar':

			$datos=$area->get_area_id($_POST["id_area"]);

				if (is_array($datos)==true and count($datos)>0) {
					
					foreach ($datos as $row) {

						$output["nombre"]=$row["nombre"];
						
					}

					echo json_encode($output);

				} else {
					$errors[]="El area no existe";
				}
		//para errors
		if (isset($errors)) {
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Error!</strong>
				<?php
				foreach($erros as $error) {
					echo $error;
				}
				?>
			</div>
			<?php				
			}
		break;

		//PARA LISTAR
		case 'listar':

			$datos=$area->get_area();

			$data=Array();

			foreach ($datos as $row ) {

				$sub_array=array();

				$sub_array[]=$row["nombre"];

				$sub_array[]='<button type="button" onClick="mostrara ('.$row["id_area"].');" id="'.$row["id_area"].'" class="btn btn-warning btn-md update"><i class="far fa-edit"></i> Editar </button>';

				$data[]=$sub_array;
			}
			$results=array(

				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);

			echo json_encode($results);
		break;

	}

	}

else{

    header("Location:../error.php");
    exit();

  }
	
 ?>