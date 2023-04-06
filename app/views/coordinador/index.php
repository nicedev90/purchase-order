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
     <!--  **************** CARDS **************** -->
    <div class="row">
      <div class="col-lg-12">
        <div class="row">

          <div class="col-lg-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| Usuarios</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                  </div>

                  <div class="ps-3">
                    <h6><?php echo (!empty($data['usuarios'])) ? count($data['usuarios']) : '' ?></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Supervisor <?= setTipoBySede() ?><span>| SOS</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-send-check-fill"></i>
                  </div>
                  <div class="ps-3">
                    <?php foreach($data['superv'] as $superv) : ?>
                      <?php 
                        if (strtoupper($superv->tipo) == 'FONDOS') {
                          $orden = explode('_', $superv->funcion);
                          echo '<h5>' . $orden[1] . '°  ' . $superv->nombre .'</h5>';
                        }
                      ?>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Supervisor Compra <span>| SOS</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php foreach($data['superv'] as $superv) : ?>
                      <?php 
                        if (strtoupper($superv->tipo) == 'COMPRA') {
                          $orden = explode('_', $superv->funcion);
                          echo '<h5>' . $orden[1] . '°  ' . $superv->nombre .'</h5>';
                        }
                      ?>
                    <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
          </div>

        </div>
    </div>
    <!-- Inicio tabla resumen Ordenes -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Lista usuarios</h5>

                <table class="table table-hover table-borderless datatable">
                    <thead>
                        <tr>
                        <th class="col text-center">Rol</th>
                        <th class="col text-center">Funcion</th>
                        <th class="col text-center">Nombre</th>
                        <th class="col text-center">Usuario</th>
                        <th class="col text-center">Email</th>
                        <th class="col text-center">Estado</th>
                        <th class="col text-center"> Accion </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['usuarios'] as $usuario): ?>
                        <tr>
                            <td class="text-center fw-bold "> 
                            <?php if($usuario->user_rol=="Encargado"){ ?>
                            <?php  echo '<a class="badge bg-danger">Encargado</a>'; ?>
                            <?php } 
                            else if ($usuario->user_rol == "Usuario" ){?>
                                <?php echo '<a class="badge bg-primary">Usuario</a>'; ?>
                            <?php } ?>
                            </td>

                            <td class="text-dark text-center ">
                            <?php if($usuario->funcion=="Normal"){ ?>
                            <?php  echo '<a class="badge bg-primary">Normal</a>'; ?>
                            <?php } 
                            else if ($usuario->funcion == "Revisor" ){?>
                                <?php echo '<a class="badge bg-dark">Revisor</a>'; ?>
                            <?php } ?>
                            </td>

                            <td class="text-dark text-center fw-bold "><?php echo utf8_encode($usuario->nombre); ?></td>
                            <td  class="text-dark text-center"><?php echo utf8_encode($usuario->usuario); ?></span></td>
                            <td class="text-primary text-center"><?php echo utf8_encode($usuario->email); ?></td>
                            <td class="text-primary text-center">
                                
                                <?php if($usuario->estado=="Activo"){ ?>
                                  <?php  echo '<a class="badge bg-success">Activo</a>'; ?>
                                <?php } 
                                  else if ($usuario->estado == "Inactivo" ){?>
                                  <?php echo '<a class="badge bg-danger">Inactivo</a>'; ?>
                                <?php } ?>
                                </td>
                            <td class="d-flex justify-content-around ">
                                
                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_user_<?php echo $usuario->id ?>"><i class="bi bi-check2-square"></i></a>   
                                <?php require APPROOT . '/views/coordinador/partials/modal_edit_user.php'; ?>
                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_user_<?php echo $usuario->id ?>"><i class="bi bi-trash3-fill"></i></i></a>
                                <?php require APPROOT . '/views/coordinador/partials/modal_delete_user.php'; ?>
            
                            </td>
                            
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Fin tabla resumen usuarioes -->
</section>

</main><!-- End #main -->

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>