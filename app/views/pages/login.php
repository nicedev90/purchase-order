<?php require APPROOT . '/views/pages/partials/header.php'; ?>


    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo URLROOT . '/pages/login' ?>" method="POST" class="sign-in-form" autocomplete="off" >
                    <?php showAlert(); ?>
                    <h2 class="title">Inicia Sesión </h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="usuario" placeholder="Nombre de Usuario" required/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Contraseña" required />
                    </div>
                    <input type="submit" value="Inicia Sesión" class="btn solid"/>
                    <p class="social-text">Proximamente con nuestras plataformas sociales</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <form action="<?php echo URLROOT . '/pages/registrar' ?>" method="POST" class="sign-up-form"> 
                    <h2 class="title">Registrate</h2> 
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nombres Completos" name="nombre" required/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Correo Electrónico" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="password" required />
                    </div>
                    <input type="submit" class="btn" value="Registrarse" />
                    <p class="social-text">Proximamente con nuestras plataformas sociales</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>¿Eres Nuevo Aquí?</h3>
                    <p>
                        Si deseas una nueva cuenta, darle en el botón "Registrate"
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
              Registrate
            </button>
                </div>
                <img src="<?php echo URLROOT; ?>/img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Ya tienes cuenta?</h3>
                    <p>
                        Si ya tienes cuenta, darle en el botón "Inicia Sesión"
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
              Inicia Sesión
            </button>
                </div>
                <img src="<?php echo URLROOT; ?>/img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>
   

<?php require APPROOT . '/views/pages/partials/footer.php'; ?>
