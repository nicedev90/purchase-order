  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?php echo URLROOT . '/' . $data['controller'] . '/index'?>" class="logo d-flex align-items-center">
      <div class="nav-item" ></div>  
      <span class="d-none d-lg-block">Clonsa Ingeniería <img src="<?php echo URLROOT; ?>/img/l1.png" ></span>
        
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>

    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>

        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-cast"></i>
            <span class="badge bg-primary badge-number">1</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

            <li class="dropdown-header">
             Tutorial Orden de Servicio Clonsa 
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver Aquí</span></a>
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4><b> Cuenta Activa</b></h4>
                <p><b> Bajo Aprobación Directa. </b></p>
                
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4><b> Formulario de Orden de Servicio </b></h4>
                <p><b> Llenar correctamente los datos. </b></p>
              
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4><b> No Compartir Credenciales </b></h4>
                <p><b> Prohibido compartir usuario y contraseña. </b></p>
                
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4><b> Soporte Técnico</b></h4>
                <p><b> Para soporte técnico, <a href="mailto:admin@clonsaingenieria.cl?Subject=Soporte%20Técnico%20Sistema%20SOS"> click AQUI.</a></b></p>
                <a href=""></a>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Notificaciones TI - SOS</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">1</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              Contacto Soporte TI - Clonsa
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Verificado</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="<?php echo URLROOT; ?>/img/usuario3.png" alt="" class="rounded-circle">
                <div>
                  <h4>Jack Tuñoque</h4>
                  <p>Enlaces de Contacto</p>
                  <p></p>
                </div>
              </a>
              <div class="btn-group align-center" role="group" aria-label="Basic outlined example" >
                <b><p class=text-dark> Clonsa SOS</p></b>
                  <div class="btn-group pt-4"  role="group" aria-label="Basic outlined example">
                        <a href="https://wa.link/sh0yao">
                          <button type="button" class="btn btn-outline-success">1 <i class="bi bi-whatsapp"></i></button>
                        </a>
                        <a href="mailto:admin@clonsaingenieria.cl?Subject=Soporte%20Técnico%20Sistema%20SOS">
                          <button type="button" class="btn btn-outline-danger">2 <i class="bi bi-google"></i></button>
                        </a>
                        <a href="https://t.me/Jack_Rick">
                          <button type="button" class="btn btn-outline-primary">3 <i class="bi bi-telegram"></i></button>
                        </a>
                  </div>
              </div>
              <b><p class=text-dark t> Enlace QR</p></b>
              <div class="text-center" >
                <img src="<?php echo URLROOT; ?>/img/qr.png" alt="">
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Notificaciones TI - SOS</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo URLROOT; ?>/img/clonsa.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php echo $_SESSION['user_nombre']; ?> 
              <?php if ($_SESSION['user_sede']== "Peru") { ?>
                <img src="<?php echo URLROOT; ?>/img/peru.png" />
                  <?php } else { ?>
                <img src="<?php echo URLROOT; ?>/img/chile.png" />
              <?php } ?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['user_nombre']; ?>
                    
              </h6>
              <span class="badge rounded-pill bg-success"> 
                <?php echo $_SESSION['user_rol'] . '  ' . $_SESSION['user_sede']; ?>
              </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Mi Perfil </span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Configuración</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Versión</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo URLROOT; ?>/pages/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar Sesión</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->