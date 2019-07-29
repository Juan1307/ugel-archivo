var tabla;
	//Funcion que se ejecuta al inicio
	function init() {
		//inicializa las funciones
		listar();
		//cuando se da click en submit se ejecuta la funcion e
		$("#usuariosin_form").on("submit",function(e)
		{
			editar(e);
		});

	}
	//Funcion listar 
	function listar() {
		tabla=$('#usuariosin_data').dataTable({
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
				url:'../ajax/usuariosin.php?op=listar',
				type:"get",
				dataType:"json",
				error: function (e) {
					console.log(e.responseText);
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

	function mostrar(id_usuario) {

		$.post("../ajax/usuariosin.php?op=mostrar",{id_usuario : id_usuario},function(data,status)
			{//enviamos el parametro a traves de la url a ajax
				
				data=JSON.parse(data); //datos a mostrar y funciones para editar
				
				$("#usuariosinModal").modal("show");//abre el modal
				$("#nombres").val(data.nombres);
				$("#apellidos").val(data.apellidos);
				$("#ndni").val(data.ndni);				
				$("#carnet").val(data.carnet);
				$("#contacto").val(data.contacto);
				$("#id_usuario").val(id_usuario);//especificamos el id a editar
				$("#action").val("Edit");//para realizar el envio de datos
			});	
		}

	function limpiar() {

		$("#nombres").val("");
		$("#apellidos").val("");
		$("#ndni").val("");
		$("#carnet").val("");
		$("#contacto").val("");
		$("#id_usuario").val("");
	}

	function editar(e){

		e.preventDefault();//creamos formdata
		var formData = new FormData($("#usuariosin_form")[0]);

			$.ajax({

				url:"../ajax/usuariosin.php?op=editar",//enviamos el parametro a travez de la url
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {
					console.log(datos);//consulta los datos y lo arroja en json

					$('#usuariosin_form')[0].reset();
					$('#usuariosinModal').modal('hide');

					$('#usuariosin_ajax').html(datos);
					$('#usuariosin_data').DataTable().ajax.reload();

					limpiar();
				}

			});//cierre 

	}
	
init();