    <?php 
    //llamamos a la conexion
    require_once("../config/conexion.php");
    
      if (isset($_SESSION["ndni"])) {
      

     ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!--Search Resolucion-->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <!--<input type="text" class="form-control bg-light border-0 small" placeholder="Buscar resolucion ..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>-->
            </div>
          </form>

          <!-- Navbar ADMIN -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Buscar Resolucion -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <!--Fin Nav Buscar Resolucion-->

            <!--Separador-->
            <div class="topbar-divider d-none d-sm-block"></div>
            <!--Separador-->

            <!-- Nav Admin Informacion -->
            <li class="nav-item dropdown no-arrow">

              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["usuario"]; ?></span>
                <img class="img-profile rounded-circle" src="../vistas/includes/user.png">
              </a>

              <!-- Dropdown - Admin Informacion -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <!--Para editar el perfil-->
              <div id="resultados_ajax_perfil"></div>
                <a class="dropdown-item" onclick="mostrar_perfil('<?php echo $_SESSION["id_admin"]?>')" href="#"  data-toggle="modal" data-target="#perfilModal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>

                <!--Para ver Administradores-->
                <div id="resultados_adminver"></div><!--RESULTADOS Admin-->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#adminverModal">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Admins
                </a>

                <!--Para cerrar sesions-->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../vistas/login/logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesion
                </a>

              </div>

              <!--MODAL ADMIN -->
              <div id="perfilModal" class="modal fade">
                <div class="modal-dialog">
                  <!--Form Perfil-->
                  <form method="POST" id="perfil_form" >
                    <!--Modal Content-->
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5>Editar Perfil</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <div class="modal-body">

                        <div class="row">
                          <div class="col-md-12">
                              <label>Usuario</label>
                              <input type="text" name="usuario_perfil" id="usuario_perfil" class="form-control" placeholder="Usuario" required pattern="[a-zA-Z0-9ñÑ_-]{5,15}"  maxlength="15" onkeyup="this.value=NumText2(this.value)" disabled ><br>
                          </div>

                          <div class="col-md-12">
                            <label>DNI</label>
                            <input type="text" name="ndni_perfil" id="ndni_perfil" class="form-control" required pattern="[0-9]{0,8}" disabled maxlength="8"><br>
                          </div>

                          <div class="col-md-6">
                            <label>Contraseña</label>
                            <input type="password" name="password_perfil" id="password_perfil" class="form-control" placeholder="Contraseña" pattern="[a-zA-Z0-9ñÑ_-]{5,15}" maxlength="15" onkeyup="this.value=NumText2(this.value)" oninvalid="setCustomValidity('Este campo solo puede contener caracteres como : a-z , A-Z y 0-9 / Con un mínimo obligatorio de 5 caracteres.')"oninput="setCustomValidity('')"><br>
                          </div>
                          <div class="col-md-6">
                            <label>Repetir contraseña</label>
                            <input type="password" name="password1_perfil" id="password1_perfil" class="form-control" placeholder="Contraseña" required pattern="[a-zA-Z0-9ñÑ_-]{5,15}" maxlength="15" onkeyup="this.value=NumText2(this.value)" oninvalid="setCustomValidity('Este campo solo puede contener caracteres como : a-z , A-Z y 0-9 / Con un mínimo obligatorio de 5 caracteres.')"oninput="setCustomValidity('')">
                          </div>
                        </div>
      
                      </div>

                      <div class="modal-footer">
                        <!--Campo oculto para en envio-->
                        <input type="hidden" name="id_admin_perfil" id="id_admin_perfil">

                        <button type="submit" name="action_perfil" id="btnGuardar"  class="btn btn-success" value="Add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Editar</button>
                        <button type="button" class="btn btn-danger" onclick="limpiar_perfil()" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancelar</button>
                      </div>
                    </div>
                    <!--Fin Modal Content-->
                  </form>
                  <!--Fin Form PERFIL-->
                </div>
              </div>
              <!--FIN MODAL PERFIL-->

              <!--MODAL ADMIN -->
              <div id="adminverModal" class="modal fade">
                <div class="modal-dialog">
                  <!--Form Admin-->
                  <form>
                    <!--Modal Content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5>Listado de Administradores</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="table-responsive">
                          <table id="adminver_data" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                  <th>Id Admin</th>
                                  <th>Usuario</th>
                                </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                  <th>Id Admin</th>
                                  <th>Usuario</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                           </table>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <!--<input type="hidden" name="id_admin" id="id_admin"/>-->
                        <button class="btn btn-info btn-icon-split" data-dismiss="modal">
                          <span class="icon text-white-50">
                          <i class="fas fa-arrow-right"></i>
                          </span>
                          <span class="text">Salir</span>
                        </button>
                      </div>
                    </div>
                    <!--Fin Modal Content-->
                  </form>
                  <!--Fin Form Admin-->
                </div>
              </div>
              <!--FIN MODAL ADMIN-->

            </li>
            <!--Fin Nav Admin Informacion-->

          </ul>
          <!--Fin Navbar ADMIN-->

        </nav>
        <!-- End of Topbar -->

      </div>
      <!-- End of Main Content -->
      <script src="../public/vendor/jquery/jquery.min.js"></script>
      <script src="../public/alertify/alertify.min.js"></script>
      <!--<script src="../public/bootbox/bootbox.min.js"></script>-->
      <script src="../vistas/js/admin/perfil.js" type="text/javascript"></script>
    <!--Only Perful-->
    <script type="text/javascript">
    
    function NumText2(string){//solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890_-';//Caracteres validos
  
      for (var i=0; i<string.length; i++) //para i en 0
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
    }
  </script>
<?php
     
     } else {

        header("Location:".Conectar::ruta()."error.php");
        exit();
     }
  ?>