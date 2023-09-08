<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Nueva Contraseña <i class="bi bi-shield-lock-fill"></i></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Mi Perfil <i class="bi bi-person"></i></li>
        <li class="breadcrumb-item active">Nueva Contraseña <i class="bi bi-shield-lock"></i></li>
      </ol>
    </nav>
  </div>

  <section class="section profile">
    <div class="row">

      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-5 d-flex flex-column align-items-center">
            <img src="<?php echo URLROOT; ?>/img/login1.gif" alt="Profile" class="rounded-circle">
            <h2>Perfil de Usuario <i class="bi bi-person"></i> </h2>
            <h3>Sistema SOS <i class="bi bi-person-vcard"></i> </h3> 
            <?php if ($_SESSION['user_sede']== "Peru") { ?>
              <img src="<?php echo URLROOT; ?>/img/peru.png" />
                <?php } else { ?>
              <img src="<?php echo URLROOT; ?>/img/chile.png" />
            <?php } ?>
            <h3><b>CLONSA INGENIERIA <i class="bi bi-trophy-fill"></i></b> </h3>
            <h3 class="text-center">Sus desafíos nuestra inspiración <i class="bi bi-globe-americas"></i> </h3> 
            <div class="social-links mt-2">
              <a href="" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
            <p></p>
            <h3>All Rights Reserved <i class="bi bi-shield-lock-fill"></i> </h3> 
          </div>
        </div>

      </div>

      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">New Contraseña <i class="bi bi-gear-fill"></i> </button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Seguridad <i class="bi bi-tools"></i> </button>
              </li>
            </ul>

            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <form action="" method="post">
                  <div class="alert alert-warning  alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading text-center"><b> ¡ IMPORTANTE ! </b></h4>
                    <p>Estimado Usuario <b> " <?php echo $_SESSION['user_nombre']; ?> "</b>, esta sección es para crear una nueva contraseña o cambiar su contraseña actual del Sistema de Orden de Servicio SOS.</p>
                    <hr>
                    <p class="mb-0 text-center"> <b>Notificación de Área TI Clonsa </b> </p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                      
                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Nueva Contraseña</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce Contraseña" required autocomplete="off">
                      <div class="valid-tooltip">Correcto</div>
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label for="password_confirm" class="col-md-4 col-lg-3 col-form-label">Confirmar Contraseña</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password_confirm" type="password" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Repetir Contraseña" required autocomplete="off">
                      <div class="valid-tooltip">Correcto</div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="invalidCheck3" required>
                      <label class="form-check-label" for="invalidCheck3">
                          Acepto los cambios realizados, bajo mi Responsabilidad de mi Cuenta.
                      </label>
                      <div class="invalid-feedback">
                          Por favor, acepta los Términos y Condiciones.
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar Cambios <i class="bi bi-person-fill"></i></button>
                  </div>
                </form>
              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Notificaciones</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="changesMade" checked>
                      <label class="form-check-label" for="changesMade">
                        Inicio de Sesión
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="newProducts" checked>
                      <label class="form-check-label" for="newProducts">
                        Ordenes de Servicios Solicitadas
                      </label>
                    </div>
                    
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                      <label class="form-check-label" for="securityNotify">
                        Alertas de Seguridad Clonsa S.A.C
                      </label>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

</main>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/_modal_alert.php'; ?>

<script src="<?php echo URLROOT; ?>/js/_modal_alert.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>