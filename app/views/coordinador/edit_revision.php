<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Editar Areas de revision de ORDENES</h1>
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

        <h2>CAMBIAR AREAS PARA FONDOS</h2>
<form action="<?php echo URLROOT ?>/coordinadores/edit_revision" method="post">
        <div class="row mb-3">

            <input type="hidden" name="tipo_fondo" value="<?php echo $data['areas'][0]->tipo ?>">

            <div class="col-2">
                <p>Area 1</p>
            </div>
            <div class="col-5">
                <input name="area_fondo_1" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][0]->area_1 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
            </div>
                 
        </div>

        <div class="row mb-3">
            <div class="col-2">
                <p>Area 2</p>
            </div>
            <div class="col-5">
                <input name="area_fondo_2" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][0]->area_2 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
            </div>
                 
        </div>

        <div class="row mb-3">
            <div class="col-2">
                <p>Area 3</p>
            </div>
            <div class="col-5">
                <input name="area_fondo_3" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][0]->area_3 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
            </div>
                 
        </div>

        <button name="btn_fondo" type="submit" class="btn btn-danger col-12">
            <i class="bi bi-printer"></i> <b>ACTUALIZAR</b> 
          </button>

    </form>




        <h2>CAMBIAR AREAS PARA CÓMPRAS</h2>
<form action="<?php echo URLROOT ?>/coordinadores/edit_revision" method="post">
        <div class="row mb-3">
            <input type="hidden" name="tipo_compra" value="<?php echo $data['areas'][1]->tipo ?>">

            <div class="col-2">
                <p>Area 1</p>
            </div>
            <div class="col-5">
                <input name="area_compra_1" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][1]->area_1 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
            </div>
                 
        </div>

        <div class="row mb-3">
            <div class="col-2">
                <p>Area 2</p>
            </div>
            <div class="col-5">
                <input name="area_compra_2" type="text" class="form-control" id="cantidad" value="<?php echo $data['areas'][1]->area_2 ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
            <div class="valid-tooltip">Correcto</div>
            </div>
                 
        </div>



        <button type="submit" name="btn_compra" class="btn btn-danger col-12">
            <i class="bi bi-printer"></i> <b>ACTUALIZAR</b> 
          </button>

    </form>










    </div>



</section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
