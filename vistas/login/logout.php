<?php 
	//llamamos a la conexion
	require_once("../../config/conexion.php");
	//destruimos la sesion creada
	session_unset();
	session_destroy();

	//al cerrar sesion nos regrese al login
	header("Location:".Conectar::ruta()."index.php");
	exit();
 ?>