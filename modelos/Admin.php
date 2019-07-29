<?php 
	//lamamos a la conexion de config
	require_once("../config/conexion.php");
	/**
	CREAMOS LA CLASE ADMIN
		 
		 */
		class Admin extends Conectar
		{
			//PARA REGISTRAR Y LISTAR

			public function agregar_admin($usuario,$ndni,$hash)
			{
				$conectar=parent::conexion();
				parent::set_names();

					$sql="insert into tbladmin values(null,?,?,?)";
				
				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,trim($_POST["usuario"]));
				$sql->bindValue(2,trim($_POST["ndni"]));
				$sql->bindValue(3,$hash);
				
					$sql->execute();
			}	
			public function get_admin()
			{
				$conectar=parent::conexion();
				parent::set_names();

					$sql="select * from tbladmin";

				$sql=$conectar->prepare($sql);

					$sql->execute();

					return $resultado=$sql->fetchAll();
			}
			public function filter_ndni($ndni)
			{
				$conectar=parent::conexion();
				parent::set_names();

					$sql="select * from tbladmin where ndni=? ";

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,trim($_POST["ndni"]));

					$sql->execute();

					return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
					
			}
			public function filter_user($usuario)
			{
				$conectar=parent::conexion();
				parent::set_names();

					$sql="select * from tbladmin where usuario=? ";

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,trim($_POST["usuario"]));

					$sql->execute();

					return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
					
			}

			//PARA EDITAR PERFIL

			public function get_admin_id_perfil($id_admin_perfil)
			{
				$conectar=parent::conexion();
				parent::set_names();
				
					$sql="select * from tbladmin where id_admin=?";
					
				$sql=$conectar->prepare($sql);
				
				$sql->bindValue(1,trim($id_admin_perfil));
				
					$sql->execute();
					
					return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
			}
			public function editar_admin_perfil($id_admin_perfil,$hash)
			{
				$conectar=parent::conexion();
				parent::set_names();
				
					$sql="update tbladmin set
					
					password=?

					where id_admin=?";//el dni no deberia editarses

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,$hash);
				$sql->bindValue(2,trim($_POST["id_admin_perfil"]));

					$sql->execute();
			}
			public function editar_admin($id_admin,$usuario,$hash)
			{
				$conectar=parent::conexion();
				parent::set_names();
				
					$sql="update tbladmin set
					
					usuario=?,
					password=?

					where id_admin=?";//el dni no deberia editarses

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,trim($_POST["usuario"]));
				$sql->bindValue(2,$hash);
				$sql->bindValue(3,trim($_POST["id_admin"]));

					$sql->execute();
			}
			
		}
		
	 ?>