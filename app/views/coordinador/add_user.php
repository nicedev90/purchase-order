<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Nuevo Usuario <i class="bi bi-person-check-fill"></i></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Crear Nuevo Usuario <i class="bi bi-person-fill-add"></i></li>
            </ol>
        </nav>
    </div>

<section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-5 d-flex flex-column align-items-center">
              <img src="<?php echo URLROOT; ?>/img/login1.gif" alt="Profile" class="rounded-circle">
              <h2>Nuevo Usuario<i class="bi bi-person-fill-add"></i> </h2>
              <h3>Sistema SOS <i class="bi bi-person-vcard"></i> </h3> 
              <?php if ($_SESSION['user_sede']== "Peru") { ?>
                <img src="<?php echo URLROOT; ?>/img/peru.png" />
                  <?php } else { ?>
                <img src="<?php echo URLROOT; ?>/img/chile.png" />
              <?php } ?>
              <h3><b>CLONSA INGENIERIA <i class="bi bi-shield-lock-fill"></i></b> </h3>
              <h3>Sus desafíos nuestra inspiración <i class="bi bi-globe-americas"></i> </h3> 

              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Nuevo Usuario <i class="bi bi-person-plus-fill"></i> </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Configuración <i class="bi bi-tools"></i> </button>
                </li>

                

              </ul>
              <div class="tab-content pt-2">

    <!-- EMPIEZAAAAAA -->

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <form action="<?php echo URLROOT ?>/coordinadores/add_user" method="post">
                <input type="hidden" name="sede_id" value="<?php echo ($_SESSION['user_sede'] == 'Peru') ? 1 : 2; ?>">
                    
                    <div class="row mb-3">
                      <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombres</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombre" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce Nombres Completos" required autocomplete="off">
                        <div class="valid-tooltip">Correcto</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario" class="col-md-4 col-lg-3 col-form-label">Usuario</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="usuario" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce Nuevo Usuario" required autocomplete="off">
                        <div class="valid-tooltip">Correcto</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">Contraseña</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce contraseña" required autocomplete="off">
                        <div class="valid-tooltip">Correcto</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Correo Electrónico</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce Correo Electrónico" required autocomplete="off">
                        <div class="valid-tooltip">Correcto</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="validationTooltip04" class="col-md-4 col-lg-3 col-form-label">Rol de Usuario</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="rol_id" class="form-select" required>
                            <option selected disabled value="">Selecciona...</option> 
                            <?php foreach($data['roles'] as $rol): ?>
                                <option value="<?php echo $rol->id; ?>"> <?php echo $rol->rol; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-tooltip">
                            Por favor selecciona el Rol de Usuario
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="validationTooltip04" class="col-md-4 col-lg-3 col-form-label">Función</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="funcion" class="form-select" required>
                            <option selected disabled value="">Selecciona...</option> 
                            <option value="Normal"> Normal</option>
                            <option value="Revisor"> Revisor</option>
                        </select>
                        <div class="invalid-tooltip">
                            Por favor selecciona la función de Usuario
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="validationTooltip04" class="col-md-4 col-lg-3 col-form-label">Estado</label>
                      <div class="col-md-8 col-lg-9">
                      <select name="estado" class="form-select" required>
                        <option selected disabled value="">Selecciona...</option> 
                        <option value="Activo"> Activo</option>
                        <option value="Inactivo"> Inactivo</option>
                      </select>
                        <div class="invalid-tooltip">
                            Por favor selecciona el Estado del Usuario
                        </div>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck3" required>
                            <label class="form-check-label" for="invalidCheck3">
                                Acepto los cambios realizados, bajo mi Responsabilidad de Coordinador.
                            </label>
                            <div class="invalid-feedback">
                                Por favor, acepta los Términos y Condiciones.
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Crear Usuario <i class="bi bi-person-fill"></i></button>
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
              </div><!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
