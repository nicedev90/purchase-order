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
          <h1 class="pt-4 text-center">Reportes de caja chica</h1>
          <div class="col-md-5 d-flex justify-content-between align-items-center">

            <div class="col-md-8 card-title"> Ingresar criterios de busqueda </div>
          </div>
        </div>

        <!-- FILA 1  mina - categoria -->
        <div class="row justify-content-md-around align-items-end "> 
          <input type="hidden" name="currentMonth" value="<?php echo date("m") ?>">

          <div class="col-md-4">
            <label for="validationTooltip04" class="form-label">Seleccionar Centro de Costo</label>
            <select name="mina" class="form-select" id="mina" required>
              <option selected disabled value="">Selecciona...</option> 
              <?php foreach($data['minas'] as $mina): ?>
                <option value="<?php echo $mina->nombre; ?>"> <?php echo $mina->nombre; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
          </div>

          <div class="col-md-4 mt-4 mt-md-0">
            <label for="validationTooltip04" class="form-label">Seleccionar Mes</label>
            <select name="mes" class="form-select" id="mes" required>
              <option selected disabled value="">Selecciona...</option> 
              <?php foreach($data['meses'] as $numero => $mes): ?>
                <option value="<?php echo $numero ?>"> <?php echo $mes ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona mes</div>
          </div>

          <div class="col-md-4 mt-4 mt-md-0">
            <button id="btn-search" data-method="<?= strtolower($data['pagename']) ?>" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" class="p-2 col-12 fw-bold btn btn-success" > <i class="bi bi-search"></i> Buscar </button>
          </div>

        </div>

        
      </div>
    </div>
    <!-- ======= FIN FORMULARIO ======= -->

    <!-- Inicio tabla -->
    <!-- <pre><?php print_r($data) ?></pre> -->


    <?php if (isset($data['reporte'])) : ?>

    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <h5 class="card-title">Reporte de Mina :<?php echo $data['reporte'][0]->centro_costo ?>
            <a  href="<?php echo URLROOT . '/' . $data['controller'] . '/reporte_caja_pdf/' . $data['mina'] . '/' . $data['mes'] ?>" target="_blank" class="p-2 fw-bold btn btn-primary" > GENERAR REPORTE Fondos </a>
          </h5>
          <div class="col-md-4">
            <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
          </div>
          <h5 class="card-title"> Mes : <?php echo fixedMes($data['reporte'][0]->actualizado) ?></h5>
          <table class="table table-hover table-borderless datatable">
            <thead>
              <tr>
              <th scope="col" class="d-none d-md-table-cell">N°</th>
              <th scope="col">Fecha </th>
              <th scope="col" class="d-none d-md-table-cell">Creado por</th>
              <th scope="col" class="d-none d-md-table-cell">Descripcion</th>
              <th scope="col">Proveedor</th>
              <th scope="col"  class="d-none d-md-table-cell">Documento</th>
              <th scope="col">Monto</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['reporte'] as $orden): ?>            <tr>
                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->num_os); ?></th>
                
                <td class="text-primary fw-bold"><?php echo fixedFecha($orden->fecha); ?></td>
                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->usuario); ?></td>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->descripcion); ?></th>

                <td class="fw-bold "><?php echo utf8_encode($orden->proveedor); ?></th>
                <td class="fw-bold d-none d-md-table-cell "><?php echo utf8_encode($orden->documento); ?></th>
                <td class="fw-bold "><?php echo setCurrency() . $orden->monto; ?></th>

                  
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php else: ?>
    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <h1> No hay registros.</h1>
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


<script src="<?php echo URLROOT; ?>/js/reportes_caja.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>