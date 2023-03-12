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
 

<section class="section dashboard">
    <pre>
        <?php print_r($data) ?>
    </pre>
    <!-- Inicio tabla resumen Ordenes -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Lista usuarios</h5>

                <table class="table table-hover table-borderless datatable">
                    <thead>
                        <tr>
                        <th scope="col">Rol</th>
                        <th scope="col">Funcion</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Estado</th>
                        <th scope="col"> Accion </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['usuarios'] as $usuario): ?>
                        <tr>
                            <td class="fw-bold"><?php echo utf8_encode($usuario->user_rol); ?></th>
                            <td><?php echo utf8_encode($usuario->funcion); ?></td>
                            <td class="text-primary"><?php echo utf8_encode($usuario->nombre); ?></td>
                            <td><button class="btn btn-success"><?php echo utf8_encode($usuario->usuario); ?></span></td>
                            <td class="text-primary"><?php echo utf8_encode($usuario->email); ?></td>
                            <td class="text-primary"><?php echo utf8_encode($usuario->estado); ?></td>
                            <td class="d-flex justify-content-around">
 
                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_user_<?php echo $usuario->id ?>"><i class="bi bi-pencil-square"></i></a>   
                                <?php require APPROOT . '/views/coordinador/partials/modal_edit_user.php'; ?>
                                

                            </td>
                            
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Fin tabla resumen usuarioes -->


</section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
