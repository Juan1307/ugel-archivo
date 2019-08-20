
<!--Formulario USUARIO MODAL-->
<div class="modal fade bd-example-modal-xl"  id="resolucion_detalle_modal" role="dialog">

   <div class="modal-dialog modal-dialog-scrollable "style="max-width: 1440px!important;" >
    <div class="modal-content">
        <div class="modal-header">

            <h5 class="m-0 font-weight-bold text-primary modal-title"><i class="fa fa-folder"></i>&nbsp; Detalle de la Resolucion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <!--Modal body-->
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <th>RES</th>
                  <th>PRO</th>
                  <th>Motivo</th>
                  <th>Oficina</th>
                  <th>Emision</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                  <!--Cargamos la data para la resolucion-->
                  <td><h5 id="resolucion"></h5> <input type="hidden" name="resolucion" id="resolucion"></td>
                  <td><h5 id="proyecto"></h5><input type="hidden" name="proyecto" id="proyecto"></td>
                  <td><h5 id="motivo"></h5><input type="hidden" name="motivo" id="motivo"></td>
                  <td><h5 id="area"></h5><input type="hidden" name="area" id="area"></td>
                  <td><h5 id="emision"></h5><input type="hidden" name="emision" id="emision"></td>
                  <td><h4 id="estado"></h4><input type="hidden" name="estado" id="estado"></td>
                </tbody>
              </table>
            </div>
            <!--Resultados de Uusuario Detalle-->
            <div id="resultados_ajax_detalle"></div>

            <div id="resultados_ajax_add_usuarios"></div>

            <button class="btn btn-primary float-right user_go" id="id_resolucion_add" ><i class="fa fa-plus"></i></button>

              <div class="table-responsive">
                  <table id="detalle_usuarios" class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light ">
                      <th>Apellidos</th>
                      <th>Nombres</th>
                      <th>Dni</th>
                      <th>Carnet</th>
                      <th>Contacto</th>
                      <th>Entrega</th>
                      <th>Estado</th>
                      <th>Editar</th>
                      <th>E/R</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot class="thead-light">
                      <th>Apellidos</th>
                      <th>Nombres</th>
                      <th>Dni</th>
                      <th>Carnet</th>
                      <th>Contacto</th>
                      <th>Entrega</th>
                      <th>Estado</th>
                      <th>Editar</th>
                      <th>E/R</th>
                    </tfoot>
                  </table>
                </div>

            <!--Resultados de Uusuario Detalle-->

          </div>
          <!--Fin del modal body-->
          <div class="modal-footer">
            <button class=" btn btn-danger float-right" data-dismiss="modal">Cerrar</button>
          </div>
    </div>
  </div>

</div>

<!--Para Editar Resolucion MODAL-->
<div class="modal fade" id="usuarios_detalle_Modal" role="dialog">

  <div class="modal-dialog">
    <form method="POST" id="usuarios_detalle_form">
      <div class="modal-content">

        <div class="modal-header">
          <h5>Editar Detalle de Usuario</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Apellidos:</label>
              <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñÑÁÉÍÓÚ\s]{0,50}$" maxlength="50">
            </div>
            <div class="form-group col-md-12">
              <label>Nombres:</label>
              <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" required pattern="^[a-zA-Z_áéíóúñÑÁÉÍÓÚ\s]{0,30}$" maxlength="30">
            </div>
            <div class="form-group col-md-6">
              <label>Nro de DNI:</label>
              <input type="text" name="ndni" id="ndni" class="form-control" placeholder="Doc Identidad" pattern="[0-9]{8}" maxlength="8">
            </div>
            <div class="form-group col-md-6">
              <label>C. Extranjeria:</label>
              <input type="text" name="carnet" id="carnet" class="form-control" placeholder="Nro Carnet" onkeyup="this.value=num(this.value)" maxlength="15">
            </div>
            <div class="form-group col-md-12">
              <label>Contacto:</label>
              <input type="text" name="contacto" id="contacto" class="form-control" placeholder="Cell/Telf" pattern="[0-9]{7,9}" maxlength="9">    
            </div>

            <div class="form-group col-md-6">
              <label>Estado:</label>
                <select class="form-control" name="estado_detalle" id="estado_detalle" required>
                  <option value="">---Seleccionar Estado---</option>
                  <option value="1">Entregado</option>
                  <option value="0">Por Entregar</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label>Fecha Entrega</label>
              <input type="text" name="f_entrega" id="f_entrega" data-target="#f_entrega" class="form-control" placeholder="Entrega">    
            </div>        
          </div>
        </div>

        <div class="modal-footer">
        <!--Envio del campo oculto-->
        <input type="hidden" name="id_usuario" id="id_usuario">
        <input type="hidden" name="id_detresolucion" id="id_detresolucion">

          <button type="submit" name="action_det" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" onclick="limpiar_detalle()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"  aria-hidden="true"></i>&nbsp;Cancelar</button>

        </div>  

      </div>
    </form>
  </div>
</div>
