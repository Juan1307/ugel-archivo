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
    
        <h1 class="h3 mb-2 text-gray-800">Sección - Control</h1>
          
        <p>Esta sección esta desarrollada en base al módulo control, aquí se realizan los procesos para entregar la resolución.</p>
        
    <!--Para el formulario-->
    <form id="control_form_in">

      <!---Para Resolucion-->

          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fab fa-telegram-plane"></i>&nbsp; Info - Entrega
                <a href="control_listar.php">
                  <button type="button" class="btn btn-primary float-right"><i class="fas fa-share"></i>
                  </button>
                </a>
             </h5> 
            </div>

            <!--Card Body-->
            <div class="card-body">
                
              <div class="form-row">
                <!--Para registrar resolucion-->
                <div class="form-group col-md-3">
                  <label >Area - Oficina:</label>

                  <select class="form-control" name="id_area" id="id_area" required >
                    <option value=""selected>---Seleccionar Área---</option>
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

                <div class="form-group col-md-5">
                  <label>Responsable:</label>  
                    <select id="id_personal" name="id_personal" class="form-control selectpicker" data-live-search="true" ></select>
                </div>

                <div class="form-group col-md-2">
                  <label>N° Folios:</label>
                  <input type="text" id="nfolios" name="nfolios" onkeyup="this.value=NumText(this.value)" class="form-control" placeholder="N° Folios" required pattern="[0-9]{1,5}" maxlength="5">
                </div>
                <div class="form-group col-md-2">
                  <label>Fecha Entrega:</label>
                  <input type="text" class="form-control" name="f_entrega" id="f_entrega" onkeyup="this.value=NumText(this.value)" placeholder="Entrega" required>
                </div>

              </div>
                  

              </div>

          </div>
          <!--Card Body-->

          <!--Para Usuarios-->
          <div class="card shadow mb-4">

            <div class="card-header">
              <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-folder"></i>&nbsp; Info - Resolucion
                <button type="button" id="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#listar_resolucion_modal"><i class="fas fa-folder-plus" aria-hidden="true"></i></button>
              </h5>
            </div>

            <div class="card-body">

                <div class="row">
                  <div class="form-group col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                      </div> 
                      <input class="form-control" id="buscar_res" type="text" onkeyup="this.value=NumText_ar(this.value)" placeholder="Buscar Resolucion ..." maxlength="50">
                    </div>
                  </div>
                  <div class="form-group col-md-6"></div>  
                </div>
                <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        
                  <thead>
                    <tr>
                      <th>Cantidad</th>
                      <th>RES</th>
                      <th>PRO</th>
                      <th>Motivo</th>
                      <th>Oficina</th>
                      <th>Emision</th>
                    </tr>

                  </thead>
                        
                  <tfoot>
                    <tr>
                      <th>Cantidad</th>
                      <th>RES</th>
                      <th>PRO</th>
                      <th>Motivo</th>
                      <th>Oficina</th>
                      <th>Emision</th>  
                    </tr>
                  </tfoot>
                        
                  <tbody id="listar_resolucion">
                          <!--Aqui va la informacion de los usuarios-->  
                  </tbody>
                </table>
                </div>
            </div>

          </div>
          <!--Para Usuarios-->

          <button type="submit" id="btn" class=" btn btn-success float-right" aria-hidden="true"><i class="fa fa-plus"></i>&nbsp; &nbsp; Realizar Entrega</button>

          <!--Para limpiar resolucion-->  
          <button type="button" onclick="limpiar_control_in()" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; &nbsp; Cancelar / Limpiar</button>

        </form>
        <!--Final para el form--> 

<!--importamos el modal-->
<?php require_once("modal/control_resolucion.php"); ?>
<!--para el footer-->
<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/personal.js"></script>
<script type="text/javascript" src="js/control.js"></script>

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

<script type="text/javascript">

$(document).ready(function(){
  $("#buscar_res").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listar_resolucion tr").filter(function() {
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