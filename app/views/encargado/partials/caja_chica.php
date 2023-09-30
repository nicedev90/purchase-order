  <?php if (checkSedePeru()): ?>

  <div class="row mx-auto justify-content-md-between">
    <div class="card col-md-6">
      <div class="card-body ">
        <!-- FILA 0 -->
        <div class="row px-4">
          <div class="col-md-8 card-title"> Rendición de Cuentas </div>
        </div>

        <!-- FILA 1   -->
        <div class="row justify-content-md-around align-items-center "> 
          <div class="row col-12 col-md-6 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/sustentar" class="p-2 fw-bold btn btn-primary" >Crear Rendición</a>
          </div>

          <div class="row col-12 col-md-6 pt-md-0 pt-4 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/rep_mi_caja" class="p-2 fw-bold btn btn-warning" >Ver Mis Rendiciones</a>
          </div>
        </div>

      </div>
    </div>

  <?php if ($_SESSION['user_usuario'] == $data['revisorCaja']) : ?>
    <div class="card col-md-5 ">
      <div class="card-body ">
        <!-- FILA 0 -->
        <div class="row px-4">
          <div class="col-md-8 card-title"> Caja Chica Usuarios</div>
        </div>

        <!-- FILA 1   -->
        <div class="row justify-content-md-around align-items-center "> 
          <div class="row col-12 col-md-6 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/revisar_caja" class="p-2 fw-bold btn btn-primary" >Revisar Caja Chica</a>
          </div>

          <div class="row col-12 col-md-6 pt-md-0 pt-4 mx-auto">
            <a href="<?php echo URLROOT; ?>/encargados/reportes_caja" class="p-2 fw-bold btn btn-warning" >Ver Reportes</a>
          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>

  </div>
  <?php endif; ?>