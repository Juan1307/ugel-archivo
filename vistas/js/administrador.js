var tabla;
	//Funcion que se ejecuta al inicio
	function init() {
		//inicializa las funciones
		listar();

		$("#administrador_form").on("submit",function(e){
			
			guardaryeditar(e);

		});

		$("#add_button_administrador").click(function(){

			$(".modal-title").text("Agregar Admin");
			$("#ndni").prop("disabled",false);
		});
	}
	//para limpiar los campos 
	function limpiar() {

		$("#usuario").val("");
		$("#ndni").val("");
		$("#password").val("");
		$("#password1").val("");
		$("#id_admin").val("");
	}
	

	function guardaryeditar(e) {

		e.preventDefault();

			var formData = new FormData($("#administrador_form")[0]);
			//recogemos los valores en la variables
		var password = $("#password").val();
		var password1 = $("#password1").val();

		var usuario = $("#usuario").val();

		if (usuario === "") {

		//para el boton de success
			alertify.alert("<p class='text-danger'>¡Conforme!</p>","Ingrese el usuario porfavor", 
				function(){ 
					alertify.error('Error'); 
				});

		} else {

			if (password == password1) {

				$.ajax({

					url:"../ajax/admin.php?ad=guardar",
					type:"POST",
					data: formData,
					contentType:false,
					processData:false,

					success: function (datos) {
						console.log(datos);//consulta los datos y lo arroja en json
							
							//$('#perfil_form')[0].reset();
						$('#administradorModal').modal('hide');

						$('#resultados_ajax_administrador').html(datos);

						$('#administrador_data').DataTable().ajax.reload();

						limpiar();
					}

				})//cierre

			}else{
					function limpiar_edit() {
						
						$("#password").val("");
						$("#password1").val("");
					}

				limpiar_edit();
					//solo con bootbox

				alertify.alert("<p class='text-danger'>¡Error!</p>","Las contraseñas no coinciden", 
					function(){ 
						alertify.error('Error'); 
					});

			}
		}//end else
				
	}
	//Funcion listar 
	function listar() {
		
		tabla=$('#administrador_data').dataTable({

			"aProcessing":true,//Activamos procesamiento de datatable
			"aServerSide":true,//Paginacion y filtrado realizados por el servidor
			dom:'Bfrtip',//Definimos los elementos del control de table
			buttons:[
				'copy',
				'excel'
			],
			"ajax":
			{
				url:'../ajax/admin.php?ad=listar',
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