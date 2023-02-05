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
    </div><!-- End Page Title -->
    
    <b>asdasdsadasd</b>
 
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
            <div class="col-xxl-3 col-xl-12">

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
            <!-- <?php print_r($data); ?> -->
    <div class="card">
            <div class="card-body">
                <h5 class="card-title"> Nueva Orden de Servicio <b class="bg-warning">n° 0015</b> </h5>
                <p>Rellena los campos para solicitar tu Orden de Servicio Clonsa S.A.C </p>

                <form action="<?php echo URLROOT; ?>/administrador/crear/<?php echo $data['id']; ?>" class="col-md-12 needs-validation" novalidate method="POST">
                <div class="row mb-3">
                    <!-- INICIO SELECT GUIA DE COSTOS -->
                    <div class="col-md-6 position-relative">
                    <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
                    <select name="centro_costo" class="form-select" id="mina" required>
                        <option selected value="<?php echo $data['centro_costo']; ?>"><?php echo $data['centro_costo']; ?></option> 
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
                            
                            <?php foreach($data['categorias'] as $categoria): ?>
                                <option value="<?php echo $categoria->categoria; ?>"> <?php echo $categoria->categoria; ?></option>
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
                        <button class="btn btn-info fw-bold" type="button">+ Agregar item</button>
                    </div>

                    <div class="col-2">
                        <button class="btn btn-danger fw-bold" type="button">- Eliminar item</button>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <!-- INICIO INPUT ITEM -->
                    <div class="col-md-1 position-relative">
                    <label for="validationTooltip01" class="form-label">Item</label>
                    <input type="text" name="item" class="form-control-plaintext" id="validationTooltip01" value="1" required readonly>
                    <div class="valid-tooltip">
                        Correcto
                    </div>
                    </div>
                    <!-- FIN INPUT ITEM -->

                    <!-- INICIO INPUT CANTIDAD -->
                    <div class="col-md-1 position-relative">
                        <label for="validationTooltip01" class="form-label">Cantidad</label>
                        <input name="cantidad" type="text" class="form-control" id="validationTooltip01" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
                        <div class="valid-tooltip">
                            Correcto
                        </div>
                    </div>
                    <!-- FIN INPUT CANTIDAD -->

                    <!-- INICIO SELECT UNIDAD -->
                    <div class="col-md-2 position-relative">
                        <label for="validationTooltip04" class="form-label">Unidad</label>
                        <select name="unidad" class="form-select" id="validationTooltip04" required>
                            <option selected disabled value="">Selecciona...</option>
                            <option>Metro</option>
                            <option>Kilo</option>
                            <option>Litro</option>
                        </select>
                            <div class="invalid-tooltip">
                            Por favor selecciona una unidad.
                            </div>
                    </div>
                    <!-- FIN SELECT UNIDAD -->

                    <div class="col-md-6 position-relative">
                        <label for="" class="form-label">Descripción</label>
                        <input name="descripcion" type="text" class="form-control" id="" value="" data-bs-toggle="tooltip" data-bs-placement="top" title="Llena este campo descripción" required autocomplete="off">
                        <div class="valid-tooltip">
                        Correcto
                        </div>
                    </div>

                    <div class="col-md-2 position-relative">
                        <label for="validationTooltip02" class="form-label">Proveedor Sugerido</label>
                        <input name="proveedor" type="text" class="form-control" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                        <div class="valid-tooltip">
                            Correcto
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Adjuntar archivo</label>
                        <div class="col-sm-4">
                            <input name ="adjuntar_archivo" class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                
                <div class="row col-5 mx-auto">
                    <button name="guardar_os" class="p-3 mt-8 fw-bold btn btn-primary" type="submit">ENVIAR</button>
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
