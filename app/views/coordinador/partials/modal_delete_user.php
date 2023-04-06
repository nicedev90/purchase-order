<div class="modal fade" id="delete_user_<?php echo $usuario->id ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="section"> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="pagetitle">
                                    <p></p>
                                    <h1><b>Eliminar Usuario</b> <?php echo $usuario->nombre ?> <i class="bi bi-person-fill-dash"></i></h1>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="">Acceso Premium</a></li>
                                            <li class="breadcrumb-item active">Clonsa Ingeniería <i class="bi bi-person-fill-dash"></i></li>
                                        </ol>
                                    </nav>
                                </div>
                                <p class="text-center">
                                <img src="<?php echo URLROOT; ?>/img/delete.gif" width="350" height="250">
                                </p>
                                <p class="text-center">¿Desea eliminar a usuario <b> "Makuko Gallardo" </b>permanente? <i class="bi bi-person-fill-dash"></i></p>
                                <p></p>
                                <form action="<?php echo URLROOT ?>/coordinadores/edit_user" method="post">
                                    <div class="text-center">
                                        <input type="hidden" name="user_id" value="<?php echo $usuario->id ?>">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-reply-all-fill"></i> Cancelar</button>
                                        <button type="submit" name="eliminar_user" class="btn btn-danger"><i class="bi bi-person-fill-dash"></i> Eliminar</button>
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





  