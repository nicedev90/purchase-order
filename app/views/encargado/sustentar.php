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

    <div class="card">
      <div class="card-body">

        <!-- num_os , boton cancelar -->
        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-md-6 d-flex justify-content-between align-items-center">
            <div class="col-6 col-md-8 card-title"> RENDICION DE CUENTA CAJA CHICA</div>
            <div class="col-md-4 p-2 fw-bold bg-warning rounded text-center">
              <b>N° - </b>
              <b id="numero_orden"><?php echo $data['num_os']; ?></b>
              <b> - 2023</b>
            </div>
          </div>  

          <div class="col-md-6 d-flex justify-content-around justify-content-md-end align-items-center"> 
            <div class="col-md-4">
              <button id="btn-return" class="btn btn-danger fw-bold">Cancelar Orden</button>
            </div>
          </div>
        </div>
                

        <form id="form_crear" action="<?php echo URLROOT; ?>/usuarios/sustentar" class="col-md-12 mt-4 mt-md-2 needs-validation" novalidate method="POST" enctype="multipart/form-data">
          
          <!-- FILA 1  mina - categoria -->
          <div class="row my-3 d-flex">
            <input type="hidden" name="item[1][num_os]" id="num_os"  value="<?php echo $data['num_os']; ?>">
            <input type="hidden" name="item[1][usuario]" id="usuario" value="<?php echo $_SESSION['user_usuario']; ?>">
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
            <div class="col-md-1">Fecha </div>
            <div class="col-md-1">C. Costo </div>
            <div class="col-md-5">Descripción </div>
            <div class="col-md-2">Proveedor </div>
            <div class="col-md-2">N° Doc</div>
            <div class="col-md-1">Total PEN </div>
          </div>

          <!-- FILA 4 Filas de Items -->
          <div id="lista-items">
            <div id="1" class="row mb-3">

              <div class="col-md-1 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Fecha</label>
                <input name="item[1][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                <div class="valid-tooltip"> Correcto </div>
              </div>

              <div class="col-md-1 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">C. Costo</label>
                <select name="item[1][unidad]" class="form-control form-control-sm" id="validationTooltip04" required>
                  <option selected disabled value="">Selecciona...</option>

                  <option value="2"> 1</option>
                  <option value="">Yanacocha</option>

                </select>
              </div>

              <div class="col-md-5 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Descripcion</label>
                <input name="item[1][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                <div class="valid-tooltip"> Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Proveedor</label>
                <input name="item[1][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                <div class="valid-tooltip"> Correcto </div>
              </div>

              <div class="col-md-2 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">N° Doc</label>
                <input name="item[1][proveedor]" type="text" class="form-control form-control-sm" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

              <div class="col-md-1 mt-2 mt-md-0 position-relative">
                <label for="" class="d-md-none">Total PEN</label>
                <input name="item[1][valor]" type="number" step="any" min="0"  class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
              </div>

            </div>
          </div>

 
          <!-- FILA 5 OBSERVACIONES -->
          <div class="d-flex-col mt-3 alert alert-secondary p-2">
            <div class="d-flex-col justify-content-md-start p-2">
                <label for="observaciones" class="fw-bold" >Observaciones</label>
                <input name="observaciones" type="text" class="form-control form-control-sm " id="observaciones" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" autocomplete="off">
                <div class="valid-tooltip">  Correcto </div>
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
            <button name="save" class="p-3 fw-bold btn btn-primary" type="submit">ENVIAR</button>
          </div>

        </form>

      </div>
    </div>

  </section>
</main>


<script src="<?php echo URLROOT; ?>/js/_sustentar.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>