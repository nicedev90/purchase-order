<?php include('../header.php')?>
<?php include('../topbar.php')?>
<?php include('../sidebar.php')?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Editar Orden de Servicio</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tabla</li>
          <li class="breadcrumb-item active">Editar OS</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- ======= INICIO FORMULARIO ======= -->
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-8">
                        <h5 class="card-title"> Editar Orden de Servicio  </h5>
                        <p>Campos ingresados por Usuario <b>Jorge Perez</b> de Orden de Servicio Clonsa Ingeniería S.A.C </p>
                        
                    </div>
                    <div class="col-md-4 lead fw-bold">
                    </div>
                </div>

                <form id="form_crear" action="" class="col-md-12 needs-validation" novalidate method="POST" enctype="multipart/form-data">

                    <div class="row mb-3"> 
                        <!-- INICIO SELECT GUIA DE COSTOS -->
                        <div class="col-md-6 position-relative">
                            <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
                            <select name="mina" class="form-select" id="mina" required>
                                <option selected disabled value="">Selecciona...</option> 
                                <?php foreach($data['minas'] as $mina): ?>
                                    <option value="<?php echo $mina->id; ?>"> <?php echo $mina->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-tooltip">
                                Por favor selecciona la Unidad Minera
                            </div>
                        </div>
                        <!-- FIN SELECT GUIA DE COSTOS -->

                        <!-- INICIO SELECT CATEGORIA -->
                        <div class="col-md-6 position-relative">
                            <label for="validationTooltip04" class="form-label">Categoría</label>

                            <select name="categoria" class="form-select" id="categoria" required>
                                <option selected disabled value="">Selecciona ...</option>
                            </select>
                            <div class="invalid-tooltip">
                                Por favor selecciona una categoría.
                            </div>
                        </div>
                        <!-- FIN SELECT CATEGORIA -->
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <button id="agregar" class="btn btn-success" type="button">Agregar item</button>
                        </div>

                        <div class="col-2">
                            <button id="btnEliminar" class="btn btn-danger" type="button">Eliminar item</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-1 position-relative">
                            <b>Item</b>
                        </div>
                        <div class="col-md-1 position-relative">
                            <b>Cantidad</b>
                        </div>
                        <div class="col-md-2 position-relative">
                            <b>Unidad</b>
                        </div>
                        <div class="col-md-6 position-relative">
                            <b>Descripcion</b>
                        </div>
                        <div class="col-md-2 position-relative">
                            <b>Proveedor Sugerido</b>
                        </div>
                    </div>
                    
                    <div id="lista">
                        <div id="1" class="row mb-3">
                            <!-- INICIO INPUT ITEM -->
                            <div class="col-md-1 position-relative">
                                <input type="text" name="item" class="form-control-plaintext text-center" id="numItem" value="1" required readonly>
                                <div class="valid-tooltip">Correcto</div>
                            </div>
                            <!-- FIN INPUT ITEM -->
                            <!-- INICIO INPUT CANTIDAD -->
                            <div class="col-md-1 position-relative">
                                <input name="cantidad" type="number" class="form-control" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
                                <div class="valid-tooltip">Correcto</div>
                            </div>
                            <!-- FIN INPUT CANTIDAD -->
                            <!-- INICIO SELECT UNIDAD -->
                            <div class="col-md-2 position-relative">
                                <select name="unidad" class="form-select" id="validationTooltip04" required>
                                    <option selected disabled value="">Selecciona...</option>
                                    <option>Metro</option>
                                    <option>Kilo</option>
                                    <option>Litro</option>
                                </select>
                                <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
                            </div>
                            <!-- FIN SELECT UNIDAD -->

                            <div class="col-md-6 position-relative">
                                <input name="descripcion" type="text" class="form-control" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                                <div class="valid-tooltip"> Correcto </div>
                            </div>

                            <div class="col-md-2 position-relative">
                                <input name="proveedor" type="text" class="form-control" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                                <div class="valid-tooltip">  Correcto </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- INICIO SECCION ARCHIVOS -->
                    <div class="row my-5 alert alert-secondary mx-1">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="btn">
                                    <b>Archivos Adjuntos: </b>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <button id="add_adjunto" class="btn btn-success" type="button"> + Agregar archivo</button>
                            </div>

                            <div class="col-md-3">
                                <button id="delete_adjunto" class="btn btn-danger" type="button" hidden> - Eliminar archivo</button>
                            </div>
                        </div>

                        <div id="lista_adjunto" class="col my-2">
                            <div class="col my-1" id="adjunto_1" hidden>
                                <div id="numAdjunto" class="btn fw-bold col-md-1">
                                    1
                                </div>
                                <label for="adjunto1" class="col-md-1"> 
                                    <span class="btn btn-primary">Cargar. <i class="bi bi-paperclip"></i>
                                    </span>
                                </label>

                                <input type='file' name="adjunto[1]" id="adjunto1" class="item_adjunto" hidden>
                                
                                <div id="file_name" class="btn col-md-5">

                                </div>

                                <div id="file_size" class="btn col-md-2">

                                </div>
                                
                                <div class="btn col-md-1 btn-success">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN SECCION ARCHIVOS -->
                    <!-- INICIO SELECT ESTADO -->
                    <div class="row mb-3"> 
                        <div class="col-md-2 position-relative">
                            <b>Estado</b>
                        </div>
                    </div>
                    <div class="col-md-2 position-relative">
                        <select name="unidad" class="form-select" id="validationTooltip04" required>
                                <option selected disabled value="">Selecciona...</option>
                                <option>En Progreso</option>
                                <option>Revisado</option>
                                <option>Completado</option>
                                <option>Rechazado</option>
                        </select>
                    </div>
                    <!-- FIN SELECT UNIDAD -->
                                    <p></p>
                    <!-- INICIO ** ACEPTO BAJO RESPONSABILIDAD -->
                    <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                        Acepto bajo mi responsabilidad los términos y condiciones solicitados.
                        </label>
                        <div class="invalid-feedback">                      
                            Debe estar de acuerdo antes de enviar.
                        </div>
                    </div>
                    </div>
                    <!-- FIN ** ACEPTO BAJO RESPONSABILIDAD -->
                    <p></p>
                    <div class="row col-5 mx-auto">
                        <button name="guardar_os" class="p-3 fw-bold btn btn-primary" type="submit">GUARDAR OS</button>
                    </div>
                </form>

            </div>
        </div>
        <!-- ======= FIN FORMULARIO ======= -->
    </div>
</section>


</main><!-- End #main -->


<?php include('../footer.php')?>
