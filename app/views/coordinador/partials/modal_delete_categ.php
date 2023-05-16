<div class="modal fade" id="delete_categ_<?php echo $categoria->id ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="section"> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="pagetitle">
                                    <p></p>
                                    <h1><b>Eliminar Categoria de centro de costo</b> <?php echo $categoria->categoria ?> <i class="bi bi-person-fill-dash"></i></h1>

                                <form action="<?php echo URLROOT ?>/coordinadores/edit_categoria/<?php echo isset($data['mina']) ? $data['mina']->id : ''; ?>" method="post">
                                    <div class="mt-4 text-center">
                                        <input type="hidden" name="categoria_id" value="<?php echo $categoria->id ?>">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-reply-all-fill"></i> Cancelar</button>
                                        <button type="submit" name="delete_categoria" class="btn btn-danger"><i class="bi bi-person-fill-dash"></i> Eliminar</button>
                                    </div>
                                    <div class="row my-4">
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div><!-- End Large Modal-->


