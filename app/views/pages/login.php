<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/login.css" />
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap-icons.css" />

    <title>SAC CLONSA INGENIERIA </title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo URLROOT; ?>/users/login" method="POST" class="sign-in-form" autocomplete="off" >
                    <?php showAlert(); ?>
                    <h2 class="title">Inicia Sesión </h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name ="usuario" placeholder="Nombre de Usuario" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name ="password" placeholder="Contraseña" />
                    </div>
                    <input type="submit" value="Inicia Sesión" class="btn solid" />
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
                <form action="<?php echo URLROOT; ?>/users/sendMail" method="POST" class="sign-up-form"> 
                    <h2 class="title">Registrate</h2> 
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nombre de usuario" name="nombre" required/>
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
    
    <script src="<?php echo URLROOT; ?>/js/app.js"></script>
</body>

</html>