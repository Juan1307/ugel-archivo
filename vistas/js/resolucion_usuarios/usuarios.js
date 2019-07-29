
var tabla;

var tabla_resolucion_usuarios;

	function init() {
		//inicializa las funciones
		listar();
		
		listar_resolucion_usuarios();
		//PARA USUARIOS
		$("#usuarios_form").on("submit",function(e)
		{
			guardaryeditar(e);
		});
		//PARA RESOLUCION
		$("#resolucion_form_in").on("submit",function(e)
		{
			registraresolucion(e);
		});
		//PARA CAMBIAR EL TITULO EN USUARIOS
		$("#add_button_usuarios").click(function(){

			$(".modal-title").text("Agregar Usuario");
		});
	}
	//LIMPIAR USUARIOS
	function limpiar_usuario() {

		$("#nombres").val("");
		$("#apellidos").val("");
		$("#ndni").val("");
		$("#carnet").val("");
		$("#contacto").val("");
		$("#id_usuario").val("");
	}
	//PARA RESOLUCION
	function listar_resolucion_usuarios() {

		tabla_resolucion_usuarios=$('#resolucion_usuarios_data').dataTable(
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
				url:'../ajax/usuarios.php?op=listar_resolucion_usuarios',
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
	//PARA USUARIOS
	function listar() {
		
		tabla=$('#usuarios_data').dataTable({
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
				url:'../ajax/usuarios.php?op=listar',
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
	// AL PRESIONAR OCULTAMOS LOS MENSAJES - RESOLUCION
	$(document).on('click','.listar_usuario',function () {
		
		$("#messages").hide();
		$("#errors").hide();
		$("#warnings").hide();

	});
	//PARA USUARIOS
	function mostrar_usuario(id_usuario) {

		$.post("../ajax/usuarios.php?op=mostrar",{id_usuario : id_usuario}, function(data, status)
			{
				data=JSON.parse(data);

				$("#messages").hide();
				$("#errors").hide();
				$("#warnings").hide();
				
				$("#usuariosModal").modal("show");
				$("#nombres").val(data.nombres);
				$("#apellidos").val(data.apellidos);
				$("#ndni").val(data.ndni);
				$("#carnet").val(data.carnet);	
				$("#contacto").val(data.contacto);			
				$(".modal-title").text("Editar Usuario");
				$("#id_usuario").val(id_usuario);
				$("#action").val("Edit");

			});
		}

	//PARA USUARIOS Y RESOLUCION
	function guardaryeditar(e){

		e.preventDefault();
		var formData = new FormData($("#usuarios_form")[0]);

			$.ajax({

				url:"../ajax/usuarios.php?op=guardaryeditar",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {
					console.log(datos);//consulta los datos y lo arroja en json

					$('#usuarios_form')[0].reset();
					$('#usuariosModal').modal('hide');

					$('#resultados_ajax_usuarios').html(datos);

					$("#messages").show();
					$("#errors").show();
					$("#warnings").show();
				
					$('#resolucion_usuarios_data').DataTable().ajax.reload();
					$('#usuarios_data').DataTable().ajax.reload();


					limpiar_usuario();

				}

			});//cierre 

		}

	//PARA RESOLUCION Y DET RESOLUCION
	var detalle=[];//detalle es una array vacio que almacenara datos mas adelante
	
	//PARA AGREGAR USUARIOS - SCRIPT EN RESOLUCION
	function agregardetalle(id_usuario) {

		$.ajax({

			url:"../ajax/usuarios.php?op=buscar_usuarios",//llamamos el case de ajax
			method:"POST",

			data:{id_usuario:id_usuario},//la data que estamos usando
			cache: false,
			dataType:"json",//formato de los datos

			success:function(data){

				if (data.id_usuario){ 
					//si existe el id_usuario
					if(typeof data == "string"){//lo igualamos a string la data

						data = $.parseJSON(data);//devuelve datata 

					}

					console.log(data);
					//definimos un objeto para las columnas var obj={} 
					var obj = {

						id_usuario : id_usuario, 
						nombres    : data.nombres,
						apellidos  : data.apellidos,
						ndni 	   : data.ndni,
						carnet	   : data.carnet,
						contacto   : data.contacto,
						estado     : 1,
						//agregamos a estado para poder eliminar un usuario en detalle
						
					};
						//usamos el array detalle para obtener los datos de obj 
					detalle.push(obj);//puskh nos sirve para agregar elementos a un arreglo
						//listamos los detalles del usuario
					listardetalle();
					$('#listar_usuarios_modal').modal("hide");//al agregar ocultamos el modal

				} else {

					bootbox.alert(data.error);//arroja el error en data					

				}
				
			}//fin success

		});//cierre del ajax
	}//fin de la funcion agregar_detalle_usuarios
	
	//LISTA LOS USUARIOS - RESOLUCION
	function listardetalle() {
		
		$('#listar_usuarios_resolucion').html('');//empieza vacio hasta que se agregen datos

		var filas = ""; //variable filas que luego sera usada para agregar datos 
	
		for (var i = 0; i < detalle.length; i++) {

		//si el estado es igual a 1 - en este caso no tenemos estado en usuarios... entonces hemos creado un dato mas para objeto
			if(detalle[i].estado == 1){
			//mostramos los datos en la variable var filas
				var filas = filas + "<tr> <td>"+(i+1)+"</td> <td name='nombres[]'>"+detalle[i].nombres+"</td>  <td name='apellidos[]'>"+detalle[i].apellidos+"</td>  <td name='ndni[]'>"+detalle[i].ndni+"</td>   <td name='carnet[]'>"+detalle[i].carnet+"</td>   <td name='contacto[]'>"+detalle[i].contacto+"</td> </tr>";
			}
		}
		//al tener datos en filas este ya recibe los datos en el html
		$('#listar_usuarios_resolucion').html(filas);
	}//fin de la funcion listar_detalle_usuarios
	//PARA RESOLUCION
	function limpiar_resolucion() {
		
		$("#nresolucion").val("");
		$("#nproyecto").val("");
		$("#id_motivo").val("");
		$("#id_area").val("");
		$("#f_emision").val("");

		//el detalle tambien se limpia 
		detalle=[];
					
		$('#listar_usuarios_resolucion').html('');

		explode();
	}
	//PARA RESOLUCION - regitramos la resolucion
	function registraresolucion(e) {

		e.preventDefault();
		//recogemos los datos del formulario de la resolucion y del detalle[]s
		var nresolucion = $("#nresolucion").val();
		var nproyecto = $("#nproyecto").val();
		var id_motivo = $("#id_motivo").val();
		var id_area = $("#id_area").val();
		var f_emision = $("#f_emision").val();

		//verificamos que los campos no tengan vacios incluyendo el detalle
		if (nresolucion!="" && nproyecto!="" && id_motivo!="" && id_area!="" && detalle!="") {
			//prueba para la validacion del if
			//console.log(id_resolucion);
			console.log('Go register');
			//hacemos el llamado a ajax para el envio de los datos
			$.ajax({

				url:"../ajax/usuarios.php?op=registrar_resolucion",
				method:"POST",
				data:{'arrayResolucion':JSON.stringify(detalle),'nresolucion':nresolucion, 'nproyecto':nproyecto, 'id_motivo':id_motivo, 'id_area':id_area, 'f_emision':f_emision},
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
					//IMPORTANTE: esta se descomenta cuando imprimo el console.log
					/*if (typeof data == "string"){
					      data = $.parseJSON(data);
					}*/
					//realizamos el output de data con console.log
					//console.log(data);
					//alert(data);
					//al registrar los campos se limpian 
						var nresolucion = $("#nresolucion").val("");
						var nproyecto = $("#nproyecto").val("");
						var id_motivo = $("#id_motivo").val("");
						var id_area = $("#id_area").val("");
						var f_emision = $("#f_emision").val("");

					//el detalle tambien se limpia 
					detalle=[];
					
					$('#listar_usuarios_resolucion').html('');
					//para refrescar la pagina y agregar una nueva info

					alertify.alert("<p class='text-success'>¡Conforme!</p>","Nueva resolución agregada", 
						
						function(){ 
							alertify.success('Conforme'); 
						});

					setTimeout("explode()",2000);//llamamos a la funcion explode para recargar la pagina

				}

			});//fin del ajax

		} else {

			alertify.alert("<p class='text-danger'>¡Error! - Al agregar resolución</p>","Porfavor agregue como mínimo un usuario", 
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

init();//de la funcion init
