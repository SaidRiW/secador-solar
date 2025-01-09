<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <title>DCIT | Secador solar</title>
    <meta charset="UTF-8">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="dist/css/sweetalert2.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/home/logo-c.png">
  </head>
  <body class="hold-transition login-page" style="background-image: url('assets/images/home/banner-login-img.png'); background-size: cover; background-position: center; background-color: rgba(0, 0, 0, .8); background-blend-mode: overlay; height: 100vh; width: 100%;">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <a type="button" class="btn bg-olive btn-sm w-25" href="./index.php">Regresar</a>
      <hr>
      <div class="login-logo">
        <img class="img-fluid w-25" src="assets/images/home/logo-c.png" alt="Logo">
        <hr>
        <h5 style="color: black"><b>Inicio de sesión</b></h5>
      </div>
      <!-- /.login-logo -->
      <form class="login-form" id="frmLogin" method="post">
        <div class="input-group mb-3">
          <input type="text" id="correo" name="correo" class="form-control" placeholder="Correo electrónico">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña" onkeypress="handleKeyPress(event)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row w-25 mx-auto">
            <button type="button" id="entrarSistema" class="btn bg-olive btn-block">Ingresar</button>
          <!-- /.col -->
        </div>
      </form>  
  </div>
</div>
<!-- /.login-box -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Sweet Alert -->
    <script src="dist/js/sweetalert2.all.min.js"></script>
    <!-- Funciones del login -->
    <script src="dist/js/pages/login.js"></script>
    <!-- Activar el botón Ingresar al dar Enter en el teclado -->
    <script>
    function handleKeyPress(event) {
      if (event.keyCode === 13) {
        document.getElementById("entrarSistema").click();
      }
    }
    </script>
  </body>
</html>