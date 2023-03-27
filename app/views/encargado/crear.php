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


    <!-- ======= INICIO FORMULARIO ======= -->

    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-between align-items-center">

          <div class="col-md-6 d-flex justify-content-between align-items-center">
            <div class="col-md-8 card-title"> Nueva Orden de Servicio</div>

            <div class="col-md-4 p-2 fw-bold bg-warning rounded text-center">
              <b>N° - </b>
              <b id="numero_orden"><?php echo $data['numero_os']; ?></b>
              <b> - 2023</b>
            </div>
          </div>  

          <div class="col-md-6 d-flex justify-content-around justify-content-md-between justify-content-md-end align-items-center"> 
            <?php if (strtoupper($data['tipo_os']) == 'FONDOS') : ?>
              <div class="col-md-4 p-2 fw-bold <?= bgFondos() ?> rounded text-center">
                <b><?php echo setName($data['tipo_os']) ?></b>
              </div>
            <?php else : ?>
              <div class="col-md-4 p-2 fw-bold <?= bgCompra() ?> rounded text-center">
                <b><?php echo strtoupper($data['tipo_os']) ?></b>
              </div>
            <?php endif; ?>


            <div class="col-md-4">
              <a href="<?php echo URLROOT; ?>/encargados/index" class="btn btn-danger fw-bold">Cancelar Orden</a>
            </div>
          </div>

        </div>
                


        <form id="form_crear" action="<?php echo URLROOT; ?>/encargados/crear " class="col-md-12 mt-4 mt-md-2 needs-validation" novalidate method="POST" enctype="multipart/form-data">
          
          <!-- FILA 1  mina - categoria -->
          <div class="row my-3 d-flex">
            <input type="hidden" name="item[1][num_os]" id="num_os"  value="<?php echo $data['numero_os']; ?>">
            <input type="hidden" name="item[1][usuario]" id="usuario" value="<?php echo $_SESSION['user_usuario']; ?>">
            <input type="hidden" name="item[1][tipo]" id="tipo" value="<?php echo $data['tipo_os']; ?>">
            <input type="hidden" name="item[1][estado]" id="estado" value="En Proceso">

            <div class="col-md-6">
              <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
              <select name="item[1][mina]" class="form-select" id="mina" required>
                <option selected value="<?php echo $data['mina_codigo']; ?>"><?php echo $data['mina_nombre']; ?></option>
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


          <!-- FILA 2 AGREGAR ELIMINAR ITEM -->
          <div class="row mb-3 mt-4 mt-md-0 d-flex justify-content-around justify-content-md-start">
            <div class="col-5 col-md-2">
              <button id="add_item" class="btn btn-success" type="button">Agregar item</button>
            </div>

            <div class="col-5 col-md-2">
              <button id="delete_item" class="btn btn-danger" type="button">Eliminar item</button>
            </div>
          </div>

          <?php if (strtoupper($data['tipo_os']) == 'COMPRA') : ?>
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
            
              <div class="col-4 d-flex-col col-md-1 position-relative">
                <label for="" class="d-md-none">Item</label>
                <input type="text" name="item[1][item]" class="form-control-plaintext form-control-sm text-center" id="numItem" value="1" required readonly>
              </div>

              <div class="col-4 d-flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Cantidad</label>
                <input name="item[1][cantidad]"  type="number" step="any" min="0"  class="form-control form-control-sm" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required  autocomplete="off">
                <div class="valid-tooltip">Correcto</div>
              </div>

              <div class="col-4 d-flex-col flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Unidad</label>
                <select name="item[1][unidad]" class="form-control form-control-sm" id="validationTooltip04" required>
                  <option selected disabled value="">Selecciona...</option>
                  <option>Metro</option>
                  <option>Kilo</option>
                  <option>Litro</option>
                </select>
                <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
              </div>

              <div class="col-md-5 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Descripcion</label>
                <input name="item[1][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                <div class="valid-tooltip"> Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Proveedor</label>
                <input name="item[1][proveedor]" type="text" class="form-control form-control-sm" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Valor Referencial</label>
                <input name="item[1][valor]" type="number" step="any" min="0"  class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

            </div>
          </div>

          <?php endif; ?>

          <?php if (strtoupper($data['tipo_os']) == 'FONDOS') : ?>
          <!-- FILA 3 titulo de Items -->
          <div class="row mb-3 d-none d-md-flex text-sm text-center">
            <div class="col-md-1">Item  </div>
            <div class="col-md-8">Descripcion </div>
            <div class="col-md-3">Monto </div>
          </div>

          <!-- FILA 4 Filas de Items -->
          <div id="lista">
            <div id="1" class="row mb-3">
              <!-- INICIO INPUT ITEM -->
              <div class="col-4 d-flex-col col-md-1 position-relative">
                <label for="" class="d-md-none">Item</label>
                <input type="text" name="item[1][item]" class="form-control-plaintext form-control-sm text-center" id="numItem" value="1" required readonly>
              </div>
              <!-- FIN INPUT ITEM -->
              <!-- INICIO INPUT CANTIDAD -->
              <div hidden class="col-4 d-flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Cantidad</label>
                <input name="item[1][cantidad]"  type="number" step="any" min="0"  class="form-control form-control-sm" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número"  autocomplete="off">
                <div class="valid-tooltip">Correcto</div>
              </div>
              <!-- FIN INPUT CANTIDAD -->
              <!-- INICIO SELECT UNIDAD -->
              <div hidden class="col-4 d-flex-col flex-col  col-md-1 position-relative">
                <label for="" class="d-md-none">Unidad</label>
                <select name="item[1][unidad]" class="form-control form-control-sm" id="validationTooltip04" >
                  <option selected value="">Selecciona...</option>
                  <option>Metro</option>
                  <option>Kilo</option>
                  <option>Litro</option>
                </select>
                <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
              </div>
              <!-- FIN SELECT UNIDAD -->

              <div class="col-md-8 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Descripcion</label>
                <input name="item[1][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                <div class="valid-tooltip"> Correcto </div>
              </div>

              <div hidden class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Proveedor</label>
                <input name="item[1][proveedor]" type="text" class="form-control form-control-sm" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

              <div class="col-md-3 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Valor Referencial</label>
                <input name="item[1][valor]" type="number" step="any" min="0" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

            </div>
          </div>

          <?php endif; ?>

          <!-- FILA 5 OBSERVACIONES -->
          <div class="d-flex-col mt-3 alert alert-secondary p-2">
            <div class="d-flex-col justify-content-md-start p-2">
                <label for="observaciones" class="fw-bold" >Observaciones</label>
                <input name="observaciones" type="text" class="form-control form-control-sm " id="observaciones" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
            </div>
          </div>



          <!-- FILA 6 ENLACES -->
          <div class="d-flex-col mt-3 alert alert-info p-2">

            <div class="d-flex-col d-md-flex justify-content-md-start">

              <div class="col-5 col-md-2 d-flex align-items-center">
                <div class="btn fw-bold">Agregar Enlace: </div>
              </div>

              <div class="d-flex justify-content-around justify-content-md-start col-md-6">
                <div class="col-md-5">
                  <button id="add_link" class="btn btn-sm btn-success" type="button"> + Agregar Enlace</button>
                </div>

