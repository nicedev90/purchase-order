<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">
  <!-- breadcrumb section -->
  <div class="pagetitle">
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active"><?= $data['pagename'] ?></li>
      </ol>
    </nav>
  </div>
 
<section class="section dashboard">
  <div class="row">

    <!-- ======= INICIO FORMULARIO ======= -->
    <div class="card">
      <div class="card-body">

        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-md-5 d-flex justify-content-between align-items-center">
            <div class="col-md-8 card-title"> Reportes Por Mes</div>
          </div>
        </div>

        <!-- FILA 1  mina - categoria -->
        <div class="row justify-content-md-around align-items-center "> 
          <input type="hidden" name="currentMonth" value="<?php echo date("m") ?>">

          <div class="col-md-6">
            <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
            <select name="mina" class="form-select" id="mina" required>
              <option selected disabled value="">Selecciona...</option> 
              <?php foreach($data['minas'] as $mina): ?>
                <option value="<?php echo $mina->codigo; ?>"> <?php echo $mina->nombre; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
          </div>

          <div class="col-md-6 mt-4 mt-md-0">
            <label for="validationTooltip04" class="form-label">Seleccionar Mes</label>
            <select name="mes" class="form-select" id="mes" required>
              <option selected disabled value="">Selecciona...</option> 
              <?php foreach($data['meses'] as $numero => $mes): ?>
                <option value="<?php echo $numero ?>"> <?php echo $mes ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip">Por favor selecciona mes</div>
          </div>

        </div>

        <!-- FILA 2 BOTON DE ENVIAR -->
        <div class="row">
          <div class="row col-12 col-md-4 mt-5 mx-auto">
            <button id="btn_compra" data-tipo="compra" data-method="<?= strtolower($data['pagename']) ?>" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" class="p-2 fw-bold btn btn-primary" > REPORTE COMPRA </button>
          </div>

          <div class="row col-12 col-md-4 mt-5 mx-auto">
            <button id="btn_fondos" data-tipo="fondos" data-method="<?= strtolower($data['pagename']) ?>" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" class="p-2 fw-bold btn btn-primary" > REPORTE <?php echo ($_SESSION['user_sede'] == 'Peru') ? 'CAJA CHICA' : 'FONDOS' ?> </button>
          </div>
        </div>
        
      </div>
    </div>
    <!-- ======= FIN FORMULARIO ======= -->

    <!-- Inicio tabla resumen Ordenes -->
    <pre><?php print_r($data) ?></pre>


    <?php if (isset($data['tipo']) && strtoupper($data['tipo']) == 'FONDOS') : ?>

    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <h5 class="card-title">Reporte de Mina :<?php echo $data['reporte'][0]->mina_nom ?>
            <a  href="<?php echo URLROOT . '/' . $data['controller'] . '/reporte_pdf/' . $data['tipo'] . '/' . $data['mina'] . '/' . $data['mes'] ?>" target="_blank" class="p-2 fw-bold btn btn-primary" > GENERAR REPORTE Fondos </a>
          </h5>
          <div class="col-md-4">
            <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
          </div>
          <h5 class="card-title"> Mes : <?php echo fixedMes($data['reporte'][0]->actualizado) ?></h5>
          <table class="table table-hover table-borderless datatable">
            <thead>
              <tr>
              <th scope="col">N°</th>
              <th scope="col">Mina </th>
              <th scope="col" class="d-none d-md-table-cell">Categoria</th>
              <th scope="col" class="d-none d-md-table-cell">Creado por</th>
              <th scope="col" class="d-none d-md-table-cell">Monto</th>
              <th scope="col">Estado</th>
              <th scope="col" class="d-none d-md-table-cell">Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['reporte'] as $orden): ?>            <tr>
                <td class="fw-bold"><?php echo utf8_encode($orden->num_os); ?></th>
                
                <td class="text-primary"><?php echo utf8_encode($orden->mina_nom); ?></td>
                <td class="text-primary"><?php echo utf8_encode($orden->categ_nom); ?></td>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->usuario); ?></th>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->valor_total); ?></th>

                <td>
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <span class="<?= bgAprobado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php elseif (strtoupper($orden->estado) == 'RECHAZADO') : ?>
                    <span class="<?= bgRechazado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php else: ?>
                    <span class="<?= bgEnProceso() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php endif; ?>
                  
                </td>
                <td class="d-none d-md-table-cell"><?php echo fixedFecha($orden->creado); ?></td>

                  
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>


    <?php if (isset($data['tipo'])  && strtoupper($data['tipo']) == 'COMPRA') : ?>

    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">

          <?php if (isset($data['reporte'][0]->mina_nom)) : ?>

          <div class="row d-md-flex justify-content-md-start justify-content-around align-items-center card-title ">
            <div class="d-flex col-md-4 py-2 justify-content-start ">
              <div class="col-md-6"> Reporte Mina : </div>
              <div class="col-md-6 p-1 fw-bold btn btn-warning"> <?= $data['reporte'][0]->mina_nom; ?></div>
            </div>

            <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
              <div class="col-md-6 p-1 <?= bgFondos() ?>"> <?=  fixedMes($data['reporte'][0]->actualizado) ?></div>
              <div class="col-md-6 p-1 <?= bgFondos() ?>"> <?=  setName($data['reporte'][0]->tipo) ?></div>
            </div>

            <div class="d-flex col-md-4 py-2 justify-content-start justify-content-md-end">
              <div class="col-md-4">Imprimir : </div>
              <a  href="<?php echo URLROOT . '/' . $data['controller'] . '/reporte_pdf/' . strtoupper($data['tipo']) . '/' . $data['mina'] . '/' . $data['mes'] ?>" target="_blank" class="p-2 btn btn-danger" ><i class="bi bi-file-earmark-pdf"></i> Descargar PDF </a>
            </div>

          </div>

          <?php endif; ?>

          <table class="table table-hover table-borderless datatable">
            <thead>
              <tr>
              <th scope="col">N°</th>
              <th scope="col">Mina </th>
              <th scope="col" class="d-none d-md-table-cell">Creado por</th>
              <th scope="col" class="d-none d-md-table-cell">Monto</th>


              <th scope="col">Estado</th>
              <th scope="col" class="d-none d-md-table-cell">Fecha</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach($data['reporte'] as $orden): ?>            <tr>
                <td class="fw-bold"><?php echo utf8_encode($orden->num_os); ?></th>


                
                <td class="text-primary"><?php echo utf8_encode($orden->mina_nom); ?></td>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->usuario); ?></th>

                <td class="fw-bold d-none d-md-table-cell"><?php echo utf8_encode($orden->valor_total); ?></th>

                <td>
                  <?php if (strtoupper($orden->estado) == 'APROBADO') : ?>
                    <span class="<?= bgAprobado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php elseif (strtoupper($orden->estado) == 'RECHAZADO') : ?>
                    <span class="<?= bgRechazado() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php else: ?>
                    <span class="<?= bgEnProceso() ?> btn-sm"><?php echo utf8_encode(strtoupper($orden->estado)); ?></span>
                  <?php endif; ?>
                  
                </td>
                <td class="d-none d-md-table-cell"><?php echo fixedFecha($orden->creado); ?></td>

                  
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>



