var tablamotivo;

	function initm() {
		//inicializa las funciones
		listarm();
		//cuando se da click en submit se ejecuta la funcion e
		$("#motivo_form").on("submit",function(e)
		{
			guardaryeditarm(e);
		})

		$("#add_button_motivo").click(function(){

			$(".modal-titlem").text("Agregar Motivo");
		});
		
	}

	function limpiarm() {
		$("#descripcion").val("");
		$("#id_motivo").val("");
	}

	function listarm() {
		tablamotivo=$('#motivo_data').dataTable({
			"aProcessing":true,//Activamos procesamiento de datatable
			"aServerSide":true,//Paginacion y filtrado realizados por el servidor
			dom:'Bfrtip',//Definimos los elementos del control de table
			buttons:[
		
				'copyHtml5'
			],
			"ajax":
			{
				url:'../ajax/motivo.php?op=listar',
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

	function mostrarm(id_motivo) {

		$.post("../ajax/motivo.php?op=mostrar",{id_motivo : id_motivo},function(data,status)
			
			{
				data=JSON.parse(data);
				
				$("#motivoModal").modal("show");
				$("#descripcion").val(data.descripcion);			
				$(".modal-titlem").text("Editar Motivo");
				$("#id_motivo").val(id_motivo);
				$("#actionm").val("Edit");
			});	
		}

	function guardaryeditarm(e){

		e.preventDefault();
		var formData = new FormData($("#motivo_form")[0]);

			$.ajax({

				url:"../ajax/motivo.php?op=guardaryeditar",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {
					console.log(datos);//consulta los datos y lo arroja en json

					$('#motivo_form')[0].reset();
					$('#motivoModal').modal('hide');

					$('#resultados_ajax_motivo').html(datos);
					$('#motivo_data').DataTable().ajax.reload();

				limpiarm();
				
				}

			});//cierre 
		}
initm();