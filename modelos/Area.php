<?php 
	//llamamos a la conexion de config

	require_once("../config/conexion.php");

	//CREAMOS LA CLASE AREA

	class Area extends Conectar
	{
		//PARA TODAS LAS AREAS
		public function get_area()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblarea";

			$sql=$conectar->prepare($sql);

			$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//PARA AGREGAR
		public function agregar_area($nombre)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="insert into tblarea values(null,?)";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($_POST["nombre"]));

				$sql->execute();
		}
		//PARA EDITAR 
		public function editar_area($id_area,$nombre)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="update tblarea set nombre=? where id_area=?";
			
			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($_POST["nombre"]));
			$sql->bindValue(2,trim($_POST["id_area"]));

			$sql->execute();

		}
		//PARA MOSTRAR
		public function get_area_id($id_area)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblarea where id_area=?";

			$sql=$conectar->prepare($sql);
			$sql->bindValue(1,trim($id_area));
			$sql->execute();

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//PARA CONSULTAR AREA
		public function get_area_nombre($nombre)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblarea where nombre=?";

			$sql=$conectar->prepare($sql);
			$sql->bindValue(1,trim($nombre));
			$sql->execute();

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
	}

 ?>