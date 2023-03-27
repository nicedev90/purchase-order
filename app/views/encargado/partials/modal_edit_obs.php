
  <div class="modal fade" id="edit_obs_<?= $obs->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <div class="card">
            <div class="card-body"> 
              <form action="" class="col-md-12 needs-validation" novalidate method="POST" >
                <input type="hidden" name="id" value="<?php echo $obs->id ?>">
                <input type="hidden" name="num_os" value="<?php echo $obs->num_os ?>">

                <div class="my-3 mt-2 mt-md-0 position-relative">
                  <label for="">Observaciones</label>
                  <textarea name="observaciones" class="form-control" id="exampleFormControlTextarea1" rows="2"><?= $obs->observaciones ?></textarea>

                  <div class="valid-tooltip"> Correcto </div>
                </div>

                <div class="row col-12 col-md-5 pt-4 mx-auto">
                  <button name="edit_obs" class="p-3 fw-bold btn btn-primary" type="submit">ACTUALIZAR OBSERVACION</button>
                </div>

              </form>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

