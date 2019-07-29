<?php 
	//llamamos a la conexion
	require_once("../config/conexion.php");

	/**
	 * CREAMOS LA CLASE RESOLUCION
	 */
	class Resolucion extends Conectar
	{
		//CONTEO POR ENTREGAR
		public function get_resolucion_reporte_general_por_entregar()
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql = "SELECT MONTHname(r.f_emision) as mes, MONTH(r.f_emision) as numero_mes , YEAR(r.f_emision) as ano,COUNT(d.id_detresolucion) as total FROM tblresolucion r INNER JOIN tbl_detresolucion d ON r.id_resolucion = d.id_resolucion where d.estado='0' GROUP BY YEAR(r.f_emision) desc , month(r.f_emision) desc ";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//CONTEO ENTREGADOS
		public function get_resolucion_reporte_general_entregados()
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql = "SELECT MONTHname(f_entrega) as mes, MONTH(f_entrega) as numero_mes,YEAR(f_entrega) as ano, COUNT(id_detresolucion) as total FROM tbl_detresolucion where estado='1' GROUP BY YEAR(f_entrega) desc , month(f_entrega) desc";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//CONTEO DE ACTIVOS
		public function get_resolucion_reporte_general_activos()
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql = "SELECT MONTHname(f_emision) as mes, MONTH(f_emision) as numero_mes,YEAR(f_emision) as ano, COUNT(id_resolucion) as total FROM tblresolucion where estado='1' GROUP BY YEAR(f_emision) desc , month(f_emision) desc";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); 
		}
		//CONTEO DE INACTIVOS
		public function get_resolucion_reporte_general_inactivos()
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql = "SELECT MONTHname(f_emision) as mes, MONTH(f_emision) as numero_mes,YEAR(f_emision) as ano, COUNT(id_resolucion) as total FROM tblresolucion where estado='0' GROUP BY YEAR(f_emision) desc , month(f_emision) desc";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); 
		}


		//para conteo de registros
		public function get_filas_resolucion_inactivos()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblresolucion where estado=0";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}
		//para conteo de registros
		public function get_filas_resolucion_activos()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblresolucion where estado=1";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}
		//para el conteo de registros
		public function get_filas_resolucion()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblresolucion";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}
		public function get_filas_detresolucion_entregados()
		{
			$conectar=parent::conexion();

			$sql = "select * from tbl_detresolucion where estado=1";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}
		public function get_filas_detresolucion_por_entregar()
		{
			$conectar=parent::conexion();

			$sql = "select * from tbl_detresolucion where estado=0";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}




		//para traer todas la resoluciones
		public function get_resolucion()
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

			//CONSULTA DE PRUEBA ----> SELECT * FROM tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo

			$sql="select r.id_resolucion, m.descripcion as id_motivo,a.nombre as id_area, r.nresolucion, r.nproyecto,r.f_emision ,r.estado from tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo where r.est_tbl=0";//consulta para traer todas las resolucion

			$sql=$conectar->prepare($sql);//preparamos la conexion

				$sql->execute();//ejecutamos la consulta

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos todas las filas de tbl resolucion y la almacenamos en $resultado
		}
		public function get_resolucion_all()
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

			//CONSULTA DE PRUEBA ----> SELECT * FROM tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo

			$sql="select r.id_resolucion, m.descripcion as id_motivo,a.nombre as id_area, r.nresolucion, r.nproyecto,r.f_emision ,r.estado from tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo ";//consulta para traer todas las resolucion

			$sql=$conectar->prepare($sql);//preparamos la conexion

				$sql->execute();//ejecutamos la consulta

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos todas las filas de tbl resolucion y la almacenamos en $resultado
		}
				//para traer todas la resoluciones
		public function get_resolucion_institucion()
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

			//CONSULTA DE PRUEBA ----> SELECT * FROM tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo

			$sql="select r.id_resolucion, m.descripcion as id_motivo,a.nombre as id_area, r.nresolucion, r.nproyecto,r.f_emision ,r.estado from tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo where r.est_tbl=1";//consulta para traer todas las resolucion

			$sql=$conectar->prepare($sql);//preparamos la conexion

				$sql->execute();//ejecutamos la consulta

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos todas las filas de tbl resolucion y la almacenamos en $resultado
		}
		//para resolucion por id
		public function get_resolucion_id($id_resolucion)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				$sql="select * from tblresolucion where id_resolucion=?";//consulta para mostrar

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_resolucion));

				$sql->execute();//ejecutamos la consulta

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//recibimos los datos
		}
		//para resolucion por id
		public function resolucion_id($id_resolucion,$estado)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

			$estado = 1;

				$sql="select r.id_resolucion, m.descripcion as id_motivo,a.nombre as id_area, r.nresolucion, r.nproyecto,r.f_emision ,r.estado from tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo where r.id_resolucion=? and r.estado=?";//consulta para mostrar

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_resolucion));
			$sql->bindValue(2,trim($estado));

				$sql->execute();//ejecutamos la consulta

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//recibimos los datos
		}	
		//para editar la resolucion
		public function editar_resolucion($id_resolucion,$id_motivo,$id_area,$nresolucion,$nproyecto,$f_emision,$estado)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

			//PARA LAS FECHAS
			$date = $_POST["f_emision"];//enviamos f_emision por form

				$date_inicial = str_replace('/', '-', $date); //reemplazamos los caracteres de separacion entre los caracteres de las fecha

				if (empty($_POST["f_emision"])){
						
					$f_emision = null;//le asignamos un valor nulo

				} else {

					$f_emision = date("Y-m-d",strtotime($date_inicial));//le aignamos la fecha que nos trae
				}			
			
					$sql="update tblresolucion set 

					id_motivo=?,
					id_area=?,
					nresolucion=?,
					nproyecto=?,
					f_emision=?,
					estado=?

					where id_resolucion=?";//realizamos la consulta

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($_POST["id_motivo"]));//asiga¿namos los valores
			$sql->bindValue(2,trim($_POST["id_area"]));
			$sql->bindValue(3,trim($_POST["nresolucion"]));
			$sql->bindValue(4,trim($_POST["nproyecto"]));
			$sql->bindValue(5,$f_emision);
			$sql->bindValue(6,trim($_POST["est"]));
			$sql->bindValue(7,trim($_POST["id_resolucion"]));

			//print_r($_POST); el print_r es para ver los $post -- y claramente para ver lo que estamos enviando
			$sql->execute();//ejecutamos la consulta
		}
		//activar resolucion
		public function activar_resolucion($id_resolucion)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				$sql = "update tblresolucion set
						
							estado=1

						where id_resolucion=?";
						
			$sql=$conectar->prepare($sql);
			//asignamos los valores
			$sql->bindValue(1,trim($id_resolucion));

			//ejecutamos la consulta
				$sql->execute();
		}
		//desactivar resolucion
		public function desactivar_resolucion($id_resolucion)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				$sql = "update tblresolucion set
						
							estado=0

						where id_resolucion=?";
						
			$sql=$conectar->prepare($sql);
			//asignamos los valores
			$sql->bindValue(1,trim($id_resolucion));

			//ejecutamos la consulta
				$sql->execute();
		}
		public function get_det_resolucion()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select r.nresolucion, r.nproyecto, m.descripcion as motivo, a.nombre as area, r.f_emision, r.estado , u.nombres, u.apellidos, u.ndni, u.carnet, u.contacto, d.f_entrega, d.estado as estado_detalle from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblarea a ON r.id_area=a.id_area INNER JOIN tblmotivo m ON r.id_motivo=m.id_motivo INNER JOIN tblusuarios u ON u.id_usuario = d.id_usuario where r.est_tbl=0";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//recibimos los datos
		}
		public function get_det_resolucion_institucion()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select r.nresolucion, r.nproyecto, m.descripcion as motivo, a.nombre as area, r.f_emision, r.estado , i.nombre, i.nivel, d.f_entrega, d.estado as estado_detalle from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblarea a ON r.id_area=a.id_area INNER JOIN tblmotivo m ON r.id_motivo=m.id_motivo INNER JOIN tblinstitucion i ON i.id_institucion = d.id_institucion where r.est_tbl=1";
 
			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//recibimos los datos
		}
		//para eliminar el detalle
		public function eliminar_detalle($id_detresolucion)
		{

			$conectar=parent::conexion();
			parent::set_names();

				$sql="delete from tbl_detresolucion where id_detresolucion=?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,$id_detresolucion);//para el id del detalle de la rsolucion

				$sql->execute();

		}
		//para editar el detalle
		public function editar_detalle_resolucion($id_detresolucion,$f_entrega,$estado)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

					//PARA LAS FECHAS
			$date = $_POST["f_entrega"];//enviamos f_emision por form

				$date_inicial = str_replace('/', '-', $date); //reemplazamos los caracteres de separacion entre los caracteres de las fecha

				if (empty($_POST["f_entrega"])){

					$f_entrega = null;

					$estado = 0;

				} else {

					$f_entrega = date("Y-m-d",strtotime($date_inicial));//le aignamos la fecha que nos trae
					$estado = 1;
				}			
			
					$sql="update tbl_detresolucion set 

					f_entrega=?,
					estado=?

					where id_detresolucion=?";//realizamos la consulta

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,$f_entrega);
			$sql->bindValue(2,trim($estado));
			$sql->bindValue(3,trim($_POST["id_detresolucion"]));

			//print_r($_POST); el print_r es para ver los $post -- y claramente para ver lo que estamos enviando
			$sql->execute();//ejecutamos la consulta
			
		}
		//detalle de la resolucion por id
		public function get_detresolucion_id($id_detresolucion)
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql="select d.id_detresolucion, d.id_resolucion, d.id_usuario, u.nombres, u.apellidos, u.ndni, u.carnet ,u.contacto, d.f_entrega,d.estado from tbl_detresolucion d INNER JOIN tblusuarios u ON u.id_usuario = d.id_usuario where d.id_detresolucion=?";//realizamos la consulta
				//preparamos la consulta
			$sql=$conectar->prepare($sql);
			//asignamos los valores
			$sql->bindValue(1,trim($id_detresolucion));

					$sql->execute();//ejecutamos la cosnulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//devolvemos el resultado 
		}
		public function get_detresolucion_id_ie($id_detresolucion)
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql="select d.id_detresolucion, d.id_resolucion, d.id_institucion, i.nombre, i.nivel, d.f_entrega,d.estado from tbl_detresolucion d INNER JOIN tblinstitucion i ON i.id_institucion = d.id_institucion where d.id_detresolucion=?";//realizamos la consulta
				//preparamos la consulta
			$sql=$conectar->prepare($sql);
			//asignamos los valores
			$sql->bindValue(1,trim($id_detresolucion));

					$sql->execute();//ejecutamos la cosnulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//devolvemos el resultado 
		}
		//funcion para cambiar el estado del detalle de la resolucion
		public function cambiar_estado_detalle($id_detresolucion,$estado)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				if ($_POST["estado"]=="0") {

					$sql="update tbl_detresolucion set
								 
								f_entrega=now(),
								estado=1 

							where id_detresolucion=?";
						
						//preparamos la consulta		
						$sql=$conectar->prepare($sql);

						$sql->bindValue(1,trim($id_detresolucion));
							
							$sql->execute();//ejecutamos la consulta


				} else {
						//realizamos la cosulta
						$sql = "update tbl_detresolucion set
								
								f_entrega=null,
								estado=0
								
							where id_detresolucion=?";
						//preparamos la consulta		
						$sql=$conectar->prepare($sql);

						$sql->bindValue(1,trim($id_detresolucion));
							
							$sql->execute();//ejecutamos la consulta
				}

		}

		public function agregar_usuario_det_re($id_resolucion,$id_usuario)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="insert into tbl_detresolucion values(null,?,?,null,null,0)";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($_POST["id_resolucion"]));
			$sql->bindValue(2,trim($_POST["id_usuario"]));

				$sql->execute();

		}
		public function agregar_receptor_det_re($id_detresolucion,$id_usuario)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="update tbl_detresolucion set 

					id_usuario=?

					where id_detresolucion=?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($_POST["id_usuario"]));
			$sql->bindValue(2,trim($_POST["id_detresolucion"]));

				$sql->execute();
		}

		public function agregar_institucion_det_re($id_resolucion,$id_institucion)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="insert into tbl_detresolucion values(null,?,null,?,null,0)";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($_POST["id_resolucion"]));
			$sql->bindValue(2,trim($_POST["id_institucion"]));

				$sql->execute();

		}
		public function eliminar_resolucion($id_resolucion)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="delete from tblresolucion where id_resolucion=?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($_POST["id_resolucion"]));

				$sql->execute();

		}
		//para gregar el detalle de la resolucion
		public function agregar_detalle_resolucion()
		{
			$str='';
			$detalle = array();
			$detalle = json_decode($_POST['arrayResolucion']);
			//hacemos la conexion
			$conectar=parent::conexion();

			$nresolucion = $_POST["nresolucion"];
			$nproyecto = $_POST["nproyecto"];
			$id_motivo = $_POST["id_motivo"];
			$id_area = $_POST["id_area"];
			$f_emision = $_POST["f_emision"];

			//PARA LAS FECHAS
			$date = $_POST["f_emision"];//enviamos datepicker por form

					$date_inicial = str_replace('/', '-', $date); //reemplazamos los caracteres de separacion entre los caracteres de las fecha
					
					if (empty($_POST["f_emision"])) {
						
						$f_emision = null;//le asignamos un valor nulo
						
						$estado = 0; //INACTIVO

					} else {

						$f_emision = date("Y-m-d",strtotime($date_inicial));//le aignamos la fecha que nos trae
						
						$estado = 1; //ACTIVO
					}

				//consulta para agregar la resolucion
				$sql1="insert into tblresolucion values(null,?,?,?,?,?,?,0)";

				//INSERT INTO `tblresolucion` (`id_resolucion`, `id_motivo`, `id_area`, `nresolucion`, `nproyecto`, `f_emision`, `estado`) VALUES (NULL, '1', '1', '1234', '4321', '2019-05-16', '1');

				$sql1=$conectar->prepare($sql1);//preparamos la consulta

					//asignamos los valores a la consulta
					$sql1->bindValue(1,$id_motivo);
					$sql1->bindValue(2,$id_area);
					$sql1->bindValue(3,$nresolucion);
					$sql1->bindValue(4,$nproyecto);
					$sql1->bindValue(5,$f_emision);
					$sql1->bindValue(6,$estado);

				$sql1->execute();//ejecutamos la consulta	

			$id_resolucion=$conectar->lastInsertId();//tremos el ultimo id de la consulta insertada	

			//recorremos para insertar el detalle de la resoluciom	

			foreach ($detalle as $k=>$v) {

				//recorremos los datos de detalle que se encuentra en usuarios js
				$id_usuario = $v->id_usuario;
				$nombres = $v->nombres;
				$apellidos = $v->apellidos;
				$ndni = $v->ndni;
				$carnet = $v->carnet;
				$contacto = $v->contacto;

				//echo "id_usuario: ".$id_usuario." nombres: ".$nombres. " apellidos: ". $apellidos. " ndni: ".$ndni. " carnet: ".$carnet. " contacto: ".$contacto;
					//definimos las variables para la resolucion

				//para insertar el detalle de la resolucion
				$sql="insert into tbl_detresolucion values(null,?,?,null,null,0)";
				//al ingresar la resolucion esta se activa como dato null para que posteriormente se le asigne una fecha
				$sql=$conectar->prepare($sql);

				//echo $sql;

					$sql->bindValue(1,$id_resolucion);
					$sql->bindValue(2,$id_usuario);

					//var_dump($id_resolucion);
					//var_dump($id_usuario);
					//ejecutanos la consulta
				
				$sql->execute();

				/*$results = $sql->fetchAll(PDO::FETCH_ASSOC);
    			var_dump($results);*/

				//print_r($_POST);

			}//cierre del foreach

		}//funcion agregar_detalle_resolucion_institucion
		public function agregar_detalle_resolucion_institucion()
		{
			$str='';
			$detalle = array();
			$detalle = json_decode($_POST['arrayResolucion']);
			//hacemos la conexion
			$conectar=parent::conexion();

			$nresolucion = $_POST["nresolucion"];
			$nproyecto = $_POST["nproyecto"];
			$id_motivo = $_POST["id_motivo"];
			$id_area = $_POST["id_area"];
			$f_emision = $_POST["f_emision"];

			//PARA LAS FECHAS
			$date = $_POST["f_emision"];//enviamos datepicker por form

					$date_inicial = str_replace('/', '-', $date); //reemplazamos los caracteres de separacion entre los caracteres de las fecha
					
					if (empty($_POST["f_emision"])) {
						
						$f_emision = null;//le asignamos un valor nulo
						
						$estado = 0; //INACTIVO

					} else {

						$f_emision = date("Y-m-d",strtotime($date_inicial));//le aignamos la fecha que nos trae
						
						$estado = 1; //ACTIVO
					}

				//consulta para agregar la resolucion
				$sql1="insert into tblresolucion values(null,?,?,?,?,?,?,1)";

				//INSERT INTO `tblresolucion` (`id_resolucion`, `id_motivo`, `id_area`, `nresolucion`, `nproyecto`, `f_emision`, `estado`) VALUES (NULL, '1', '1', '1234', '4321', '2019-05-16', '1');

				$sql1=$conectar->prepare($sql1);//preparamos la consulta

					//asignamos los valores a la consulta
					$sql1->bindValue(1,$id_motivo);
					$sql1->bindValue(2,$id_area);
					$sql1->bindValue(3,$nresolucion);
					$sql1->bindValue(4,$nproyecto);
					$sql1->bindValue(5,$f_emision);
					$sql1->bindValue(6,$estado);

				$sql1->execute();//ejecutamos la consulta	

			$id_resolucion=$conectar->lastInsertId();//tremos el ultimo id de la consulta insertada	

			//recorremos para insertar el detalle de la resoluciom	

			foreach ($detalle as $k=>$v) {

				//recorremos los datos de detalle que se encuentra en usuarios js
				$id_institucion = $v->id_institucion;
				$nombre = $v->nombre;
				$nivel = $v->nivel;

				//para insertar el detalle de la resolucion
				$sql="insert into tbl_detresolucion values(null,?,null,?,null,0)";
				//al ingresar la resolucion esta se activa como dato null para que posteriormente se le asigne una fecha
				$sql=$conectar->prepare($sql);

				//echo $sql;

					$sql->bindValue(1,$id_resolucion);
					$sql->bindValue(2,$id_institucion);

					//var_dump($id_resolucion);
					//ejecutanos la consulta
				
				$sql->execute();

				/*$results = $sql->fetchAll(PDO::FETCH_ASSOC);
    			var_dump($results);*/

				//print_r($_POST);

			}//cierre del foreach

		}//funcion agregar_detalle_resolucion	
		//FUNCION PRA TRAER UNA SOLA FILA
		public function get_detalle_resolucion($id_resolucion)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				$sql="select r.id_resolucion, m.descripcion as id_motivo,a.nombre as id_area, r.nresolucion, r.nproyecto,r.f_emision ,r.estado from tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo where r.id_resolucion=?";//consulta para traer toda la resolucion segun el id_resolucion

			$sql=$conectar->prepare($sql);//preparamos la conexion

			$sql->bindValue(1,trim($id_resolucion));

				$sql->execute();//ejecutamos la consulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos la fila de tbl resolucion y la almacenamos en $resultado
		}
		public function verificar_resolucion($id_resolucion)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				$sql="select d.id_detresolucion, d.id_resolucion, d.id_usuario, d.id_institucion from tbl_detresolucion d INNER JOIN tblresolucion r where d.id_resolucion=?";//consulta para traer toda la resolucion segun el id_resolucion

			$sql=$conectar->prepare($sql);//preparamos la conexion

			$sql->bindValue(1,trim($id_resolucion));

				$sql->execute();//ejecutamos la consulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos la fila de tbl resolucion y la almacenamos en $resultado
		}
		//para listar los usuarios
		public function get_detalle_usuarios($id_resolucion)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

			//consulta de prueba - con todo los datos necesarios //select d.id_detresolucion, d.id_resolucion, d.id_usuario,r.id_resolucion,r.id_motivo,r.id_area, u.nombres, u.apellidos, u.ndni, u.carnet ,u.contacto from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblusuarios u ON u.id_usuario = d.id_usuario where d.id_resolucion=5

				$sql="select d.id_detresolucion, u.nombres, u.apellidos, u.ndni, u.carnet ,u.contacto,d.f_entrega,d.estado from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblusuarios u ON u.id_usuario = d.id_usuario where d.id_resolucion=?";//consulta para traer los usuarios de la resolucion

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_resolucion));

				$sql->execute();//ejecutamos la consulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos resultado

		}
		//para listar los instituciones
		public function get_detalle_institucion($id_resolucion)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

			//consulta de prueba - con todo los datos necesarios //select d.id_detresolucion, d.id_resolucion, d.id_usuario,r.id_resolucion,r.id_motivo,r.id_area, u.nombres, u.apellidos, u.ndni, u.carnet ,u.contacto from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblusuarios u ON u.id_usuario = d.id_usuario where d.id_resolucion=5

				$sql="select d.id_detresolucion, i.nombre, i.nivel, d.f_entrega, d.estado from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblinstitucion i ON i.id_institucion = d.id_institucion where d.id_resolucion=? ";//consulta para traer los usuarios de la resolucion

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_resolucion));

				$sql->execute();//ejecutamos la consulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos resultado

		}
		//para la consulta por fecha
		public function resolucion_fecha($mes,$ano)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$mes=$_POST["mes"];
				$ano=$_POST["ano"];

			$fecha=($ano."-".$mes."%");

				$sql="select r.id_resolucion, m.descripcion as id_motivo,a.nombre as id_area, r.nresolucion, r.nproyecto,r.f_emision ,r.estado from tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo where r.f_emision like ? and r.est_tbl = 0";

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,$fecha);

				$sql->execute();

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

		}
				//para la consulta por fecha
		public function resolucion_fecha_institucion($mes,$ano)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$mes=$_POST["mes"];
				$ano=$_POST["ano"];

			$fecha=($ano."-".$mes."%");

				$sql="select r.id_resolucion, m.descripcion as id_motivo,a.nombre as id_area, r.nresolucion, r.nproyecto,r.f_emision ,r.estado from tblresolucion r INNER JOIN tblarea a ON r.id_area = a.id_area INNER JOIN tblmotivo m ON r.id_motivo = m.id_motivo where r.f_emision like ? and r.est_tbl = 1";

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,$fecha);

				$sql->execute();

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

		}
		public function mostrar_receptor_detalle_entrega($id_detresolucion)
		{
			$conectar=parent::conexion();
			parent::set_names();
			//hacemos el verificado

			$sql= "select * from tbl_detresolucion where id_detresolucion=?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,$_POST["id_detresolucion"]);

				$sql->execute();
				
			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public function muestra_receptor($id_detresolucion)
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql= "select d.id_detresolucion, i.nombre, i.nivel, d.f_entrega, d.estado, u.nombres, u.apellidos,u.ndni, u.carnet, u.contacto from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblusuarios u  ON u.id_usuario=d.id_usuario INNER JOIN tblinstitucion i ON i.id_institucion = d.id_institucion where d.id_detresolucion = ?";

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,$_POST["id_detresolucion"]);

				$sql->execute();
				
				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public function no_muestra_receptor($id_detresolucion)
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql= "select d.id_detresolucion, i.nombre, i.nivel, d.f_entrega, d.estado from tbl_detresolucion d INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblinstitucion i ON i.id_institucion = d.id_institucion where d.id_detresolucion=?";
				
				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,$_POST["id_detresolucion"]);

				$sql->execute();
				
				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
			
	}
?>