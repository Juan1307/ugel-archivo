<?php 

require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {

	require_once("../config/conexion.php");

	require_once("../modelos/Control.php");

		$control = new Control();

	switch ($_GET["op"]) {

		case 'cambiar_estado_detalle':

			$control->cambiar_estado_detalle($_POST["id_detcontrol"],$_POST["estado"]);

		break;
		
		case 'mostrar_detalle':

			$datos=$control->get_detalle_control_id($_POST["id_detcontrol"]);//en el post tenemos el valor del id de la resolucion a mostrar

			if (is_array($datos)==true and count($datos)>0) {
				//si existe el id que enviamos me trae los datos y recorro
				foreach ($datos as $row) {
					//Para FECHA
					if ($row["f_recepcion"] == null) {

						$f_recepcion="";//si esta vacio mostramos son fecha

					} else {

						$f_recepcion=date("d-m-Y",strtotime($row["f_recepcion"]));//muestra la fecha

					}
					//asignamos el resultado a f_emision
					$output["f_recepcion"]=$f_recepcion;

					$output["estado"]=$row["estado"];
				}
				//lo que recogimos en output 
				echo json_encode($output);

			} else {
			 	//si no existe nos arroja un error
			 	$errors[]="Entrega no existente";
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

		case 'eliminar_detalle':

			$control->eliminar_detalle($_POST["id_detcontrol"]);
			
		break;
		
		case 'editar_detalle':

			$estado_detalle = isset($_POST["estado_detalle"]);
			$f_recepcion = isset($_POST["f_recepcion"]);
			$id_detcontrol = isset($_POST["id_detcontrol"]);

			$control->editar_detalle_control($id_detcontrol,$f_recepcion,$estado_detalle);

			$messages[]="Entrega - Resolucion actualizado correctamente";
		//Para messages
		if (isset($messages)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-success  fixed-top" id="messages" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<p class="text-center">
					<strong><i class="fas fa-check-circle"></i>&nbsp;Conforme!</strong>&nbsp;
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

		case 'listar_det_control':
		//llamamos al metodo
			$datos = $control->get_det_control();
				//data para datatable
				$data = Array();

			foreach ($datos as $row) {
				
				$sub_array = array();//sl descomponer lo almacenamos en este array

					$sub_array[]=$row["nresolucion"]; //tbl control
					
					if ($row["f_emision"]==null) {
						
						$f_emision = "Sin fecha";

					} else {
						
						$f_emision = date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha 
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';


					$sub_array[]=$row["id_area"];
					$sub_array[]=$row["res_a"]." ".$row["res_n"];
					$sub_array[]=$row["nfolios"];

					if ($row["f_entrega"]==null) {
						
						$f_entrega = "Sin fecha";

					} else {
						
						$f_entrega = date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha 
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';

					if ($row["estc"] == 1) {

						$estc = '<span class="badge badge-success">Entregado</span>';
						
					} else {
						
						$estc = '<span class="badge badge-danger">Por entregar</span>';
					}

					$sub_array[]=$estc;


					if ($row["f_recepcion"]==null) {
						
						$f_recepcion = "Sin fecha";

					} else {
						
						$f_recepcion = date("d-m-Y",strtotime($row["f_recepcion"]));//muestra la fecha 
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_recepcion.' </span>';

					if ($row["estado"] == 1) {

						$estado = '<span class="badge badge-success">Recibido</span>';
						
					} else {
						
						$estado = '<span class="badge badge-danger">Enviado</span>';
					}

					$sub_array[]=$estado;
				
					$data[]=$sub_array;
			}

			$results = array(

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