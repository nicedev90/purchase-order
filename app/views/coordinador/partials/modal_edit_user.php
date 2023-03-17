<div class="modal fade" id="edit_user_<?php echo $usuario->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <section class="section"> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="pagetitle">
                                    <p></p>
                                    <h1><b>Editar Usuario</b>  <i class="bi bi-person-check-fill"></i></h1>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="">Acceso Premium</a></li>
                                            <li class="breadcrumb-item active">Clonsa Ingeniería <i class="bi bi-person-fill-add"></i></li>
                                        </ol>
                                    </nav>
                                </div>
                                <p>La presente información mostrada es para editar las credenciales de los usuarios creados, quienes estan bajo responsabilidad de la Empresa Clonsa Ingeniería. </p>
                                <form action="<?php echo URLROOT ?>/coordinadores/edit_user" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $usuario->id ?>">

                                    <div class="row mb-3">
                                        <label for="nombre" class="col-md-4 col-lg-3 col-form-label"><b>Nombres</b></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nombre" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce Nombres Completos" required autocomplete="off" value="<?php echo utf8_encode($usuario->nombre); ?>">
                                            <div class="valid-tooltip">Correcto    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="usuario" class="col-md-4 col-lg-3 col-form-label"><b>Usuario</b></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="usuario" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce Nuevo Usuario" required autocomplete="off" value="<?php echo utf8_encode($usuario->usuario); ?>">
                                            <div class="valid-tooltip">Correcto
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label"><b>Contraseña</b></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce contraseña" required autocomplete="off" value="<?php echo utf8_encode($usuario->password); ?>">
                                            <div class="valid-tooltip">Correcto
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label"><b>Correo Electrónico</b></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="bottom" placeholder="Introduce Correo Electrónico" required autocomplete="off" value="<?php echo utf8_encode($usuario->email); ?>">
                                            <div class="valid-tooltip">Correcto
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="validationTooltip04" class="col-md-4 col-lg-3 col-form-label"><b>Rol de Usuario</b> </label>
                                            <div class="col-md-8 col-lg-9">
                                                <select name="rol_id" class="form-select" required>
                                                    <option selected value="<?php echo utf8_encode($usuario->rol_id); ?>"><?php echo utf8_encode        ($usuario->user_rol); ?></option> 
                                                        <?php foreach($data['roles'] as $rol): ?>
                                                    <option value="<?php echo $rol->id; ?>"> <?php echo $rol->rol; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-tooltip">
                                                    Por favor selecciona el Rol de Usuario
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="validationTooltip04" class="col-md-4 col-lg-3 col-form-label"><b>Función</b></label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="funcion" class="form-select" required>
                                                <option selected value="<?php echo utf8_encode($usuario->funcion); ?>"><?php echo utf8_encode($usuario->funcion); ?></option> 
                                                <option value="Normal"> Normal</option>
                                                <option value="Revisor"> Revisor</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Por favor selecciona la función de Usuario
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="validationTooltip04" class="col-md-4 col-lg-3 col-form-label"><b>Estado</b></label>
                                            <div class="col-md-8 col-lg-9">
                                                <select name="estado" class="form-select" required>
                                                    <option selected value="<?php echo utf8_encode($usuario->estado); ?>"><?php echo utf8_encode($usuario->estado); ?></option> 
                                                    <option value="Activo"> Activo</option>
                                                    <option value="Inactivo"> Inactivo</option>
                                                </select>
                                                <div class="invalid-tooltip">
                                                    Por favor selecciona el Estado del Usuario
                                                </div>
                                            </div>
                                    </div> 

                                    <div class="row mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck4" required>
                                            <label class="form-check-label" for="invalidCheck4">
                                                Acepto los cambios realizados, bajo mi Responsabilidad de Coordinador.
                                            </label>
                                            <div class="invalid-feedback">
                                                Por favor, acepta los Términos y Condiciones.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Guardar <i class="bi bi-person-fill"></i></button>
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

  