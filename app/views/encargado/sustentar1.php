<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>
<main id="main" class="main">

  <section class="section dashboard">

    <div class="card">
      <div class="card-body">

        <!-- num_os , boton cancelar -->
        <div class="row md-flex-column p-2 justify-content-md-between align-items-md-center">

          <div class="row col-md-9 d-md-flex justify-content-between align-items-center">
            <div class="col-md-5 mt-md-0 p-2 mt-2 card-title"> RENDICION DE CUENTA CAJA CHICA</div>
            <div class="col-md-3 mt-md-0 p-2 mt-2 btn btn-info fw-bold"> <?php echo ($data['tipo'] == 'doc') ? 'DOCUMENTADO' : 'No Documentado' ; ?></div>
            <div class="col-md-3 mt-md-0 p-2 mt-2 fw-bold bg-warning rounded text-center">
              <b>N° - </b>
              <b id="numero_orden"><?php echo $data['num_os']; ?></b>
              <b> - 2023</b>
            </div>
          </div>  

          <div class="row mt-md-0 mt-2 col-md-3"> 
            <button id="btn-return" class="col-12 btn btn-danger fw-bold">Cancelar</button>
          </div>
        </div>
                
          
          <!-- FILA 1  mina - categoria -->
          <div class="row d-flex">
            <input type="hidden" name="item[1][num_os]" id="num_os"  value="<?php echo $data['num_os']; ?>">
            <input type="hidden" name="item[1][usuario]" id="usuario" value="<?php echo $_SESSION['user_usuario']; ?>">
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

                <option value="2"> 1</option>
                <option value="">Yanacocha</option>

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

            <div class="col-md-2 mt-2 mt-md-0 position-relative <?php echo ($data['tipo'] == 'doc') ? '' : 'd-none'; ?>">
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
              <button id="add_item" class="col-12 btn btn-sm btn-success" data-numero="<?php echo $data['num_os']; ?>" data-usuario="<?php echo $_SESSION['user_usuario']; ?>"> + Agregar item</button>
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
              <tr>
                <td class="text-center">01</td>
                <td class="d-none d-md-table-cell" > 01-01-2023</td>
                <td class="d-none d-md-table-cell">YANACOCHA</td>
                <td >CONSORCIO KUNTURWASI</td>
                <td class="d-none d-md-table-cell  " style="width: 420px;"> MOVILIDAD OFICINA-NOTARIA-PARURO-OFICINA</td>
                <td class="d-none d-md-table-cell">F -34234525</td>
                <td class="text-end">s/ 123 134.66</td>
              </tr>
              <tr>
                <td class="text-center">02</td>
                <td class="d-none d-md-table-cell" > 01-01-2023</td>
                <td class="d-none d-md-table-cell">YANACOCHA</td>
                <td > JC CLIMATIZACION Y CONFORT</td>
                <td class="d-none d-md-table-cell " style="width: 420px;"> REVALIDACION CURSO MANEJO DE TAREAS SEGURAS -A.CONTREAS</td>
                <td class="d-none d-md-table-cell">F -34234525</td>
                <td class="text-end">s/ 3134.66</td>

              </tr>
            </tbody>
          </table>



        <form action="<?php echo URLROOT . '/encargados/sustentar/' . $data['tipo'] . '/' . $data['num_os'] ?>" class="col-md-12 mt-4 mt-md-2 needs-validation" novalidate method="POST" enctype="multipart/form-data">

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