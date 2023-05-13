<div class="modal fade" id="delete_unidad_<?php echo $unidad->id ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="section"> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="pagetitle">
                                    <p></p>
                                    <h1><b>Eliminar unidad</b> <?php echo $unidad->unidad ?> <i class="bi bi-person-fill-dash"></i></h1>

                                <form action="<?php echo URLROOT ?>/coordinadores/edit_unidad" method="post">
                                    <div class="text-center">
                                        <input type="hidden" name="unidad_id" value="<?php echo $unidad->id ?>">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-reply-all-fill"></i> Cancelar</button>
                                        <button type="submit" name="delete_unidad" class="btn btn-danger"><i class="bi bi-person-fill-dash"></i> Eliminar</button>
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


