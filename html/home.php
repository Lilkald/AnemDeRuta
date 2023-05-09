<?php

    session_start();
	if (!isset($_SESSION['username'])) {
        // No hay sesión activa, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head> 
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="../images/logo.png">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="../css/style.css" rel="stylesheet">
        <title>Anem de Ruta</title>
        <script src="../js/code.js"></script>
    </head>
    <header>
        
        <div class="logo">
            <a href="home.php">
                <img src="../images/anemderuta.png" alt="Logo de la página">
            </a>
            <a href="home.php">
                <p>ANEM DE RUTA</p>
            </a>
        </div>
        </a>
        <nav>
            <ul>
            <li><a href="home.php">Inici</a></li>
            <li><a href="client.php">Les teves rutes</a></li>
            <li><a href="contacte.php">Contacte</a></li>
            <li><a href="logout.php">Log out</a></li>
            </ul>
        </nav>
        </header>
    <body>
        <div class="containerMapa" id="map">
            <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2986.1721557136198!2d2.096044914932535!3d41.54386959424358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a494f7a6b86651%3A0xe9a74531a2b7ca1!2sJaume%20Viladoms%2C%20Centre%20d&#39;Estudis%20Professionals!5e0!3m2!1sca!2ses!4v1635488846516!5m2!1sca!2ses" width="1000" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="descargaApp">
            <div class="container1">
                <p>Des de nuestra app, podrás crear todas las rutas que te imagines, escogiendo el tipo de transporte, localización de la ruta, comentando sobre la misma...</p>
                <a class="enlaceApp" href="https://www.youtube.com/watch?v=b8FUR5Z2MDI">Descarga la app</a>
            </div>
        </div>
        <article>
            <div class="consultaMejores">
                <div class="container2">
                    <div class="box">
                        <h3>CONSULTA LAS MEJORES RUTAS DE LOS USUARIOS</h3>
                        <img src="../images/box1.png" alt="">
                        <p>Descarga ya nuestra app y compruébalo</p>
                    </div>
                    <div class="box">
                        <h3>COMPARTE <br>TUS OPINIONES</h3>
                        <img src="../images/box2.png" alt="">
                        <p>Haz reseña y crítica constructiva para mejorar!</p>
                    </div>
                    <div class="box">
                        <h3>CHATEA CON NUESTRA COMUNIDAD DE USUARIOS</h3>
                        <img src="../images/box3.png" alt="">
                        <p>Habla con otros usuarios y pregunta lo que necesites en nuestro nuevo chat!</p>
                    </div>
                </div>
            </div>
        </article>
        <nav class="registrate">
            <div class="container3">
                <div class="avion">
                    <h3>REGISTRATE YA Y EMPIEZA EN EL <br>NUEVO MUNDO DE RUTAS</h3>
                    <a class="enlaceApp" href="https://www.youtube.com/watch?v=b8FUR5Z2MDI">Registrate ya!</a>
                </div>
                <div class="avioneta">
                    <h3>TARIFA PREMIUM!</h3>
                    <p>Descubre mucho mas suscribiéndote a nuestra tarifa premium, y accede a más contenido y chat ilimitado!</p>
                </div>
            </div>
        </nav>
    </body>
    <footer>
        <div class="footer">
            <div class="redes sect">
                <p>SIGUENOS EN:</p>
                <div class="logo">
                    <a href="https://www.instagram.com"><i class='bx bxl-instagram'></i></a>
                    <a href="https://www.twitter.com"><i class='bx bxl-twitter'></i></a>
                    <a href="https://www.facebook.com"><i class='bx bxl-facebook-circle'></i></a>
                </div>
            </div>
            <div class="allright sect">
                <p>&copy; NosVamosDeRuta. All rights reserved.</p>
                <a href="">Condiciones de uso</a> | <a href="">Privacidad</a> | <a href="">Política de cookies</a>
            </div>
            <div class="politica sect">
                <a href="">Política de privacidad</a>
                <a href="">Sobre nosotros</a>
                <a href="">Nuestras Tarifas</a>
            </div>
        </div>
    </footer>

</html>