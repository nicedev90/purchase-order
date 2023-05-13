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
        <div class="col-xl-6">

          <div class="card">
            <div class="card-body profile-card  align-items-center">
              <h2>Unidades actuales</h2>
              <?php foreach($data['unidades'] as $unidad) : ?>
                <div class="col-md-6 d-flex justify-content-between align-items-center">
                  <div class="col-md-8 card-title bg-info p-2">
                    <?php echo $unidad->unidad ?>
                  </div>

                  <div class="col-md-4 p-2 fw-bold  rounded text-center">
                    <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_unidad_<?php echo $unidad->id ?>"><i class="bi bi-trash3-fill"></i></a>
                    <?php require APPROOT . '/views/coordinador/partials/modal_delete_unidad.php'; ?>
                  </div>
                </div>
                
              <?php endforeach; ?>
            </div>
          </div>

        </div>

        <div class="col-xl-6">

          <div class="card">
            <form action="<?php echo URLROOT ?>/coordinadores/edit_unidad" method="post" class="p-4">
              <input type="hidden" name="sede" value="<?php echo $_SESSION['user_sede']; ?>">
                
              <div class="row mb-3">
                <label for="unidad" class="col-md-4 col-lg-3 col-form-label">unidad</label>
                <div class="col-md-8 col-lg-9">
                  <input name="unidad" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce unidad" required autocomplete="off">
                  <div class="valid-tooltip">Correcto</div>
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
                <button type="submit" name="add_unidad" class="btn btn-primary"> Agregar unidad</button>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
