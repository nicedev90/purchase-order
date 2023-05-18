<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/header.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/topbar.php'; ?>
<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Nuevo Usuario <i class="bi bi-person-check-fill"></i></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Crear Nuevo Usuario <i class="bi bi-person-fill-add"></i></li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
      <div class="card p-2">
        <div class="card-body">
          <div class="row justify-content-md-around "> 

            <div class="col-md-6 pt-4">
              <label for="validationTooltip04" class="form-label">Guía de Centros de Costos</label>
              <select name="mina" class="form-select" id="mina" data-method="<?= $data['pagename'] ?>" data-url="<?= URLROOT ?>" data-controller="<?= $data['controller'] ?>" required>
                <?php if (isset($data['mina'])) : ?>
                  <option selected value="<?php echo $data['mina']->id ?>"> <?php echo $data['mina']->nombre ?></option> 
                <?php else: ?>
                  <option selected disabled value="">Selecciona...</option> 
                <?php endif; ?>
                
                <?php foreach($data['minas'] as $mina): ?>
                  <option value="<?php echo $mina->id; ?>"> <?php echo $mina->nombre; ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
            </div>

            <div class="d-flex col-md-6 mb-4 mb-md-0 justify-content-around">
              <form action="<?php echo URLROOT ?>/coordinadores/edit_categoria/<?php echo isset($data['mina']) ? $data['mina']->id : ''; ?>" method="post" class="p-4">

                <input type="hidden" name="codigo" value="<?php echo isset($data['nextCode']) ? $data['nextCode'] : ''; ?>">
                <input type="hidden" name="mina_id" value="<?php echo isset($data['mina']) ? $data['mina']->id : ''; ?>">
                
                <div class="row mb-3">
                  <label for="validationTooltip04" class="col-md-4 col-lg-3 col-form-label" class="form-label">Tipo</label>
                  <div class="col-md-8 col-lg-9">

                    <select name="tipo" class="form-select" id="tipo" required>
                      <option selected disabled value="">Selecciona...</option> 
                        <option value="Fondos"> Fondos</option>
                        <option value="Compra"> Compra</option>
                    </select>
                    <div class="invalid-tooltip">Por favor selecciona la Unidad Minera</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="categoria" class="col-md-4 col-lg-3 col-form-label">Categoria</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="categoria" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="nombre de Categoria" required autocomplete="off">
                    <div class="valid-tooltip">Correcto</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck3" required>
                    <label class="form-check-label" for="invalidCheck3">
                        Acepto los cambios realizados, bajo mi Responsabilidad de Coordinador.
                    </label>
                    <div class="invalid-feedback">
                        Por favor, acepta los Términos y Condiciones.
                    </div>
                  </div>
                </div>


                <div class="text-center">
                  <button type="submit" name="add_categoria" class="btn btn-primary"> Agregar Categoria</button>
                </div>
              </form>
            </div>

          </div>

          <div class="row justify-content-md-around align-items-center mt-4 "> 

            <div class="col">

              <div class="card">
                <div class="card-body profile-card  align-items-center">
                  <h2>Categorias de : <?php echo isset($data['mina']) ? $data['mina']->nombre : ''; ?> </h2>
                  <?php if (isset($data['categorias'])) : ?>
                  <?php foreach($data['categorias'] as $categoria) : ?>
                    <div class="col-md-11 d-flex justify-content-between align-items-center">
                      <div class="col-md-8 card-title bg-info p-2">
                        <?php echo $categoria->codigo . ' - ' . strtoupper($categoria->tipo) . ' - ' . $categoria->categoria  ?>
                      </div>

                      <div class="col-md-1 p-2 fw-bold  rounded text-center">
                        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_categ_<?php echo $categoria->id ?>">
                          <i class="bi bi-trash3-fill"></i>
                        </a>
                        <?php require APPROOT . '/views/coordinador/partials/modal_delete_categ.php'; ?>
                      </div>
                    </div>
                    
                  <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<script>
  window.addEventListener('DOMContentLoaded', () => {
    const mina = document.querySelector('#mina')
    mina.addEventListener('change', loadCateg)
  })

  const loadCateg = (e) => {
    const select = e.target
    const centro_costo = e.target.value
    let urlRoot     = select.getAttribute('data-url')
    let controller  = select.getAttribute('data-controller')
    let method      = select.getAttribute('data-method').toLowerCase()

    if (centro_costo) {
      location.href = `${urlRoot}/${controller}/${method}/${centro_costo}`
    } 
  }

</script>

<?php require APPROOT . '/views/' . strtolower($_SESSION['user_rol']) . '/partials/footer.php'; ?>
