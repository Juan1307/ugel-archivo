<?php 
	
	require_once("../config/conexion.php");

	/**
	 * CLASE PARA CONSULTAS
	 */
	class Personal extends Conectar
	{
		//para listar personal
		public function get_personal()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblpersonal";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
			
		}
		//agregar personal
		public function agregar_personal($nombres,$apellidos)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="insert into tblpersonal values(null,?,?)";

			$sql=$conectar->prepare($sql);

				$sql->bindValue(1,trim($_POST["nombres"]));
				$sql->bindValue(2,trim($_POST["apellidos"]));

				$sql->execute();

		}
		//para edtar personal
		public function editar_personal($id_personal,$nombres,$apellidos)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="update tblpersonal set 

						nombres=?,
						apellidos=?	

					where id_personal=?";

			$sql=$conectar->prepare($sql);

				$sql->bindValue(1,trim($_POST["nombres"]));
				$sql->bindValue(2,trim($_POST["apellidos"]));
				$sql->bindValue(3,trim($_POST["id_personal"]));

				$sql->execute();
		}
		//para mostrar el personal
		public function get_personal_id($id_personal)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblpersonal where id_personal=?";

			$sql=$conectar->prepare($sql);	

				$sql->bindValue(1,trim($id_personal));

				$sql->execute();

			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//select personal
		public function select_personal()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblpersonal where id_personal";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
	}

 ?>