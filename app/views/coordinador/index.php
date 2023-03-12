<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
 
 <!-- <?php print_r($data)  ?> -->
<section class="section dashboard">

    <!-- Inicio tabla resumen Ordenes -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Lista usuarios</h5>

                <table class="table table-hover table-borderless datatable">
                    <thead>
                        <tr>
                        <th scope="col">N° O.S.</th>
                        <th scope="col">Creado por</th>
                        <th scope="col">Detalle </th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de Creación</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['ordenes'] as $orden): ?>
                        <tr>
                            <td class="fw-bold"><?php echo utf8_encode($orden->num_os); ?></th>
                            <td><?php echo utf8_encode($orden->usuario); ?></td>
                            <td class="text-primary"><?php echo utf8_encode($orden->descripcion); ?></td>
                            <td><button class="btn btn-success"><?php echo utf8_encode($orden->estado); ?></span></td>
                            <td class="text-primary"><?php echo fixedFecha($orden->creado); ?></td>
                            <td class="d-flex justify-content-around">
                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#largeModal2"><i class="bi bi-search"></i></a>
                                <a href="<?php echo URLROOT; ?>/encargados/editar_os" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>   
                                <?php require APPROOT . '/views/encargado/partials/modal_tabla.php'; ?>
                                

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

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
