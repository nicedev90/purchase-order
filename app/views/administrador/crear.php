<?php require APPROOT . '/views/administrador/partials/header.php'; ?>

<?php require APPROOT . '/views/administrador/partials/topbar.php'; ?>

<?php require APPROOT . '/views/administrador/partials/sidebar.php'; ?>

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
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>145</h6>
                            <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                        </div>
                        </div>
                    </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Última Orden <span>| Creada</span></h5>

                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>$3,264</h6>
                            <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

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
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>$3,264</h6>
                            <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                        </div>
                        </div>
                    </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-3 col-md-6">

                    <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">En Proceso <span>| Sin revisar</span></h5>

                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>ORDEN N°044</h6>
                            <span class="text-danger small pt-1 fw-bold">ORDEN N°44</span> <span class="text-muted small pt-2 ps-1">decrease</span>

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
                <div class="col-md-6">
                    <h5 class="card-title"> Nueva Orden de Servicio  
                        <b class="lead p-2 fw-bold bg-warning"> N° - 
                            <b id="numero_orden"><?php echo $data['numero_os']; ?></b>
                        </b>
                    </h5>
                    <p>Rellena los campos para solicitar tu Orden de Servicio Clonsa S.A.C </p>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo URLROOT; ?>/administrador/index" class="btn btn-danger btn-lg fw-bold">Cancelar Orden</a>
                </div>
            </div>

            <form action="<?php echo URLROOT; ?>/administrador/crear/<?php echo $data['id']; ?>" class="col-md-12 needs-validation" novalidate method="POST">
                <div class="row mb-3">
                    <input type="hidden" name="item[1][num_os]" value="<?php echo $data['numero_os']; ?>">
                    <input type="hidden" name="item[1][usuario]" id="usuario" value="<?php echo $_SESSION['user_usuario']; ?>">
                    <!-- INICIO SELECT GUIA DE COSTOS -->
                    <div class="col-md-6 position-relative">
                        <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
                        <select name="item[1][mina]" class="form-select" id="mina" required>
                            <option selected value="<?php echo $data['mina_codigo']; ?>"><?php echo $data['mina_nombre']; ?></option> 
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

                        <select name="item[1][categoria]" class="form-select" id="categoria" required>
                            
                            <?php foreach($data['mina_categ'] as $categoria): ?>
                                <option value="<?php echo utf8_encode($categoria->codigo); ?>"> <?php echo utf8_encode($categoria->categoria); ?></option>
                            <?php endforeach; ?>
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
                            <input type="text" name="item[1][item]" class="form-control-plaintext text-center" id="numItem" value="1" required readonly>
                            <div class="valid-tooltip">Correcto</div>
                        </div>
                        <!-- FIN INPUT ITEM -->
                        <!-- INICIO INPUT CANTIDAD -->
                        <div class="col-md-1 position-relative">
                            <input name="item[1][cantidad]" type="number" class="form-control" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
                            <div class="valid-tooltip">Correcto</div>
                        </div>
                        <!-- FIN INPUT CANTIDAD -->
                        <!-- INICIO SELECT UNIDAD -->
                        <div class="col-md-2 position-relative">
                            <select name="item[1][unidad]" class="form-select" id="validationTooltip04" required>
                                <option selected disabled value="">Selecciona...</option>
                                <option>Metro</option>
                                <option>Kilo</option>
                                <option>Litro</option>
                            </select>
                            <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
                        </div>
                        <!-- FIN SELECT UNIDAD -->

                        <div class="col-md-6 position-relative">
                            <input name="item[1][descripcion]" type="text" class="form-control" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                            <div class="valid-tooltip"> Correcto </div>
                        </div>

                        <div class="col-md-2 position-relative">
                            <input name="item[1][proveedor]" type="text" class="form-control" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                            <div class="valid-tooltip">  Correcto </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Adjuntar archivo</label>
                        <div class="col-sm-4">
                            <input name="adjunto" class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                
                <div class="row col-5 mx-auto">
                    <button name="guardar_os" class="p-3 fw-bold btn btn-primary" type="submit">ENVIAR</button>
                </div>
            </form><!-- End Custom Styled Validation with Tooltips -->
        </div>
    </div>
    <!-- ======= FIN FORMULARIO ======= -->

    <!-- Recent Sales -->
    <div class="col-12">
            <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title">Últimas Ordenes <span>| Creadas</span></h5>

                <table class="table table-borderless datatable">
                <thead>
                    <tr>
                    <th scope="col">N° Orden</th>
                    <th scope="col">Creado por</th>
                    <th scope="col">Detalle </th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de Creación</th>
                    <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row"><a href="#">#2457</a></th>
                    <td>Brandon Jacob</td>
                    <td><a href="#" class="text-primary">At praesentium minu</a></td>
                    <td>$64</td>
                    <td><span class="badge bg-success">Approved</span></td>
                    </tr>
                    <tr>
                    <th scope="row"><a href="#">#2147</a></th>
                    <td>Bridie Kessler</td>
                    <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                    <td>$47</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    </tr>
                    <tr>
                    <th scope="row"><a href="#">#2049</a></th>
                    <td>Ashleigh Langosh</td>
                    <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                    <td>$147</td>
                    <td><span class="badge bg-success">Approved</span></td>
                    </tr>
                    <tr>
                    <th scope="row"><a href="#">#2644</a></th>
                    <td>Angus Grady</td>
                    <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                    <td>$67</td>
                    <td><span class="badge bg-danger">Rejected</span></td>
                    </tr>
                    <tr>
                    <th scope="row"><a href="#">#2644</a></th>
                    <td>Raheem Lehner</td>
                    <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                    <td>$165</td>
                    <td><span class="badge bg-success">Approved</span></td>
                    </tr>
                </tbody>
                </table>

            </div>

            </div>
    </div><!-- End Recent Sales -->
</section>

</main><!-- End #main -->

<?php require APPROOT . '/views/administrador/partials/footer.php'; ?>
