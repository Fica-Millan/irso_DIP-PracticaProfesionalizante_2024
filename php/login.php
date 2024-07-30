<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ubicar</title>

    <!-- Integrar Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/menu-hamburguesa.css">

    <!--Sweet Alert-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="../img/logo.jpg" alt="Ubicar Logo">
            </div>

            <div class="mobile-menu-toggle">
                <button class="hamburger" onclick="toggleMenu()">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>

            <nav id="navbar">
                <div class="menu">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">NUESTROS SERVICIOS</a></li>
                        <li><a href="#">CONTACTO</a></li>
                        <li><a href="#">PREGUNTAS FRECUENTES</a></li>
                    </ul>
                    <button id="logout">LOGIN</button>  
                </div>
                      
            </nav>
        </div>
    </header>

    <main>
        <section class="contenedor-login">
            <div>
                <img class="img-login" src="../img/bg_login.jpg" alt="telefono celular que muestra un mapa.">
            </div>
            <div class="contenedor-login_form">
                <h2>Iniciar Sesión</h2>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="error">' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']);
                }
                ?>
                <form id="loginForm" action="authenticate.php" method="post">
                    <input id="email" type="email" name="email" placeholder="Correo Electrónico" required>
                    <input id="password" type="password" name="password" placeholder="Contraseña" required>
                    <input id="button" class="btn_iniciar_sesion" type="submit" value="Iniciar Sesión">
                </form>
                <a class="reset-pass"  href="../php/reset_pass.php"><button class="btn-recuperar-pass">¿Olvidó su contraseña?</button></a>
            </div>
        </section>
    </main>

    <footer>
        <img class="footer-img" src="../img/footer.jpg" alt="footer">
    </footer>
    
    <!-- Menu hamburguesa-->
    <script src="../js/menu-hamburguesa.js"></script>

</body>
</html>
