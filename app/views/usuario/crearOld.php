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

            <div class="col-md-4 p-2 fw-bold bg-warning rounded text-center">
             N° - 
              <!-- <b id="numero_orden">22</b> -->
              <b id="numero_orden"><?php echo $data['numero_os']; ?></b>
              <b> - 2023</b>
            </div>
          </div>  

          <div class="col-md-7 d-flex justify-content-around justify-content-md-end align-items-center">                      
            <div class="col-md-4">
              <a href="<?php echo URLROOT; ?>/usuarios/index" class="btn btn-danger fw-bold">Cancelar Orden</a>
            </div>
          </div>

        </div>
                
<!--           <div class="col-md-2 lead fw-bold">
              <?php submitAlert(); ?>
          </div>
  
        </div> -->

        <form id="form_crear" action="<?php echo URLROOT; ?>/usuarios/crear/<?php echo $data['id']; ?>" class="col-md-12 mt-4 mt-md-2 needs-validation" novalidate method="POST" enctype="multipart/form-data">
          
          <!-- FILA 0  mina - categoria -->
          <div class="row my-3 d-flex">
            <input type="hidden" name="item[1][num_os]" id="num_os"  value="<?php echo $data['numero_os']; ?>">
            <input type="hidden" name="item[1][usuario]" id="usuario" value="<?php echo $_SESSION['user_usuario']; ?>">
            <input type="hidden" name="item[1][estado]" id="estado" value="En Proceso">

            <div class="col-md-6">
              <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
              <select name="item[1][mina]" class="form-select" id="mina" required>
                <option selected value="<?php echo $data['mina_codigo']; ?>"><?php echo $data['mina_nombre']; ?></option>
                <?php foreach($data['minas'] as $mina): ?>
                  <option value="<?php echo $mina->id; ?>"> <?php echo $mina->nombre; ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
            </div>

            <div class="col-md-6 mt-4 mt-md-0">
              <label for="validationTooltip04" class="form-label">Categoría</label>
              <select name="item[1][categoria]" class="form-select" id="categoria" required>
                <?php foreach($data['mina_categ'] as $categoria): ?>
                  <option value="<?php echo utf8_encode($categoria->codigo); ?>"> <?php echo utf8_encode($categoria->categoria); ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-tooltip"> Por favor selecciona una categoría. </div>
            </div>
          </div>

          <!-- FILA 1 tipo -->
          <div class="row my-4 p-md-2 p-4 d-flex-col d-md-flex justify-content-start">
            <div class="col-2 col-md-2">Tipo: </div>
            <div class="col-4 col-md-3 form-check ">
              <input class="form-check-input" type="radio" name="item[1][tipo]" id="tipoFondos" value="Fondos" required>
              <label class="form-check-label fw-bold" for="tipoFondos"> FONDOS </label>
            </div>

            <div class="col-4 col-md-3 form-check ">
              <input class="form-check-input" type="radio" name="item[1][tipo]" id="tipoCompra" value="Compra" required>
              <label class="form-check-label fw-bold" for="tipoCompra"> COMPRA </label>
            </div>
          </div>

          <!-- FILA 2 AGREGAR ELIMINAR ITEM -->
          <div class="row mb-3 mt-4 mt-md-0 d-flex justify-content-around justify-content-md-start">
            <div class="col-5 col-md-2">
              <button id="add_item" class="btn btn-success" type="button">Agregar item</button>
            </div>

            <div class="col-5 col-md-2">
              <button id="delete_item" class="btn btn-danger" type="button">Eliminar item</button>
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
                <input type="text" name="item[1][item]" class="form-control-plaintext form-control-sm text-center" id="numItem" value="1" required readonly>
                <div class="valid-tooltip">Correcto</div>
              </div>
              <!-- FIN INPUT ITEM -->
              <!-- INICIO INPUT CANTIDAD -->
              <div class="col-4 d-flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Cantidad</label>
                <input name="item[1][cantidad]"  type="number" class="form-control form-control-sm" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
                <div class="valid-tooltip">Correcto</div>
              </div>
              <!-- FIN INPUT CANTIDAD -->
              <!-- INICIO SELECT UNIDAD -->
              <div class="col-4 d-flex-col flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Unidad</label>
                <select name="item[1][unidad]" class="form-select form-select-sm" id="validationTooltip04" required>
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
                <input name="item[1][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                <div class="valid-tooltip"> Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Proveedor</label>
                <input name="item[1][proveedor]" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Valor Referencial</label>
                <input name="item[1][valor]" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

            </div>
          </div>

          <!-- FILA 5 ENLACES -->
          <div class="d-flex-col mt-3 alert alert-info p-2">

            <div class="d-flex-col d-md-flex justify-content-md-start">

              <div class="col-5 col-md-2 d-flex align-items-center">
                <div class="btn fw-bold">Agregar Enlace: </div>
              </div>

              <div class="d-flex justify-content-around justify-content-md-start col-md-6">
                <div class="col-md-5">
                  <button id="add_link" class="btn btn-sm btn-success" type="button"> + Agregar Enlace</button>
                </div>

                <div class="col-md-5">
                  <button id="delete_link" class="btn btn-sm btn-danger" type="button"> - Eliminar Enlace</button>
                </div>
              </div>
            </div>

            <div class="d-flex-col d-md-flex mt-2 mx-1 ">
              <div class="d-flex col-12 mt-3 mt-md-1" id="lista_enlace">
                <div class="col-md-2 btn">Enlace</div>
                <input name="enlace[1]" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ingrea el enlace" autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>

              </div>
            </div>

          </div>
            
          <!-- FILA 6 ARCHIVOS ADJUNTOS -->
          <div class="d-flex-col mt-3 alert alert-secondary p-2">

            <div class="d-flex-col d-md-flex justify-content-md-start">

              <div class="col-2 d-flex align-items-center">
                <div class="btn fw-bold">Adjuntar: </div>
              </div>

              <div class="d-flex justify-content-around justify-content-md-start col-md-6">
                <div class="col-md-5">
                  <button id="add_adjunto" class="btn btn-sm btn-success" type="button"> + Agregar archivo</button>
                </div>

                <div class="col-md-5">
                  <button id="delete_adjunto" class="btn btn-sm btn-danger" type="button"> - Eliminar archivo</button>
                </div>
              </div>
            </div>

            <div id="wrapper_files" class="d-flex-col d-md-flex mt-2 mx-1">

              <div class="col" id="lista_adjunto">
                <div class="col my-1" id="adjunto_1">
                  <!-- id numadjunto1 es unico del primer adjunto -->
                  <div id="numAdjunto1" class="btn fw-bold"> 1 </div>
                  <label for="adjunto1" class="col-md-2"> 
                    <span class="btn btn-primary">Cargar. <i class="bi bi-paperclip"></i> </span>
                  </label>

                  <input type='file' name="adjunto[1]" id="adjunto1" class="item_adjunto" hidden>

                  <div id="file_name" class="btn col-12 text-sm col-md-5"></div>

                  <div id="file_size" class="btn col-md-2"></div>
                  
                  <div id="validar_adjunto" class="btn col-md-2"></div>

                </div>
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

  </section>

</main>



<!-- Modal -->
<div class="modal fade" id="error_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        EL archivo adjunto no puede ser mayor a 3MB;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="success_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Creado con exito
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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

<?php require APPROOT . '/views/usuario/partials/footer.php'; ?>
