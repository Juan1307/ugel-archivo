<?php 
	//importamos la conexion
	
	require_once("../config/conexion.php");

	/**
	 * CREAMOS LA CLASE MOTIVO
	 */
	class Motivo extends Conectar
	{
		//TODOS LOS MOTIVOS
		public function get_motivo()
		{
			$conectar=parent::conexion();
			parent::set_names();
				
				$sql="select * from tblmotivo";//hacemos la consulta

			$sql=$conectar->prepare($sql);//preparamos la consulta 
			
			$sql->execute();//ejecutamos la consulta
			
				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//me devuelve los datos de la consulta
		}
		//AGREGAR
		public function agregar_motivo($descripcion)
		{
			$conectar=parent::conexion();
			parent::set_names();
			
				$sql="insert into tblmotivo values(null,?)";
				
			$sql=$conectar->prepare($sql);
			
			$sql->bindValue(1,trim($_POST["descripcion"]));//enviamos la data 
			
				$sql->execute();//ejecutamos la consulta
			
		}
		//EDITAR 
		public function editar_motivo($id_motivo,$descripcion)
		{
			$conectar=parent::conexion();
			parent::set_names();
			
				$sql="update tblmotivo set descripcion=? where id_motivo=?";
				
			$sql=$conectar->prepare($sql);
			
			$sql->bindValue(1,trim($_POST["descripcion"]));
			$sql->bindValue(2,trim($_POST["id_motivo"]));
			
			$sql->execute();
			
		}
		//CONSULTAR MOTIVO
		public function get_motivo_id($id_motivo)
		{
			$conectar=parent::conexion();
			parent::set_names();
			
				$sql="select * from tblmotivo where id_motivo=?";
				
			$sql=$conectar->prepare($sql);
			
			$sql->bindValue(1,trim($id_motivo));
			
			$sql->execute();
			
				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//traemos el motivo por su descripcion
		public function get_motivo_descripcion($descripcion)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblmotivo where descripcion=?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($descripcion));

			$sql->execute();
			
				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//PARA EL SELECT MOTIVO
		public function select_motivo()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblmotivo where id_motivo";

			$sql=$conectar->prepare($sql);

			$sql->execute();

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//devolvemos todas las filas que deseamos obtener			
		}
	}
 ?>
	
 