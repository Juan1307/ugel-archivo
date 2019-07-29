	
	//inicializamos las funciones

	$("#perfil_form").on("submit",function (e) 
	{

		editar_perfil(e);

	});
	//para limpiar los datos sobrantes
	function limpiar_perfil() {
		
		$("#password1_perfil").val("");
		$("#password_perfil").val("");
		$("#id_admin_perfil").val("");
	}

	//para mostrar modal perfil
	function mostrar_perfil(id_admin_perfil) {

		limpiar_perfil();

		$.post("../ajax/perfil.php?pr=mostrar_perfil",{id_admin_perfil : id_admin_perfil},function(data,status)
		{
			data = JSON.parse(data);
				
			$("#perfilModal").modal("show");         
			$("#usuario_perfil").val(data.usuario);
			$("#ndni_perfil").val(data.ndni);	
			$("#id_admin_perfil").val(id_admin_perfil);	
			$("#action_perfil").val("Edit");
		});	
		
	}
	function editar_perfil(e) {

		e.preventDefault();

			var formData = new FormData($("#perfil_form")[0]);

		//recogemos los valores en la variables
		var password = $("#password_perfil").val();
		var password1 = $("#password1_perfil").val();

		if (password == password1) {

			$.ajax({

				url:"../ajax/perfil.php?pr=editar_perfil",
				type:"POST",
				data: formData,
				contentType:false,
				processData:false,

				success: function (datos) {
					console.log(datos);//consulta los datos y lo arroja en json
					
					//$('#perfil_form')[0].reset();
					$('#perfilModal').modal('hide');

					$('#resultados_ajax_perfil').html(datos);
					
					$("#usuario_perfil").val("");

					limpiar_perfil();
				}

			})//cierre

			//para el boton de success
			alertify.alert("<p class='text-success'>¡Conforme!</p>","Usuario actualizado correctamente", 
				function(){ 
					alertify.success('Conforme'); 
				});

		}else{

			limpiar_perfil();
			//solo con bootbox

			alertify.alert("<p class='text-danger'>¡Error!</p>","Las contraseñas no coinciden", 
				function(){ 
					alertify.error('Error'); 
				});

		}
			
}
