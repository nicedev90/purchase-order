<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="<?php echo URLROOT . '/' . $data['controller'] . '/index'?>">
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

  <li class="nav-heading">CONFIGURACIÓN CENTRO DE COSTOS</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_cc'?>">
      <i class="bi bi-universal-access"></i>
      <span>AGREGAR / ELIMINAR CENTRO</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-heading">CONFIGURACIÓN CATEGORÍA</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_categoria'?>">
      <i class="bi bi-universal-access"></i>
      <span>AGREGAR / ELIMINAR CATEGORIA</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-heading">CONFIGURACIÓN UNIDAD</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_unidad'?>">
      <i class="bi bi-universal-access"></i>
      <span>Unidad</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-heading">CONFIGURACIÓN REPORTE PDF</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT  . '/' . $data['controller'] . '/edit_revision'?>">
      <i class="bi bi-receipt-cutoff"></i>
      <span>Áreas de Revisión</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-heading">REGISTROS DE ACCESOS</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT  . '/' . $data['controller'] . '/registros'?>">
      <i class="bi bi-receipt-cutoff"></i>
      <span> ACCESOS AL SISTEMA </span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-heading">CONFIGURACIÓN DE USUARIOS</li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-person"></i><span>Usuario</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php echo URLROOT  . '/' . $data['controller'] . '/add_user'?>">
          <i class="bi bi-circle"></i><span>Agregar Usuario</span>
        </a>
      </li>
      <li>
        <a href="<?php echo URLROOT  . '/' . $data['controller'] . '/edit_user'?>">
          <i class="bi bi-circle"></i><span>Tabla de Usuarios </span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->


  <li class="nav-heading">CONFIGURACIÓN MI CUENTA</li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-rocket-takeoff-fill"></i><span>Mi Cuenta</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php echo URLROOT . '/' . $data['controller'] . '/config_general'?>">
          <i class="bi bi-circle"></i><span>General</span>
        </a>
      </li>
      <li>
        <a href="<?php echo URLROOT . '/' . $data['controller'] . '/config_seguridad'?>">
          <i class="bi bi-circle"></i><span>Seguridad</span>
        </a>
      </li>
    </ul>
  </li><!-- End Forms Nav -->

  <li class="nav-heading">INFORMACIÓN</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT . '/' . $data['controller'] . '/version'?>">
      <i class="bi bi-android"></i>
      <span>Versión</span>
    </a>
  </li><!-- End Profile Page Nav -->




  <!-- Card with an image on top -->
  <div class="card">
    <img src="<?php echo URLROOT; ?>/img/contac.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <h5 class="card-title text-center">CONTACTO ADMINISTRADOR</h5>
        <p class="card-text">Si el sistema presenta errores, por favor informar a la brevedad para la solución inmediata a Soporte TI</p>
      </div>
  </div><!-- End Card with an image on top -->

</ul>

</aside><!-- End Sidebar-->