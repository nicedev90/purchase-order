<?php require APPROOT . '/views/encargado/partials/header.php'; ?>

<?php require APPROOT . '/views/encargado/partials/topbar.php'; ?>

<?php require APPROOT . '/views/encargado/partials/sidebar.php'; ?>

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
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-3 col-md-6">
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
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-3 col-md-6">
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
                            <?php require APPROOT . '/views/encargado/partials/modal_card.php'; ?>
                        </div>
                        </div>
                    </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-3 col-md-6">
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
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-3 col-md-6">

                    <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">Mis Ordenes <span>| Acceso Premium</span></h5>

                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-clipboard2-data-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6>44</h6> 
                            <a href="" data-bs-toggle="modal" data-bs-target="#largeModal1">
                                <span class="text-danger pt-1 small pt-1 fw-bold">Mi Última Orden
                                    <i class="bi bi-files"></i>
                                </span>
                            </a>
                            <?php require APPROOT . '/views/encargado/partials/modal_my.php'; ?>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><!-- End Customers Card -->
            </div>
        </div><!-- End Left side columns -->
    </div>

    <!-- ======= INICIO FORMULARIO ======= -->
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title"> Nueva Orden de Servicio  </h5>
                    <p>Rellena los campos para solicitar tu Orden de Servicio Clonsa S.A.C </p>
                </div>
                <div class="col-md-4 lead fw-bold">
                    <?php submitAlert(); ?>
                </div>
            </div>

            <form id="form_crear" action="<?php echo URLROOT; ?>/encargados/index" class="col-md-12 needs-validation" novalidate method="POST" enctype="multipart/form-data">

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
                        <button id="eliminar" class="btn btn-danger" type="button">Eliminar item</button>
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
                        <div class="col-md-1">
                            <div class="btn">
                                <b>Adjuntar: </b>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button id="agregar" class="btn btn-success" type="button"> + Agregar archivo</button>
                        </div>

                        <div class="col-md-2">
                            <button id="eliminar" class="btn btn-danger" type="button"> - Eliminar archivo</button>
                        </div>
                    </div>

                    <div id="lista_adjunto" class="col my-2">
                        <div class="col my-1" id="adjunto_1" hidden>
                            <div id="numAdjunto" class="btn fw-bold col-md-1">
                                1
                            </div>
                            <label for="adjunto" class="col-md-1"> 
                                <span class="btn btn-primary">Cargar. <i class="bi bi-paperclip"></i>
                                </span>
                            </label>

                            <input type='file' name="adjunto" id="adjunto" class="item_adjunto" hidden>
                            
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
                
                <div class="row col-5 mx-auto">
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

</main><!-- End #main -->

<?php require APPROOT . '/views/encargado/partials/footer.php'; ?>
