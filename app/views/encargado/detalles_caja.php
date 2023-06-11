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

    <div class="card">
      <div class="card-body">

        <!-- FILA 0 MINA CATEGORIA -->
        <div class="row d-md-flex justify-content-md-start justify-content-around align-items-center card-title">
          <div class="row d-md-flex justify-content-md-between ">

            <div class="row col-md-6 col-12">
              <div class="col-md-5 bg-light"> Caja Chica N° :  </div>
              <div class="col-md-7 btn btn-secondary">  <?php echo '0' . $data['caja'][0]->num_caja ?></div>
            </div>

            <div class="row  col-md-6 col-12">
              <div class="col-md-5 bg-light"> Usuario:  </div>
              <div class="col-md-7 btn btn-secondary"> <?php echo $data['caja'][0]->nombre . ' - ' . $data['caja'][0]->codigo  ?></div>
            </div>


          </div>
        </div>

        <div class="row d-md-flex justify-content-md-start justify-content-around align-items-center card-title">
          <div class="row d-md-flex justify-content-md-between ">

            <div class="row  col-md-6 col-12">
              <div class="col-md-6 fw-bold  bg-light"> Estado:  </div>

              <?php if (strtoupper($data['caja'][0]->estado) == 'APROBADO') : ?>
                <div class="col-md-6 <?= bgAprobado() ?>"> <?= strtoupper($data['caja'][0]->estado); ?></div>
              <?php elseif (strtoupper($data['caja'][0]->estado) == 'RECHAZADO'): ?>
                <div class="col-md-6 <?= bgRechazado() ?>"> <?= strtoupper($data['caja'][0]->estado); ?></div>
              <?php else : ?>
                <div class="col-md-6 <?= bgEnProceso() ?>"> <?= strtoupper($data['caja'][0]->estado); ?></div>
              <?php endif; ?>
            </div>

            <div class="row d-md-flex align-items-center justify-content-center col-md-6 col-12">
              <?php 
                $total = 0; 

                foreach($data['caja'] as $orden) {
                  $total += floatval($orden->monto);
                }
              ?>
              <div class="col-md-6 bg-light"> Total : </div>
              <div class="col-md-6 btn btn-primary"> <?= setCurrency() . number_format(floatval($total), 2, '.', ' ') ?></div>
            </div>

          </div>
        </div>



          <!-- FILA 4 - lista de items -->
          <table class="my-4 table table-hover" >
            <thead class="table-dark">
              <tr>
                <th >Item</th>
                <th class="d-none d-md-table-cell">Fecha</th>
                <th class="d-none d-md-table-cell">C. Costo</th>
                <th >Proveedor</th>
                <th class="d-none d-md-table-cell " style="width: 420px;">Descripcion</th>
                <th class="d-none d-md-table-cell " >Documento</th>
                <th >Total PEN</th>
              </tr>
            </thead>

            <tbody id="lista_items" style="font-size: 14px;">
              <?php foreach($data['caja'] as $orden) : ?>
                <tr>
                  <td class="text-center"><?php echo $orden->item ?></td>
                  <td class="d-none d-md-table-cell" > <?php echo fixedFecha($orden->fecha); ?></td>
                  <td class="d-none d-md-table-cell"><?php echo $orden->centro_costo ?></td>
                  <td ><?php echo $orden->proveedor ?></td>
                  <td class="d-none d-md-table-cell  " style="width: 420px;"> <?php echo $orden->descripcion ?></td>
                  <td class="d-none d-md-table-cell"><?php echo $orden->documento ?></td>
                  <td class="text-end"><?php echo setCurrency() . $orden->monto ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        <!-- FILA 4 - observaciones  -->
        <div class="row d-md-flex-col px-4  my-0 justify-content-start card-title">
          <div class="col-6 col-md-3 p-1">Observaciones  : </div>
          <?php if (!empty($data['observ'][0]->observaciones)) : ?>
          <?php foreach($data['observ'] as $obs) : ?>
            <span class="px-2 form-control-plaintext form-control-sm alert alert-info text-dark"> <?= $obs->observaciones ?></span>
          <?php endforeach; ?>
        <?php endif; ?>
        </div>


        <!-- FILA 6 - Adjuntos  -->
        <div class="row d-md-flex-col px-4 my-0 justify-content-start card-title">
          <div class="col-6 col-md-3 p-1">Adjuntos  : </div>
            <div class="d-md-flex alert alert-success text-dark ">

            <?php if (str_contains($data['adjuntos'][0]->archivo, '.')) : ?>
              <?php 
                $file = $data['adjuntos'][0]->archivo;
                $file = explode('/', $file);
                $file = end($file);
              ?>
              <div class="row col-md-4 ">
                <span class="p-2 text-dark">
                  <?php echo $file; ?>
                  [ <a href="<?= URLROOT . $data['adjuntos'][0]->archivo ?>" target="_blank">Ver archivo</a> ]
                </span>

                <?php for ($i = 1; $i <= count($data['adjuntos']) -1; $i++) : ?> 
                  <?php 
                    $adj = $data['adjuntos'][$i]->archivo;
                    $adj = explode('/', $adj);
                    $adj = end($adj);
                  ?>
                  <span class="p-2 text-dark">
                    <?php echo $adj; ?>
                    [ <a href="<?= URLROOT . $data['adjuntos'][$i]->archivo ?>" target="_blank">Ver archivo</a> ]
                  </span>
                <?php endfor; ?>
              </div>

            <?php else : ?>

              <?php for ($i = 1; $i <= count($data['adjuntos']) -1; $i++) : ?> 
                <?php 
                  $adj = $data['adjuntos'][$i]->archivo;
                  $adj = explode('/', $adj);
                  $adj = end($adj);
                ?>
                <span class="p-2 text-dark">
                  <?php echo $adj; ?>
                  [ <a href="<?= URLROOT . $data['adjuntos'][$i]->archivo ?>" target="_blank">Ver archivo</a> ]
                </span>
              <?php endfor; ?>

            <?php endif; ?>
            
            </div>
        </div>


        <!-- FILA 7 - botones  -->
        <div class="row d-md-flex flex-md-row flex-column-reverse p-2 justify-content-around justify-content-md-between justify-content-md-end align-items-center">
          <?php if (strtoupper($data['caja'][0]->estado)  == 'APROBADO') : ?>
            <button id="btn-return" class="col-12 col-md-4 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/' . $data['controller'] . '/crear_pdf/' . $data['caja'][0]->num_os ?>" target="_blank" class="col-12 col-md-4 mt-4 p-3 btn btn-info fw-bold">
              <i class="bi bi-printer"></i>
              <span>IMPRIMIR</span>
            </a>

          <?php elseif (strtoupper($data['caja'][0]->estado)  == 'RECHAZADO') : ?>
            <button id="btn-return" class="col-12 col-md-4 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>

            <a href="<?php echo URLROOT . '/' . $data['controller'] . '/crear_pdf/' . $data['caja'][0]->num_os ?>" target="_blank" class="col-12 col-md-4 mt-4 p-3 btn btn-info fw-bold">
              <i class="bi bi-printer"></i>
              <span>IMPRIMIR</span>
            </a>
          <?php else : ?>
            <button id="btn-return" class="col-12 col-md-4 mt-4 p-3 btn btn-primary fw-bold">
              <i class="bi bi-arrow-left mr-5"></i>
              <span>REGRESAR</span>
            </button>
             
          <?php endif; ?> 
        </div>

        
      </div>
    </div>

    <pre><?php //print_r($data) ?></pre>

  </section>

</main>


<script src="<?php echo URLROOT; ?>/js/form_usuario.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>