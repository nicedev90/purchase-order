<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>AGREGAR NUEVO USUARIO</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
 
<section class="section dashboard">

    <pre>
        <!-- <?php print_r($data) ?> -->
    </pre>
    <div id="1" class="row mb-3">


        <h2>AGREGAR NUEVO </h2>
<form action="<?php echo URLROOT ?>/coordinadores/add_user" method="post">
    <input type="hidden" name="sede_id" value="<?php echo ($_SESSION['user_sede'] == 'Peru') ? 1 : 2; ?>">


    <div class="row mb-3">
        <div class="col-6">
            <label for="validationTooltip04" class="form-label">Rol de usuario</label>
            <select name="rol_id" class="form-select" required>
                <option selected disabled value="">Selecciona...</option> 
                <?php foreach($data['roles'] as $rol): ?>
                     <option value="<?php echo $rol->id; ?>"> <?php echo $rol->rol; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">
                Por favor selecciona la Unidad Minera
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <label for="validationTooltip04" class="form-label">Funcion</label>
            <select name="funcion" class="form-select" required>
                <option selected disabled value="">Selecciona...</option> 
                <option value="Normal"> Normal</option>
                <option value="Revisor"> Revisor</option>
            </select>
            <div class="invalid-tooltip">
                Por favor selecciona la Unidad Minera
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-5">
            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce nombre" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-5">
            <label for="usuario" class="form-label">usuario</label>
            <input name="usuario" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce usuario" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-5">
            <label for="email" class="form-label">email</label>
            <input name="email" type="email" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce email" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-5">
            <label for="password" class="form-label">password</label>
            <input name="password" type="password" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce password" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="validationTooltip04" class="form-label">estado</label>
            <select name="estado" class="form-select" required>
                <option selected disabled value="">Selecciona...</option> 
                <option value="Activo"> Activo</option>
                <option value="Inactivo"> Inactivo</option>
            </select>
            <div class="invalid-tooltip">
                Por favor selecciona la Unidad Minera
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-danger col-12">
        <i class="bi bi-printer"></i> <b>REGISTRAR NUEVO USER</b> 
    </button>

    </form>



    </div>


</section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
