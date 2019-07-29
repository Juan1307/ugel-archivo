
var tabla;

var tabla_control_resolucion;

	function init() {

		listar();
		
		listar_control_resolucion();
				//cuando se da click en submit se ejecuta la funcion e
		$("#personal_form").on("submit",function(e)
		{
			guardaryeditar(e);
		});

		$("#control_form_in").on("submit",function(e)
		{
			registrarcontrol(e);
		});
				//PARA CAMBIAR EL TITULO EN USUARIOS
		$("#add_button_personal").click(function(){

			$(".modal-title").text("Agregar Responsable");
		});
	}
	//funcion para limpiar
	function limpiar() {

		$("#nombres").val("");
		$("#apellidos").val("");
		$("#id_personal").val("");				
	}

	function listar_control_resolucion() {

		tabla_control_resolucion=$('#control_resolucion_data').dataTable(
		{
			"aProcessing":true,//Activamos procesamiento de datatable
			"aServerSide":true,//Paginacion y filtrado realizados por el servidor
			dom:'Bfrtip',//Definimos los elementos del control de table
			buttons:[
				'copyHtml5',
				'excelHtml5',
				'pdf'
			],
			"ajax":
			{
				url:'../ajax/personal.php?op=listar_control_resolucion',
				type:"get",
				dataType:"json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy":true,
			"responsive":true,
			"bInfo":true,//informacion del los datatable
			"iDisplayLength":20,//Pora cada 10 registros hace una paginacion
			"order":[[0,"desc"]],//Ordenar (Columna,orden)
 			
 			"language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			
			    }

			   }//cerrando language
		}).DataTable();
	}
	//funcion para listar personal
	function listar() {

		tabla=$('#personal_data').dataTable({
			"aProcessing":true,//Activamos procesamiento de datatable
			"aServerSide":true,//Paginacion y filtrado realizados por el servidor
			dom:'Bfrtip',//Definimos los elementos del control de table
			buttons:[
				'copyHtml5',
				'excelHtml5',
				'pdf'//para los botones en el datatable
			],
			"ajax":
			{
				url:'../ajax/personal.php?op=listar',//enviamos el parametro 
				type:"get",//el tipo del parametro
				dataType:"json",//formato de la data

				error: function (e) {
					console.log(e.responseText);//para hacer la verificacion de errores
				}
			},
			"bDestroy":true,
			"responsive":true,
			"bInfo":true,//informacion del los datatable
			"iDisplayLength":20,//Pora cada 10 registros hace una paginacion
			"order":[[0,"desc"]],//Ordenar (Columna,orden)
 			
 			"language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			
			    }

			   }//cerrando language
		}).DataTable();
	}
	//funcion para mostrar
	function mostrar(id_personal) {
		
		$.post("../ajax/personal.php?op=mostrar",{id_personal : id_personal},function(data,status)
			{
				data=JSON.parse(data);
				
				$("#personalModal").modal("show");
				$("#nombres").val(data.nombres);
				$("#apellidos").val(data.apellidos);			
				$(".modal-title").text("Editar Responsable");
				$("#id_personal").val(id_personal);
				$("#action").val("Edit");
		});		
	}
	//funcion para guardar y editar
	function guardaryeditar(e) {
		
		e.preventDefault();

		var formData = new FormData($("#personal_form")[0]);

			$.ajax({

				url:"../ajax/personal.php?op=guardaryeditar",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {
					console.log(datos);//consulta los datos y lo arroja en json

					$('#personal_form')[0].reset();
					$('#personalModal').modal('hide');//al agregar ocultamos el modal

					$('#resultados_ajax_personal').html(datos);
					$('#personal_data').DataTable().ajax.reload();//para el datatable de personal

					limpiar();

				}

			});//cierre 
	}

	var detalle=[];//detalle es una array vacio que almacenara datos mas adelante
	
	function agregardetalle_control(id_resolucion,estado) {

		$.ajax({

			url:"../ajax/personal.php?op=buscar_resolucion",//llamamos el case de ajax
			method:"POST",

			data:{id_resolucion:id_resolucion, estado:estado},//la data que estamos usando
			cache: false,
			dataType:"json",//formato de los datos

			success:function(data){

				if (data.id_resolucion){ 
					//si existe el id_usuario
					if(typeof data == "string"){//lo igualamos a string la data

						data = $.parseJSON(data);//devuelve datata 

					}

					console.log(data);
					//definimos un objeto para las columnas var obj={} 
					var obj = {

						id_resolucion  : id_resolucion, 
						nresolucion    : data.nresolucion,
						nproyecto  	   : data.nproyecto,
						id_motivo 	   : data.id_motivo,
						id_area	       : data.id_area,
						f_emision      : data.f_emision,
						estado         : data.estado,
					};
					//usamos el array detalle para obtener los datos de obj 
					detalle.push(obj);//puskh nos sirve para agregar elementos a un arreglo
				
					listardetalle_control();

					$('#listar_resolucion_modal').modal("hide");//al agregar ocultamos el modal

				} else {

					//bootbox.alert(data.error);//arroja el error en data		

					alertify.alert("<p class='text-danger'>¡Resolución INACTIVA!</p>",data.error, function(){ 
						alertify.error('Error'); 
					});
			

				}
				
			}//fin success

		});//cierre del ajax
	}
	
	function listardetalle_control() {
		
		$('#listar_resolucion').html('');//empieza vacio hasta que se agregen datos

		var filas = ""; //variable filas que luego sera usada para agregar datos 
	
		for (var i = 0; i < detalle.length; i++) {

			if(detalle[i].estado == 1){
			//mostramos los datos en la variable var filas
				var filas = filas + "<tr> <td>"+(i+1)+"</td> <td name='nresolucion[]'>"+detalle[i].nresolucion+"</td>  <td name='nproyecto[]'>"+detalle[i].nproyecto+"</td>  <td name='id_motivo[]'>"+detalle[i].id_motivo+"</td>   <td name='id_area[]'>"+detalle[i].id_area+"</td>   <td name='f_emision[]'>"+detalle[i].f_emision+"</td> </tr>";
			}
		}
		//al tener datos en filas este ya recibe los datos en el html
		$('#listar_resolucion').html(filas);
	}//fin de la funcion 

	function limpiar_control_in() {
		
		$("#id_area").val("");
		$("#nfolios").val("");
		$("#id_personal").val("");

		//el detalle tambien se limpia 
		detalle=[];
					
		$('#listar_resolucion').html('');

		explode();
	}
	
	function registrarcontrol(e) {

		e.preventDefault();
		//recogemos los datos del formulario de la resolucion y del detalle[]s
		var id_area = $("#id_area").val();
		var id_personal = $("#id_personal").val();
		var nfolios = $("#nfolios").val();
		var f_entrega = $("#f_entrega").val();

		//verificamos que los campos no tengan vacios incluyendo el detalle
		if (id_area!="" && nfolios!="" && id_personal!="" && f_entrega!="" && detalle!="") {
			//prueba para la validacion del if
			//console.log(id_resolucion);
			console.log('Go register control');
			//hacemos el llamado a ajax para el envio de los datos
			$.ajax({

				url:"../ajax/control.php?op=registrar_control",
				method:"POST",
				data:{'arrayControl':JSON.stringify(detalle),'id_area':id_area, 'id_personal':id_personal, 'nfolios':nfolios, 'f_entrega':f_entrega},
				cache:false,
				dataType:"html",
				//para los errores - prueba - definimos los argumentos
				error:function(x,y,z) {
					//realimos el output de los argumentos
					console.log(x);
					console.log(y);
					console.log(z);
				},
				//para el arrojo de la data
				success:function (data) {

						var id_area = $("#id_area").val("");
						var id_personal = $("#id_personal").val("");
						var nfolios = $("#nfolios").val("");
						var f_entrega = $("#f_entrega").val("");

					//el detalle tambien se limpia 
					detalle=[];
					
					$('#listar_resolucion').html('');
					//para refrescar la pagina y agregar una nueva info

					alertify.alert("<p class='text-success'>¡Conforme!</p>","Nueva entrega registrada", 
						
						function(){ 
							alertify.success('Conforme'); 
						});

					setTimeout("explode()",2000);//llamamos a la funcion explode para recargar la pagina

				}

			});//fin del ajax

		} else {

			alertify.alert("<p class='text-danger'>¡Error! - Al agregar entrega</p>","Porfavor ingrese como mínimo una resolución", 
				function(){ 
					alertify.error('Error'); 
				});

	 	 	return false;

		}//fin del else	
	}//fin de la funcion registrar
	//Funcion explode
	function explode() {
		
		location.reload();
	}
init();