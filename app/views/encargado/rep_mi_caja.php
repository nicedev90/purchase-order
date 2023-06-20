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
    <pre><?php //print_r($data) ?></pre>
    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <h5 class="card-title">Historial Caja Chica <span>| Creadas</span>  -
            Saldo Disponible : 
            <button class="<?php echo ($data['saldo'] > 0) ? bgAprobado() : bgRechazado() ?>"> <?php echo setCurrency() . $data['saldo'] ?></button>
          </h5>
          <table class="table table-hover table-borderless datatable">
            <thead>
              <tr>
              <th scope="col" >N° Caja</th>
              <th scope="col" class="d-none d-md-table-cell">Creado Por</th>
              <th scope="col">Monto Total</th>
              <th scope="col" class="d-none d-md-table-cell">Fecha Creación</th>
              <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['totalCajas'] as $orden): ?>
              <tr>
                <td class="fw-bold"><?php echo utf8_encode($orden->num_caja); ?></td>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->nombre); ?></th>
                <td class="fw-bold"><?php echo setCurrency() . $orden->total; ?></td>
                <td class="d-none d-md-table-cell"><?php echo fixedFecha($orden->creado); ?></td>
                <td class="d-flex justify-content-around">
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles_caja/' . $orden->num_caja ?>" class="btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
                  <?php elseif (strtoupper($orden->estado) == 'RECHAZADO') : ?>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles_caja/' . $orden->num_caja ?>" class="btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
                  <?php else: ?>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles_caja/' . $orden->num_caja ?>" class="btn btn-warning btn-sm"><i class="bi bi-search"></i></a>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/editar_caja/' . $orden->num_caja ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a> 
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




  <div class="row d-md-flex flex-md-row justify-content-md-start justify-content-center">
    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/index'; ?>" class="col-10 col-md-4 m-2 m-md-3 p-3 p-md-2 btn btn-primary fw-bold">
      <i class="bi bi-arrow-left mr-5"></i>
      <span>REGRESAR</span>
    </a> 
  </div>

</main><!-- End #main -->



<script src="<?php echo URLROOT; ?>/js/init_new.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>