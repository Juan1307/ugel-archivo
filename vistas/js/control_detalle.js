var tabla;

	function init() {

		listar_detalle();

		$("#control_detalle_form").on("submit",function(e)
		{
			editar_detalle_control(e);
		});

	}
	//para limpiar el detalle
	function limpiar_detalle() {

	 	$("#f_recepcion").val("");
	 	$("#estado_detalle").val("");
	 	$("#id_detcontrol").val("");
	} 

	function listar_detalle() {

		tabla=$('#control_detalle_data').dataTable({
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
				url:'../ajax/control_detalle.php?op=listar_det_control',//enviamos el parametro 
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
	//para el cambio de estado de detalle 
	function cambiar_estado_detalle(id_detcontrol,estado) {

		//hacemos una confirm
		alertify.confirm("<p class='text-primary'>Para cambiar estado</p>", '¿ Desea RECIBIR la entrega y/o cancelar la RECEPCIÓN ?', function(result){ 
			
			if(result){

				$.ajax({
					url:"../ajax/control_detalle.php?op=cambiar_estado_detalle",
					 method:"POST",
					//data:dataString,
					//toma el valor del id y del estado
					data:{id_detcontrol:id_detcontrol, estado:estado},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#detalle_resolucion').DataTable().ajax.reload();
				    	
				    }

				});

			 }

			alertify.success('Conforme')

			}, function(){

                 alertify.error('Cancelado')
             }
        );

	}
	//Para mostrar detalle
	function mostrar_detalle(id_detcontrol) {

		$.post("../ajax/control_detalle.php?op=mostrar_detalle",{id_detcontrol : id_detcontrol},function (data,status) 
		{
			//traemos la data del json a mostrar
			data=JSON.parse(data);
				//indicamos los campos 
				$("#control_detalle_Modal").modal("show");//hacemos que se muestre el modal para editar
				$("#f_recepcion").val(data.f_recepcion);
				$("#estado_detalle").val(data.estado);
				$("#id_detcontrol").val(id_detcontrol);
				$("#action_det").val("Edit");
		});
	}
	//para eliminar detalle
	function eliminar_detalle(id_detcontrol) {
		//hacemos una confirm
		alertify.confirm("<p class='text-danger'>Para eliminar resolución</p>", '¿ Desea eliminar la resolución de esta entrega ?', function(result){ 
			
			if(result){

				$.ajax({
					url:"../ajax/control_detalle.php?op=eliminar_detalle",
					 method:"POST",
					//data:dataString,
					data:{id_detcontrol:id_detcontrol},
					//cache: false,
					//dataType:"html",
					success: function(data){
	                 //si se ejecuta se hace refresca el datatable asincrono
	                  $('#detalle_resolucion').DataTable().ajax.reload();
				    	
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

	function editar_detalle_control(e) {
		
		e.preventDefault();
		//indicamos el formulario
		var formData = new FormData($("#control_detalle_form")[0]);

			$.ajax({
				//enviamos la data al ajax
				url:"../ajax/control_detalle.php?op=editar_detalle",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {

					console.log(datos);//consulta los datos y lo arroja en json

					$('#control_detalle_form')[0].reset();
					$('#resolucion_detalle_Modal').modal('hide');
					
					$('#resultados_ajax_detalle').html(datos);
					$('#detalle_resolucion').DataTable().ajax.reload();

					$("#messages").show();
					
					limpiar_detalle();

				}

			});//cierre
	}

init();