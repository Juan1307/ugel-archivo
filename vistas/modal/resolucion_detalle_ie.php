
<!--Formulario USUARIO MODAL-->
<div class="modal fade bd-example-modal-xl"  id="resolucion_detalle_modal_ie" role="dialog">

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

            <div id="resultados_ajax_add_institucion"></div>
            
            <button class="btn btn-primary float-right ie_go" id="id_resolucion_add" ><i class="fa fa-plus"></i></button>

            <div class="table-responsive">
              <table id="detalle_institucion" class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light ">
                  <th>Institución</th>
                  <th>Nivel</th>
                  <th>Entrega</th>
                  <th>Estado</th>
                  <th>A - R</th>
                  <th>E - R</th>
                  <th>Ver</th>
                  <th>E/R</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="thead-light">
                  <th>Institución</th>
                  <th>Nivel</th>
                  <th>Entrega</th>
                  <th>Estado</th>
                  <th>A - R</th>
                  <th>E - R</th>
                  <th>Ver</th>
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
<div class="modal fade" id="institucion_detalle_Modal" role="dialog">

  <div class="modal-dialog">
    <form method="POST" id="institucion_detalle_form">
      <div class="modal-content">

        <div class="modal-header">
          <h5>Editar Detalle de Institucion</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="form-row">

            <div class="form-group col-md-12">
              <label>Institución:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre I - E" required onkeyup="this.value=NumText_ie(this.value)" maxlength="80">
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
        <input type="hidden" name="id_institucion" id="id_institucion">
        <input type="hidden" name="id_detresolucion" id="id_detresolucion">

          <button type="submit" name="action_det" id="btnGuardar" class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Guardar</button>

          <button type="button" onclick="limpiar_detalle()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"  aria-hidden="true"></i>&nbsp;Cancelar</button>

        </div>  

      </div>
    </form>
  </div>
</div>


<!--Para ver Resolucion MODAL-->
<div class="modal fade" id="receptor_detalle_Modal" role="dialog">

  <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5>Ver Info de Entrega</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="form-row">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">CAMPOS</th>
                  <th scope="col">DATOS - INSTITUCIÓN</th>
                </tr>
              </thead>
              <tbody>
                <tr> 
                  <td scope="row" class="text-primary"><h5>Institución:</h5></td>
                  <td><h6 id="institucion"></h6> <input type="hidden" id="institucion"></td>
                </tr>
                <tr>
                  <td scope="row" class="text-primary"><h5>Nivel:</h5></td>
                  <td><h6 id="nivel_ie"></h6> <input type="hidden" id="nivel_ie"></td>
                </tr>
                <tr>
                  <td scope="row" class="text-primary"><h5>Entrega:</h5></td>
                  <td><h6 id="entrega_ie"></h6> <input type="hidden" id="entrega_ie"></td>
                </tr>
                <tr>
                  <td scope="row" class="text-primary"><h5>Estado:</h5></td>
                  <td><h6 id="estado_ie"></h6> <input type="hidden" id="estado_ie"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="form-row">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">CAMPOS</th>
                  <th scope="col">DATOS - RECEPTOR</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="row" class="text-primary"><h5>Nombres:</h5></td>
                  <td><h6 id="nombres"></h6> <input type="hidden" id="nombres"></td>
                </tr>
                <tr>
                  <td scope="row" class="text-primary"><h5>Apellidos:</h5></td>
                  <td><h6 id="apellidos"></h6> <input type="hidden" id="apellidos"></td>
                </tr>
                <tr>
                  <td scope="row" class="text-primary"><h5>Dni:</h5></td>
                  <td><h6 id="ndni"></h6> <input type="hidden" id="ndni"></td>
                </tr>
                <tr>
                  <td scope="row" class="text-primary"><h5>Carnet:</h5></td>
                  <td><h6 id="Carnet"></h6> <input type="hidden" id="Carnet"></td>
                </tr>
                <tr>
                  <td scope="row" class="text-primary"><h5>Contacto:</h5></td>
                  <td><h6 id="contacto"></h6> <input type="hidden" id="contacto"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
        <!--Envio del campo oculto-->

          <button type="button" class="btn btn-danger" onclick="limpiar_receptor()" data-dismiss="modal"><i class="fa fa-times"  aria-hidden="true"></i>&nbsp;Cerrar</button>

        </div>  

      </div>
    </form>
  </div>
</div>


