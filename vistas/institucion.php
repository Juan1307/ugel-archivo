<?php 
//importamos la conexion
  require_once("../config/conexion.php");
  //verifivcamos si existe la session -- se recomienda usar el dato unico en el modulo
  if (isset($_SESSION["ndni"])) {
    
 ?>

<?php require_once("includes/header.php");?>
<?php require_once("includes/navbar.php"); ?>
<div class="container-fluid">

 	<div id="resultados_ajax_institucion"></div>

    <h1 class="h3 mb-2 text-gray-800">Sección - Institución</h1>
      <p>Esta sección es la parte general en base al módulo Institución, aquí se realizan todos los procesos para las Instituciones.</p>
      <!-- Tabla INSTITUcION -->
      <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-home"></i> Info Institución<button class="btn btn-success float-right" id="add_button_institucion" onclick="limpiar_institucion()" data-toggle="modal" data-target="#institucionModal"><i class="fas fa-plus" aria-hidden="true"></i></button></h5>
            </div>
            <div class="card-body">     
              <div class="table-responsive">
                <table id="institucion_data" class="table table-bordered  table-hover" width="100%" cellspacing="0">
                	<thead>
                	  	<tr>
	                      <th>Institucion</th>
	                      <th>Nivel</th>
                        <th>Editar</th>
                      </tr>
                	</thead>
                	<tfoot>
                		<tr>
                        <th>Institucion</th>
                        <th>Nivel</th>
                        <th>Editar</th>
                    </tr>
                	</tfoot>
                	<tbody>
                		
                	</tbody>
                 </table>
              </div>
            </div>
      
      </div>   
</div>

<!--Formulario INSTITUCION MODAL-->
<div id="institucionModal" class="modal fade">

	 	<div class="modal-dialog">
	 		<form method="POST" id="institucion_form">
 			  <div class="modal-content">

 				<div class="modal-header">
 					<h5 class="modal-title">Agregar Institucion</h5>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>

 				<div class="modal-body">

          <div class="form-row">
            
            <div class="form-group col-md-12">
              <label>Institución:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" onkeyup="this.value=NumText(this.value)" placeholder="Nombre I - E" required maxlength="80">
            </div>
            <div class="form-group col-md-12">
              <label>Nivel:</label>
              <select class="form-control" name="nivel" id="nivel" required>
                <option value="" selected>---- Seleccione Nivel ----</option>
                <option value="Inicial">Inicial</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
              </select>
            </div>
          </div>
          
				</div>
   			<div class="modal-footer">

 				<input type="hidden" name="id_institucion" id="id_institucion">

 				<button type="submit" name="action" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

 				<button type="button" onclick="limpiar_institucion()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>

 				</div>
 			  </div>
 			</form>
 		  </div>

</div>
<?php require_once("includes/footer.php");?>

<script type="text/javascript" src="js/resolucion_institucion/institucion.js"></script>
<script>
    function NumText(string){//solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ/1234567890°#_-() ';//Caracteres validos
  
      for (var i=0; i<string.length; i++) //para i en 0
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
  }
  </script>
<?php
//PARA LOGIN 
  }else{
    header("Location:".Conectar::ruta()."index.php");
   exit();
  }
?>