</section>

</main><!-- End #main -->

<!-- warning Modal -->
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

<!-- Success Modal -->

<div class="modal fade" id="<?= createdAlert() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        LA ORDEN SE CREO CON EXITO
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>







<main id="main" class="main">

    <div class="pagetitle">
        <h1>Reporte SOS FONDO <i class="bi bi-bar-chart-line-fill"></i></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Estadística <i class="bi bi-layout-text-window"></i></li>
                <li class="breadcrumb-item active">Reporte <i class="bi bi-calendar-week-fill"></i></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
    <div class="row">
        
      <div class="col-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Ordenes Totales <i class="bi bi-toggle-on"></i> <span>|Ordenes Aprobadas Totales</span></h5>

            <table class="table table-hover table-borderless datatable ">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Ordenes Totales Fondos <i class="bi bi-calendar2-check-fill"></i></th>
                  <th scope="col" class="text-center">Ordenes Aprobadas Fondos <i class="bi bi-cursor"></i></th> 
                </tr>
              </thead>
                          
              <tbody>
                <tr>
                  <td class="fw-bold text-center"> 80 </td>
                  <td class="fw-bold text-center"> 50</td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Resumen Ordenes Totales <i class="bi bi-toggle-on"></i> <span>| Usuarios</span></h5>

            <table class="table table-hover table-borderless datatable ">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Item <i class="bi bi-sort-numeric-down"></i></th>
                  <th scope="col" class="text-center">Creado Por <i class="bi bi-cursor"></i></th> 
                  <th scope="col" class="text-center">N° Orden <i class="ri-alarm-warning-fill"></i></th>
                  <th scope="col" class="text-center">Estado <i class="bi bi-calendar2-check-fill"></i></th>
                </tr>
              </thead>
                        
              <tbody>
                <tr>
                  <td class="fw-bold text-center"> 1 </td>
                  <td class="fw-bold text-center"> Antauro Humala</td>
                  <td class="text-dark text-center"> N° 30 - 2023 </td>
                  <td class="text-dark text-center"> Aceptada </td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
            </div>
          </div>
        </div>
      </div>
    
      <div class="col-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Gastos Totales Por Mina <i class="bi bi-toggle-on"></i> <span>|Gastos Totales Mina</span></h5>

            <table class="table table-hover table-borderless datatable ">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Item <i class="bi bi-sort-numeric-down"></i></th>
                  <th scope="col" class="text-center">Mina <i class="bi bi-cloud-drizzle-fill"></i></th> 
                  <th scope="col" class="text-center">Gasto <i class="bi bi-cash-coin"></i></th> 
                </tr>
              </thead>
                          
              <tbody>
                <tr>
                  <td class="fw-bold text-center"> 1 </td>
                  <td class="fw-bold text-center"> Bambas</td>
                  <td class="fw-bold text-center"> 15000</td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Gastos Totales Por Persona <i class="bi bi-toggle-on"></i> <span>| Usuario</span></h5>

            <table class="table table-hover table-borderless datatable ">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Item <i class="bi bi-sort-numeric-down"></i></th>
                  <th scope="col" class="text-center">Usuario <i class="bi bi-person"></i></th> 
                  <th scope="col" class="text-center">Gasto <i class="bi bi-cash-coin"></i></th> 
                </tr>
              </thead>
                        
              <tbody>
                <tr>
                  <td class="fw-bold text-center"> 1 </td>
                  <td class="fw-bold text-center"> Antauro Humala</td>
                  <td class="text-dark text-center"> 1200 </td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Fin tabla resumen Ordenes -->
   <!-- Reports -->
   <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reporte <span>/Mensual Ordenes de Servicio</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'OS Creadas',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'OS Aprobadas',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'OS Rechazadas',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->


    <div class="pagetitle">
        <h1>Reporte SOS COMPRA <i class="bi bi-bar-chart-line-fill"></i></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Estadística <i class="bi bi-layout-text-window"></i></li>
                <li class="breadcrumb-item active">Reporte <i class="bi bi-calendar-week-fill"></i></li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        
      <div class="col-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Ordenes Totales <i class="bi bi-toggle-on"></i> <span>|Ordenes Aprobadas Totales</span></h5>

            <table class="table table-hover table-borderless datatable ">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Ordenes Totales Compra <i class="bi bi-calendar2-check-fill"></i></th>
                  <th scope="col" class="text-center">Ordenes Aprobadas Compra <i class="bi bi-cursor"></i></th> 
                </tr>
              </thead>
                          
              <tbody>
                <tr>
                  <td class="fw-bold text-center"> 80 </td>
                  <td class="fw-bold text-center"> 50</td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Resumen Ordenes Totales <i class="bi bi-toggle-on"></i> <span>| Usuarios</span></h5>

            <table class="table table-hover table-borderless datatable ">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Item <i class="bi bi-sort-numeric-down"></i></th>
                  <th scope="col" class="text-center">Creado Por <i class="bi bi-cursor"></i></th> 
                  <th scope="col" class="text-center">N° Orden <i class="ri-alarm-warning-fill"></i></th>
                  <th scope="col" class="text-center">Estado <i class="bi bi-calendar2-check-fill"></i></th>
                </tr>
              </thead>
                        
              <tbody>
                <tr>
                  <td class="fw-bold text-center"> 1 </td>
                  <td class="fw-bold text-center"> Antauro Humala</td>
                  <td class="text-dark text-center"> N° 30 - 2023 </td>
                  <td class="text-dark text-center"> Aceptada </td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Descargar PDF</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Usuarios | Clonsa SOS<i class="bi bi-file-earmark-code"></i></h5>

              <!-- Pie Chart -->
              <div id="pieChart" style="min-height: 500px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#pieChart")).setOption({
                    title: {
                      text: 'Cuentas',
                      subtext: 'Personal Clonsa Ingeniería',
                      left: 'center'
                    },
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      orient: 'vertical',
                      left: 'left'
                    },
                    series: [{
                      name: 'Cuenta',
                      type: 'pie',
                      radius: '70%',
                      data: [{
                          value: 1000,
                          name: 'Usuario'
                        },
                        {
                          value: 1000,
                          name: 'Encargado'
                        },
                        {
                          value: 600,
                          name: 'Coordinador'
                        },
                        {
                          value: 880,
                          name: 'Administrador'
                        },
                      ],
                      emphasis: {
                        itemStyle: {
                          shadowBlur: 10,
                          shadowOffsetX: 0,
                          shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                      }
                    }]
                  });
                });
              </script>
              <!-- End Pie Chart -->

            </div>
          </div>
        </div>
    </div>
    </section>

</main><!-- End #main -->





<script src="<?php echo URLROOT; ?>/js/reportes_cc.js"></script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>