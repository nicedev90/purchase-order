<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">
  <!-- breadcrumb section -->
  <div class="pagetitle">
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active"><?= $data['pagename'] ?></li>
      </ol>
    </nav>
  </div>
 
<section class="section dashboard">
  <div class="row">

    <!-- ======= INICIO FORMULARIO ======= -->
    <div class="card">
      <div class="card-body">

        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-md-5 d-flex justify-content-between align-items-center">
            <div class="col-md-8 card-title"> Reportes Por Mes</div>
          </div>
        </div>

        <!-- FILA 1  mina - categoria -->
        <div class="row justify-content-md-around align-items-center "> 
          <input type="hidden" name="currentMonth" value="<?php echo date("m") ?>">

          <div class="col-md-6">

            <input type="text" class="form-control form-control-sm text-center" id="filterInput" placeholder="Buscar por nombre">

            <label for="validationTooltip04" class="form-label">Lista de Usuarios</label>
            <select name="user" class="form-select" id="usuarios" required>
              <option value="">Selecciona...</option> 
              <?php foreach($data['usuarios'] as $user): ?>
                <option class="user-item" value="<?php echo $user->usuario; ?>"> <?php echo $user->nombre; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
          </div>

          <div class="col-md-6 mt-4 mt-md-0">
            <label for="validationTooltip04" class="form-label">Seleccionar Mes</label>
            <select name="mes" class="form-select" id="mes" required>
              <option selected disabled value="">Selecciona...</option> 
              <?php foreach($data['meses'] as $numero => $mes): ?>
                <option value="<?php echo $numero ?>"> <?php echo $mes ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona mes</div>
          </div>

        </div>

        <!-- FILA 2 BOTON DE ENVIAR -->
        <div class="row">
          <div class="row col-12 col-md-4 mt-5 mx-auto">
            <button id="btn_compra" data-tipo="compra" data-method="<?= strtolower($data['pagename']) ?>" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" class="p-2 fw-bold btn btn-primary" > REPORTE COMPRA </button>
          </div>

          <div class="row col-12 col-md-4 mt-5 mx-auto">
            <button id="btn_fondos" data-tipo="fondos" data-method="<?= strtolower($data['pagename']) ?>" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" class="p-2 fw-bold btn btn-primary" > REPORTE <?php echo ($_SESSION['user_sede'] == 'Peru') ? 'CAJA CHICA' : 'FONDOS' ?> </button>
          </div>
        </div>
        
      </div>
    </div>
    <!-- ======= FIN FORMULARIO ======= -->

    <!-- Inicio tabla resumen Ordenes -->
    <pre><?php print_r($data) ?></pre>


    <?php if (isset($data['dataUser']) && strtoupper($data['dataUser'][0]->tipo) == 'FONDOS') : ?>

    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <h5 class="card-title">Reporte de <?php echo ($_SESSION['user_sede'] == 'Peru') ? 'CAJA CHICA' : 'FONDOS' ?> :<?php echo $data['dataUser'][0]->nombre_user ?>
            <a  href="<?php echo URLROOT . '/' . $data['controller'] . '/reporte_pdfuser/' . $data['mes'] ?>" target="_blank" class="p-2 fw-bold btn btn-primary" > GENERAR REPORTE Fondos </a>
          </h5>
          <div class="col-md-4">
            <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
          </div>
          <h5 class="card-title"> Mes : <?php echo fixedMes($data['dataUser'][0]->actualizado) ?></h5>
          <table class="table table-hover table-borderless datatable">
            <thead>
              <tr>
              <th scope="col">N°</th>
              <th scope="col">Mina </th>
              <th scope="col" class="d-none d-md-table-cell">Categoria</th>
              <th scope="col" class="d-none d-md-table-cell">Creado por</th>
              <th scope="col" class="d-none d-md-table-cell">Monto</th>
              <th scope="col">Estado</th>
              <th scope="col" class="d-none d-md-table-cell">Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['dataUser'] as $orden): ?>            <tr>
                <td class="fw-bold"><?php echo utf8_encode($orden->num_os); ?></th>
                
                <td class="text-primary"><?php echo utf8_encode($orden->mina_nom); ?></td>
                <td class="text-primary"><?php echo utf8_encode($orden->categ_nom); ?></td>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->usuario); ?></th>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->valor_total); ?></th>

                <td>
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <span class="<?= bgAprobado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php elseif (strtoupper($orden->estado) == 'RECHAZADO') : ?>
                    <span class="<?= bgRechazado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php else: ?>
                    <span class="<?= bgEnProceso() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php endif; ?>
                  
                </td>
                <td class="d-none d-md-table-cell"><?php echo fixedFecha($orden->creado); ?></td>

                  
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>


    <?php if (isset($data['tipo'])  && strtoupper($data['tipo']) == 'COMPRA') : ?>

    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">

          <?php if (isset($data['reporte'][0]->mina_nom)) : ?>

          <div class="row d-md-flex justify-content-md-start justify-content-around align-items-center card-title ">
            <div class="d-flex col-md-4 py-2 justify-content-start ">
              <div class="col-md-6"> Reporte Mina : </div>
              <div class="col-md-6 p-1 fw-bold btn btn-warning"> <?= $data['reporte'][0]->mina_nom; ?></div>
            </div>

            <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
              <div class="col-md-6 p-1 <?= bgFondos() ?>"> <?=  fixedMes($data['reporte'][0]->actualizado) ?></div>
              <div class="col-md-6 p-1 <?= bgFondos() ?>"> <?=  setName($data['reporte'][0]->tipo) ?></div>
            </div>

            <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
              <div class="col-md-4">Imprimir : </div>
              <a  href="<?php echo URLROOT . '/' . $data['controller'] . '/reporte_pdf/' . strtoupper($data['tipo']) . '/' . $data['mina'] . '/' . $data['mes'] ?>" target="_blank" class="p-2 btn btn-danger" ><i class="bi bi-file-earmark-pdf"></i> Descargar PDF </a>
            </div>

          </div>

          <?php endif; ?>

          <table class="table table-hover table-borderless datatable">
            <thead>
              <tr>
              <th scope="col">N°</th>
              <th scope="col">Mina </th>
              <th scope="col" class="d-none d-md-table-cell">Creado por</th>
              <th scope="col" class="d-none d-md-table-cell">Monto</th>


              <th scope="col">Estado</th>
              <th scope="col" class="d-none d-md-table-cell">Fecha</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach($data['reporte'] as $orden): ?>            <tr>
                <td class="fw-bold"><?php echo utf8_encode($orden->num_os); ?></th>


                
                <td class="text-primary"><?php echo utf8_encode($orden->mina_nom); ?></td>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->usuario); ?></th>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->valor_total); ?></th>

                <td>
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <span class="<?= bgAprobado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php elseif (strtoupper($orden->estado) == 'RECHAZADO') : ?>
                    <span class="<?= bgRechazado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php else: ?>
                    <span class="<?= bgEnProceso() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php endif; ?>
                  
                </td>
                <td class="d-none d-md-table-cell"><?php echo fixedFecha($orden->creado); ?></td>

                  
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>



</section>

</main><!-- End #main -->

<!-- warning Modal -->
<div class="modal fade" id="warning_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        falta llenar camposs
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->

<div class="modal fade" id="<?= createdAlert() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        LA ORDEN SE CREO CON EXITO
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>






<script src="<?php echo URLROOT; ?>/js/reportes_user.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>