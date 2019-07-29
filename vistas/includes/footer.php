
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; BD-IO Company 2019 <a href="#terminos" data-toggle="modal">Terminos y Condiciones</a></span>
          </div>
        </div>
              <!-- Modal -->
      <div class="modal fade" id="terminos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" >Terminos y Condiciones</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <p>AL INSTALAR, COPIAR O, EN CUALQUIER CASO, UTILIZAR EL  SOFTWARE SE CONSIDERA QUE USTED ESTÁ DE ACUERDO CON LOS TÉRMINOS Y CONDICIONES DE ESTE DOCUMENTO.</p>
              
              <p>Los derechos de propiedad intelectual sobre el software, o «copyright», pertenecen exclusivamente a su autor o entidad que desarrollo dicho software.</p>

              <p>El usuario adquiere solamente el derecho a usarlo libremente en su sistema informático, con las únicas limitaciones que se detallan a continuación en este documento:</p>

              <p>RESPONSABILIDAD ANTE FALLAS</p>

              <p>En caso de contener la aplicación algún error, no se compromete a los daños directos o indirectos, consecuencia de la utilización o imposibilidad de utilización de la aplicación, incluida la pérdida de datos que eventualmente pudiera producirse con ocasión de, o en relación con, el uso del software autorizado.</p>

              <p>RESPONSABILIDAD SOBRE LOS DATOS</p>

              <p>La integridad y conservación de los ficheros de datos corre por cuenta exclusiva del usuario, quien deberá obtener y mantener una copia de seguridad por lo menos una vez al día.  Para facilitar la realización de copias se seguridad, el software centraliza todos los datos en el gestor de base de datos Mysql (<a href="http://localhost/phpmyadmin/db_export.php?db=bdarchivo">Copia de seguridad</a>).</p>

              <p>Ugel System Software mantendrá la estructura intacta por algun fallo al usarlo durante un año y podrán ser solicitados enviando un correo electrónico a juan_chuquiruna_100@hotmail.com .Cualquier solicitud enviada que no se comprometa con lo anteriormente mencionado este no será atendido.</p>

              <p>En caso que se solicite una mejora del software o solucionar un fallo donde el desarrollador pueda dar la solución de acuerdo a su criterio y el nivel del problema en lo posible se procederá a la solución caso, contrario no se compromete a dar con la solución.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../public/vendor/jquery/jquery.min.js"></script>

  <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!--Para el select--->
  <script src="../public/select/bootstrap-select.min.js"></script>    
  <!-- Custom scripts for all pages-->  

  <script src="../public/js/sb-admin-2.min.js"></script>
  
  <!-- Page level plugins -->
  <script src="../public/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!--Buttons datatables-->  
  <script src="../public/vendor/datatables/buttons/dataTables.buttons.min.js"></script>
  <script src="../public/vendor/datatables/buttons/buttons.bootstrap4.min.js"></script>
  <script src="../public/vendor/datatables/buttons/buttons.colVis.min.js"></script>
  <script src="../public/vendor/datatables/buttons/buttons.html5.min.js"></script>
  <script src="../public/vendor/datatables/buttons/buttons.print.min.js"></script>

  <script src="../public/vendor/datatables/buttons/jszip.min.js"></script>
  <script src="../public/vendor/datatables/buttons/pdfmake.min.js"></script>
  <script src="../public/vendor/datatables/buttons/vfs_fonts.js"></script>

  <!-- Page level custom scripts -->
  <script src="../public/js/demo/datatables-demo.js"></script>
  
  <!---<script src="../public/alertify/alertify.min.js"></script>--->
  <!--Para Datepicker-->
  <script src="../public/datepicker/bootstrap-datepicker.min.js"></script>

  <!--Script Admin-->
  <script src="../vistas/js/admin/adminver.js"></script>
  <!--Bootbox-->
  <!--Para las fechas-->
  <script type="text/javascript">

      $('#f_emision').datepicker({
      /*dateFormat: 'dd-mm-yy',
      autoclose: true*/
       format: "dd/mm/yyyy",
        clearBtn: true,
        todayHighlight: true,
        //language: "es",
        //autoclose: true,
        /*keyboardNavigation: false,*/
    })
      $('#f_entrega').datepicker({
      /*dateFormat: 'dd-mm-yy',
      autoclose: true*/
       format: "dd/mm/yyyy",
        clearBtn: true,
        todayHighlight: true,
        //language: "es",
        //autoclose: true,
        /*keyboardNavigation: false,*/
      });
      $('#f_recepcion').datepicker({
      /*dateFormat: 'dd-mm-yy',
      autoclose: true*/
        format: "dd/mm/yyyy",
        clearBtn: true,
        todayHighlight: true,
        //language: "es",
        //autoclose: true,
        /*keyboardNavigation: false,*/
      });
  </script>
  <!--Para el filtro de Contraseñas--> 
  <script type="text/javascript">
    
    function NumText(string){//solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890';//Caracteres validos
  
      for (var i=0; i<string.length; i++) //para i en 0
        if (filtro.indexOf(string.charAt(i)) != -1) 
        out += string.charAt(i);

      return out;
  }
  </script>
  <script type="text/javascript">

    $(document).ready(function () {

    $('#openBtn').click(function () {
        $('#usuariosModal').modal({
            show: true
        })
    });

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


  });
  </script>

  <script type="text/javascript">

    $(document).ready(function () {

    $('#openBtn').click(function () {
        $('#usuarios_detalle_Modal').modal({
            show: true
        })
    });

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


  });
  </script>
  <script type="text/javascript">

    $(document).ready(function () {

    $('#openBtn').click(function () {
        $('#resolucion_detalle_Modal').modal({
            show: true
        })
    });

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


  });
  </script>

</body>

</html>
