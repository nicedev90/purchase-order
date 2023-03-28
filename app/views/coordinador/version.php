<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Información <i class="bi bi-megaphone-fill"></i></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Información <i class="bi bi-info-lg"></i></i></li>
                <li class="breadcrumb-item active">Versión <i class="bi bi-people"></i></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-4">
          <div class="row">
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Información General <i class="bi bi-people"></i> <span>| SOS</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">1° ero</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Inicio de Sesión en el Sistema de Orden y Servicio.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2° do</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Si no tienes cuenta, solicitala a través del formulario de Registrate en el Login.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">3° ero</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    El Sistema registra órdenes de Tipo Fondo o Compra.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">4° to</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    El Sistema tiene aprobaciones dadas por Áreas Responsables a cargo.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">5° to</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    El sistema notifica a través de un correo, cuando se crea una orden.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">6° to</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Reporte de Orden de Servicio a través de PDF.
                  </div>
                </div><!-- End activity item-->

              </div>
            </div>
          </div><!-- End Recent Activity -->

          </div>
        </div><!-- End Left side columns -->




        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Preguntas Frecuentes <i class="bi bi-info-circle-fill"></i></h5>

              <!-- Accordion without outline borders -->
              <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                      ¿Quién puede crear una Orden de Servicio?
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Todas las ordenes pueden ser creadas por todos los usuarios, a excepción del Rol Administrador y Coordinador.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                      ¿Qué tipos de Ordenes de Servicio hay en el SOS?
                    </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Existen dos tipos de Ordenes, las cuales son de Tipo "Fondo" y "Compra".</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                      ¿Qué tipo de roles hay en el Sistema?
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Existen 4 tipos de roles en el Sistema, los cuales son el Administrador, Coordinador, Encargado y Usuario.</div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                      ¿Puedo agregar más Centros de Costos en el SOS?
                    </button>
                  </h2>
                  <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Si, para ello debe solicitarlo a su Coordinador o Administrador, para que gestione la creación de un campo más en los Centros de Costos. No obstante, tambien puede añadir, editar o eliminar Centros de Costos esto es igual para las categorías.</div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                      ¿Puedo editar una Orden de Servicio Creada?
                    </button>
                  </h2>
                  <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Si puedes editarla, siempre y cuando tu orden de servicio creada no haya sido aprobada, en caso contrario si se a realizado algún tipo de aprobación o denegación, tu orden no se podra editar. </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                      ¿Qué pasaría si quiero eliminar una Orden de Servicio Creada?
                    </button>
                  </h2>
                  <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">En este caso, solo el que puede eliminar ordenes de servicio es el Administrador. Esto a medida para tener una mejor gestión de la Información </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                      ¿Puedo dejar una Orden de Servicio Abierta?
                    </button>
                  </h2>
                  <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSevenx" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">No puedes dejar ninguna orden de servicio a medio crear, dado que el Sistema te asigna un Número, cuando solicitas un Orden. Para ello, cancelar la Orden y generar una Nueva Orden de Servicio.</div>
                  </div>
                </div>
                
              </div><!-- End Accordion without outline borders -->

            </div>
          </div>

        </div>
      </div>




      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-4">
          <div class="row">
            <!-- Recent Activity -->
            <div class="card">

              <div class="card-body pb-0">
              <h5 class="card-title">Versión <i class="bi bi-journal-code"></i> <span>| Software de Desarrollo </span></h5>

              <div class="news">
                <div class="post-item clearfix">
                  <img src="<?php echo URLROOT; ?>/img/mysql.png" alt="">
                  <h4><a href="">Base de Datos MySQL <i class="bi bi-hdd-stack-fill"></i> </a></h4>
                  <p>Versión 8</p>
                  <p> All Rights Reserved</p>
                </div>
                <div class="post-item clearfix">
                  <img src="<?php echo URLROOT; ?>/img/php.png" alt="">
                  <h4><a href="">PHP <i class="bi bi-filetype-php"></i></a></h4>
                  <p>Versión 7.2 Native</p>
                  <p> All Rights Reserved</p>
                </div>

                <div class="post-item clearfix">
                  <img src="<?php echo URLROOT; ?>/img/html.png" alt="">
                  <h4><a href="">HTML 5 <i class="bi bi-filetype-html"></i></a></h4>
                  <p>Versión 5 Web</p>
                  <p> All Rights Reserved</p>
                </div>

                <div class="post-item clearfix">
                  <img src="<?php echo URLROOT; ?>/img/css.png" alt="">
                  <h4><a href="">CCS 3 <i class="bi bi-filetype-css"></i></a></h4>
                  <p>Version 3 </p>
                  <p> All Rights Reserved</p>
                </div>

                <div class="post-item clearfix">
                  <img src="<?php echo URLROOT; ?>/img/js.png" alt="">
                  <h4><a href="">JavaScript <i class="bi bi-filetype-js"></i></a></h4>
                  <p>Versión 2023</p>
                  <p> All Rights Reserved</p>
                </div>

                <div class="post-item clearfix">
                  <img src="<?php echo URLROOT; ?>/img/boostrap.png" alt="">
                  <h4><a href="">Boostrap 5 <i class="bi bi-bootstrap-fill"></i></a></h4>
                  <p>Versión 5.2</p>
                  <p> All Rights Reserved</p>
                </div>

              </div><!-- End sidebar recent posts-->

            </div>
            </div><!-- End Recent Activity -->

          </div>
        </div><!-- End Left side columns -->
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Desarrollo de Software | Estadística <i class="bi bi-file-earmark-code"></i></h5>

              <!-- Pie Chart -->
              <div id="pieChart" style="min-height: 635px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#pieChart")).setOption({
                    title: {
                      text: 'Programación',
                      subtext: 'Software',
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
                      name: 'Software',
                      type: 'pie',
                      radius: '70%',
                      data: [{
                          value: 1000,
                          name: 'PHP 25%'
                        },
                        {
                          value: 1000,
                          name: 'HTML5 25%'
                        },
                        {
                          value: 600,
                          name: 'CSS 15%'
                        },
                        {
                          value: 880,
                          name: 'JavaScritp 22%'
                        },
                        {
                          value: 720,
                          name: 'Boostrap 18%'
                        }
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

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>