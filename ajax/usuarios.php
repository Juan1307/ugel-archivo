<?php
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//Llamamos a la base de datos

	require_once("../config/conexion.php");

	//Llamamos al modulo USUARIOS - MODELOS

	require_once("../modelos/Usuarios.php");
	
		$usuarios = new Usuarios();

	//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
 
	$id_usuario = isset($_POST["id_usuario"]);
	$nombres = isset($_POST["nombres"]);
	$apellidos = isset($_POST["apellidos"]);
	$ndni = isset($_POST["ndni"]);
	$carnet = isset($_POST["carnet"]);
	$contacto = isset($_POST["contacto"]);
	//Es lo que se envia al formulario

	//parametro que evalua los parametros que se envian por ajax
	switch ($_GET["op"]){
	
		case "guardaryeditar":
			//verifica si ya existen los datos
			$datos = $usuarios->get_usuarios_dni($_POST["ndni"]); //para DNI

			$datos1 = $usuarios->get_usuarios_carnet($_POST["carnet"]); //Para CARNET
			
			if (empty($_POST["id_usuario"])) //empty es vacio
				//si no existe el usuario lo registra pero si existe lo edita
			{
				//DNI Vacio & CARNET vacio
				if (empty($_POST["ndni"]) and empty($_POST["carnet"])) 
				{
									
					$usuarios->registrar_usuario($nombres,$apellidos,$ndni,$carnet,$contacto);
					
					$messages[]="Usuario <strong> incompleto </strong> registrado correctamente";

				}else{
					//CARNET vacio 
					if (empty($_POST["carnet"])) {
						
						if (is_array($datos)==true and count($datos)==0) {
							
						   $usuarios->registrar_usuario($nombres,$apellidos,$ndni,$carnet,$contacto);
							//Ingresa los usuarios correctamente
						   $messages[]="El Usuario con <strong> DNI ".$_POST["ndni"]."</strong> se registro correctamente";				
						
						}

						else{

							$errors[]="El <strong>DNI ".$_POST["ndni"]."</strong> ingresado ya existe";
						}					
					}else{
						//DNI vacio
						if (empty($_POST["ndni"])) {
							
							if (is_array($datos1)==true and count($datos1)==0) {

							   $usuarios->registrar_usuario($nombres,$apellidos,$ndni,$carnet,$contacto);
							   //Ingresa los usuarios correctamente
						       $messages[]="El Usuario con <strong>CARNET ".$_POST["carnet"]."</strong> se registro correctamente";
							
							}else{

								$errors[]="El <strong>CARNET ".$_POST["carnet"]."</strong> ingresado ya existe";	
							}

						}else{
							//DNI no existe & CARNET existe
							if (!empty($_POST["ndni"]) and !empty($_POST["carnet"])) {
								
								$warnings[]="Porfavor ingrese solo <strong> DNI o CARNET .</strong>";

							}
					}//fin else 1
				}
			  }
			//Fin empty
			}else{

				if (!empty($_POST["ndni"]) and !empty($_POST["carnet"])) {
								
					$warnings[]="Porfavor ingrese solo <strong> DNI o CARNET .</strong>";

					$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);
				}
				//DNI vacio
				elseif (empty($_POST["ndni"]) and empty($_POST["carnet"])) {

					$messages[]="Usuario actualizado correctamente";
					
					$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);
				}

				elseif (empty($_POST["ndni"])) {

					$datos2 = $usuarios->get_usuarios_id($_POST["id_usuario"]);

						foreach ($datos2 as $row) {
							//sacamos el dni
							$row["carnet"];
						}
						//lo comparamos con el valor de la base de datos
					if ($row["carnet"] == $_POST["carnet"]) {

						$messages[]="Usuario con <strong>CARNET ".$_POST["carnet"]."</strong> actualizado correctamente";
						
						$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);

					}elseif (is_array($datos1)==true and count($datos1)>0) {

						$errors[]="El <strong>CARNET ".$_POST["carnet"]."</strong> ingresado ya existe";
					
					}else{

						$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);
							//Edita los usuarios correctamente
						$messages[]="Usuario con <strong>CARNET ".$_POST["carnet"]."</strong> actualizado correctamente";
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

						$usuarios->editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto);

						$messages[]="Usuario con <strong>DNI ".$_POST["ndni"]."</strong> actualizado correctamente";
					}

					elseif (is_array($datos)==true and count($datos)>0) {

						$errors[]="El <strong>DNI ".$_POST["ndni"]."</strong> ingresado ya existe";
						
					}else{
							
						$usuarios->editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto);
							//Edita los usuarios correctamente
						$messages[]="Usuario con <strong>DNI ".$_POST["ndni"]."</strong> actualizado correctamente";				

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
		
		//PARA MOSTRAR
		case "mostrar":
		//verificamos si existen los datos en la base de datos ID_USUARIO
			$datos = $usuarios->get_usuarios_id($_POST["id_usuario"]);
			//Verificamos si el usuario a consultar existe 
			if (is_array($datos)==true and count($datos)>0) {
				//verifica si el id es mayor a cero para ejecutar funcion
				foreach ($datos as $row) {

					$output["apellidos"]=$row["apellidos"];
					$output["nombres"]=$row["nombres"];
					$output["ndni"]=$row["ndni"];
					$output["carnet"]=$row["carnet"];
					$output["contacto"]=$row["contacto"];

					echo json_encode($output);
				}
			} else {

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
		case "listar":

			$datos=$usuarios->get_usuarios();//traemos los datos del metodo get_usuarios

			$data = Array();//arreglo para las filas que va a almacenar

			foreach ($datos as $row){

				$sub_array= array();//recogemos los datos de la variable $row

				//asignado valores a las filas 
				$sub_array[]=$row["apellidos"];
				$sub_array[]=$row["nombres"];
				$sub_array[]=$row["ndni"];
				$sub_array[]=$row["carnet"];
				$sub_array[]=$row["contacto"];

					$sub_array[]='<button type="button" onclick="mostrar_usuario('.$row["id_usuario"].');" id="'.$row["id_usuario"].'" class="btn btn-warning btn-md update"><i class="far fa-edit"></i> Editar </button>';

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

		//PARA LA RESOLUCION 
		case "listar_resolucion_usuarios":

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

				$sub_array[]='<button type="button" name="" id="'.$row["id_usuario"].'" class="btn btn-primary btn-md" onclick="agregardetalle('.$row["id_usuario"].')"><i class="fa fa-plus"></i> Agregar </button>';
				$sub_array[]='<button type="button" name="" id="'.$row["id_usuario"].'" class="btn btn-warning btn-md" onclick="mostrar_usuario('.$row["id_usuario"].');"><i class="fa fa-edit"></i> Editar </button>';

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

		//PARA LA RESOLUCION 
		case "buscar_usuarios":
			//lamamos al metodo de usuarios por id
			$datos = $usuarios->usuario_id($_POST["id_usuario"]);

			if (is_array($datos)==true and count($datos)>0) {
				
				foreach ($datos as $row) {
					//para buscar se traen todos los datos incluyendo el id del usuario
					$output["id_usuario"] = $row["id_usuario"];
					$output["apellidos"] = $row["apellidos"];
					$output["nombres"] = $row["nombres"];
					$output["ndni"] = $row["ndni"];
					$output["carnet"] = $row["carnet"];
					$output["contacto"] = $row["contacto"];
				}
				
			}
			//arrojamos el output en json 		
			echo json_encode($output);	

		break;

		//PARA RESOLUCION
		case 'registrar_resolucion':
			//llamamos al modelos de resolucion
			require_once("../modelos/Resolucion.php");
			//Instanciamos la clase
			$resolucion = new Resolucion();
			//llamamos al metodo de la clase resolcuion
			$resolucion->agregar_detalle_resolucion();
			
		break;

	}	
}

else{

    header("Location:../error.php");
    exit();

  }
	
?>