<!--                 <div class="col-md-5">
                  <button id="delete_link" class="btn btn-sm btn-danger" type="button"> - Eliminar Enlace</button>
                </div> -->
              </div>
            </div>

            
            <div class="d-flex-col col-12 mt-3 mt-md-1" id="lista_enlace" data-link="1">
              <div id="link_1" class="d-flex-col  col-12">
                <input type="hidden" name="enlaces[1][num_os]" value="<?php echo $data['numero_os']; ?>">
                <div class="col-md-2 btn">Enlace 1</div>
                <input name="enlaces[1][enlace]" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ingrea el enlace" autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>
            </div>

          </div>
            
          <!-- FILA 7 ARCHIVOS ADJUNTOS -->
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
                  <!-- id numadjunto1 es unico del primer adjunto (1) -->
                  <div id="numAdjunto" class="btn fw-bold"> 1 </div>
                  <label for="adjunto1" class="col-md-2"> 
                    <span class="btn btn-primary">Cargar. <i class="bi bi-paperclip"></i> </span>
                  </label>

                  <input type='file' name="adjunto[1]" id="adjunto1" class="item_adjunto" hidden>

                  <div id="file_name" class="btn col-12 text-sm col-md-4"></div>

                  <div id="file_size" class="btn col-md-2"></div>
                  
                  <div id="validar_adjunto" class="btn col-md-3"></div>

                </div>
              </div>
            </div>

          </div>

          <!-- FILA 8 BOTON DE ENVIAR -->
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


<!-- Modal -->
<div class="modal fade" id="adjunto_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Solo puede agregar 5 archivos
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<script src="<?php echo URLROOT; ?>/js/form_usuario.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>