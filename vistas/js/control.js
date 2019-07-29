var tabla;

	function init() {

		listar();

		//cuando se da click en submit se ejecuta la funcion e
		$("#control_form").on("submit",function(e)
		{
			editar(e);
		})
		//llamamos al select de ajax
		$.post("../ajax/control.php?op=select_responsable",function (r) {

			$("#id_personal").html(r);
			$("#id_personal").selectpicker('refresh');
		});
			
	}

	function limpiar_control() {

		$("#id_area").val("");
		$("#nfolios").val("");
		$("#id_personal").selectpicker('refresh');//refrescamos el motivo
		$("#est").val("");
		$("#f_entrega").val("");
		$("#id_control").val("");
	}
	//listas control
	function listar() {

		tabla=$('#control_data').dataTable({
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
				url:'../ajax/control.php?op=buscar_control',//enviamos el parametro 
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
	//listar
	function mostrar(id_control) {

		$.post("../ajax/control.php?op=mostrar",{id_control : id_control}, function(data, status)
			{
				//traemos la data del json
				data=JSON.parse(data);
				//indicamos los campos a mostrar 
				$("#controlModal").modal("show");//al dar click en el boton editar abrimos el modal         
				$("#id_area").val(data.id_area);
				$("#nfolios").val(data.nfolios);
				$("#id_personal").val(data.id_personal);
				$("#id_personal").selectpicker('refresh');//refrescamos el motivo
				$("#f_entrega").val(data.f_entrega);	
				$("#est").val(data.estado);
				$("#id_control").val(id_control);	
				$("#action").val("Edit");
		});	
	}
	//editar la entrega
	function editar(e) {

		e.preventDefault();
		var formData = new FormData($("#control_form")[0]);//idicamos el formulario para editar

			$.ajax({
				//indicamos la direccion para el case
				url:"../ajax/control.php?op=editar",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {

					console.log(datos);//consulta los datos y lo arroja en json

					$('#control_form')[0].reset();
					$('#controlModal').modal('hide');//al editar ocultamos el formulario
					$('#resultados_ajax_control').html(datos);//mostramos los mensajes del ajax
					$('#control_data').DataTable().ajax.reload();
					$('#control_fecha_data').DataTable().ajax.reload();	


					limpiar_control();//llamamos a limpiar 
				}
		});//cierre	
	}
	//eliminar 
	function eliminar_control(id_control) {
		//hacemos un confirm
		alertify.confirm("<p class='text-danger'>Eliminar Entrega</p>", '¿ Desea eliminar esta entrega ?', function(result){ 
			
			if(result){

				$.ajax({

					url:"../ajax/control.php?op=eliminar",
					method:"POST",
					//data:dataString,
					//toma el valor del id y del estado
					data:{id_control:id_control},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#control_data').DataTable().ajax.reload();
	                  $('#control_fecha_data').DataTable().ajax.reload();
				    	
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

	//VER DETALLE DE LA Entrega
	$(document).on('click','.detalle',function () {
		
		$("#messages").hide();

		//$('#resultados_ajax_detalle').prop('disabled',true);
		//toma el valor del id
		var id_control=$(this).attr("id");

		$.ajax({
			//llamamos ajax y que nos ejecute un case
			url:"../ajax/control.php?op=detalle_control",
			method:"POST",
			data:{id_control:id_control},
			cache:false,
			dataType:"json",

			success:function (data) {
				//una vez se jecuta el ajax me devuelve los valores para la resolucion
				$("#area").html(data.id_area);
				$("#personal").html(data.id_personal);
				$("#folios").html(data.nfolios);
				$("#entrega").html(data.f_entrega);
				$("#estado").html(data.estado);
			}
		})
	});

	//VER DETALLE DE USUARIOS
	$(document).on('click','.detalle',function () {

		$("#messages").hide();


		//toma el id de la resolucion
		var id_control=$(this).attr("id");

				tabla_resolucion=$('#detalle_resolucion').dataTable({

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

						url:'../ajax/control.php?op=detalle_resolucion',//enviamos el parametro 
						method:"POST",
						data:{id_control:id_control},
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
	//PARA LA CONSULTA DE resolyuciones por mes y año
	$(document).on("click","#btn_control_fecha",function () {
		
		var mes = $("#mes").val();
		var ano = $("#ano").val();

		if (mes!="" && ano!="") {

			var	tabla_control_fecha = $("#control_fecha_data").dataTable({

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

						url:'../ajax/control.php?op=control_fecha',//enviamos el parametro 
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