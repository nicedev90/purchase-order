<?php require APPROOT . '/views/usuario/partials/header.php'; ?>

<?php require APPROOT . '/views/usuario/partials/topbar.php'; ?>

<?php require APPROOT . '/views/usuario/partials/sidebar.php'; ?>

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
    <!--  **************** CARDS **************** -->
    <div class="row">
      <div class="col-lg-12">
        <div class="row">

          <div class="col-lg-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Ordenes de Servicio</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                  </div>

                  <div class="ps-3">
                    <h6>145</h6>
                    <a href="<?php echo URLROOT; ?>/encargados/consultar_os">
                      <span class="text-primary pt-1 small pt-1 fw-bold"> Ver Historial OS
                        <i class="bi bi-folder"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Última Orden <span>| Creada</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-send-check-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>OS N°50</h6>
                    <a href="" data-bs-toggle="modal" data-bs-target="#largeModal">
                      <span class="text-success pt-1 small pt-1 fw-bold"> Ver Detalles
                        <i class="bi bi-files"></i>
                      </span>
                    </a>
                    <?php require APPROOT . '/views/usuario/partials/modal_ultima_orden.php'; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Orden Completas <span>| Aceptadas</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                    </div>
                  </div>
                </div>
              </div>
          </div>

        </div>
    </div>

    <!-- ======= INICIO FORMULARIO ======= -->
    <div class="card">
      <div class="card-body">

        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-md-5 d-flex justify-content-between align-items-center">
            <div class="col-md-8 card-title"> Nueva Orden de Servicio</div>
          </div>
        </div>

        <!-- FILA 1  mina - categoria -->
        <div class="row justify-content-md-around align-items-center "> 

          <div class="d-flex col-md-6 mb-4 mb-md-0 justify-content-around">
            <div class="row col-md-2">Tipo: </div>
            <div class="d-flex justify-content-between justify-content-md-around col-md-10">
              <div class="col-4 col-md-3 form-check ">
                <input class="form-check-input" type="radio" name="tipo" id="tipoFondos" value="Fondos" required>
                <label class="form-check-label fw-bold" for="tipoFondos"> FONDOS </label>
              </div>

              <div class="col-4 col-md-3 form-check ">
                <input class="form-check-input" type="radio" name="tipo" id="tipoCompra" value="Compra" required>
                <label class="form-check-label fw-bold" for="tipoCompra"> COMPRA </label>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
            <select name="mina" class="form-select" id="mina" required>
              <option selected disabled value="">Selecciona...</option> 
              <?php foreach($data['minas'] as $mina): ?>
                <option value="<?php echo $mina->id; ?>"> <?php echo $mina->nombre; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
          </div>

        </div>

        <!-- FILA 2 BOTON DE ENVIAR -->
        <div class="row col-12 col-md-5 mt-5 mx-auto">
          <button id="btn_init" data-method="crear" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" class="p-2 fw-bold btn btn-primary" >CREAR ORDEN</button>
        </div>
        
      </div>
    </div>
    <!-- ======= FIN FORMULARIO ======= -->

    <!-- Inicio tabla resumen Ordenes -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Últimas Ordenes <span>| Creadas</span></h5>

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

</main>


<!-- Modal -->
<div class="modal fade" id="warning_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        falta llenar camposs
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script src="<?php echo URLROOT; ?>/js/init_new.js"></script>

<?php require APPROOT . '/views/usuario/partials/footer.php'; ?>