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
    <?php if (strtoupper($data['orden'][0]->tipo)  == 'COMPRA') : ?>
    <div class="card">
      <div class="card-body">

        <!-- FILA 1 encabezado num Orden - TIPO -->
        <div class="row d-md-flex justify-content-md-start justify-content-around align-items-center card-title">
          <div class="d-flex col-md-4 py-2 justify-content-start ">
            <div class="col-md-6"><?= $data['pagename'] . ' Orden :'?></div>
            <div class="col-md-6 p-1 fw-bold btn btn-warning"> <?= 'N° - ' . $data['orden'][0]->num_os . ' - 2023'; ?></div>
          </div>

          <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
            <div class="col-md-4">Tipo : </div>
            <?php if (strtoupper($data['orden'][0]->tipo) == 'FONDOS') : ?>
              <div class="col-md-6 p-1 <?= bgFondos() ?>"> <?= strtoupper($data['orden'][0]->tipo); ?></div>
            <?php else : ?>
              <div class="col-md-6 p-1 <?= bgCompra() ?>"> <?= strtoupper($data['orden'][0]->tipo); ?></div>
            <?php endif; ?>
          </div>

          <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
            <div class="col-md-4">Estado : </div>
            <?php if (strtoupper($data['orden'][0]->estado) == 'APROBADO') : ?>
              <div class="col-md-6 p-1 <?= bgAprobado() ?>"> <?= strtoupper($data['orden'][0]->estado); ?></div>
            <?php elseif (strtoupper($data['orden'][0]->estado) == 'RECHAZADO'): ?>
              <div class="col-md-6 p-1 <?= bgRechazado() ?>"> <?= strtoupper($data['orden'][0]->estado); ?></div>
            <?php else : ?>
              <div class="col-md-6 p-1 <?= bgEnProceso() ?>"> <?= strtoupper($data['orden'][0]->estado); ?></div>
            <?php endif; ?>
          </div>

        </div>

        <!-- FILA 2 encabezado de tabla de ITEMS -->
        <div class="row mb-1 d-none d-md-flex bg-secondary text-light text-sm text-center">
          <div class="col-md-1">Item  </div>
          <div class="col-md-1">Cant. </div>
          <div class="col-md-1">Unidad </div>
          <div class="col-md-5">Descripcion </div>
          <div class="col-md-2">Proveedor </div>
          <div class="col-md-2">Valor Refer. </div>
        </div>

        <!-- FILA 3 - filas de ITEMS -->
        <?php foreach($data['orden'] as $orden) : ?>
          <div class="row mb-1 border-bottom border-dark">

            <div class="col-4 d-flex-col col-md-1 position-relative">
              <label for="" class="d-md-none">Item</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center " value="<?= $orden->item ?>" readonly>
            </div>

            <div class="col-4 d-flex-col  col-md-1 position-relative">
              <label for="" class="d-md-none">Cantidad</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center" value="<?= $orden->cantidad ?>" readonly>
            </div>
 
            <div class="col-4 d-flex-col flex-col  col-md-1 position-relative">
              <label for="" class="d-md-none">Unidad</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center" value="<?= $orden->unidad ?>" readonly>
            </div>

            <div class="col-md-5 mt-2 mt-md-0 position-relative">
              <label for="" class="d-md-none">Descripcion</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center" value="<?= $orden->descripcion ?>" readonly>
            </div>

            <div class="col-md-2 mt-2 mt-md-0 position-relative">
              <label for="" class="d-md-none">Proveedor</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center" value="<?= $orden->proveedor ?>" readonly>
            </div>

            <div class="col-md-2 my-2  mt-md-0 position-relative">
              <label for="" class="d-md-none">Valor Referencial</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center" value="<?= setCurrency() . number_format(floatval($orden->valor), 2, '.', ' ') ?>" readonly>
            </div>

          </div>
        <?php endforeach; ?>


        <!-- FILA 5- botones  -->
        <div class="row d-md-flex flex-md-row flex-column-reverse p-2 justify-content-around justify-content-md-between justify-content-md-end align-items-center">
          <?php if (strtoupper($data['orden'][0]->estado)  == 'APROBADO') : ?>
            <button id="btn-return" class="col-12 col-md-6 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/' . $data['controller'] . '/crear_pdf' ?>" class="col-12 col-md-4 mt-4 p-3 btn btn-info fw-bold">
              <i class="bi bi-printer"></i>
              <span>IMPRIMIR</span>
            </a>

          <?php elseif (strtoupper($data['orden'][0]->estado)  == 'RECHAZADO') : ?>
            <button id="btn-return" class="col-12 col-md-6 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/' . $data['controller'] . '/crear_pdf' ?>" class="col-12 col-md-4 mt-4 p-3 btn btn-info fw-bold">
              <i class="bi bi-printer"></i>
              <span>IMPRIMIR</span>
            </a>
          <?php else : ?>
            <button id="btn-return" class="col-12 col-md-6 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/usuarios/editar/' . $data['orden'][0]->num_os; ?>" class="col-12 col-md-4 mt-4 p-3 btn btn-success fw-bold">
              <i class="bi bi-search mr-5"></i>
              <span>EDITAR</span>
            </a>
             
          <?php endif; ?> 
        </div>

        
      </div>
    </div>
    <?php endif; ?>




    <?php if (strtoupper($data['orden'][0]->tipo)  == 'FONDOS') : ?>
    <div class="card">
      <div class="card-body">

        <!-- FILA 1 encabezado num Orden - TIPO -->
        <div class="row d-md-flex justify-content-md-start justify-content-around align-items-center card-title">
          <div class="d-flex col-md-4 py-2 justify-content-start ">
            <div class="col-md-6"><?= $data['pagename'] . ' Orden :'?></div>
            <div class="col-md-6 p-1 fw-bold btn btn-warning"> <?= 'N° - ' . $data['orden'][0]->num_os . ' - 2023'; ?></div>
          </div>

          <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
            <div class="col-md-4">Tipo : </div>
            <?php if (strtoupper($data['orden'][0]->tipo) == 'FONDOS') : ?>
              <div class="col-md-6 p-1 <?= bgFondos() ?>"> <?= strtoupper($data['orden'][0]->tipo); ?></div>
            <?php else : ?>
              <div class="col-md-6 p-1 <?= bgCompra() ?>"> <?= strtoupper($data['orden'][0]->tipo); ?></div>
            <?php endif; ?>
          </div>

          <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
            <div class="col-md-4">Estado : </div>
            <?php if (strtoupper($data['orden'][0]->estado) == 'APROBADO') : ?>
              <div class="col-md-6 p-1 <?= bgAprobado() ?>"> <?= strtoupper($data['orden'][0]->estado); ?></div>
            <?php elseif (strtoupper($data['orden'][0]->estado) == 'RECHAZADO'): ?>
              <div class="col-md-6 p-1 <?= bgRechazado() ?>"> <?= strtoupper($data['orden'][0]->estado); ?></div>
            <?php else : ?>
              <div class="col-md-6 p-1 <?= bgEnProceso() ?>"> <?= strtoupper($data['orden'][0]->estado); ?></div>
            <?php endif; ?>
          </div>

        </div>

        <!-- FILA 2 encabezado de tabla de ITEMS -->
        <div class="row mb-1 d-none d-md-flex bg-secondary text-light text-sm text-center">
          <div class="col-md-1">Item  </div>
          <div class="col-md-8">Descripcion </div>
          <div class="col-md-3">Valor Refer. </div>
        </div>

        <!-- FILA 3 - filas de ITEMS -->
        <?php foreach($data['orden'] as $orden) : ?>
          <div class="row mb-1 border-bottom border-dark border-md-none">

            <div class="col-4 d-flex-col col-md-1 position-relative">
              <label for="" class="d-md-none">Item</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center " value="<?= $orden->item ?>" readonly>
            </div>

            <div class="col-md-8 mt-2 mt-md-0 position-relative">
              <label for="" class="d-md-none">Descripcion</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center" value="<?= $orden->descripcion ?>" readonly>
            </div>

            <div class="col-md-3 my-2  mt-md-0 position-relative">
              <label for="" class="d-md-none">Valor Referencial</label>
              <input type="text" class="form-control-plaintext form-control-sm bg-light text-dark text-center" value="<?= setCurrency() . number_format(floatval($orden->valor), 2, '.', ' ') ?>" readonly>
            </div>

          </div>
        <?php endforeach; ?>

        <!-- FILA 4 - mostrar total de suma  ITEMS -->
          <?php 
            $total = 0; 

            foreach($data['orden'] as $orden) {
              $total += floatval($orden->valor);
            }
          ?>

          <div class="row d-md-flex justify-content-end card-title">
            <div class="d-flex col-md-6 justify-content-start justify-content-md-end">
              <div class="col-6 col-md-3 p-1">Total  : </div>
              <div class="col-6 col-md-4 p-1 btn btn-secondary"> <?= setCurrency() . number_format(floatval($total), 2, '.', ' ') ?></div>
            </div>
          </div>


        <!-- FILA 5- botones  -->
        <div class="row d-md-flex flex-md-row flex-column-reverse p-2 justify-content-around justify-content-md-between justify-content-md-end align-items-center">
          <?php if (strtoupper($data['orden'][0]->estado)  == 'APROBADO') : ?>
            <button id="btn-return" class="col-12 col-md-6 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/' . $data['controller'] . '/crear_pdf' ?>" class="col-12 col-md-4 mt-4 p-3 btn btn-info fw-bold">
              <i class="bi bi-printer"></i>
              <span>IMPRIMIR</span>
            </a>

          <?php elseif (strtoupper($data['orden'][0]->estado)  == 'RECHAZADO') : ?>
            <button id="btn-return" class="col-12 col-md-6 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/' . $data['controller'] . '/crear_pdf' ?>" class="col-12 col-md-4 mt-4 p-3 btn btn-info fw-bold">
              <i class="bi bi-printer"></i>
              <span>IMPRIMIR</span>
            </a>
          <?php else : ?>
            <button id="btn-return" class="col-12 col-md-6 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/usuarios/editar/' . $data['orden'][0]->num_os; ?>" class="col-12 col-md-4 mt-4 p-3 btn btn-success fw-bold">
              <i class="bi bi-search mr-5"></i>
              <span>EDITAR</span>
            </a>
             
          <?php endif; ?> 
        </div>

        
      </div>
    </div>
    <?php endif; ?>
    <pre><?php print_r($data) ?></pre>

  </section>

</main>


<script src="<?php echo URLROOT; ?>/js/form_usuario.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>