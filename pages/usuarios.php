<?php
  //Cargar sesion del usuario logueado
  session_start();
	if(!isset($_SESSION['autenticado'])){//Si no hay un usuario logueado, regresar al logueo**
    header("Location: ../index.php");

  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DCIT | Secador solar</title>

  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/home/logo-c.png"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php 
    include('components/encabezado.php')
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php 
    include('components/menu.php')
  ?>
  <!--  /.Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Gestión de usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button id="btnNuevoRegistro" type="button" class="btn btn-success mr-2">Nuevo usuario</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
      <div class="container-fluid">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de usuarios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaUsuarios" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre completo</th>
                    <th>Correo electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- FORMULARIOS MODALES-->
    <!-- REGISTRAR USUARIO -->
    <div class="modal fade" tabindex="1" id="registrarUsuario" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo usuario</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left input_mask need-validated" id="frmNuevoUsuario">
              <div class="form-group row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre(s)" maxlength="30">
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtApellido_pat" name="txtApellido_pat" placeholder="Apellido paterno" maxlength="30">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtApellido_mat" name="txtApellido_mat" placeholder="Apellido materno" maxlength="30">
                </div>
                <div class="col-sm-6">
                  <select class="form-control" id="selRol" name="selRol">
                    <option value="1">Administrador</option>
                    <option value="2">Supervisor</option>
                 </select>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="Correo electrónico" maxlength="30">
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="txtContrasena" name="txtContrasena" placeholder="Contraseña" maxlength="30">
                </div>
              </div> 
            </form>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-danger" id="btnCancelarUsuario">Cancelar</button>
            <button type="button" class="btn btn-success" id="btnGuardarUsuario">Registrar </button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL REGISTRAR USUARIO-->     

    <!-- EDITAR USUARIO -->
    <div class="modal fade" tabindex="1" id="editarUsuario" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar usuario</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left input_mask need-validated" id="frmEditarUsuario">
              <div class="form-group">
                <!--
                  <label for="txtIdEventoE">ID</label>
                -->
                <input type="hidden" class="form-control" id="txtIdE" name="txtIdE" readonly>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtNombreE" name="txtNombreE" placeholder="Nombre(s)" maxlength="30">
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtApellido_patE" name="txtApellido_patE" placeholder="Apellido paterno" maxlength="30">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtApellido_matE" name="txtApellido_matE" placeholder="Apellido materno" maxlength="30">
                </div>
                <div class="col-sm-6">
                  <select class="form-control" id="selRolE" name="selRolE">
                    <option value="1">Administrador</option>
                    <option value="2">Supervisor</option>
                 </select>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="email" class="form-control" id="txtCorreoE" name="txtCorreoE" placeholder="Correo electrónico" maxlength="30">
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="txtContrasenaE" name="txtContrasenaE" placeholder="Contraseña" maxlength="30">
                </div>
              </div> 
            </form>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-danger" id="btnCancelarUsuarioE">Cancelar</button>
            <button type="button" class="btn btn-success" id="btnGuardarUsuarioE">Guardar </button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL EDITAR USUARIO-->     
      
    <!-- VISUALIZAR USUARIO -->
    <div class="modal fade" tabindex="1" id="visualizarUsuario" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Visualizar usuario</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left input_mask need-validated" id="frmVisualizarUsuario">
              <div class="form-group row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtNombreV" name="txtNombreV" placeholder="Nombre(s)" maxlength="30" readonly>
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtApellido_patV" name="txtApellido_patV" placeholder="Apellido paterno" maxlength="30" readonly>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtApellido_matV" name="txtApellido_matV" placeholder="Apellido materno" maxlength="30" readonly>
                </div>
                <div class="col-sm-6">
                  <select class="form-control" id="selRolV" name="selRolV" readonly>
                    <option value="1">Administrador</option>
                    <option value="2">Supervisor</option>
                 </select>
                </div>
              </div> 
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="email" class="form-control" id="txtCorreoV" name="txtCorreoV" placeholder="Correo electrónico" maxlength="30" readonly>
                </div>
              </div> 
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnCerrarUsuarioV">Cerrar </button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL VISUALIZAR USUARIO-->   
  <!-- FIN FORMULARIOS MODALES -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Sweet Alert -->
<script src="../dist/js/sweetalert2.all.min.js"></script>
<!-- Funciones de la gestión de usuarios -->
<script src="../dist/js/pages/usuarios.js"></script>
<style>
.confirm-button-class {
  margin-left: 15px;
}

.cancel-button-class {
  margin-right: 15px;
}
</style>

</body>
</html>
