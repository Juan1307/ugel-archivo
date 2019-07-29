var tablaarea;

	function init() {
		//inicializa las funciones
		listara();
		//cuando se da click en submit se ejecuta la funcion e
		$("#area_form").on("submit",function(e)
		{
			guardaryeditara(e);
		})

		$("#add_button_area").click(function(){

			$(".modal-titlea").text("Agregar Area");
		});

	}

	function limpiara() {
		$("#nombre").val("");
		$("#id_area").val("");
	}

	function listara() {
		tablaarea=$('#area_data').dataTable({

			"aProcessing":true,//Activamos procesamiento de datatable
			"aServerSide":true,//Paginacion y filtrado realizados por el servidor
			dom:'Bfrtip',//Definimos los elementos del control de table
			buttons:[
				'copyHtml5'
			],
			"ajax":
			{
				url:'../ajax/area.php?op=listar',
				type:"get",
				dataType:"json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy":true,
			"responsive":true,
			"bInfo":true,//informacion del los datatable
			"iDisplayLength":5,//Pora cada 10 registros hace una paginacion
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

	function mostrara(id_area) {

			$.post("../ajax/area.php?op=mostrar",{id_area : id_area},function(data,status)
			{
				data=JSON.parse(data);
				
				$("#areaModal").modal("show");         
				$("#nombre").val(data.nombre);			
				$(".modal-titlea").text("Editar Area");
				$("#id_area").val(id_area);
				$("#actiona").val("Edit");
			});	
		}

	function guardaryeditara(e){

		e.preventDefault();
		var formData = new FormData($("#area_form")[0]);

			$.ajax({

				url:"../ajax/area.php?op=guardaryeditar",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {

					console.log(datos);//consulta los datos y lo arroja en json

					$('#area_form')[0].reset();
					$('#areaModal').modal('hide');

					$('#resultados_ajax_area').html(datos);
					$('#area_data').DataTable().ajax.reload();

				limpiara();

				}

			});//cierre 

		}
init();