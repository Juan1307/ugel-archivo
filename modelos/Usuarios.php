<?php
	//Conexion a la base de datos
	require_once("../config/conexion.php"); 
	 /**
	  *Clase pero llama a la clase conectar en config conexion .php  
	  */
	 class Usuarios extends Conectar
	 {
	 	public function get_filas_usuarios()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblusuarios";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();

		}
	 	//Listar los usuarios 
	 	public function get_usuarios(){

	 		$conectar=parent::conexion(); //para la conexion
	 		parent::set_names(); //para los caracteres

		 		$sql="select * from tblusuarios"; //Consulta para usuarios

	 		$sql=$conectar->prepare($sql); //Prepara la conexion y le asignamos la consulta SQL 
	 		
	 			$sql->execute(); //Ejecuta la consulta

	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //recoge la consulta con todas sus filas en la variable $resultado de la consulta $sql
	 	}
	 	//Agregar usuarios
	 	public function registrar_usuario($nombres,$apellidos,$ndni,$carnet,$contacto){

	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql="insert into tblusuarios values(null,?,?,?,?,?)";//Consulta para agregar usuarios y asigna los valores en values 
	 		$sql=$conectar->prepare($sql);//Prepara una sentencia SQL 

	 		$sql->bindValue(1,trim($_POST["nombres"]));//POST para datos por formulario y GET para datos por Url 
	 		$sql->bindValue(2,trim($_POST["apellidos"]));
	 		$sql->bindValue(3,trim($_POST["ndni"]));	 		
	 		$sql->bindValue(4,trim($_POST["carnet"]));
	 		$sql->bindValue(5,trim($_POST["contacto"]));

	 			$sql->execute(); //Ejecuta la consulta
	 	}
	 	//Editar usuario
	 	public function editar_usuario($id_usuario,$nombres,$apellidos,$ndni,$carnet,$contacto){
			
			$conectar=parent::conexion();
	 		parent::set_names();


		 		$sql="update tblusuarios set 
		 		
		 		nombres=?,
		 		apellidos=?,
		 		ndni=?,		
		 		carnet=?,
		 		contacto=?

		 		where 
		 		id_usuario=?";//Consulta para editar usuarios

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($_POST["nombres"]));//POST para datos por formulario y GET para datos por Url 
	 		$sql->bindValue(2,trim($_POST["apellidos"]));
	 		$sql->bindValue(3,trim($_POST["ndni"]));
	 		$sql->bindValue(4,trim($_POST["carnet"]));//bindValue asigna el valor que tenga en el momento
	 		$sql->bindValue(5,trim($_POST["contacto"]));
	 		$sql->bindValue(6,trim($_POST["id_usuario"]));

	 			$sql->execute();//Ejecuta la consulta

	 		//print_r($_POST); Verifica los datos de la consulta consulta
	 	}
	 	//get usuarios por id
	 	public function get_usuarios_id($id_usuario){
	 		
	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql="select * from tblusuarios where id_usuario=?";//consulta para mostrar

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($id_usuario));//enviamos el id que queremos de la fila que queremos mostrar

	 			$sql->execute();

	 			//print_r($id_usuario);

	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//Devuelve los datos de la consulta
	 	}
	 	//get usuarios por dni
	 	public function get_usuarios_dni($ndni){
	 		
	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql="select * from tblusuarios where ndni=?";//consulta datos por dni

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($ndni));//enviamos el dni

	 			$sql->execute();

	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//traemos el resultado del usuario carnet
	 	}
	 	//get usuarios por carnet
	 	public function get_usuarios_carnet($carnet){

	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql="select * from tblusuarios where carnet=?";//consulta datos por dni

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($carnet));//enviamos el carnet

	 			$sql->execute();

	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//traemos el resultado del usuario carnet
	 	}
	 	//para usuarios sobrantes o datos a excepcion del DNI
	 	public function editar_usuario_sobrante($id_usuario,$nombres,$apellidos,$contacto){
	 		
	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql= "update tblusuarios set 
	 			
	 			nombres=?,
	 			apellidos=?,
	 			contacto=?

	 			where id_usuario=? ";//indicamos los campos a modificar

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($_POST["nombres"]));//asignamos los valores para los capos a editar
	 		$sql->bindValue(2,trim($_POST["apellidos"]));
	 		$sql->bindValue(3,trim($_POST["contacto"]));
	 		$sql->bindValue(4,trim($_POST["id_usuario"]));//enviamos el id para indicar que usuario se va a editar

	 			$sql->execute();//ejecutamos la consulta 

	 	}
	 	//PARA USUARIOS INCOMPLETOS
	 	public function get_usuarios_in_dni_carnet()
	 	{
	 		$conectar=parent::conexion();
	 		parent::set_names();

	 		$vacio="";//asignamos una variable para luego reemplazarlo en la consulta

	 			$sql ="select * from tblusuarios where ndni='$vacio' and carnet='$vacio' ";//realizamos la consulta

	 		$sql=$conectar->prepare($sql);

	 			$sql->execute();//ejecutamos la consulta
	 			
			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//retornamos el resultado de la consulta

	 	}
	 	//PARA LA RESOLUCION --- METODO AGREGADO
	 	public function usuario_id($id_usuario)
	 	{
	 		$conectar=parent::conexion();
	 		//parent::set_names();

	 			$sql="select * from tblusuarios where id_usuario=?";

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($id_usuario));

	 			$sql->execute();

	 			//print_r($id_usuario);
	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
	 	}
	 	
	}//fin clase

	
?>