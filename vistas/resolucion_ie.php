<?php 
  //llamamos a la conexion

  require_once("../config/conexion.php");

    if (isset($_SESSION["ndni"])) {

      //llamamos a la clase de Area
      require_once("../modelos/Area.php");

      $area = new Area();

        $ar = $area->get_area();//traemos las areas

 ?>
<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navbar.php"); ?>
  
  <div class="container-fluid">
    
        <h1 class="h3 mb-2 text-gray-800">Sección - Resolución - Institución</h1>
          
        <p>Esta sección esta desarrollada en base al módulo resolución, aquí se realizan los procesos para agregar la resolución.</p>
        
        <!--Para el formulario-->

        <form id="resolucion_form_in">
          
          <!---Para Resolucion-->
          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-folder"></i>&nbsp; Info - Resolución
                <a href="resolucion_listar_ie.php">
                  <button type="button" class="btn btn-primary float-right"><i class="fa fa-folder" aria-hidden="true"></i>
                  </button>
                </a>
             </h5> 
            </div>

            <!--Card Body-->
            <div class="card-body">
                
              <div class="form-row">
                <!--Para registrar resolucion-->
                <div class="form-group col-md-3">
                  <label for="">N° Resolución:</label>
                  <input type="text" class="form-control" placeholder="Resolución" name="nresolucion" id="nresolucion" onkeyup="this.value=NumText(this.value)" required pattern="[0-9]{3,5}" maxlength="5" autofocus="autofocus" >
                </div>

                <div class="form-group col-md-3">
                  <label for="">N° Proyecto:</label>  
                  <input type="text" class="form-control" placeholder="Proyecto" name="nproyecto" id="nproyecto" onkeyup="this.value=NumText(this.value)" required pattern="[0-9]{3,5}"  maxlength="5" >
                </div>

                <div class="form-group col-md-6">
                  <label>Motivo:</label>
                    <select id="id_motivo" name="id_motivo" class="form-control selectpicker" data-live-search="true" ></select>
                </div>

              </div>
              <br>
              <div class="form-row">

                <div class="form-group col-md-3"> 
                  <label>Área Oficina:</label>
                  <select class="form-control" name="id_area" id="id_area" required >
                    <option value="" selected>---Seleccionar Área---</option>
                      <!--PARA area-->
                      <?php 
                        for ($i=0; $i < sizeof($ar) ; $i++) { 
                          ?>
                          <option value="<?php echo $ar[$i]["id_area"]?>"><!--Para el valor que va a tomar value=id_area -->
                            <?php echo $ar[$i]["nombre"]; ?><!--Extraemos el valor del area-->
                          </option>
                      <?php 
                        }//Cierre del for para area
                      ?>
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label>Fecha Emisión:</label>
                    <input type="text" class="form-control" name="f_emision" id="f_emision" onkeyup="this.value=NumText(this.value)" placeholder="Emisión" required>
                </div>

              </div>

            </div>

          </div>
          <!--Card Body-->

          <!--Para Instituciones-->

          <div class="card shadow mb-4">

            <div class="card-header">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-home"></i>&nbsp; Info - Instituciones
                <button type="button" id="#" class="btn btn-primary float-right listar_institucion" data-toggle="modal" data-target="#listar_institucion_modal"><i class="fas fa-plus" aria-hidden="true"></i></button>
              </h5>
            </div>

            <div class="card-body">

                <div class="row">
                  <div class="form-group col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                      </div> 
                      <input class="form-control" id="buscar_res" type="text" onkeyup="this.value=NumText_ar(this.value)" placeholder="Buscar Instituciones ..." maxlength="50">
                    </div>
                  </div>
                  <div class="form-group col-md-6"></div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        
                  <thead>
                    <tr>
                      <th>Cantidad</th>
                      <th>Institucion</th>
                      <th>Nivel</th>
                    </tr>
                  </thead>
                        
                  <tfoot>
                    <tr>
                      <th>Cantidad</th>
                      <th>Institucion</th>
                      <th>Nivel</th>
                    </tr>
                  </tfoot>
                        
                  <tbody id="listar_institucion_resolucion">
                          <!--Aqui va la informacion de las Instituciones-->  
                  </tbody>
                </table>
                </div>
            </div>

          </div>
          <!--Para Institucion-->

          <button type="submit" id="btn" class=" btn btn-success float-right" aria-hidden="true"><i class="fa fa-plus"></i>&nbsp; &nbsp; Registrar Resolucion</button>

          <!--Para limpiar resolucion-->  
          <button type="button" onclick="limpiar_resolucion()" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; &nbsp; Cancelar / Limpiar</button>

        </form>
        <!--Final para el form--> 

<!--importamos el modal-->
<?php require_once("modal/resolucion_ie.php"); ?>
<!--para el footer-->
<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/resolucion_institucion/institucion.js"></script>
<script type="text/javascript" src="js/resolucion_institucion/resolucion.js"></script>

<script type="text/javascript">
    
    function NumText_ar(string){//solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑÁÉÍÓÚOPQRSTUVWXYZ1234567890 ';//Caracteres validos
  
      for (var i=0; i<string.length; i++) //para i en 0
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
  }
</script>
<script>
    function NumText_ie(string){//solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ/1234567890°#_-() ';//Caracteres validos
  
      for (var i=0; i<string.length; i++) //para i en 0
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
  }
  </script>

<script type="text/javascript">

$(document).ready(function(){
  $("#buscar_res").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listar_institucion_resolucion tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

<?php 

  }else{

    header("Location:".Conectar::ruta()."index.php");
    exit();

  }

 ?>