<?php 
	//llamamos a la conexion
	require_once("config/conexion.php");

	/**
	 * 
	 */
	class Login extends Conectar
	{
		
		public function login()
			{
				$conectar=parent::conexion();
				parent::set_names();

				if (isset($_POST["enviar"])) {//verificamos si existe el dato
					
					//declaramos las variables para acceder

					$usuario = $_POST["usuario"];

					$password_login = $_POST["password"];
					
					if (empty($usuario) or empty($password_login)) {
						//sie el usuario esta vacion muestra un mensaje 
						header("Location:".Conectar::ruta()."index.php?m=2");

						exit();

					} else {

						$sql = "select * from tbladmin where usuario = ?";

						$sql = $conectar->prepare($sql);

						$sql->bindValue(1,trim($usuario));

							$sql->execute();

						$resultado = $sql->fetch();

						if (!$resultado) {

							header("Location:".Conectar::ruta()."index.php?m=1");
							exit();
						}

						if (password_verify($password_login, $resultado["password"])) {
							
								$_SESSION["id_admin"] = $resultado["id_admin"];
								$_SESSION["usuario"] = $resultado["usuario"];
								$_SESSION["ndni"] = $resultado["ndni"];
								$_SESSION["password"] = $resultado["password"];

								header("Location:".Conectar::ruta()."vistas/home.php");
								exit();

						}else{
								//si no existe el registro aparecera un mensaje
								header("Location:".Conectar::ruta()."index.php?m=1");
								exit();
							}

						}
				}//fin del else
		}//fin funcion
	}
 ?>