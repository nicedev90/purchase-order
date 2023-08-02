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
  <div class="row col-12 mx-auto">
    <div class="card">
      <div class="card-body">

        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-md-5 d-flex justify-content-between align-items-center">
            <div class="col-md-8 card-title"> Nueva Orden de Servicio</div>
          </div>
        </div>

        <!-- FILA 1  mina - categoria -->
        <div class="row justify-content-md-around align-items-center "> 

          <div class="d-flex col-md-6 mb-4 mb-md-0 justify-content-between justify-content-md-around">
            <div class="d-none d-md-block col-md-2">Tipo: </div>
            <div class="d-flex col-12 justify-content-between justify-content-md-around col-md-10">
              <div class="col-6 col-md-3 form-check ">
                <input class="form-check-input" type="radio" name="tipo" id="tipoFondos" value="Fondos" required>
                <label class="form-check-label fw-bold" for="tipoFondos"> <?= setTipoBySede() ?> </label>
              </div>

              <div class="col-6 col-md-3 form-check ">
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
  </div>
    <!-- ======= FIN FORMULARIO ======= -->

    <!-- INICIO SECCION CAJA CHICA -->

  <div class="row mx-auto justify-content-md-between">
    <div class="card col-md-6">
      <div class="card-body ">
        <!-- FILA 0 -->
        <div class="row px-4">
          <div class="col-md-8 card-title"> Mi Caja Chica </div>
        </div>

        <!-- FILA 1   -->
        <div class="row justify-content-md-around align-items-center "> 
          <div class="row col-12 col-md-6 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/sustentar" class="p-2 fw-bold btn btn-primary" >Crear Caja Chica</a>
          </div>

          <div class="row col-12 col-md-6 pt-md-0 pt-4 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/rep_mi_caja" class="p-2 fw-bold btn btn-warning" >Ver mi Caja Chica</a>
          </div>
        </div>

      </div>
    </div>

<?php if ($_SESSION['user_usuario'] == $data['revisorCaja']) : ?>
    <div class="card col-md-5 ">
      <div class="card-body ">
        <!-- FILA 0 -->
        <div class="row px-4">
          <div class="col-md-8 card-title"> Caja Chica Usuarios</div>
        </div>

        <!-- FILA 1   -->
        <div class="row justify-content-md-around align-items-center "> 
          <div class="row col-12 col-md-6 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/revisar_caja" class="p-2 fw-bold btn btn-primary" >Revisar Caja Chica</a>
          </div>

          <div class="row col-12 col-md-6 pt-md-0 pt-4 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/reportes_caja" class="p-2 fw-bold btn btn-warning" >Ver Reportes</a>
          </div>
        </div>

      </div>
    </div>
<?php endif; ?>

  </div>

    <!-- FIN SECCION CAJA CHICA -->

    <!-- Inicio tabla resumen Ordenes -->

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
                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->nombre_usuario); ?></th>
                <td class="text-primary d-none d-md-table-cell"><?php echo utf8_encode($orden->mina_nombre); ?></td>
                <td>
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <span class="<?= bgAprobado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php elseif (strtoupper($orden->estado) == 'RECHAZADO') : ?>
                    <span class="<?= bgRechazado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php else: ?>
                    <span class="<?= bgEnProceso() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                    <?php if (strtoupper($orden->rev) == "APROBADO") : ?>
                      <span class="btn btn-primary btn-sm"> 1° Rev. </span>
                    <?php endif; ?>

                  <?php endif; ?>
                  
                </td>
                <td class="d-none d-md-table-cell"><?php echo fixedFecha($orden->creado); ?></td>
                <td class="d-flex justify-content-around">
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles/' . $orden->num_os ?>" class="btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
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


<?php
  echo "<pre>";
  // print_r($data);
  echo "</pre>";
?>
</main><!-- End #main -->

<!-- warning Modal -->
<div class="modal fade" id="warning_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body d-flex p-4 flex-column align-items-center justify-content-center">
       <span class="card-title text-secondary  fs-3"> Falta completar campos.</span>
        <div style=" display: flex; align-items: center;justify-content: center; border-radius: 50%; width:10rem; height:10rem; background:#FFF2CA; ">
          <!-- <i class="bi bi-check-circle-fill "></i -->
          <i class="bi bi-exclamation-triangle text-warning"  style="font-size:5rem;"></i>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Success Modal -->
<div class="modal modal-lg fade" id="<?= createdAlert() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body d-flex p-4 flex-column align-items-center justify-content-center">
       <span class="card-title text-success fs-3"> Orden creada correctamente.</span>
        <div style=" display: flex; align-items: center;justify-content: center; border-radius: 50%; width:20rem; height:20rem; padding:0.2rem; background:#E0F8E9; ">
          <i class="bi bi-check-circle-fill " style="font-size:10rem;color:#2ECA6A;"></i>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<script src="<?php echo URLROOT; ?>/js/_index_enc.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>