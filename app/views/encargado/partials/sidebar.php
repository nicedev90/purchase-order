<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
          <a class="nav-link " href="<?php echo URLROOT; ?>/usuarios/index">
            <i class="bi bi-grid"></i>
            <span>Dashboard </span>
            <p class="text-light">text-light</p>
              <?php if ($_SESSION['user_sede']== "Peru") { ?>
                  <img src="<?php echo URLROOT; ?>/img/chullo.png" width="40" height="40"/>
                    <?php } else { ?>
                  <img src="<?php echo URLROOT; ?>/img/bandera_chile.png" width="40" height="40"/>
              <?php } ?>
          </a>
  </li>


  <li class="nav-heading">CONSULTA TUS ORDENES DE SERVICIO</li>


  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Historial</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php echo URLROOT . '/' . $data['controller'] . '/historial'?>">
          <i class="bi bi-circle"></i><span>Consultar OS</span>
        </a>
      </li>
      <li>
        <a href="<?php echo URLROOT . '/' . $data['controller'] . '/registros'?>">
          <i class="bi bi-circle"></i><span>Actividad de sesión</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->



  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Información</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="informacion/informacion_pe.php">
          <i class="bi bi-circle"></i><span>Contactos Perú</span>
        </a>
      </li>
      <li>
        <a href="informacion/informacion_cl.php">
          <i class="bi bi-circle"></i><span>Contactos Chile</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->

  <li class="nav-heading">CONFIGURACIÓN</li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Configura tu cuenta</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="configuracion/general.php">
          <i class="bi bi-circle"></i><span>General</span>
        </a>
      </li>
      <li>
        <a href="configuracion/seguridad.php">
          <i class="bi bi-circle"></i><span>Seguridad</span>
        </a>
      </li>
    </ul>
  </li><!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="version/version.php">
      <i class="bi bi-person"></i>
      <span>Versión</span>
    </a>
  </li><!-- End Profile Page Nav -->

   <!-- Privilegios Inventario Perú -->
 

  <li class="nav-heading">REGISTRO DE INVENTARIO</li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-gem"></i></i><span>Inventario Perú</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="inventario_pe/new_inventario_pe.php">
          <i class="bi bi-circle"></i><span>Nuevo Inventario</span>
        </a>
      </li>
      <li>
        <a href="inventario_pe/tabla_pe.php">
          <i class="bi bi-circle"></i><span>Tabla de Inventario</span>
        </a>
      </li>
      <li>
        <a href="inventario_pe/historial_pe.php">
          <i class="bi bi-circle"></i><span>Historial</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->

  <!-- Privilegios -->
    <li class="nav-heading">REGISTRO DE INVENTARIO</li>
    
    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gem"></i><span>Inventario Chile</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="inventario_cl/new_inventario_cl.php">
          <i class="bi bi-circle"></i><span>Nuevo Inventario</span>
        </a>
      </li>
      <li>
        <a href="inventario_cl/tabla_cl.php">
          <i class="bi bi-circle"></i><span>Tabla de Inventario</span>
        </a>
      </li>
      <li>
        <a href="inventario_cl/historial_cl.php">
          <i class="bi bi-circle"></i><span>Historial</span>
        </a>
      </li>
    </ul>
  </li><!-- End Icons Nav -->

  <!-- Privilegios -->

  <li class="nav-heading">LISTA DE USUARIOS</li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="tabla_usuario/tabla_usuario.php">
      <i class="bi bi-card-list"></i>
      <span>Tabla de Usuario</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="tabla_usuario/desarrollo_software.php">
      <i class="bi bi-file-earmark"></i>
      <span>Desarrollo de Software</span>
    </a>
  </li><!-- End Blank Page Nav -->

</ul>

</aside><!-- End Sidebar-->