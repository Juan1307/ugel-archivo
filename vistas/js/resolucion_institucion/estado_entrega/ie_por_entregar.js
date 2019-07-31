	function init() {

		listar_detalle();
		
	}
	function listar_detalle() {

		tabla=$('#resolucion_detalle_data_sn').dataTable({
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
				url:'../ajax/resolucion_detalle.php?op=listar_det_resolucion_institucion_sn',//enviamos el parametro 
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

	init();