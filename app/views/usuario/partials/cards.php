
    <div class="row">
      <div class="col-lg-12">
        <div class="row">

          <div class="col-lg-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Ordenes de Servicio</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                  </div>

                  <div class="ps-3">
                    <h6><?php echo $data['ordenes_user'] ?></h6>
                    <a href="<?php echo URLROOT . '/' . $data['controller'] . '/historial' ?>">
                      <span class="text-primary pt-1 small pt-1 fw-bold"> Ver Historial OS
                        <i class="bi bi-folder"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Última Orden <span>| Creada</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-send-check-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>OS N° - <?php echo $data['ultima_orden'] ?></h6>
                    <?php if ($data['ultima_orden'] > 0 ) : ?>
                      <a href="<?php echo URLROOT . '/' . $data['controller'] . '/detalles/' . $data['ultima_orden'] ?>">
                        <span class="text-primary pt-1 small pt-1 fw-bold"> Ver Detalles
                          <i class="bi bi-folder"></i>
                        </span>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Orden Completas <span>| Aceptadas</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div class="ps-3">

                      <h6><?php echo $data['ordenes_aprobadas'] ?></h6>
                    </div>
                  </div>
                </div>
              </div>
          </div>

        </div>
    </div>