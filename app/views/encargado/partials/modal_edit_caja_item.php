  <div class="modal fade" id="edit_caja_item_<?= $orden->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <div class="card">
            <div class="card-body"> 
              <form action="" class="col-md-12 needs-validation" novalidate method="POST" >
                <input type="hidden" name="id" value="<?php echo $orden->id ?>">

                <div class="row my-3">
                  <div class=" d-flex-col  col-md-6 position-relative">
                    <label for="" >Fecha</label>
                    <input name="fecha"  type="date" class="form-control form-control-sm" id="fecha" value="<?php echo date('Y-m-d',strtotime($orden->fecha)) ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required  autocomplete="off">
                    <div class="valid-tooltip">Correcto</div>
                  </div>


                  <div class="d-flex-col  col-md-6 position-relative">
                    <label for="" >Centro Costo</label>
                    <input name="centro_costo"  type="text"  class="form-control form-control-sm" id="centro_costo" value="<?= $orden->centro_costo ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce unidad" required  autocomplete="off">
                    <div class="valid-tooltip">Correcto</div>
                  </div>
                </div>

                <div class="my-3 mt-2 mt-md-0 position-relative">
                  <label for="">Proveedor</label>
                  <input name="proveedor" type="text" class="form-control form-control-sm" id="" value="<?= $orden->proveedor ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" autocomplete="off">
                  <div class="valid-tooltip"> Correcto </div>
                </div>

                <div class="my-3 mt-2 mt-md-0 position-relative">
                  <label for="">Descripcion</label>
                  <input name="descripcion" type="text" class="form-control form-control-sm" id="" value="<?= $orden->descripcion ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                  <div class="valid-tooltip"> Correcto </div>
                </div>

                <div class="row my-3">
                  <div class="col-md-6 mt-2 mt-md-0 position-relative">
                    <label for="" >Documento</label>
                    <input name="documento" type="text" class="form-control form-control-sm" id="validationTooltip02" value="<?= $orden->documento ?>"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor"  autocomplete="off">
                    <div class="valid-tooltip">  Correcto </div>
                  </div>

                  <div class="col-md-6 mt-2 mt-md-0 position-relative">
                    <label for="" >Monto</label>
                    <input name="monto" type="number" class="form-control form-control-sm " id="validationTooltip02" value="<?=$orden->monto?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
                    <div class="valid-tooltip">  Correcto </div>
                  </div>
                </div>


                <div class="row col-12 col-md-5 pt-4 mx-auto">
                  <button name="edit_item" class="p-3 fw-bold btn btn-primary" type="submit">Guardar Cambios</button>
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