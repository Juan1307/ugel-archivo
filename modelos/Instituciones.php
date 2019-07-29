<?php
	//Conexion a la base de datos
	require_once("../config/conexion.php"); 
	 /**
	  *Clase pero llama a la clase conectar en config conexion .php  
	  */
	 class Instituciones extends Conectar
	 {
	 	public function get_filas_institucion()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblinstitucion";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();

		}
	 	//Listar los institucion 
	 	public function get_institucion(){

	 		$conectar=parent::conexion(); //para la conexion
	 		parent::set_names(); //para los caracteres

		 		$sql="select * from tblinstitucion"; //Consulta para institucion

	 		$sql=$conectar->prepare($sql); //Prepara la conexion y le asignamos la consulta SQL 
	 		
	 			$sql->execute(); //Ejecuta la consulta

	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //recoge la consulta con todas sus filas en la variable $resultado de la consulta $sql
	 	}
	 	//Agregar institucion
	 	public function registrar_institucion($nombre,$nivel){

	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql="insert into tblinstitucion values(null,?,?)";//Consulta para agregar institucion y asigna los valores en values 
	 		$sql=$conectar->prepare($sql);//Prepara una sentencia SQL 

	 		$sql->bindValue(1,trim($_POST["nombre"]));//POST para datos por formulario y GET para datos por Url 
	 		$sql->bindValue(2,trim($_POST["nivel"]));

	 			$sql->execute(); //Ejecuta la consulta
	 	}
	 	//Editar institucion
	 	public function editar_institucion($id_institucion,$nombre,$nivel){
			
			$conectar=parent::conexion();
	 		parent::set_names();


		 		$sql="update tblinstitucion set 
		 		
		 		nombre=?,
		 		nivel=?

		 		where 
		 		id_institucion=?";//Consulta para editar institucion

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($_POST["nombre"]));//POST para datos por formulario y GET para datos por Url 
	 		$sql->bindValue(2,trim($_POST["nivel"]));
	 		$sql->bindValue(3,trim($_POST["id_institucion"]));

	 			$sql->execute();//Ejecuta la consulta

	 		//print_r($_POST); Verifica los datos de la consulta consulta
	 	}
	 	//get institucion por id
	 	public function get_institucion_id($id_institucion){
	 		
	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql="select * from tblinstitucion where id_institucion=?";//consulta para mostrar

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($id_institucion));//enviamos el id que queremos de la fila que queremos mostrar

	 			$sql->execute();

	 			//print_r($id_institucion);

	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//Devuelve los datos de la consulta
	 	}
	 	//get institucion por nombre
	 	public function get_institucion_nombre($nombre){
	 		
	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql="select * from tblinstitucion where nombre=?";//consulta datos por nombre

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($nombre));//enviamos el nombre

	 			$sql->execute();

	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//traemos el resultado del Institucion nombre
	 	}
	 	//get usuari
	 	//para institucion sobrantes o datos a excepcion del DNI
	 	public function editar_institucion_sobrante($id_institucion,$nivel){
	 		
	 		$conectar=parent::conexion();
	 		parent::set_names();

	 			$sql= "update tblinstitucion set 

	 			nivel=?

	 			where id_institucion=? ";//indicamos los campos a modificar

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($_POST["nivel"]));
	 		$sql->bindValue(2,trim($_POST["id_institucion"]));//enviamos el id para indicar que institucion se va a editar

	 			$sql->execute();//ejecutamos la consulta 

	 	}
	 	//PARA LA RESOLUCION --- METODO AGREGADO
	 	public function institucion_id($id_institucion)
	 	{
	 		$conectar=parent::conexion();
	 		//parent::set_names();

	 			$sql="select * from tblinstitucion where id_institucion=?";

	 		$sql=$conectar->prepare($sql);

	 		$sql->bindValue(1,trim($id_institucion));

	 			$sql->execute();

	 			//print_r($id_institucion);
	 			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
	 	}
	 	
	}//fin clase

	
?>