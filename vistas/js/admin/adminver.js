var tablaad;
	//Funcion que se ejecuta al inicio
	function init() {
		//inicializa las funciones
		listarver();
	}
	//Funcion listar 
	function listarver() {
		tablaad=$('#adminver_data').dataTable({
			"aProcessing":true,//Activamos procesamiento de datatable
			"aServerSide":true,//Paginacion y filtrado realizados por el servidor
			dom:'Bfrtip',//Definimos los elementos del control de table
			buttons:[],
			"ajax":
			{
				url:'../ajax/admin.php?ad=listarver',
				type:"get",
				dataType:"json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy":true,
			"responsive":true,
			"bInfo":true,//informacion del los datatable
			"iDisplayLenght":5,//Pora cada 10 registros hace una paginacion
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
			 
			        "sNext":     "Siguiente ",
			 
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