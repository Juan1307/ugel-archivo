<?php 
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//llamamos a la base de datos 
	require_once("../config/conexion.php");

	//llamamos a la clase de de Control
	require_once("../modelos/Control.php");

	$control = new Control();

	switch ($_GET["op"]) {

		case 'select_responsable':
			//llamamos a la clase de responsable
			require_once("../modelos/Personal.php");

			$personal = new Personal();

				$datos = $personal->select_personal();

			foreach ($datos as $row) {
				
				echo '<option value=' . $row["id_personal"] . '>' . $row["apellidos"] ." " . $row["nombres"] . '</option>';
			}
			
		break;

		case 'detalle_control':
			//llamamos al metdo para traer la resolucion
			$datos=$control->get_detalle_control($_POST["id_control"]);//en el post tenemos el valor del id de la resolucion a mostrar
			 
			 if (is_array($datos)==true and count($datos)>0) {
			 	//recorremos para traer la fila
			 	foreach ($datos as $row) {

			 		$output["id_area"]=$row["id_area"];
			 		$output["id_personal"]=$row["res_a"]." ".$row["res_n"];
			 		$output["nfolios"]=$row["nfolios"];
			 		//Para FECHA
					if ($row["f_entrega"] == null) {

						$f_entrega="Sin fecha";//si esta vacio mostramos son fecha

					} else {

						$f_entrega=date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha

					}

			 		$output["f_entrega"]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';
			 		
			 		//PARA ESTADO
			 		if ($row["estado"]==1) {
			 			
			 			$estado='<span class="badge badge-success">Entregado</span>';//bagge Success

			 		} else {

			 			$estado='<span class="badge badge-danger">Por entregar</span>';//bagge danger
			 		}
			 		//le indico el texto al output
			 		$output["estado"]=$estado;	
			 	}

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

		case 'registrar_control':
			//para registrar control
			$control->agregar_detalle_control();

		break;

		case 'editar':

			$id_control = isset($_POST["id_control"]);
			$id_area = isset($_POST["id_area"]);
			$nfolios = isset($_POST["nfolios"]);
			$id_personal = isset($_POST["id_personal"]);
			$estado = isset($_POST["est"]);
			$f_entrega = isset($_POST["f_entrega"]);

			if (empty($id_control)) {
				
				$errors[]="No se pudo editar la entrega";

			} else {
				
				$control->editar_control($id_control,$id_personal,$id_area,$nfolios,$f_entrega,$estado);
				$messages[]="Entrega actualizada correctamente";
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

		case 'eliminar':

			$control->eliminar_control($_POST["id_control"]);
			
		break;

		case 'mostrar':

			$datos=$control->get_control_id($_POST["id_control"]);//en el post tenemos el valor del id de control a mostrar

			if (is_array($datos)==true and count($datos)>0) {
				//si existe el id que enviamos me trae los datos y recorro
				foreach ($datos as $row) {
					//asignamos la data a output
					$output["id_area"]=$row["id_area"];
					$output["id_personal"]=$row["id_personal"];

					$output["nfolios"]=$row["nfolios"];
					//Para FECHA
					if ($row["f_entrega"] == null) {

						$f_entrega="";//si esta vacio mostramos son fecha

					} else {

						$f_entrega=date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha

					}
					//asignamos el resultado a f_emision
					$output["f_entrega"]=$f_entrega;

					$output["estado"]=$row["estado"];
				}
				//lo que recogimos en output 
				echo json_encode($output);

			} else {
			 	//si no existe nos arroja un error
			 	$errors[]="Control no existente";
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

		case 'detalle_resolucion':

			$datos = $control->get_detalle_resolucion($_POST["id_control"]);//en el post tenemos el valor del id de la resolucion a mostrar

			$data = Array();//la data qu eenviamos al datatable

				foreach ($datos as $row) {
					//recogemos los datos en el output
					$sub_array=array();

					$est='';//esta vacion
						$atrib="btn btn-success btn-md estado";//para cuando esta activo

						if ($row["estado"] == 0) {
							//si el valor recibido a traves de estado es 0 muestra Entregado
							$est='ENVIADO';
							$atrib="btn btn-danger btn-md estado";

						} else {
							//caso contrario pasa como activo
							if($row["estado"] == 1){
								$est='RECIBIDO';
							}
						}//cierre para estado

					$sub_array[]=$row["nresolucion"];
					$sub_array[]=$row["nproyecto"];
					$sub_array[]=$row["id_motivo"];
					$sub_array[]=$row["id_area"];
					//PARA LA FECHA
					if ($row["f_emision"] == null) {

						$f_emision="Sin fecha";//arrojamos el mensaje sin fecha

					} else {

						$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//arrojamos la fecha de que contiene
					}

					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';
					//PARA LA FECHA
					if ($row["f_recepcion"] == null) {

						$f_recepcion="Sin fecha";//arrojamos el mensaje sin fecha

					} else {

						$f_recepcion=date("d-m-Y",strtotime($row["f_recepcion"]));//arrojamos la fecha de que contiene
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_recepcion.' </span>';

					//PARA ESTADO
					$sub_array[] = '<button type="button" onclick="cambiar_estado_detalle('.$row["id_detcontrol"].','.$row["estado"].');" name="estado_det" id="'.$row["id_detcontrol"].'" class="'.$atrib.'">'.$est.'</button>';//Aqui se hace el llamamdo 	de atrib y est

					//PARA EDITAR
					$sub_array[]='<button type="button" onclick="mostrar_detalle('.$row["id_detcontrol"].')" data-toggle="modal" data-target="#resolucion_detalle_Modal"  id="'.$row["id_detcontrol"].'" class="btn btn-warning"><i class="far fa-edit"></i></button>';

					$sub_array[]='<button type="button" onclick="eliminar_detalle('.$row["id_detcontrol"].');" id="'.$row["id_detcontrol"].'" class="btn btn-danger"><i class="fa fa-times"></i></button>';//Aqui se hace el llamamdo 	de atrib y est

					//asignamos a data todo lo que tiene sub array 
					$data[]=$sub_array;
				}

			//enviamos los resultados en $results

			//a traves de un array asociativo enviamos los datos en results ... para el datatable

			$results = array(

				"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 				"aaData"=>$data);

			echo json_encode($results);
		break;

		case 'buscar_control':

			$datos=$control->get_control();
			
			$data = Array();//a traves de data llevamos los datos al datatable

			foreach ($datos as $row) {
				//recorremos un foreach para sacar los datos y mostrarlo en filas

				$sub_array = array();//suba array recogera los elemento del row

				//PARA ESTADO
				$est='';//esta vacion
				$atrib="btn btn-success btn-md estado";//para cuando esta activo
				//Para ver la resolucion
				$sub_array[]='<button class="btn btn-info detalle" id="'.$row["id_control"].'" data-toggle="modal" data-target="#control_detalle_modal" ><i class="fa fa-eye"></i></button>';
				//DATOS
				$sub_array[]=$row["id_area"];//id_area - nombre
				
				$sub_array[]=$row["res_a"]." ".$row["res_n"];//solo para personal

				$sub_array[]=$row["nfolios"];
				//PARA LAS FECHAS
				//Para NUll
				if ($row["f_entrega"] == null) {

					$f_entrega="Sin fecha";//si esta vacio mostramos son fecha

				} else {

					$f_entrega=date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha

				}	
				//var_dump($row["f_entrega"]);

				$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';

				//PARA ESTADO
				$sub_array[] = ($row["estado"]==1) ? '<span class="badge badge-success">Entregado</span>' : '<span class="badge badge-danger">Por entregar</span>';//Aqui se hace el llamamdo de atrib y est

				//PARA EDITAR
				$sub_array[] =  '<button type="button" onclick="mostrar('.$row["id_control"].')" id="'.$row["id_control"].'" class="btn btn-warning "><i class="far fa-edit"></i></button>';

				$sub_array[] =  '<button type="button" onclick="eliminar_control('.$row["id_control"].')" id="'.$row["id_control"].'" class="btn btn-danger "><i class="fas fa-times"></i></button>';
				//asignamos a data todo lo que tiene sub array 
				$data[]=$sub_array;
				
			}
			//enviamos los resultados en $results

			//a traves de un array asociativo enviamos los datos en results ... para el datatable

			$results = array(

				"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 				"aaData"=>$data);

			echo json_encode($results);
			
		break;

		case 'control_fecha':

			$datos = $control->control_fecha($_POST["mes"],$_POST["ano"]);
			
			$data = Array();//a traves de data llevamos los datos al datatable

			foreach ($datos as $row) {
				//recorremos un foreach para sacar los datos y mostrarlo en filas

				$sub_array = array();//suba array recogera los elemento del row

				//PARA ESTADO
				$est='';//esta vacion
				$atrib="btn btn-success btn-md estado";//para cuando esta activo
				//Para ver la resolucion
				$sub_array[]='<button class="btn btn-info detalle" id="'.$row["id_control"].'" data-toggle="modal" data-target="#control_detalle_modal" ><i class="fa fa-eye"></i></button>';
				//DATOS
				$sub_array[]=$row["id_area"];//id_area - nombre
				
				$sub_array[]=$row["res_a"]." ".$row["res_n"];//solo para personal

				$sub_array[]=$row["nfolios"];
				//PARA LAS FECHAS
				//Para NUll
				if ($row["f_entrega"] == null) {

					$f_entrega="Sin fecha";//si esta vacio mostramos son fecha

				} else {

					$f_entrega=date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha

				}	
				//var_dump($row["f_entrega"]);

				$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';

				//PARA ESTADO
				$sub_array[] = ($row["estado"]==1) ? '<span class="badge badge-success">Entregado</span>' : '<span class="badge badge-danger">Por entregar</span>';//Aqui se hace el llamamdo de atrib y est

				//PARA EDITAR
				$sub_array[] =  '<button type="button" onclick="mostrar('.$row["id_control"].')" id="'.$row["id_control"].'" class="btn btn-warning "><i class="far fa-edit"></i></button>';

				$sub_array[] =  '<button type="button" onclick="eliminar_control('.$row["id_control"].')" id="'.$row["id_control"].'" class="btn btn-danger "><i class="fas fa-times"></i></button>';
				//asignamos a data todo lo que tiene sub array 
				$data[]=$sub_array;
				
			}
			//enviamos los resultados en $results

			//a traves de un array asociativo enviamos los datos en results ... para el datatable

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