
  <div class="modal fade" id="subir_adjunto" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <div class="card">
            <div class="card-body"> 
              <form action="" class="col-md-12 needs-validation" novalidate method="POST" enctype="multipart/form-data">
                <input type="hidden" name="num_os" value="<?php echo $data['orden'][0]->num_os ?>">

                <div class="my-3 mt-2 mt-md-0 position-relative">
<!--                   <label for="myFile" class="col-md-4"> 
                    <span class="btn btn-primary text-light">Cargar. <i class="bi bi-paperclip"></i> </span>
                  </label> -->
                  <input type='file' name="subir_file" id="myFile" >
                </div>

                <div class="row col-12 col-md-5 pt-4 mx-auto">
                  <button name="subir_adjunto" class="p-3 fw-bold btn btn-primary" type="submit">SUBIR ARCHIVO</button>
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

