

  <div class="modal fade" id="aprobar_orden1" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <div class="card">
            <div class="card-body"> 
              <form action="" class="col-md-12 needs-validation" novalidate method="POST" >
                <input type="hidden" name="num_os" value="<?php echo $data['orden'][0]->num_os ?>">


                <div class="my-3 mt-2 mt-md-0 position-relative">
                  <label for="" class="my-3 fw-bold">Observacion</label>
                  <input name="observacion" type="text" class="form-control form-control" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
                  <div class="valid-tooltip"> Correcto </div>
                </div>


              <div class="my-3 mt-2 mt-md-0 position-relative">
                <label for="" class="my-3 fw-bold">1 ° Aprobacion</label>
                <select name="aprobacion" class="form-control form-control-lg" id="validationTooltip04" required>
                  <option selected disabled value="">Selecciona...</option>
                  <option value="Aprobado">Aprobado</option>
                  <option value="Rechazado">Rechazado</option>
                </select>
                <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
              </div>

              <div class="my-5 position-relative">
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



                <div class="row col-12 col-md-5 pt-4 mx-auto">
                  <button name="btn_aprobacion1" class="p-3 fw-bold btn btn-primary" type="submit">GUARDAR</button>
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

