  <div class="modal fade" id="edit_user_<?php echo $usuario->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <h2>AGREGAR NUEVO </h2>
          <form action="<?php echo URLROOT ?>/coordinadores/edit_user" method="post">
              <input type="hidden" name="user_id" value="<?php echo $usuario->id ?>">

              <div class="row mb-3">
                  <div class="col-6">
                      <label for="validationTooltip04" class="form-label">Rol de usuario</label>
                      <select name="rol_id" class="form-select" required>
                          <option selected value="<?php echo utf8_encode($usuario->rol_id); ?>"><?php echo utf8_encode($usuario->user_rol); ?></option> 
                          <?php foreach($data['roles'] as $rol): ?>
                               <option value="<?php echo $rol->id; ?>"> <?php echo $rol->rol; ?></option>
                          <?php endforeach; ?>
                      </select>
                      <div class="invalid-tooltip">
                          Por favor selecciona la Unidad Minera
                      </div>
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-6">
                      <label for="validationTooltip04" class="form-label">Funcion</label>
                      <select name="funcion" class="form-select" required>
                          <option selected value="<?php echo utf8_encode($usuario->funcion); ?>"><?php echo utf8_encode($usuario->funcion); ?></option> 
                          <option value="Normal"> Normal</option>
                          <option value="Revisor"> Revisor</option>
                      </select>
                      <div class="invalid-tooltip">
                          Por favor selecciona la Unidad Minera
                      </div>
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-5">
                      <label for="nombre" class="form-label">Nombre</label>
                      <input name="nombre" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce nombre" required autocomplete="off" value="<?php echo utf8_encode($usuario->nombre); ?>">
                      <div class="valid-tooltip">Correcto</div>
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-5">
                      <label for="usuario" class="form-label">usuario</label>
                      <input name="usuario" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce usuario" required autocomplete="off" value="<?php echo utf8_encode($usuario->usuario); ?>">
                      <div class="valid-tooltip">Correcto</div>
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-5">
                      <label for="email" class="form-label">email</label>
                      <input name="email" type="email" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce email" required autocomplete="off" value="<?php echo utf8_encode($usuario->email); ?>">
                      <div class="valid-tooltip">Correcto</div>
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-5">
                      <label for="password" class="form-label">password</label>
                      <input name="password" type="password" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce password" required autocomplete="off" value="<?php echo utf8_encode($usuario->password); ?>">
                      <div class="valid-tooltip">Correcto</div>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-6">
                      <label for="validationTooltip04" class="form-label">estado</label>
                      <select name="estado" class="form-select" required>
                          <option selected value="<?php echo utf8_encode($usuario->estado); ?>"><?php echo utf8_encode($usuario->estado); ?></option> 
                          <option value="Activo"> Activo</option>
                          <option value="Inactivo"> Inactivo</option>
                      </select>
                      <div class="invalid-tooltip">
                          Por favor selecciona la Unidad Minera
                      </div>
                  </div>
              </div>


              <button type="submit" class="btn btn-danger col-12">
                  <i class="bi bi-printer"></i> <b>ACTUALIZAR USER</b> 
              </button>

              </form>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
  </div><!-- End Large Modal-->