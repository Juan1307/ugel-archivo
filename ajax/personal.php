<?php 
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//llamamos a la conexion
	require_once ("../config/conexion.php");

	//llamamos a la clase
	require_once ("../modelos/Personal.php");

		$personal = new Personal();

	//definimos las variables que vienen a traves de formulario
	$id_personal=isset($_POST["id_personal"]);
	$nombres=isset($_POST["nombres"]);
	$apellidos=isset($_POST["apellidos"]);

	switch ($_GET["op"]) {

		case 'guardaryeditar':

				if (empty($_POST["id_personal"])) {

					$personal->agregar_personal($nombres,$apellidos);				

					$messages[]="Responsable registrado correctamente";

				} else {

					$personal->editar_personal($id_personal,$nombres,$apellidos);

					$messages[]="Responsable actualizado correctamente";
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
		break;

		//PARA MOSTRAR 	
		case 'mostrar':

			$datos=$personal->get_personal_id($_POST["id_personal"]);

			if (is_array($datos)==true and count($datos)>0) {
				
				foreach ($datos as $row) {
					
					$output["apellidos"]=$row["apellidos"];
					$output["nombres"]=$row["nombres"];
				}

				echo json_encode($output);

			} else {

				$errors[]="El personal no existe";			
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

			$datos = $personal->get_personal();

			$data = Array();

			foreach ($datos as $row) {

				$sub_array = array();

				$sub_array[]=$row["apellidos"];
				$sub_array[]=$row["nombres"];

				$sub_array[]='<button type="button" onclick="mostrar('.$row["id_personal"].');" id="'.$row["id_personal"].'" class="btn btn-warning btn-md update"><i class="far fa-edit"></i> Editar </button>';

				$data[]=$sub_array;
			}

			$results=array(//hacemos una array asociativo para asignar datos y variables como data
			
			//con los datos de data[] lo asignamos al datatable

				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data

			);

			echo json_encode($results);//recojemos los resultados en json_encode

		break;

		//PARA LA RESOLUCION 
		case "buscar_resolucion":
		//llamamos a la clase resolucion
			require_once("../modelos/Resolucion.php");
			//verificamos si existen los datos en la base de datos TBLRESOLUCION

			$resolucion = new Resolucion();
			//lamamos al metodo de usuarios por id
			$datos = $resolucion->resolucion_id($_POST["id_resolucion"],$_POST["estado"]);

			if (is_array($datos)==true and count($datos)>0) {
				
				foreach ($datos as $row) {
					//para buscar se traen todos los datos incluyendo el id del usuario
					$output["id_resolucion"] = $row["id_resolucion"];
					$output["nresolucion"] = $row["nresolucion"];
					$output["nproyecto"] = $row["nproyecto"];
					$output["id_motivo"] = $row["id_motivo"];
					$output["id_area"] = $row["id_area"];
												 		//Para FECHA
					if ($row["f_emision"] == null) {

						$f_emision="Sin fecha";//si esta vacio mostramos son fecha

					} else {

						$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

					}
			 		
				$output["f_emision"]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';
				$output["estado"]=$row["estado"];
				}
				
			}else{

				$output["error"]="La resolucion esta inactiva seleccione otro.";

			}
			//arrojamos el output en json 		
			echo json_encode($output);	
		break;

		//PARA CONTROL 
		case "listar_control_resolucion":
		//llamamaos a la clase de resolucion
			require_once("../modelos/Resolucion.php");
			//verificamos si existen los datos en la base de datos TBLRESOLUCION

			$resolucion = new Resolucion();

			$datos = $resolucion->get_resolucion_all();

			$data = Array();//arreglo para las filas que va a almacenar

			foreach ($datos as $row){

				$sub_array = array();//recogemos los datos de la variable 4row

				//asignado valores a las filas
				$sub_array[]=$row["nresolucion"];
				$sub_array[]=$row["nproyecto"];
				$sub_array[]=$row["id_motivo"];
				$sub_array[]=$row["id_area"];
							 		//Para FECHA
					if ($row["f_emision"] == null) {

						$f_emision="Sin fecha";//si esta vacio mostramos son fecha

					} else {

						$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

					}
			 		
				$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';
					//PARA ESTADO
			 		if ($row["estado"]==1) {
			 			
			 			$estado='<span class="badge badge-success">Activo</span>';//bagge Success

			 		} else {

			 			$estado='<span class="badge badge-danger">Inactivo</span>';//bagge danger
			 		}

				$sub_array[]=$estado;

				$sub_array[]='<button type="button" name="" id="'.$row["id_resolucion"].'" class="btn btn-primary btn-md" onclick="agregardetalle_control('.$row["id_resolucion"].','.$row["estado"].')"><i class="fa fa-plus"></i> Agregar </button>';

				$data[]=$sub_array;//recogemos los datos de subarray y lo almacenamos en data[]

			}
			//creamos un arreglo que almacene los datos de data[] y que este a la vez almacena los datos de sub_array

			$results=array(//hacemos una array asociativo para asignar datos y variables como data
			
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