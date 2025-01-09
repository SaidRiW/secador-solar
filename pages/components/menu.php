  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-success elevation-1">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../assets/images/home/logo-c.png" alt="Logo" class="brand-image img-circle elevation-1">
      <span class="brand-text font-weight-light">DCIT | Secador solar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="historicos.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Registros históricos
              </p>
            </a>
          </li>
          <?php  
            if($_SESSION['rol']== 1){
          ?>
          <li class="nav-item">
            <a href="usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gestión de usuarios
              </p>
            </a>
          </li>
          <?php 
            } 
          ?> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var url = window.location.href; // Obtiene la URL actual
      
      // Itera sobre cada enlace del menú
      var links = document.querySelectorAll('.nav-sidebar a');
      links.forEach(function(link) {
        if (link.href === url) {
          link.classList.add('active'); // Agrega la clase 'active' al enlace correspondiente
        }
      });
    });
  </script>