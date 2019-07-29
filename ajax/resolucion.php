<?php 
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//llamamos a la conexion
	require_once("../config/conexion.php");
	
	//llamamos a la clase RESOLUCION
	require_once("../modelos/Resolucion.php");

	//instanciamos la clase
	$resolucion = new Resolucion();

	switch ($_GET["op"]) 
	{
		case 'detalle_resolucion':
			//llamamos al metdo para traer la resolucion
			$datos=$resolucion->get_detalle_resolucion($_POST["id_resolucion"]);//en el post tenemos el valor del id de la resolucion a mostrar
			 
			 if (is_array($datos)==true and count($datos)>0) {
			 	//recorremos para traer la fila
			 	foreach ($datos as $row) {
			 		$output["id_resolucion"]=$row["id_resolucion"];
			 		$output["nresolucion"]=$row["nresolucion"];
			 		$output["nproyecto"]=$row["nproyecto"];
			 		$output["id_motivo"]=$row["id_motivo"];
			 		$output["id_area"]=$row["id_area"];
			 		//Para FECHA
					if ($row["f_emision"] == null) {

						$f_emision="Sin fecha";//si esta vacio mostramos son fecha

					} else {

						$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

					}

			 		$output["f_emision"]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';
			 		
			 		//PARA ESTADO
			 		if ($row["estado"]==1) {
			 			
			 			$estado='<span class="badge badge-success">Activo</span>';//bagge Success

			 		} else {

			 			$estado='<span class="badge badge-danger">Inactivo</span>';//bagge danger
			 		}
			 		//le indico el texto al output
			 		$output["estado"]=$estado;	
			 	}

			 	echo json_encode($output);

			 } else {
			 	//si no existe nos arroja un error
			 	$errors[]="Resolucion no existente";
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
		//para editar la resolucion
		case 'editar':
			//las variables que almacenan datos del formulario
			//con el isset sabemos si existen dichos names
			$id_resolucion = isset($_POST["id_resolucion"]);
			$nresolucion = isset($_POST["nresolucion"]);
			$nproyecto = isset($_POST["nproyecto"]);
			$id_motivo = isset($_POST["id_motivo"]);
			$id_area = isset($_POST["id_area"]);
			$f_emision = isset($_POST["f_emision"]);
			$estado = isset($_POST["est"]);
			//hacemos el verificado del id 

			if (empty($id_resolucion)) {
				//si esta vacio el id imprime error
				$errors[]="No se pudo editar la resolucion";
				
			}else{
				//para editar la resolucion
				$resolucion->editar_resolucion($id_resolucion,$id_motivo,$id_area,$nresolucion,$nproyecto,$f_emision,$estado);
				//imprimimos un mensaje de conforme
				$messages[]="Resolucion actualizada correctamente";
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

		case 'verificar_resolucion':

			$datos = $resolucion->verificar_resolucion($_POST["id_resolucion"]);

				if (is_array($datos)==true and count($datos)>0) {
					
					foreach ($datos as $row) {

						$output["id_usuario"]=$row["id_usuario"];
						$output["id_institucion"]=$row["id_institucion"];
					}

				echo json_encode($output);
				}
				
		break;
		//Para mostrar el detalle
		case 'detalle_usuarios':

			$datos = $resolucion->get_detalle_usuarios($_POST["id_resolucion"]);//en el post tenemos el valor del id de la resolucion a mostrar

			$data = Array();//la data qu eenviamos al datatable

				foreach ($datos as $row) {
					//recogemos los datos en el output
					$sub_array=array();

					$est='';//esta vacion
						$atrib="btn btn-success btn-md estado";//para cuando esta activo

						if ($row["estado"] == 0) {
							//si el valor recibido a traves de estado es 0 muestra Entregado
							$est='POR ENTREGAR';
							$atrib="btn btn-danger btn-md estado";

						} else {
							//caso contrario pasa como activo
							if($row["estado"] == 1){
								$est='ENTREGADO';
							}
						}//cierre para estado

					$sub_array[]=$row["apellidos"];
					$sub_array[]=$row["nombres"];
					$sub_array[]=$row["ndni"];
					$sub_array[]=$row["carnet"];
					$sub_array[]=$row["contacto"];
					//PARA LA FECHA
					if ($row["f_entrega"] == null) {

						$f_entrega="Sin fecha";//arrojamos el mensaje sin fecha

					} else {

						$f_entrega=date("d-m-Y",strtotime($row["f_entrega"]));//arrojamos la fecha de que contiene
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';

					//PARA ESTADO
					$sub_array[] = '<button type="button" onclick="cambiar_estado_detalle('.$row["id_detresolucion"].','.$row["estado"].');" name="estado_det" id="'.$row["id_detresolucion"].'" class="'.$atrib.'">'.$est.'</button>';//Aqui se hace el llamamdo 	de atrib y est

					//PARA EDITAR
					$sub_array[]='<button type="button" onclick="mostrar_detalle_usuarios('.$row["id_detresolucion"].')" data-toggle="modal" data-target="#usuarios_detalle_Modal"  id="'.$row["id_detresolucion"].'" class="btn btn-warning"><i class="far fa-edit"></i></button>';

					$sub_array[]='<button type="button" onclick="eliminar_detalle('.$row["id_detresolucion"].');" id="'.$row["id_detresolucion"].'" class="btn btn-danger"><i class="fa fa-times"></i></button>';//Aqui se hace el llamamdo 	de atrib y est

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


		//Para mostrar el detalle
		case 'detalle_institucion':

			$datos = $resolucion->get_detalle_institucion($_POST["id_resolucion"]);//en el post tenemos el valor del id de la resolucion a mostrar

			$data = Array();//la data qu eenviamos al datatable

				foreach ($datos as $row) {
					//recogemos los datos en el output
					$sub_array=array();

					$est='';//esta vacion
						$atrib="btn btn-success btn-md estado";//para cuando esta activo

						if ($row["estado"] == 0) {
							//si el valor recibido a traves de estado es 0 muestra Entregado
							$est='POR ENTREGAR';
							$atrib="btn btn-danger btn-md estado";

						} else {
							//caso contrario pasa como activo
							if($row["estado"] == 1){
								$est='ENTREGADO';
							}
						}//cierre para estado

					$sub_array[]=$row["nombre"];
					$sub_array[]=$row["nivel"];
					//PARA LA FECHA
					if ($row["f_entrega"] == null) {

						$f_entrega="Sin fecha";//arrojamos el mensaje sin fecha

					} else {

						$f_entrega=date("d-m-Y",strtotime($row["f_entrega"]));//arrojamos la fecha de que contiene
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';

					//PARA ESTADO
					$sub_array[] = '<button type="button" onclick="cambiar_estado_detalle('.$row["id_detresolucion"].','.$row["estado"].');" name="estado_det" id="'.$row["id_detresolucion"].'" class="'.$atrib.'">'.$est.'</button>';//Aqui se hace el llamamdo 	de atrib y est

					//PARA EDITAR
					$sub_array[]='<button type="button" onclick="asignar_receptor('.$row["id_detresolucion"].')" id="'.$row["id_detresolucion"].'" class="btn btn-primary"><i class="fas fa-user-plus"></i></button>';

					$sub_array[]='<button type="button" onclick="mostrar_detalle_institucion('.$row["id_detresolucion"].');" id="'.$row["id_detresolucion"].'" class="btn btn-warning"><i class="far fa-edit"></i></button>';

					$sub_array[]='<button type="button" onclick="ver_receptor_detalle_entrega('.$row["id_detresolucion"].');" id="'.$row["id_detresolucion"].'" class="btn btn-info"><i class="fa fa-eye"></i></button>';

					$sub_array[]='<button type="button" onclick="eliminar_detalle('.$row["id_detresolucion"].');" id="'.$row["id_detresolucion"].'" class="btn btn-danger"><i class="fa fa-times"></i></button>';
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


		case 'eliminar_resolucion':

			$resolucion->eliminar_resolucion($_POST["id_resolucion"]);

		break;

		case 'mostrar':

			$datos=$resolucion->get_resolucion_id($_POST["id_resolucion"]);//en el post tenemos el valor del id de la resolucion a mostrar

			if (is_array($datos)==true and count($datos)>0) {
				//si existe el id que enviamos me trae los datos y recorro
				foreach ($datos as $row) {
					//asignamos la data a output
					$output["nresolucion"]=$row["nresolucion"];
					$output["nproyecto"]=$row["nproyecto"];
					$output["id_motivo"]=$row["id_motivo"];
					$output["id_area"]=$row["id_area"];
					//Para FECHA
					if ($row["f_emision"] == null) {

						$f_emision="";//si esta vacio mostramos son fecha

					} else {

						$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

					}
					//asignamos el resultado a f_emision
					$output["f_emision"]=$f_emision;

					$output["estado"]=$row["estado"];
				}
				//lo que recogimos en output 
				echo json_encode($output);

			} else {
			 	//si no existe nos arroja un error
			 	$errors[]="Resolución no existente";
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

		case 'activar_resolucion':
			//ejecutamos el metodo de cambiar estado
			$resolucion->activar_resolucion($_POST["id_resolucion"]);
				
		break;

		case 'desactivar_resolucion':
			//ejecutamos el metodo de cambiar estado
			$resolucion->desactivar_resolucion($_POST["id_resolucion"]);

		break;

		case 'buscar_resolucion':
			
			$datos=$resolucion->get_resolucion();
			
			$data = Array();//a traves de data llevamos los datos al datatable

			foreach ($datos as $row) {
				//recorremos un foreach para sacar los datos y mostrarlo en filas

				$sub_array = array();//suba array recogera los elemento del row

				//PARA ESTADO
				$est='';//esta vacion
				$atrib="btn btn-success btn-md estado";//para cuando esta activo

				if ($row["estado"] == 0) {
					//si el valor recibido a traves de estado es 0 muestra Entregado
					$est='INACTIVO';
					$atrib="btn btn-danger btn-md estado";

				} else {
					//caso contrario pasa como activo
					if($row["estado"] == 1){
						$est='ACTIVO';
					}
				}
				//Para ver la resolucion
				$sub_array[]='<button class="btn btn-info detalle" id="'.$row["id_resolucion"].'" data-toggle="modal"><i class="fa fa-eye"></i></button>';
				//DATOS
				$sub_array[]=$row["nresolucion"];
				$sub_array[]=$row["nproyecto"];

				$sub_array[]=$row["id_motivo"];//id_motivo - descripcion
				$sub_array[]=$row["id_area"];//id_area - nombre
				
				//PARA LAS FECHAS
				//Para NUll
				if ($row["f_emision"] == null) {

					$f_emision="Sin fecha";//si esta vacio mostramos son fecha

				} else {

					$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

				}	
				//var_dump($row["f_entrega"]);

				$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';

				//PARA ESTADO
				$sub_array[] = ($row["estado"]==1) ? '<button type="button" onclick="desactivar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' : '<button type="button" onclick="activar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' ;//Aqui se hace el llamamdo de atrib y est

				//PARA EDITAR
				$sub_array[] =  '<button type="button" onclick="mostrar('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-warning "><i class="far fa-edit"></i></button>';

				$sub_array[] =  '<button type="button" onclick="eliminar_resolucion('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-danger "><i class="fa fa-times"></i></button>';
				
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

		case 'buscar_resolucion_institucion':
			
			$datos=$resolucion->get_resolucion_institucion();
			
			$data = Array();//a traves de data llevamos los datos al datatable

			foreach ($datos as $row) {
				//recorremos un foreach para sacar los datos y mostrarlo en filas

				$sub_array = array();//suba array recogera los elemento del row

				//PARA ESTADO
				$est='';//esta vacion
				$atrib="btn btn-success btn-md estado";//para cuando esta activo

				if ($row["estado"] == 0) {
					//si el valor recibido a traves de estado es 0 muestra Entregado
					$est='INACTIVO';
					$atrib="btn btn-danger btn-md estado";

				} else {
					//caso contrario pasa como activo
					if($row["estado"] == 1){
						$est='ACTIVO';
					}
				}
				//Para ver la resolucion
				$sub_array[]='<button class="btn btn-info detalle_institucion" id="'.$row["id_resolucion"].'" data-toggle="modal"><i class="fa fa-eye"></i></button>';
				//DATOS
				$sub_array[]=$row["nresolucion"];
				$sub_array[]=$row["nproyecto"];

				$sub_array[]=$row["id_motivo"];//id_motivo - descripcion
				$sub_array[]=$row["id_area"];//id_area - nombre
				
				//PARA LAS FECHAS
				//Para NUll
				if ($row["f_emision"] == null) {

					$f_emision="Sin fecha";//si esta vacio mostramos son fecha

				} else {

					$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

				}	
				//var_dump($row["f_entrega"]);

				$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';

				//PARA ESTADO
				$sub_array[] = ($row["estado"]==1) ? '<button type="button" onclick="desactivar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' : '<button type="button" onclick="activar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' ;//Aqui se hace el llamamdo de atrib y est

				//PARA EDITAR
				$sub_array[] =  '<button type="button" onclick="mostrar('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-warning "><i class="far fa-edit"></i></button>';

				$sub_array[] =  '<button type="button" onclick="eliminar_resolucion('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-danger "><i class="fa fa-times"></i></button>';
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

		case 'resolucion_fecha':
			
			$datos=$resolucion->resolucion_fecha($_POST["mes"],$_POST["ano"]);
			
			$data = Array();//a traves de data llevamos los datos al datatable

			foreach ($datos as $row) {
				//recorremos un foreach para sacar los datos y mostrarlo en filas

				$sub_array = array();//suba array recogera los elemento del row

				//PARA ESTADO
				$est='';//esta vacion
				$atrib="btn btn-success btn-md estado";//para cuando esta activo

				if ($row["estado"] == 0) {
					//si el valor recibido a traves de estado es 0 muestra Entregado
					$est='INACTIVO';
					$atrib="btn btn-danger btn-md estado";

				} else {
					//caso contrario pasa como activo
					if($row["estado"] == 1){
						$est='ACTIVO';
					}
				}
				//Para ver la resolucion
				$sub_array[]='<button class="btn btn-info detalle" id="'.$row["id_resolucion"].'" data-toggle="modal" data-target="#resolucion_detalle_modal" ><i class="fa fa-eye"></i></button>';
				//DATOS
				$sub_array[]=$row["nresolucion"];
				$sub_array[]=$row["nproyecto"];

				$sub_array[]=$row["id_motivo"];//id_motivo - descripcion
				$sub_array[]=$row["id_area"];//id_area - nombre
				
				//PARA LAS FECHAS
				//Para NUll
				if ($row["f_emision"] == null) {

					$f_emision="Sin fecha";//si esta vacio mostramos son fecha

				} else {

					$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

				}	
				//var_dump($row["f_entrega"]);

				$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';

				//PARA ESTADO
				$sub_array[] = ($row["estado"]==1) ? '<button type="button" onclick="desactivar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' : '<button type="button" onclick="activar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' ;//Aqui se hace el llamamdo de atrib y est

				//PARA EDITAR
				$sub_array[] =  '<button type="button" onclick="mostrar('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-warning btn-md update"><i class="far fa-edit"></i></button>';

				$sub_array[] =  '<button type="button" onclick="eliminar_resolucion('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-danger "><i class="fa fa-times"></i></button>';

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

		case 'resolucion_fecha_institucion':
			
			$datos=$resolucion->resolucion_fecha_institucion($_POST["mes"],$_POST["ano"]);
			
			$data = Array();//a traves de data llevamos los datos al datatable

			foreach ($datos as $row) {
				//recorremos un foreach para sacar los datos y mostrarlo en filas

				$sub_array = array();//suba array recogera los elemento del row

				//PARA ESTADO
				$est='';//esta vacion
				$atrib="btn btn-success btn-md estado";//para cuando esta activo

				if ($row["estado"] == 0) {
					//si el valor recibido a traves de estado es 0 muestra Entregado
					$est='INACTIVO';
					$atrib="btn btn-danger btn-md estado";

				} else {
					//caso contrario pasa como activo
					if($row["estado"] == 1){
						$est='ACTIVO';
					}
				}
				//Para ver la resolucion
				$sub_array[]='<button class="btn btn-info detalle_institucion" id="'.$row["id_resolucion"].'" data-toggle="modal" data-target="#resolucion_detalle_modal" ><i class="fa fa-eye"></i></button>';
				//DATOS
				$sub_array[]=$row["nresolucion"];
				$sub_array[]=$row["nproyecto"];

				$sub_array[]=$row["id_motivo"];//id_motivo - descripcion
				$sub_array[]=$row["id_area"];//id_area - nombre
				
				//PARA LAS FECHAS
				//Para NUll
				if ($row["f_emision"] == null) {

					$f_emision="Sin fecha";//si esta vacio mostramos son fecha

				} else {

					$f_emision=date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha

				}	
				//var_dump($row["f_entrega"]);

				$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';

				//PARA ESTADO
				$sub_array[] = ($row["estado"]==1) ? '<button type="button" onclick="desactivar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' : '<button type="button" onclick="activar_resolucion('.$row["id_resolucion"].');" name="estado" id="'.$row["id_resolucion"].'" class="'.$atrib.'">'.$est.'</button>' ;//Aqui se hace el llamamdo de atrib y est

				//PARA EDITAR
				$sub_array[] =  '<button type="button" onclick="mostrar('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-warning btn-md update"><i class="far fa-edit"></i></button>';

				$sub_array[] =  '<button type="button" onclick="eliminar_resolucion('.$row["id_resolucion"].')" id="'.$row["id_resolucion"].'" class="btn btn-danger "><i class="fa fa-times"></i></button>';

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

		case 'selectmotivo':
		//llamamos al select para motivo
			require_once("../modelos/Motivo.php");
			//instanciamos a un objeto
			$motivo = new Motivo();

				//lamamos al metodo select_motivo
				$datos = $motivo->select_motivo(); 

				//recorremos datos	
				foreach ($datos as $row) { 
					//mostramos los motivos tanto id con descripcion
					echo '<option value=' . $row["id_motivo"] . '>' . $row["descripcion"] . '</option>';				
				}
		break;
	}
}

else{

    header("Location:../error.php");
    exit();

  }
	

	
 ?>