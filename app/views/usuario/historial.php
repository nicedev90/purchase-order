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
    <!-- Inicio tabla resumen Ordenes -->
    <div class="col-12">

      <div class="row d-md-flex flex-md-row justify-content-md-end justify-content-center">

        <button id="btn-return" class="col-10 col-md-6 m-2 m-md-3 p-3 p-md-2 btn btn-primary fw-bold">
          <i class="bi bi-arrow-left mr-5"></i>
          <span>REGRESAR</span>
        </button>

      </div>

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
                    <span class="<?= bgFondos() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->tipo)); ?></span> 
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

</main>

<script src="<?php echo URLROOT; ?>/js/form_usuario.js"></script>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>