
<!--Formulario USUARIO MODAL-->
<div class="modal fade bd-example-modal-xl"  id="control_detalle_modal" role="dialog">

   <div class="modal-dialog modal-dialog-scrollable " style="max-width: 1440px!important;">
    <div class="modal-content">
        <div class="modal-header">

            <h5 class="m-0 font-weight-bold text-primary modal-title"><i class="fas fa-share-square"></i>&nbsp; Detalle de la Entrega</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <!--Modal body-->
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <th>Area</th>
                  <th>Responsable</th>
                  <th>Folios</th>
                  <th>Entrega</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                  <!--Cargamos la data para la resolucion-->
                  <td><h5 id="area"></h5> <input type="hidden" name="area" id="area"></td>
                  <td><h5 id="personal"></h5><input type="hidden" name="personal" id="personal"></td>
                  <td><h5 id="folios"></h5><input type="hidden" name="folios" id="folios"></td>
                  <td><h5 id="entrega"></h5><input type="hidden" name="entrega" id="entrega"></td>
                  <td><h4 id="estado"></h4><input type="hidden" name="estado" id="estado"></td>
                </tbody>
              </table>
            </div>
            <!--Resultados de Uusuario Detalle-->
            <div id="resultados_ajax_detalle"></div>
            <!--Resultados de Uusuario Detalle-->
            <div class="table-responsive">
              <table id="detalle_resolucion" class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light ">
                  <th>RES</th>
                  <th>PRO</th>
                  <th>Motivo</th>
                  <th>Area</th>
                  <th>Emision</th>
                  <th>Recepcion</th>
                  <th>Estado</th>
                  <th>Editar</th>
                  <th>E/R</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="thead-light">
                  <th>RES</th>
                  <th>PRO</th>
                  <th>Motivo</th>
                  <th>Area</th>
                  <th>Emision</th>
                  <th>Recepcion</th>
                  <th>Estado</th>
                  <th>Editar</th>
                  <th>E/R</th>
                </tfoot>
              </table>
            </div>
          </div>
          <!--Fin del modal body-->
          <div class="modal-footer">
            <button class=" btn btn-danger float-right" data-dismiss="modal">Cerrar</button>
          </div>
    </div>
  </div>

</div>

<!--Para Editar Resolucion MODAL-->
<div class="modal fade" id="resolucion_detalle_Modal" role="dialog">

  <div class="modal-dialog">
    <form method="POST" id="control_detalle_form">
      <div class="modal-content">

        <div class="modal-header">
          <h5>Editar Detalle de Entrega</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="form-row">

            <div class="form-group col-md-6">
              <label>Estado:</label>
                <select class="form-control" name="estado_detalle" id="estado_detalle" required>
                  <option value="">---Seleccionar Estado---</option>
                  <option value="1">Recibido</option>
                  <option value="0">Enviado</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label>Fecha Recibido:</label>
              <input type="text" name="f_recepcion" id="f_recepcion" data-target="#f_recepcion" class="form-control" placeholder="Recibido" required>    
            </div>        
          </div>
        </div>

        <div class="modal-footer">
        <!--Envio del campo oculto-->
        <input type="hidden" name="id_detcontrol" id="id_detcontrol">

          <button type="submit" name="action_con"  id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" onclick="limpiar_detalle()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"  aria-hidden="true"></i>&nbsp;Cancelar</button>

        </div>  

      </div>
    </form>
  </div>
</div>
