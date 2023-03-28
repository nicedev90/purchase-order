<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Actividad de Sesión <i class="bi bi-person-circle"></i></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Historial <i class="bi bi-layout-text-window"></i></li>
                <li class="breadcrumb-item active">Actividad de Sesión <i class="bi bi-shield-lock"></i></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
      <div class="row">

          <!-- Inicio tabla resumen Ordenes -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Actividad de Sesión <i class="bi bi-toggle-on"></i> <span>| Historial</span></h5>

                <table class="table table-hover table-borderless datatable ">
                    <thead>
                        <tr>
                        <th scope="col" class="text-center">Item <i class="bi bi-sort-numeric-down"></i></th>
                        <th scope="col" class="text-center">Detalle <i class="ri ri-chrome-line"></i></th> 
                        <th scope="col" class="text-center">Sesión <i class="ri-alarm-warning-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($data['logs'] as $log) : ?>
                        <tr>
                            <td class="fw-bold text-center"> <?php echo $log->id ?> </td>
                            <td class="fw-bold text-center"> [ Reporte Notificacion Sessión ] # Inicio de Sesión</td>
                            <td class="text-dark text-center"> <?php echo $log->fecha ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Fin tabla resumen Ordenes -->
        
      </div>


    </section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>