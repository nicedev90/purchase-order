<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>
<main id="main" class="main">

  <section class="section dashboard">

    <div class="card">
      <div class="card-body">

        <div class="row md-flex-column p-2 justify-content-md-between align-items-md-center">

          <div class="row col-md-9 d-md-flex justify-content-between align-items-md-center">
            <div class="col-md-3 mt-md-0 p-2 mt-2 card-title fw-bold"> CAJA CHICA - <?php echo $data['num_caja'] ?> </div>
            <div class="col-md-4 mt-md-0 p-2 mt-2 btn btn-info">  <?php echo $_SESSION['user_nombre'] . ' - ' . $_SESSION['user_codigo'] ?> </div>
            <div class="col-md-3 mt-md-0 p-2 mt-2 btn btn-success rounded text-center">
              Saldo: <span id="saldo-user"><?php echo setCurrency() . $data['saldo'] ?> </span>
            </div>
          </div>  

          <div class="row mt-md-0 mt-2 col-md-2"> 
            <button id="btn-return" class="col-12 p-2 btn btn-danger">Cancelar</button>
          </div>
        </div>
                

          <!-- FILA 2 Filas para crear  Items -->
          <form  id="formAddItem" class="col-md-12 mt-4 mt-md-2 needs-validation" novalidate >
          <div class="row my-2">

            <div class="col-md-3 mt-2 mt-md-0 position-relative">
              <label for="">Fecha</label>
              <input type="date" class="form-control form-control-sm" id="input_fecha" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo fecha" required autocomplete="off">
              <div class="valid-tooltip"> Correcto </div>
            </div>

            <div class="col-md-3 mt-2 mt-md-0 position-relative">
              <label for="">C. Costo</label>
              <select id="input_cc" class="form-control form-control-sm" required>
                <option selected disabled value="">Selecciona...</option>
                <?php foreach($data['minas'] as $mina): ?>
                  <option value="<?php echo $mina->id; ?>" > <?php echo $mina->nombre; ?></option>
                <?php endforeach; ?>

              </select>
            </div>

            <div class="col-md-6 mt-2 mt-md-0 position-relative">
              <label for="">Proveedor</label>
              <input type="text" class="form-control form-control-sm" id="input_proveedor" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
              <div class="valid-tooltip"> Correcto </div>
            </div>

          </div>

          <div class="row my-md-2 align-items-end">
            <div class="col-md-8 mt-2 mt-md-0 position-relative">
              <label for="">Descripcion</label>
              <input type="text" class="form-control form-control-sm" id="input_descripcion" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
              <div class="valid-tooltip"> Correcto </div>
            </div>

            <div class="col-md-2 mt-2 mt-md-0 position-relative ">
              <label for="">N° Doc</label>
              <input type="text" class="form-control form-control-sm" id="input_documento" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
              <div class="valid-tooltip">  Correcto </div>
            </div>

            <div class="col-md-2 mt-2 mt-md-0 position-relative">
              <label for="">Total PEN</label>
              <input type="number" step="any" min="0"  class="form-control form-control-sm " id="input_total" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
              <div class="valid-tooltip">  Correcto </div>
            </div>

          </div>
          </form>

          <!-- FILA 3 botones eliminar agregar -->
          <div class="row my-2">

            <div class="col-12 col-md-2 mt-3 ">
              <button id="add_item" class="col-12 btn btn-sm btn-success"> + Agregar item</button>
            </div>
       
            <div class="col-12 col-md-2 mt-3 ">
              <button id="delete_item" class="col-12 btn btn-sm btn-danger" > - Eliminar item</button>
            </div>

            <div id="alerta"  class="col-12 col-md-5 mt-3 d-none ">
              <button class="col-12 btn btn-sm btn-warning" > Debe llenar todos los campos</button>
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

            </tbody>
          </table>



        <form action="<?php echo URLROOT . '/encargados/sustentar' ?>" class="col-md-12 mt-4 mt-md-2 needs-validation" novalidate method="POST" enctype="multipart/form-data">

          <!-- FILA 5 OBSERVACIONES -->
          <div class="d-flex-col mt-3 alert alert-secondary p-2">
            <div class="d-flex-col justify-content-md-start p-2">
              <label for="observaciones" class="fw-bold" >Observaciones</label>
              <input name="observaciones" type="text" class="form-control form-control-sm " id="observaciones" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" autocomplete="off" required>
              <div class="valid-tooltip">  Correcto </div>
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
                  <!-- id numadjunto1 es unico del primer adjunto (1) -->
                  <div id="numAdjunto" class="btn fw-bold"> 1 </div>
                  <label for="adjunto1" class="col-md-2"> 
                    <span class="btn btn-primary">Cargar. <i class="bi bi-paperclip"></i> </span>
                  </label>

                  <input type="file" name="adjunto[1]" id="adjunto1" class="item_adjunto" hidden>

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
          <div id="wrapper_items">
            <input id="num_caja" type="hidden" name="num_caja" value="<?php echo $data['num_caja'] ?>">
            <input id="usuario" type="hidden" name="usuario" value="<?php echo $_SESSION['user_usuario'] ?>">

          </div>
        </form>


      </div>
    </div>

  </section>
</main>


<script src="<?php echo URLROOT; ?>/js/_sustentar.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>