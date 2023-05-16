<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Áreas de Aprobación <i class="bi bi-check-circle"></i></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Configuración <i class="bi bi-globe2"></i> </li>
            </ol>
        </nav>
    </div>

<!-- EDITAR REVISION TIPO FONDO-->

    <section class="section">
        
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Áreas Tipo <b>FONDO</b> <i class="bi bi-coin"></i> </h5>
              <p>La presente información mostrada es para editar las áreas de las Ordenes de Servicio Tipo <b>FONDO</b>  requeridos, quienes estan bajo responsabilidad. </p>

              <!-- EDITAR TIPO FONDO -->
              <form class="row g-3 needs-validation" action="<?php echo URLROOT ?>/coordinadores/edit_revision" method="post" novalidate >
                <div class="col-12 position-relative">
                    <div class="row my-3 col-12 col-md-6 mx-auto">
                        <?php submitAlert(); ?>
                    </div>
                  <input type="hidden" name="tipo_fondo" value="<?php echo $data['areas'][0]->tipo ?>">

                  <label for="validationTooltip01" class="form-label"><b>1° Área Supervisora</b></label>
                  <input name="area_fondo_1" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][0]->area_1 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo 1" required autocomplete="off">
                  <div class="valid-tooltip">
                    Correcto!
                  </div>
                </div>

                <div class="col-12 position-relative">
                    <input type="hidden" name="tipo_fondo" value="<?php echo $data['areas'][0]->tipo ?>">
                  <label for="validationTooltip01" class="form-label"> <b>2° Área Supervisora</b></label>
                  <input name="area_fondo_2" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][0]->area_2 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo 2" required autocomplete="off">
                  <div class="valid-tooltip">
                    Correcto!
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                      Acepto los cambios realizados, bajo mi Responsabilidad de Coordinador.
                    </label>
                    <div class="invalid-feedback">
                      Por favor, acepta los Términos y Condiciones.
                    </div>
                  </div>
                </div>

                <div class="col text-center">
                    <button name="btn_fondo" type="submit" class="btn btn-primary">
                     <i class="bi bi-send-check-fill"></i> Guardar Cambios
                    </button>
                </div>
              </form><!-- FIN EDITAR TIPO FONDO -->
            </div>
          </div>

        </div>

        <!-- EDITAR REVISION TIPO COMPRA-->

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Áreas Tipo <b>COMPRA</b> <i class="bi bi-clipboard2-check-fill"></i></h5>
              <p>La presente información mostrada es para editar las áreas de las Ordenes de Servicio Tipo <b>COMPRA</b>  requeridos, quienes estan bajo responsabilidad. </p>

            <!-- EDITAR TIPO COMPRA -->
            <form class="row g-3 needs-validation" action="<?php echo URLROOT ?>/coordinadores/edit_revision" method="post" novalidate >
                <div class="col-12 position-relative">
                    <input type="hidden" name="tipo_compra" value="<?php echo $data['areas'][1]->tipo ?>">
                  <label for="validationTooltip01" class="form-label"><b>1° Área Supervisora</b></label>
                  <input name="area_compra_1" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][1]->area_1 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo 1" required autocomplete="off">
                  <div class="valid-tooltip">
                    Correcto!
                  </div>
                </div>

                <div class="col-12 position-relative">
                    <input type="hidden" name="tipo_fondo" value="<?php echo $data['areas'][0]->tipo ?>">
                  <label for="validationTooltip01" class="form-label"> <b>2° Área Supervisora</b></label>
                  <input name="area_compra_2" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][1]->area_2 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo 2" required autocomplete="off">
                  <div class="valid-tooltip">
                    Correcto!
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                    <label class="form-check-label" for="invalidCheck2">
                      Acepto los cambios realizados, bajo mi Responsabilidad de Coordinador.
                    </label>
                    <div class="invalid-feedback">
                      Por favor, acepta los Términos y Condiciones.
                    </div>
                  </div>
                </div>

                <div class="col text-center">
                    <button name="btn_compra" type="submit" class="btn btn-primary">
                     <i class="bi bi-send-check-fill"></i> Guardar Cambios
                    </button>
                </div>
              </form><!-- FIN EDITAR TIPO COMPRAAAAAA -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
