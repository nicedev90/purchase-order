<?php if (strtoupper($data['orden'][0]->tipo)  == 'FONDOS') : ?>

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

<?php else:  ?>

  <div class="modal fade" id="edit_modal_<?= $orden->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <div class="card">
            <div class="card-body"> 
              <form action="" class="col-md-12 needs-validation" novalidate method="POST" >
                <input type="hidden" name="id" value="<?php echo $orden->id ?>">
                <input type="hidden" name="num_os" value="<?php echo $orden->num_os ?>">

                <div class="row my-3">
                  <div class=" d-flex-col  col-md-6 position-relative">
                    <label for="" >Cantidad</label>
                    <input name="cantidad"  type="number" class="form-control form-control-sm" id="cantidad" value="<?= $orden->cantidad ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required  autocomplete="off">
                    <div class="valid-tooltip">Correcto</div>
                  </div>


                  <div class="d-flex-col  col-md-6 position-relative">
                    <label for="" >Unidad</label>
                    <input name="unidad"  type="text"  class="form-control form-control-sm" id="unidad" value="<?= $orden->unidad ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce unidad" required  autocomplete="off">
                    <div class="valid-tooltip">Correcto</div>
                  </div>
                </div>

                <div class="my-3 mt-2 mt-md-0 position-relative">
                  <label for="">Descripcion</label>
                  <input name="descripcion" type="text" class="form-control form-control-sm" id="" value="<?= $orden->descripcion ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                  <div class="valid-tooltip"> Correcto </div>
                </div>

                <div class="row my-3">
                  <div class="col-md-6 mt-2 mt-md-0 position-relative">
                    <label for="" >Proveedor</label>
                    <input name="proveedor" type="text" class="form-control form-control-sm" id="validationTooltip02" value="<?= $orden->proveedor ?>"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
                    <div class="valid-tooltip">  Correcto </div>
                  </div>

                  <div class="col-md-6 mt-2 mt-md-0 position-relative">
                    <label for="" >Valor Referencial</label>
                    <input name="valor" type="number" class="form-control form-control-sm " id="validationTooltip02" value="<?=$orden->valor?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
                    <div class="valid-tooltip">  Correcto </div>
                  </div>
                </div>

                <div class="row col-12 col-md-5 pt-4 mx-auto">
                  <button name="edit_item" class="p-3 fw-bold btn btn-primary" type="submit">ACTUALIZAR</button>
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


<?php endif; ?>