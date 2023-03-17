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
                
<!--           <div class="col-md-2 lead fw-bold">
              <?php submitAlert(); ?>
          </div>
  
        </div> -->

        <form id="form_crear" action="<?php echo URLROOT; ?>/encargados/index" class="col-md-12 mt-4 mt-md-2 needs-validation" novalidate method="POST" enctype="multipart/form-data">
          <!-- FILA 1  mina - categoria -->
          <div class="row mb-3 d-flex"> 
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

            <div class="col-md-6 mt-4 mt-md-0">
              <label for="validationTooltip04" class="form-label">Categoría</label>
              <select name="categoria" class="form-select" id="categoria" required>
                <option selected disabled value="">Selecciona ...</option>
              </select>
              <div class="invalid-tooltip"> Por favor selecciona una categoría. </div>
            </div>
          </div>

          <!-- FILA 2 AGREGAR ELIMINAR ITEM -->
          <div class="row mb-3 mt-4 mt-md-0 d-flex justify-content-around justify-content-md-start">
            <div class="col-5 col-md-2">
              <button id="btnAgregar" class="btn btn-success" type="button">Agregar item</button>
            </div>

            <div class="col-5 col-md-2">
              <button id="btnEliminar" class="btn btn-danger" type="button">Eliminar item</button>
            </div>
          </div>

          <!-- FILA 3 titulo de Items -->
          <div class="row mb-3 d-none d-md-flex text-sm text-center">
            <div class="col-md-1">Item  </div>
            <div class="col-md-1">Cant. </div>
            <div class="col-md-1">Unidad </div>
            <div class="col-md-5">Descripcion </div>
            <div class="col-md-2">Proveedor </div>
            <div class="col-md-2">Valor Refer. </div>
          </div>

          <!-- FILA 4 Filas de Items -->
          <div id="lista">
            <div id="1" class="row mb-3">
              <!-- INICIO INPUT ITEM -->
              <div class="col-4 d-flex-col col-md-1 position-relative">
                <label for="" class="d-md-none">Item</label>
                <input type="text" name="item" class="form-control-plaintext form-control-sm text-center" id="numItem" value="1" required readonly>
                <div class="valid-tooltip">Correcto</div>
              </div>
              <!-- FIN INPUT ITEM -->
              <!-- INICIO INPUT CANTIDAD -->
              <div class="col-4 d-flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Cantidad</label>
                <input name="cantidad" type="number" class="form-control form-control-sm" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
                <div class="valid-tooltip">Correcto</div>
              </div>
              <!-- FIN INPUT CANTIDAD -->
              <!-- INICIO SELECT UNIDAD -->
              <div class="col-4 d-flex-col flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Unidad</label>
                <select name="unidad" class="form-select form-select-sm" id="validationTooltip04" required>
                  <option selected disabled value="">Selecciona...</option>
                  <option>Metro</option>
                  <option>Kilo</option>
                  <option>Litro</option>
                </select>
                <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
              </div>
              <!-- FIN SELECT UNIDAD -->

              <div class="col-md-5 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Descripcion</label>
                <input name="descripcion" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                <div class="valid-tooltip"> Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Proveedor</label>
                <input name="proveedor" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Valor Referencial</label>
                <input name="valor" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

            </div>
          </div>


          
          <!-- FILA 7 BOTON DE ENVIAR -->
          <div class="row col-12 col-md-5 mx-auto">
            <button name="guardar_os" class="p-3 fw-bold btn btn-primary" type="submit">ENVIAR</button>
          </div>
        </form>

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

<?php require APPROOT . '/views/usuario/partials/footer.php'; ?>
