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
        <a href="<?php echo URLROOT  . '/' . $data['controller'] . '/registros'?>">
          <i class="bi bi-circle"></i><span>Actividad de sesión</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

  


  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Guía de Usuario</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php echo URLROOT . '/' . $data['controller'] . '/guia_compra'?>">
          <i class="bi bi-circle"></i><span>Compra</span>
        </a>
      </li>
      <li>
        <a href="<?php echo URLROOT . '/' . $data['controller'] . '/guia_fondos'?>">
          <i class="bi bi-circle"></i><span><?php echo ($_SESSION['user_sede'] == 'Peru') ? 'Caja Chica' : 'Fondos' ?></span>
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
      <i class="bi bi-person"></i>
      <span>Versión</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT . '/' . $data['controller'] . '/reportes_cc'?>">
      <i class="bi bi-person"></i>
      <span>Reportes Minas</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo URLROOT . '/' . $data['controller'] . '/reportes_user'?>">
      <i class="bi bi-person"></i>
      <span>Reportes Usuario</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <p></p>
  



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