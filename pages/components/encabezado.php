  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-lg"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Recordatorios Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell fa-lg"></i>
            <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div id="recordatorios-lista"></div>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer" id="marcar-todos-leidos">Marcar todos como leídos</a>
        </div>
      </li>
      <!-- User dropdown menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $_SESSION['imagen'];?>" class="user-image img-circle elevation-1" alt="User Image">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-dark">
            <img src="<?php echo $_SESSION['imagen'];?>" class="img-circle elevation-2" alt="User Image">
            <p>
              <?php echo $_SESSION['nombre'], " ", $_SESSION['apellido_pat'], " ", $_SESSION['apellido_mat'];?>
              <?php if($_SESSION['rol'] == 1){
                echo "<small>Administrador</small>";
              }elseif($_SESSION['rol'] == 2){
                echo "<small>Supervisor</small>";
              }?>
            </p>
          </li>
          <!-- Menu Body -->
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="../controladores/ctrl_cerrarSesion.php" class="btn btn-default btn-flat float-right">Cerrar sesión</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../dist/js/pages/recordatorios.js"></script>