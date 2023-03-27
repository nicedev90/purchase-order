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
      <div class="col-lg-12">
        <div class="row">

          <div class="col-lg-3">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Ordenes de Servicio</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                  </div>

                  <div class="ps-3">
                    <h6><?php echo $data['total'] ?></h6>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/historial' ?>">
                      <span class="text-primary pt-1 small pt-1 fw-bold"> Ver Historial OS
                        <i class="bi bi-folder"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Última Orden <span>| Creada</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-send-check-fill"></i>
                  </div>
                  <div class="ps-3">
                      <?php 
                        if (isset($data['ordenes'][0])) {
                          $lastOrden = current($data['ordenes'][0]); 
                        } else {
                          $lastOrden = 0; 
                        }
                      ?>
                    <h6>OS N° - <?php echo $lastOrden ?></h6>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles/' . $lastOrden ?>">
                      <span class="text-primary pt-1 small pt-1 fw-bold"> Ver Detalles
                        <i class="bi bi-folder"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Ordenes Completas <span>|</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        if (isset($data['totalOrdenes'])) {
                          $totalAprobados = 0; 

                          foreach($data['totalOrdenes'] as $orden) {
                            if (strtoupper($orden->estado) == "APROBADO") {
                              $totalAprobados++;
                            }
                          }
                        }
                      ?>
                      <h6><?php echo (isset($totalAprobados)) ? $totalAprobados : 0 ?></h6>
                    </div>
                  </div>
                </div>
              </div>
          </div>

          <div class="col-lg-3">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Mis Ordenes <span>| </span></h5>
                  <div class="d-flex align-items-center">

                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard2-data-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        if (count($data['userOrdenes']) > 0) {
                          $totalMisOrdenes = count($data['userOrdenes']); 
                        }
                      ?>
                      <h6><?php echo (isset($totalMisOrdenes)) ? $totalMisOrdenes : 0 ?></h6>
                    </div>

                  </div>
                </div>
              </div>
          </div>

        </div>
    </div>


    <!-- ======= INICIO FORMULARIO ======= -->
    <div class="card">
      <div class="card-body">

        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-md-5 d-flex justify-content-between align-items-center">
            <div class="col-md-8 card-title"> Nueva Orden de Servicio</div>
          </div>
        </div>

        <!-- FILA 1  mina - categoria -->
        <div class="row justify-content-md-around align-items-center "> 

          <div class="d-flex col-md-6 mb-4 mb-md-0 justify-content-around">
            <div class="row col-md-2">Tipo: </div>
            <div class="d-flex justify-content-between justify-content-md-around col-md-10">
              <div class="col-4 col-md-3 form-check ">
                <input class="form-check-input" type="radio" name="tipo" id="tipoFondos" value="Fondos" required>
                <label class="form-check-label fw-bold" for="tipoFondos"> <?= setTipoBySede() ?> </label>
              </div>

              <div class="col-4 col-md-3 form-check ">
                <input class="form-check-input" type="radio" name="tipo" id="tipoCompra" value="Compra" required>
                <label class="form-check-label fw-bold" for="tipoCompra"> COMPRA </label>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
            <select name="mina" class="form-select" id="mina" required>
              <option selected disabled value="">Selecciona...</option> 
              <?php foreach($data['minas'] as $mina): ?>
                <option value="<?php echo $mina->id; ?>"> <?php echo $mina->nombre; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
          </div>

        </div>

        <!-- FILA 2 BOTON DE ENVIAR -->
        <div class="row col-12 col-md-5 mt-5 mx-auto">
          <button id="btn_init" data-method="crear" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" class="p-2 fw-bold btn btn-primary" >CREAR ORDEN</button>
        </div>
        
      </div>
    </div>
    <!-- ======= FIN FORMULARIO ======= -->

    <!-- Inicio tabla resumen Ordenes -->
    <!-- <pre><?php print_r($data) ?></pre> -->
    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <h5 class="card-title">Últimas Ordenes <span>| Creadas</span></h5>
          <table class="table table-hover table-borderless datatable">
            <thead>
              <tr>
              <th scope="col">N°</th>
              <th scope="col">Tipo</th>
              <th scope="col" class="d-none d-md-table-cell">Creado por</th>
              <th scope="col" class="d-none d-md-table-cell">Mina </th>
              <th scope="col">Estado</th>
              <th scope="col" class="d-none d-md-table-cell">Fecha</th>
              <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['ordenes'] as $orden): ?>
              <tr>
                <td class="fw-bold"><?php echo utf8_encode($orden->num_os); ?></th>
                <td class="fw-bold">
                  <?php if (strtoupper($orden->tipo) == 'FONDOS') : ?>
                    <span class="<?= bgFondos() ?> btn-sm"><?php echo setName($orden->tipo); ?></span> 
                  <?php else: ?>
                    <span class="<?= bgCompra() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->tipo)); ?></span> 
                  <?php endif; ?>
                  
                </td>
                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->usuario); ?></th>
                <td class="text-primary d-none d-md-table-cell"><?php echo utf8_encode($orden->mina_nombre); ?></td>
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
                <td class="d-flex justify-content-around">
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <a href="<?php echo URLROOT . '/usuarios/detalles/' . $orden->num_os ?>" class="btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
                  <?php elseif (strtoupper($orden->estado) == 'RECHAZADO') : ?>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles/' . $orden->num_os ?>" class="btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
                  <?php else: ?>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles/' . $orden->num_os ?>" class="btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/editar/' . $orden->num_os ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a> 
                  <?php endif; ?>
                </td>
                  
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Fin tabla resumen Ordenes -->


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


<script src="<?php echo URLROOT; ?>/js/init_new.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>