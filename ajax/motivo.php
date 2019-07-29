	<?php 
	
	require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//llamamos a la conexion
	require_once("../config/conexion.php");
	//lamamos a la clase motico 
	require_once("../modelos/Motivo.php");

		//llamamos a motivo y instanciamos 
		$motivo = new Motivo ();

	//declaramos las variables que se ingresan por formulario y luego se encian por ajax
	$id_motivo=isset($_POST["id_motivo"]);
	$descripcion=isset($_POST["descripcion"]);

	switch ($_GET["op"]){

		//PARA GUARADAR Y EDITAR UN MOTIVO
		case 'guardaryeditar':

				$datos=$motivo->get_motivo_descripcion($_POST["descripcion"]);

					if (empty($_POST["id_motivo"])) {
						//Verficamos el mismo motivo
						if (is_array($datos)==true and count($datos)==0) {
							
							$motivo->agregar_motivo($descripcion);

							$messages[]="Motivo agregado correctamente ";

						} else {

							$errors[]="El Motivo ingresado ya existe";
						
						}

					} else {

						if (is_array($datos)==true and count($datos)>0) {

							$errors[]="El Motivo ingresado ya existe";

						} else {
						
							$motivo->editar_motivo($id_motivo,$descripcion);

							$messages[]="Motivo actualizado correctamente";

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
			
			$datos=$motivo->get_motivo_id($_POST["id_motivo"]);

			if (is_array($datos)==true and count($datos)>0) {
				
				foreach ($datos as $row) {

					$output["descripcion"]=$row["descripcion"];
						
				}

				echo json_encode($output);

			} else {

				$errors[]="El motivo no existe";
			}
		//para errors
		if (isset($errors)) {
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong>
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

			$datos=$motivo->get_motivo();

			$data = Array();

			foreach ($datos as $row) {

				$sub_array = array();
				//asignando valores a las a varibales
				$sub_array[]=$row["descripcion"];

				$sub_array[]='<button type="button" onClick="mostrarm('.$row["id_motivo"].');" id="'.$row["id_motivo"].'" class="btn btn-warning btn-md update"><i class="far fa-edit"></i> Editar </button>';

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