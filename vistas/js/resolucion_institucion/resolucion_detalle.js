var tabla_detalle;

var t_agregar_institucion;

var t_agregar_receptor;
	//funcion para inicializar
	function init() {
		
		listar_detalle();

		$("#institucion_detalle_form").on("submit",function(e)
		{
			editar_detalle_institucion(e);
		});
	}
	//para el cambio de estado de detalle resolucion
	function cambiar_estado_detalle(id_detresolucion,estado) {

		//hacemos una alerta
		alertify.confirm("<p class='text-primary'>Para cambiar estado</p>", '¿ Desea realizar ENTREGA y/o cancelar ENTREGA ?', function(result){ 
			
			if(result){

				$.ajax({
					url:"../ajax/resolucion_detalle.php?op=cambiar_estado_detalle",
					 method:"POST",
					//data:dataString,
					//toma el valor del id y del estado
					data:{id_detresolucion:id_detresolucion, estado:estado},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#detalle_institucion').DataTable().ajax.reload();
				    	
				    }

				});

			 }

			alertify.success('Conforme')
			//si result me da true o ver

			}, function(){

                 alertify.error('Cancelado')
             }
        );

	}
		//VER DETALLE DE USUARIOS
	$(document).on('click','.ie_go',function () {

		$("#messages").hide();		
		$("#errors").hide();
		$("#warnings").hide();
		$('#agregar_institucion_modal').modal('show');


		//toma el id de la resolucion
		var id_resolucion=$(this).attr('value');

		console.log(id_resolucion);	

				t_agregar_institucion=$('#agregar_institucion_data').dataTable({

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

						url:'../ajax/resolucion_detalle.php?op=agregar_institucion',//enviamos el parametro 
						method:"POST",
						data:{id_resolucion:id_resolucion},
						type:"get",//el tipo del parametro
						cache:false,
						dataType:"json",//formato de la data

						error: function (e) {
							console.log(e.responseText);//para hacer la verificacion de errores
						}
					},
					"bDestroy":true,
					"responsive":true,
					"bInfo":true,//informacion del los datatable
					"iDisplayLength":10,//Pora cada 10 registros hace una paginacion
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
		});

	function asignar_receptor(id_detresolucion) {
		
		$('#agregar_receptor_modal').modal('show');

		$("#messages").hide();		
		$("#errors").hide();
		$("#warnings").hide();

			t_agregar_receptor=$('#agregar_receptor_data').dataTable({

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

						url:'../ajax/resolucion_detalle.php?op=agregar_receptor',//enviamos el parametro 
						method:"POST",
						type:"get",//el tipo del parametro
						data:{id_detresolucion:id_detresolucion},
						cache:false,
						dataType:"json",//formato de la data

						error: function (e) {
							console.log(e.responseText);//para hacer la verificacion de errores
						}
					},
					"bDestroy":true,
					"responsive":true,
					"bInfo":true,//informacion del los datatable
					"iDisplayLength":10,//Pora cada 10 registros hace una paginacion
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

	function asignar_receptor_det_re(id_usuario,id_detresolucion) {
		
		$.ajax({

			//enviamos la data al ajax
			url:"../ajax/resolucion_detalle.php?op=agregar_receptor_det_re",
			method:"POST",
			data:{id_detresolucion:id_detresolucion,id_usuario:id_usuario},

			success: function (datos) {

				console.log(datos);//consulta los datos y lo arroja en json

				$('#agregar_receptor_modal').modal('hide');
					
				$('#resultados_ajax_add_institucion').html(datos);

				$('#detalle_institucion').DataTable().ajax.reload();

				$("#messages").show();

				}

			});//cierre		
	}

	//Para mostrar el detalle de los usuarios
	function mostrar_detalle_institucion(id_detresolucion) {
		
		$.post("../ajax/resolucion_detalle.php?op=mostrar_detalle_institucion",{id_detresolucion : id_detresolucion},function (data,status) 
		{
			//traemos la data del json a mostrar
			data=JSON.parse(data);
				//indicamos los campos 
				$("#institucion_detalle_Modal").modal("show");//hacemos que se muestre el modal para editar
				$("#nombre").val(data.nombre);
				$("#nivel").val(data.nivel);

				///campos para basicamente el editado del detalle como fecha y estado
				$("#f_entrega").val(data.f_entrega);
				$("#estado_detalle").val(data.estado);
				$("#id_institucion").val(data.id_institucion);
				$("#id_detresolucion").val(id_detresolucion);
				$("#action_det").val("Edit");
		});
	}
	function limpiar_receptor() {

		$("#institucion").html("");
		$("#nivel_ie").html("");
		$("#entrega_ie").html("");
		$("#estado_ie").html("");

		$("#nombres").html("");
		$("#apellidos").html("");
		$("#ndni").html("");
		$("#carnet").html("");
		$("#contacto").html("");
	}
	function agregar_institucion_det_re(id_institucion,id_resolucion) {
		
		$.ajax({

			//enviamos la data al ajax
			url:"../ajax/resolucion_detalle.php?op=agregar_institucion_det_re",
			method:"POST",
			data:{id_resolucion:id_resolucion,id_institucion:id_institucion},

			success: function (datos) {

				console.log(datos);//consulta los datos y lo arroja en json

				$('#agregar_institucion_modal').modal('hide');
					
				$('#resultados_ajax_add_institucion').html(datos);

				$('#detalle_institucion').DataTable().ajax.reload();

				$("#messages").show();

				}

			});//cierre		
	}
	//ver receptor
	function ver_receptor_detalle_entrega(id_detresolucion) {

		limpiar_receptor();

		$.post("../ajax/resolucion_detalle.php?op=ver_receptor_detalle_entrega",{id_detresolucion : id_detresolucion},function (data,status) 
		{
			//traemos la data del json a mostrar
			data=JSON.parse(data);
				
			console.log(data);
				//indicamos los campos 
				$("#receptor_detalle_Modal").modal("show");//hacemos que se muestre el modal para editar
				$("#institucion").html(data.nombre);
				$("#nivel_ie").html(data.nivel);
				$("#entrega_ie").html(data.f_entrega);
				$("#estado_ie").html(data.estado);

				$("#nombres").html(data.nombres);
				$("#apellidos").html(data.apellidos);
				$("#ndni").html(data.ndni);
				$("#carnet").html(data.carnet);
				$("#contacto").html(data.contacto);

		});

	}
	//Eliminar detalle de resolucion
	function eliminar_detalle(id_detresolucion) {
		
		//hacemos un confirm
		alertify.confirm("<p class='text-danger'>Eliminar Usuario - Resolución</p>", '¿ Desea eliminar el usuario de esta resolución ?', function(result){ 
			
			if(result){

				$.ajax({
					url:"../ajax/resolucion_detalle.php?op=eliminar_detalle",
					method:"POST",
					//data:dataString,
					data:{id_detresolucion:id_detresolucion},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#detalle_institucion').DataTable().ajax.reload();
				    	
				    }

				});

			 }

			alertify.success('Conforme')
			//si result me da true o ver

			}, function(){

                 alertify.error('Cancelado')
             }
        );

	}
	//funcion para limpiar el detalle
	function limpiar_detalle() {
		
		$("#nombre").val("");
		$("#nivel").val("");
		$("#estado_detalle").val("");
		$("#f_entrega").val("");
		$("#id_institucion").val("");
		$("#id_detresolucion").val("");
	}
	//para editar el detalle del usuario 
	function editar_detalle_institucion(e) {

		e.preventDefault();
		//indicamos el formulario
		var formData = new FormData($("#institucion_detalle_form")[0]);

			$.ajax({
				//enviamos la data al ajax
				url:"../ajax/resolucion_detalle.php?op=editar_detalle_institucion",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {

					console.log(datos);//consulta los datos y lo arroja en json

					$('#institucion_detalle_form')[0].reset();
					$('#institucion_detalle_Modal').modal('hide');
					
					$('#resultados_ajax_detalle').html(datos);
					$('#detalle_institucion').DataTable().ajax.reload();

					$("#messages").show();
					$("#errors").show();
					$("#warnings").show();
					
					limpiar_detalle();

				}

			});//cierre
	}

init();