var tabla_usuarios;

var tabla;

var tabla_resolucion_fecha;

	function init() {		
	//funcion que inicializa otras funciones
		listar();

		//cuando se da click en submit se ejecuta la funcion e
		$("#resolucion_form").on("submit",function(e)
		{
			editar(e);
		})
		//llamamos al select de ajax
		$.post("../ajax/resolucion.php?op=selectmotivo",function (r) {

			$("#id_motivo").html(r);
			$("#id_motivo").selectpicker('refresh');
		});
		
	}
	//Para LISTAR LAS RESOLUCIONES
	function listar() {

		tabla=$('#resolucion_data').dataTable({
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
				url:'../ajax/resolucion.php?op=buscar_resolucion',//enviamos el parametro 
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
	//Mostrar datos de la resolucion
	function mostrar(id_resolucion) {

		$.post("../ajax/resolucion.php?op=mostrar",{id_resolucion : id_resolucion}, function(data, status)
			{
				//traemos la data del json
				data=JSON.parse(data);
				//indicamos los campos a mostrar 
				$("#resolucionModal").modal("show");//al dar click en el boton editar abrimos el modal         
				$("#nresolucion").val(data.nresolucion);
				$("#nproyecto").val(data.nproyecto);
				$("#id_motivo").val(data.id_motivo);
				$("#id_motivo").selectpicker('refresh');//refrescamos el motivo
				$("#id_area").val(data.id_area);	
				$("#est").val(data.estado);
				$("#f_emision").val(data.f_emision);
				$("#id_resolucion").val(id_resolucion);	
				$("#action").val("Edit");
		});	
	}
	//limpiamos los campos de la resolucion
	function limpiar() {
		
		$("#nresolucion").val("");
		$("#nproyecto").val("");
		$("#id_motivo").selectpicker('refresh');//refrescamos el motivo
		$("#id_area").val("");
		$("#est").val("");
		$("#f_emision").val("");
		$("#id_resolucion").val("");
	}
	//Editar los datos de la resolucion
	function editar(e) {

		e.preventDefault();
		var formData = new FormData($("#resolucion_form")[0]);//idicamos el formulario para editar

			$.ajax({
				//indicamos la direccion para el case
				url:"../ajax/resolucion.php?op=editar",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {

					console.log(datos);//consulta los datos y lo arroja en json

					$('#resolucion_form')[0].reset();
					$('#resolucionModal').modal('hide');//al editar ocultamos el formulario
					$('#resultados_ajax_resolucion').html(datos);//mostramos los mensajes del ajax
					$('#resolucion_data').DataTable().ajax.reload();
					$('#resolucion_fecha_data').DataTable().ajax.reload();	


					limpiar();//llamamos a limpiar 
				}
		});//cierre	
	}
		//VER DETALLE DE LA RESOLUCION
	$(document).on('click','.detalle',function () {
		
		$("#messages_r").hide();
		$("#messages").hide();
		$("#errors").hide();
		$("#warnings").hide();

		$("#resolucion_detalle_modal").modal('show');
		//toma el valor del id
		var id_resolucion=$(this).attr("id");

		$.ajax({
			//llamamos ajax y que nos ejecute un case
			url:"../ajax/resolucion.php?op=detalle_resolucion",
			method:"POST",
			data:{id_resolucion:id_resolucion},
			cache:false,
			dataType:"json",

			success:function (data) {
				//una vez se jecuta el ajax me devuelve los valores para la resolucion
				$("#id_resolucion_add").val(data.id_resolucion);
				$("#resolucion").html(data.nresolucion);
				$("#proyecto").html(data.nproyecto);
				$("#motivo").html(data.id_motivo);
				$("#area").html(data.id_area);
				$("#emision").html(data.f_emision);
				$("#estado").html(data.estado);

			}
		})
	});

	//VER DETALLE DE USUARIOS
	$(document).on('click','.detalle',function () {
		
		$("#messages_r").hide();
		$("#messages").hide();
		$("#errors").hide();
		$("#warnings").hide();
		//toma el id de la resolucion
		var id_resolucion=$(this).attr("id");

				tabla_usuarios=$('#detalle_usuarios').dataTable({

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

						url:'../ajax/resolucion.php?op=detalle_usuarios',//enviamos el parametro 
						method:"POST",
						data:{id_resolucion:id_resolucion},
						type:"get",//el tipo del parametro
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

	//para cambiar el estado
	function activar_resolucion(id_resolucion) {

		alertify.alert("<p class='text-success'>¡Resolución ACTIVADA!</p>","Se cambio el estado correctamente", function(result){ 
			
			if(result){

				$.ajax({
					url:"../ajax/resolucion.php?op=activar_resolucion",
					 method:"POST",
					//data:dataString,
					//toma el valor del id y del estado
					data:{id_resolucion:id_resolucion},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#resolucion_data').DataTable().ajax.reload();		
					  $('#resolucion_fecha_data').DataTable().ajax.reload();		    	
				    }

				});

			}

			alertify.success('ACTIVO'); 
		});

	}
	//para cambiar el estado
	function desactivar_resolucion(id_resolucion) {

		alertify.alert("<p class='text-danger'>¡Resolución INACTIVA!</p>","Se cambio el estado correctamente", function(result){ 
			
			if(result){

				$.ajax({
					url:"../ajax/resolucion.php?op=desactivar_resolucion",
					 method:"POST",
					//data:dataString,
					//toma el valor del id y del estado
					data:{id_resolucion:id_resolucion},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#resolucion_data').DataTable().ajax.reload();
				      $('#resolucion_fecha_data').DataTable().ajax.reload();	
				    }

				});

			}

			alertify.error('INACTIVO'); 
		});

	}
//para eliminar resolucion
	function eliminar_resolucion(id_resolucion) {
		//hacemos una confirm
		alertify.confirm("<p class='text-danger'>Eliminar Resolución</p>", '¿ Desea eliminar esta resolucion ?', function(result){ 
			
			if(result){

				$.ajax({
					url:"../ajax/resolucion.php?op=eliminar_resolucion",
					 method:"POST",
					//data:dataString,
					data:{id_resolucion:id_resolucion},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#resolucion_data').DataTable().ajax.reload();
				      $('#resolucion_fecha_data').DataTable().ajax.reload();	
				    	
				    }

				});

			}

			alertify.success('Conforme')
			//si result me da true o ver

			}, function(){

                alertify.error('Cancelado')
            }
        );
	}	//PARA LA CONSULTA DE resolyuciones por mes y año
	$(document).on("click","#btn_resolucion_fecha",function () {
		
		var mes = $("#mes").val();
		var ano = $("#ano").val();

		if (mes!="" && ano!="") {

			var	tabla_resolucion_fecha = $("#resolucion_fecha_data").dataTable({

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

						url:'../ajax/resolucion.php?op=resolucion_fecha',//enviamos el parametro 
						data:{mes:mes,ano:ano},
						type:"post",//el tipo del parametro

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
				},//cerrando language
			});
		}//fin condicional
	});

init();