<?php
require_once("../config/conexion.php");

 	if (isset($_SESSION["ndni"])) {
	//Llamamos a la base de datos

	require_once("../config/conexion.php");

	//Llamamos al modulo INSTITUCION - MODELOS

	require_once("../modelos/Instituciones.php");
	
		$institucion = new Instituciones();

	//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
 
	$id_institucion = isset($_POST["id_institucion"]);
	$nombre = isset($_POST["nombre"]);
	$nivel = isset($_POST["nivel"]);
	//Es lo que se envia al formulario

	//parametro que evalua los parametros que se envian por ajax
	switch ($_GET["op"]){
	
		case "guardaryeditar":
			//verifica si ya existen los datos

			$datos = $institucion->get_institucion_nombre($_POST["nombre"]); //Para NOMBRE
			
			if (empty($_POST["id_institucion"])) //empty es vacio
				//si no existe el institucion lo registra pero si existe lo edita
			{
				if (is_array($datos)==true and count($datos)==0) {
					
					$institucion->registrar_institucion($nombre,$nivel);

					$messages[]="La Institución se registro correctamente";				
						
				}else{

					$errors[]="La Institución ingresada ya existe";

				}			

			}else {

				$datos1 = $institucion->get_institucion_id($_POST["id_institucion"]);

						foreach ($datos1 as $row) {
							//sacamos el nombre
							$row["nombre"];
						}
						//lo comparamos con el valor de la base de datos
					if ($row["nombre"] == $_POST["nombre"]) {

						$messages[]="La Institución se ha actualizado correctamente";
						
						$institucion->editar_institucion_sobrante($id_institucion,$nivel);

					}elseif (is_array($datos)==true and count($datos)>0) {

						$errors[]="La Institución ingresada ya existe";
					
					}else{

						$institucion->editar_institucion($id_institucion,$nombre,$nivel);
							//Edita los institucion correctamente
						$messages[]="La Institución se ha actualizado correctamente";
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
		//verificamos si existen los datos en la base de datos id_institucion
			$datos = $institucion->get_institucion_id($_POST["id_institucion"]);
			//Verificamos si el institucion a consultar existe 
			if (is_array($datos)==true and count($datos)>0) {
				//verifica si el id es mayor a cero para ejecutar funcion
				foreach ($datos as $row) {

					$output["nombre"]=$row["nombre"];
					$output["nivel"]=$row["nivel"];

					echo json_encode($output);
				}
			} else {

				$errors[]="El Institución no existe";
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

			$datos=$institucion->get_institucion();//traemos los datos del metodo get_institucion

			$data = Array();//arreglo para las filas que va a almacenar

			foreach ($datos as $row){

				$sub_array= array();//recogemos los datos de la variable $row

				//asignado valores a las filas 
				$sub_array[]=$row["nombre"];
				$sub_array[]=$row["nivel"];

					$sub_array[]='<button type="button" onclick="mostrar_institucion('.$row["id_institucion"].');" id="'.$row["id_institucion"].'" class="btn btn-warning btn-md update"><i class="far fa-edit"></i> Editar </button>';

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
		case "listar_resolucion_institucion":

			$datos=$institucion->get_institucion();

			$data = Array();//arreglo para las filas que va a almacenar
			foreach ($datos as $row){

				$sub_array = array();//recogemos los datos de la variable $row

				//asignado valores a las filas 
				$sub_array[]=$row["nombre"];
				$sub_array[]=$row["nivel"];

				$sub_array[]='<button type="button" name="" id="'.$row["id_institucion"].'" class="btn btn-primary btn-md" onclick="agregardetalle('.$row["id_institucion"].')"><i class="fa fa-plus"></i> Agregar </button>';
				$sub_array[]='<button type="button" name="" id="'.$row["id_institucion"].'" class="btn btn-warning btn-md" onclick="mostrar_institucion('.$row["id_institucion"].');"><i class="fa fa-edit"></i> Editar </button>';

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
		case "buscar_institucion":
			//lamamos al metodo de institucion por id
			$datos = $institucion->institucion_id($_POST["id_institucion"]);

			if (is_array($datos)==true and count($datos)>0) {
				
				foreach ($datos as $row) {
					//para buscar se traen todos los datos incluyendo el id del institucion
					$output["id_institucion"] = $row["id_institucion"];
					$output["nombre"] = $row["nombre"];
					$output["nivel"] = $row["nivel"];
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
			$resolucion->agregar_detalle_resolucion_institucion();
			
		break;

	}	
}

else{

    header("Location:../error.php");
    exit();

  }
	
?>