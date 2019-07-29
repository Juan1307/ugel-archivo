<?php 
	//llamamaos a la conexion
	require_once("../config/conexion.php");

	/**
	 * CLASE PARA CONTROL
	 */
	class Control extends Conectar
	{
		//CONTEO ENVIADOS
		public function get_control_reporte_general_enviados()
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql = "SELECT MONTHname(c.f_entrega) as mes, MONTH(c.f_entrega) as numero_mes , YEAR(c.f_entrega) as ano,COUNT(d.id_detcontrol) as total FROM tblcontrol c INNER JOIN tbl_detcontrol d ON c.id_control = d.id_control where d.estado='0' GROUP BY YEAR(c.f_entrega) desc , month(c.f_entrega) desc ";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//CONTEO RECIBIDOS
		public function get_control_reporte_general_recibidos()
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql = "SELECT MONTHname(f_recepcion) as mes, MONTH(f_recepcion) as numero_mes,YEAR(f_recepcion) as ano, COUNT(id_detcontrol) as total FROM tbl_detcontrol where estado='1' GROUP BY YEAR(f_recepcion) desc , month(f_recepcion) desc";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//CONTEO DE ENTREGADOS
		public function get_control_reporte_general_entregados()
		{
			$conectar=parent::conexion();
			parent::set_names();

			$sql = "SELECT MONTHname(f_entrega) as mes, MONTH(f_entrega) as numero_mes,YEAR(f_entrega) as ano, COUNT(id_control) as total FROM tblcontrol where estado='1' GROUP BY YEAR(f_entrega) desc , month(f_entrega) desc";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}



		//Para conteo registros
		public function get_filas_detcontrol_recibidos()
		{
			$conectar=parent::conexion();

			$sql = "select * from tbl_detcontrol where estado=1";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}
		//Para conteo registros
		public function get_filas_detcontrol_enviados()
		{
			$conectar=parent::conexion();

			$sql = "select * from tbl_detcontrol where estado=0";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}
		//Para conteo registros
		public function get_filas_control_por_entregar()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblcontrol where estado=0";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();
		}
		//Para conteo registros
		public function get_filas_control_entregados()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblcontrol where estado=1";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();

		}
		//Para conteo registros
		public function get_filas_control()
		{
			$conectar=parent::conexion();

			$sql = "select * from tblcontrol";

			$sql = $conectar->prepare($sql);

			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $sql->rowCount();

		}
		//Listamos los datos de control
		public function get_control()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select c.id_control, p.nombres as res_n, p.apellidos as res_a, a.nombre as id_area, c.nfolios, c.f_entrega, c.estado from tblcontrol c INNER JOIN tblarea a ON c.id_area = a.id_area INNER JOIN tblpersonal p ON c.id_personal = p.id_personal";

			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->FetchAll(PDO::FETCH_ASSOC);
		}
		//para mostrar control
		public function get_control_id($id_control)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tblcontrol where id_control=?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_control));

				$sql->execute();

			return $resultado=$sql->FetchAll(PDO::FETCH_ASSOC);

		}
		//para editar el control
		public function editar_control($id_control,$id_personal,$id_area,$nfolios,$f_entrega,$estado)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$date = $_POST["f_entrega"];//enviamos f_emision por form

				$date_inicial = str_replace('/', '-', $date); //reemplazamos los caracteres de separacion entre los caracteres de las fecha

				if (empty($_POST["f_entrega"])){
						
					$f_entrega = null;//le asignamos un valor nulo

					$estado = 0;

				} else {

					$f_entrega = date("Y-m-d",strtotime($date_inicial));//le aignamos la fecha que nos trae
					
					$estado = 1;
				}			

				$sql="update tblcontrol set 

					id_personal=?,
					id_area=?,
					nfolios=?,
					f_entrega=?,
					estado=?

				where id_control=?";

			$sql=$conectar->prepare($sql);
			
				$sql->bindValue(1,trim($_POST["id_personal"]));
				$sql->bindValue(2,trim($_POST["id_area"]));	
				$sql->bindValue(3,trim($_POST["nfolios"]));
				$sql->bindValue(4,$f_entrega);
				$sql->bindValue(5,$estado);
				$sql->bindValue(6,trim($_POST["id_control"]));

			$sql->execute();

		}

		public function eliminar_control($id_control)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="delete from tblcontrol where id_control=?";

			$sql=$conectar->prepare($sql);

				$sql->bindValue(1,trim($id_control));

			$sql->execute();

		}
		public function get_det_control()
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select r.nresolucion, r.f_emision, a.nombre as id_area, p.nombres as res_n, p.apellidos as res_a, c.nfolios, c.f_entrega,c.estado as estc,d.f_recepcion,d.estado from tbl_detcontrol d INNER JOIN tblcontrol c ON c.id_control = d.id_control INNER JOIN tblresolucion r ON r.id_resolucion=d.id_resolucion INNER JOIN tblarea a ON a.id_area=c.id_area INNER JOIN tblpersonal p ON p.id_personal = c.id_personal";
			
			$sql=$conectar->prepare($sql);

				$sql->execute();

			return $resultado=$sql->FetchAll(PDO::FETCH_ASSOC);

		}
		//cambiar estado detalle
		public function cambiar_estado_detalle($id_detcontrol,$estado)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				if ($_POST["estado"]=="0") {

					$sql="update tbl_detcontrol set
								 
								f_recepcion=now(),
								estado=1 

							where id_detcontrol = ?";
						
						//preparamos la consulta		
						$sql=$conectar->prepare($sql);

						$sql->bindValue(1,trim($id_detcontrol));
							
							$sql->execute();//ejecutamos la consulta


				} else {
						//realizamos la cosulta
						$sql = "update tbl_detcontrol set
								
								f_recepcion=null,
								estado=0
								
							where id_detcontrol=?";
						//preparamos la consulta		
						$sql=$conectar->prepare($sql);

						$sql->bindValue(1,trim($id_detcontrol));
							
							$sql->execute();//ejecutamos la consulta
				}

		}
		//detalle control id
		public function get_detalle_control_id($id_detcontrol)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="select * from tbl_detcontrol where id_detcontrol = ?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_detcontrol));

				$sql->execute();

			return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//para eliminar el detalle de una resolucion
		public function eliminar_detalle($id_detcontrol)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$sql="delete from tbl_detcontrol where id_detcontrol = ?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_detcontrol));

				$sql->execute();
		}
		//para editar detalle control
		public function editar_detalle_control($id_detcontrol,$f_recepcion,$estado_detalle)
		{
			$conectar=parent::conexion();
			parent::set_names();

			$date = $_POST["f_recepcion"];

				$date_inicial = str_replace('/', '-', $date); 

				if (empty($_POST["f_recepcion"])){

					$f_recepcion = null;

					$estado = 0;

				} else {

					$f_recepcion = date("Y-m-d",strtotime($date_inicial));//le aignamos la fecha que nos trae
					$estado = 1;
				}		


				$sql="update tbl_detcontrol set 

				f_recepcion=?,
				estado=?

				where id_detcontrol=?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,$f_recepcion);
			$sql->bindValue(2,trim($estado));
			$sql->bindValue(3,trim($_POST["id_detcontrol"]));

				$sql->execute();

		}
		//para agregar control
		public function agregar_detalle_control()
		{
			$str='';
			$detalle = array();
			$detalle = json_decode($_POST['arrayControl']);
			//hacemos la conexion
			$conectar=parent::conexion();

				$id_area = $_POST["id_area"];
				$id_personal = $_POST["id_personal"];
				$nfolios = $_POST["nfolios"];
				$f_entrega = $_POST["f_entrega"];

				$date=$_POST["f_entrega"];

					$date_inicial = str_replace('/', '-', $date);//para reemplazar los caracteres de la fecha

				if (empty($_POST["f_entrega"])) {

					$f_entrega = null;

					$estado = 0;//POR ENTREGAR

				} else {

					$f_entrega = date("Y-m-d",strtotime($date_inicial));//le aignamos la fecha que nos trae

					$estado = 1;//ENTREGADO
				}
				//consulta para agregar la resolucion
				$sql1="insert into tblcontrol values(null,?,?,?,?,?)";

				$sql1=$conectar->prepare($sql1);//preparamos la consulta

					//asignamos los valores a la consulta
					$sql1->bindValue(1,trim($id_personal));
					$sql1->bindValue(2,trim($id_area));
					$sql1->bindValue(3,trim($nfolios));
					$sql1->bindValue(4,$f_entrega);
					$sql1->bindValue(5,$estado);

				$sql1->execute();//ejecutamos la consulta	

			$id_control=$conectar->lastInsertId();//tremos el ultimo id de la consulta insertada	

			//recorremos para insertar el detalle del control	
			foreach ($detalle as $k=>$v) {

				//recorremos los datos de detalle que se encuentra en personal js
				$id_resolucion = $v->id_resolucion;
				$id_motivo = $v->id_motivo;
				$id_area = $v->id_area;
				$nresolucion = $v->nresolucion;
				$nproyecto = $v->nproyecto;
				$f_emision = $v->f_emision;

				//para insertar el detalle del control
				$sql="insert into tbl_detcontrol values(null,?,?,null,0)";
				//al ingresar el control esta se activa como dato now para que posteriormente se le asigne una fecha
				$sql=$conectar->prepare($sql);

					$sql->bindValue(1,trim($id_control));
					$sql->bindValue(2,trim($id_resolucion));
					//ejecutanos la consulta
				
				$sql->execute();

			}//cierre del foreach
		}//funcion para agregar detalle
		public function get_detalle_control($id_control)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				$sql="select c.id_control, a.nombre as id_area, p.nombres as res_n, p.apellidos as res_a, c.nfolios, c.f_entrega, c.estado from tblcontrol c INNER JOIN tblarea a ON c.id_area = a.id_area INNER JOIN tblpersonal p ON c.id_personal = p.id_personal where c.id_control=?";

			$sql=$conectar->prepare($sql);//preparamos la conexion

			$sql->bindValue(1,trim($id_control));

				$sql->execute();//ejecutamos la consulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
		}
		//
		public function get_detalle_resolucion($id_control)
		{
			$conectar=parent::conexion();//para la conexion
			parent::set_names();//para los caracteres

				$sql="select d.id_detcontrol, r.nresolucion, r.nproyecto, m.descripcion as id_motivo, a.nombre as id_area, r.f_emision, d.f_recepcion, d.estado from tbl_detcontrol d INNER JOIN tblcontrol c ON c.id_control = d.id_control INNER JOIN tblresolucion r ON r.id_resolucion = d.id_resolucion INNER JOIN tblmotivo m ON m.id_motivo = r.id_motivo INNER JOIN tblarea a ON a.id_area = r.id_area where d.id_control = ?";

			$sql=$conectar->prepare($sql);

			$sql->bindValue(1,trim($id_control));

				$sql->execute();//ejecutamos la consulta

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);//retornamos resultado

		}
		//para la consulta por fecha
		public function control_fecha($mes,$ano)
		{
			$conectar=parent::conexion();
			parent::set_names();

				$mes=$_POST["mes"];
				$ano=$_POST["ano"];

			$fecha=($ano."-".$mes."%");

				$sql="select c.id_control, p.nombres as res_n, p.apellidos as res_a, a.nombre as id_area, c.nfolios, c.f_entrega, c.estado from tblcontrol c INNER JOIN tblarea a ON c.id_area = a.id_area INNER JOIN tblpersonal p ON c.id_personal = p.id_personal where c.f_entrega like ?";

				$sql=$conectar->prepare($sql);

				$sql->bindValue(1,$fecha);

				$sql->execute();

				return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

		}	

	}


 ?>