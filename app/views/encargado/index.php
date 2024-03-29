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

  <?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/cards.php'; ?>

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
  <?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/caja_chica.php'; ?>
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
              <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
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
              <?php endif; ?>
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
  print_r($data);
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