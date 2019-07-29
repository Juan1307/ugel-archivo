<?php 
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//llamamos a la conexion
	require_once("../config/conexion.php");
	//llamamlos a modelos
	require_once("../modelos/Resolucion.php");
		//instanciamos la clase a un objeto
		$resolucion = new Resolucion();
		//entra al swixht
	switch ($_GET["op"]) {	

		case 'ver_receptor_detalle_entrega':

			$datos = $resolucion->mostrar_receptor_detalle_entrega($_POST["id_detresolucion"]);

			if (is_array($datos)==true and count($datos)>0) {
				
				foreach ($datos as $row) {

					$row["id_usuario"];
				}

				if ($row["id_usuario"]==null) {
					
					$datos0=$resolucion->no_muestra_receptor($_POST["id_detresolucion"]);

					foreach ($datos0 as $row) {

						$output["nombre"]=$row["nombre"];//de la institucion
						$output["nivel"]=$row["nivel"];

						if ($row["f_entrega"]==null) {

							$f_entrega = "Sin fecha";

						} else {

							$f_entrega = date("d-m-Y",strtotime($row["f_entrega"]));
						
						}
						
						$output["f_entrega"] = '<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';
						
						if ($row["estado"]==1) {

							$est='<span class="badge badge-success">Entregado</span>';

						} else {
							
							$est='<span class="badge badge-danger">Por entregar</span>';

						}
						
						$output["estado"]=$est;

					}

					echo json_encode($output);

				} else {

					$datos1=$resolucion->muestra_receptor($_POST["id_detresolucion"]);

					foreach ($datos1 as $row) {

						$output["nombre"]=$row["nombre"];//de la institucion
						$output["nivel"]=$row["nivel"];

						if ($row["f_entrega"]==null) {

							$f_entrega = "Sin fecha";

						} else {

							$f_entrega = date("d-m-Y",strtotime($row["f_entrega"]));
						
						}
						
						$output["f_entrega"] = '<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';
						
						if ($row["estado"]==1) {

							$est='<span class="badge badge-success">Entregado</span>';

						} else {
							
							$est='<span class="badge badge-danger">Por entregar</span>';

						}
						
						$output["estado"]=$est;

						$output["nombres"]=$row["nombres"];
						$output["apellidos"]=$row["apellidos"];
						$output["ndni"]=$row["ndni"];
						$output["carnet"]=$row["carnet"];
						$output["contacto"]=$row["contacto"];
					}

					echo json_encode($output);
				}//end else

			} else {
				
				echo "error del id_detresolucion";
			}
			

		break;

		case 'agregar_usuario_det_re':

			if (!empty($_POST["id_usuario"]) and !empty($_POST["id_resolucion"])) {
				
				$resolucion->agregar_usuario_det_re($_POST["id_resolucion"],$_POST["id_usuario"]);

				$messages[]="Usuario agregado a la resolución correctamente";

			} else {

				$errors[]="Error al llamar id_resolucion - para tbl_det_resolucion";
			}

		//para messages
		if (isset($messages)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-success fixed-top" id="messages_r" role="alert">
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

		break;

		case 'agregar_institucion_det_re':

			if (!empty($_POST["id_institucion"]) and !empty($_POST["id_resolucion"])) {
				
				$resolucion->agregar_institucion_det_re($_POST["id_resolucion"],$_POST["id_institucion"]);

				$messages[]="Institución agregada a la resolución correctamente";

			} else {

				$errors[]="Error al llamar id_resolucion - para tbl_det_resolucion";
			}

		//para messages
		if (isset($messages)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-success fixed-top" id="messages_r" role="alert">
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

		break;

		case 'agregar_receptor_det_re':

			if (!empty($_POST["id_usuario"]) and !empty($_POST["id_detresolucion"])) {
				
				$resolucion->agregar_receptor_det_re($_POST["id_detresolucion"],$_POST["id_usuario"]);

				$messages[]="Receptor agregado a la resolución correctamente";

			} else {

				$errors[]="Error al llamar id_detresolucion - para tbl_det_resolucion";
			}

		//para messages
		if (isset($messages)) {
			?>
			<div class="animated bounceOut delay-3s alert alert-success fixed-top" id="messages_r" role="alert">
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

		break;

		case 'agregar_usuarios':

		 require_once("../modelos/Usuarios.php");	

		 	$usuarios = new Usuarios();

			$datos=$usuarios->get_usuarios();

			$data = Array();//arreglo para las filas que va a almacenar

			foreach ($datos as $row){

				$sub_array = array();//recogemos los datos de la variable $row

				//asignado valores a las filas 
				$sub_array[]=$row["apellidos"];
				$sub_array[]=$row["nombres"];
				$sub_array[]=$row["ndni"];
				$sub_array[]=$row["carnet"];
				$sub_array[]=$row["contacto"];

				$sub_array[]='<button type="button" name="" id="'.$row["id_usuario"].'" class="btn btn-primary btn-md" onclick="agregar_usuario_det_re('.$row["id_usuario"].','.$_POST["id_resolucion"].')"><i class="fa fa-plus"></i> Agregar </button>';

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

		case 'agregar_institucion':

		 require_once("../modelos/Instituciones.php");	

		 	$institucion = new Instituciones();

			$datos=$institucion->get_institucion();

			$data = Array();//arreglo para las filas que va a almacenar

			foreach ($datos as $row){

				$sub_array = array();//recogemos los datos de la variable $row

				//asignado valores a las filas 
				$sub_array[]=$row["nombre"];
				$sub_array[]=$row["nivel"];

				$sub_array[]='<button type="button" name="" id="'.$row["id_institucion"].'" class="btn btn-primary btn-md" onclick="agregar_institucion_det_re('.$row["id_institucion"].','.$_POST["id_resolucion"].')"><i class="fa fa-plus"></i> Agregar </button>';

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

		case 'agregar_receptor':

		 require_once("../modelos/Usuarios.php");	

		 	$usuarios = new Usuarios();

			$datos=$usuarios->get_usuarios();

			$data = Array();//arreglo para las filas que va a almacenar

			foreach ($datos as $row){

				$sub_array = array();//recogemos los datos de la variable $row

				//asignado valores a las filas 
				$sub_array[]=$row["apellidos"];
				$sub_array[]=$row["nombres"];
				$sub_array[]=$row["ndni"];
				$sub_array[]=$row["carnet"];
				$sub_array[]=$row["contacto"];

				$sub_array[]='<button type="button" name="" id="'.$row["id_usuario"].'" class="btn btn-primary btn-md" onclick="asignar_receptor_det_re('.$row["id_usuario"].','.$_POST["id_detresolucion"].')"><i class="fa fa-plus"></i> Asignar </button>';

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


		//para activar el detalle
		case 'cambiar_estado_detalle':

			$resolucion->cambiar_estado_detalle($_POST["id_detresolucion"],$_POST["estado"]);

		break;

		case 'editar_detalle_usuarios':
			//llamamos el modelos de Usuarios			
			require_once("../modelos/Usuarios.php");
			//instanciamos la clase
			$usuarios = new Usuarios();

			$id_usuario = isset($_POST["id_usuario"]);
			$nombres = isset($_POST["nombres"]);
			$apellidos = isset($_POST["apellidos"]);
			$ndni = isset($_POST["ndni"]);
			$carnet = isset($_POST["carnet"]);
			$contacto = isset($_POST["contacto"]);
			//para la resolucion
			$f_entrega = isset($_POST["f_entrega"]);
			$estado = isset($_POST["estado_detalle"]);
			$id_detresolucion = isset($_POST["id_detresolucion"]);

			$datos = $usuarios->get_usuarios_dni($_POST["ndni"]); //para DNI

			$datos1 = $usuarios->get_usuarios_carnet($_POST["carnet"]); //Para CARNET

			if (empty($_POST["id_usuario"])) {
				
				$errors[]="El usuario no existe";

			}else{

				if (!empty($_POST["ndni"]) and !empty($_POST["carnet"])) {
								
					$warnings[]="Porfavor ingrese solo uno de los campos ya sea <strong> Dni / Carnet .</strong>";

					$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);

				}
				//DNI vacio
				elseif (empty($_POST["ndni"]) and empty($_POST["carnet"])) {

					$messages[]="Usuario - Resolución editado correctamente";
					
					$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);

					$resolucion->editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado);
				}

				elseif (empty($_POST["ndni"])) {

					$datos2 = $usuarios->get_usuarios_id($_POST["id_usuario"]);

						foreach ($datos2 as $row) {
							//sacamos el dni
							$row["carnet"];
						}
						//lo comparamos con el valor de la base de datos
					if ($row["carnet"] == $_POST["carnet"]) {

						$messages[]="Usuario - Resolución editado correctamente";
						
						$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);

						$resolucion->editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado);

					}elseif (is_array($datos1)==true and count($datos1)>0) {

						$errors[]="El <strong>CARNET ".$_POST["carnet"]."</strong> ingresado ya existe";
					
					}else{
							//Edita los usuarios correctamente
						$messages[]="Usuario - Resolución editado correctamente";
						
						$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);

						$resolucion->editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado);
					}
				}
				//CARNET vacio 
				elseif (empty($_POST["carnet"])) {

					$datos2 = $usuarios->get_usuarios_id($_POST["id_usuario"]);

						foreach ($datos2 as $row) {
							//sacamos el dni
							$row["ndni"];
						}

					if ($row["ndni"]==$_POST["ndni"]) {

						$messages[]="Usuario - Resolución editado correctamente";

						$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);

						$resolucion->editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado);
					}

					elseif (is_array($datos)==true and count($datos)>0) {

						$errors[]="El <strong>DNI ".$_POST["ndni"]."</strong> ingresado ya existe";
						
					}else{
							
						$messages[]="Usuario - Resolución editado correctamente";				
							//Edita los usuarios correctamente
						$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);

						$resolucion->editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado);

					}
				}
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

		case 'editar_detalle_institucion':
		//llamamos al modelo de instituciones
		require_once ("../modelos/Instituciones.php");

			$institucion = new Instituciones();

			$id_institucion = isset($_POST["id_institucion"]);
			$nombre = isset($_POST["nombre"]);
			$nivel = isset($_POST["nivel"]);
			//para la resolucion
			$f_entrega = isset($_POST["f_entrega"]);
			$estado = isset($_POST["estado_detalle"]);
			$id_detresolucion = isset($_POST["id_detresolucion"]);

				//Filtros
				$datos = $institucion->get_institucion_nombre($_POST["nombre"]);
				$datos1 = $institucion->get_institucion_id($_POST["id_institucion"]);

					foreach ($datos1 as $row) {
						//sacamos el nombre
						$row["nombre"];
					}
						//lo comparamos con el valor de la base de datos
				if ($row["nombre"] == $_POST["nombre"]) {

					$messages[]="La Institución se ha actualizado correctamente";
						
					$institucion->editar_institucion_sobrante($id_institucion,$nivel);

					$resolucion->editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado);

				}elseif (is_array($datos)==true and count($datos)>0) {

					$errors[]="La Institución ingresada ya existe";
					
				}else{

					$institucion->editar_institucion($id_institucion,$nombre,$nivel);

					$resolucion->editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado);
							//Edita los institucion correctamente
					$messages[]="La Institución se ha actualizado correctamente";
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
		//Para mostrar los datos del detalle y tmbn del usuario
		case 'mostrar_detalle_usuarios':

			$datos=$resolucion->get_detresolucion_id($_POST["id_detresolucion"]);//enviamos el valor para traer solo una fila a mostrar
				//hacmos el verificado
				if (is_array($datos)==true and count($datos)>0) {
					//recorremos para scar los datos
					foreach ($datos as $row) {
						//asignamos los valores al output
						$output["apellidos"]=$row["apellidos"];
						$output["nombres"]=$row["nombres"];
						$output["ndni"]=$row["ndni"];
						$output["carnet"]=$row["carnet"];
						$output["contacto"]=$row["contacto"];
						//asignamos los valores del detresolucion
						$output["id_usuario"]=$row["id_usuario"];
						//PARA LA FECHA DE ENTREGA
						if ($row["f_entrega"]==null) {

							$f_entrega = "";

						} else {
							
							$f_entrega = date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha
						}

						$output["f_entrega"]=$f_entrega;
						
						$output["estado"]=$row["estado"]; 
					}
					//recogemos los datos adignados
				echo json_encode($output);

				} else {
					//muestra un mesaje de error
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

		case 'mostrar_detalle_institucion':

			$datos=$resolucion->get_detresolucion_id_ie($_POST["id_detresolucion"]);//enviamos el valor para traer solo una fila a mostrar
				//hacmos el verificado
				if (is_array($datos)==true and count($datos)>0) {
					//recorremos para scar los datos
					foreach ($datos as $row) {
						//asignamos los valores al output
						$output["nombre"]=$row["nombre"];
						$output["nivel"]=$row["nivel"];
						//asignamos los valores del detresolucion
						$output["id_institucion"]=$row["id_institucion"];
						//PARA LA FECHA DE ENTREGA
						if ($row["f_entrega"]==null) {

							$f_entrega = "";

						} else {
							
							$f_entrega = date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha
						}

						$output["f_entrega"]=$f_entrega;
						
						$output["estado"]=$row["estado"]; 
					}
					//recogemos los datos adignados
				echo json_encode($output);

				} else {
					//muestra un mesaje de error
					$errors[]="La Institución no existe";
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
			
			$resolucion->eliminar_detalle($_POST["id_detresolucion"]);

		break;

		case 'listar_det_resolucion':
			//llamamos al metodo
			$datos = $resolucion->get_det_resolucion();
				//data para datatable
				$data = Array();

			foreach ($datos as $row) {
				
				$sub_array = array();//sl descomponer lo almacenamos en este array

					$sub_array[]=$row["nresolucion"]; //tbl resolucion
					$sub_array[]=$row["nproyecto"];
					$sub_array[]=$row["motivo"]; //tbl motivo
					//$sub_array[]=$row["area"]; //tbl area
					//PARA FECHA ENTREGA
					if ($row["f_emision"]==null) {
						
						$f_emision = "Sin fecha";

					} else {
						
						$f_emision = date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha 
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';

					//ESTADO DE TBLRESOLUCION
					/*if ($row["estado"] == 1) {
						
						$estado = '<span class="badge badge-success">Activo</spans>';
					} else {
						
						$estado ='<span class="badge badge-danger">Inactivo</span>';
					}*/
					
					//$sub_array[]=$estado; //tbl resolucion
					$sub_array[]=$row["apellidos"];
					$sub_array[]=$row["nombres"];
					$sub_array[]=$row["ndni"];
					$sub_array[]=$row["carnet"];

					//PARA FECHA DE TBL_DETRESOLUCION
					if ($row["f_entrega"]==null) {

						$f_entrega = "Sin fecha";

					} else {

						$f_entrega = date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';

					//PARA ESTADO DE TTBL_DETRESOLUCION
					if ($row["estado_detalle"] == 1) {

						$estado_detalle = '<span class="badge badge-success">Entregado</span>';
						
					} else {
						
						$estado_detalle = '<span class="badge badge-danger">Por entregar</span>';
					}

					$sub_array[]=$estado_detalle;
				
					$data[]=$sub_array;
			}

			$results = array(

				"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 				"aaData"=>$data);

			echo json_encode($results);


		break;
		
		case 'listar_det_resolucion_institucion':
			//llamamos al metodo
			$datos = $resolucion->get_det_resolucion_institucion();
				//data para datatable
				$data = Array();

			foreach ($datos as $row) {
				
				$sub_array = array();//sl descomponer lo almacenamos en este array

					$sub_array[]=$row["nresolucion"]; //tbl resolucion
					$sub_array[]=$row["nproyecto"];
					$sub_array[]=$row["motivo"]; //tbl motivo
					//$sub_array[]=$row["area"]; //tbl area
					//PARA FECHA ENTREGA
					if ($row["f_emision"]==null) {
						
						$f_emision = "Sin fecha";

					} else {
						
						$f_emision = date("d-m-Y",strtotime($row["f_emision"]));//muestra la fecha 
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_emision.' </span>';

					//ESTADO DE TBLRESOLUCION
					/*if ($row["estado"] == 1) {
						
						$estado = '<span class="badge badge-success">Activo</spans>';
					} else {
						
						$estado ='<span class="badge badge-danger">Inactivo</span>';
					}*/
					
					//$sub_array[]=$estado; //tbl resolucion
					$sub_array[]=$row["nombre"];
					$sub_array[]=$row["nivel"];

					//PARA FECHA DE TBL_DETRESOLUCION
					if ($row["f_entrega"]==null) {

						$f_entrega = "Sin fecha";

					} else {

						$f_entrega = date("d-m-Y",strtotime($row["f_entrega"]));//muestra la fecha
					}
					
					$sub_array[]='<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;'.$f_entrega.' </span>';

					//PARA ESTADO DE TTBL_DETRESOLUCION
					if ($row["estado_detalle"] == 1) {

						$estado_detalle = '<span class="badge badge-success">Entregado</span>';
						
					} else {
						
						$estado_detalle = '<span class="badge badge-danger">Por entregar</span>';
					}

					$sub_array[]=$estado_detalle;
				
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