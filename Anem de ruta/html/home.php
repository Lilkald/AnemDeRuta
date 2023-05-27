<?php

    session_start();
	if (!isset($_SESSION['username'])) {
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
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="../css/style.css" rel="stylesheet">
        <title>Anem de Ruta</title>
        <script src="../js/code.js"></script>
    </head>
    <header class="home">
        
        <div class="logo">
            <a href="index.php">
                <img src="../images/anemderuta.png" alt="Logo de la página">
            </a>
            <a href="index.php">
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
            <ul class="buscadorUL">
                <li class="buscador">
                    <input class="buscador" type="text" id="cerca" placeholder="Busca altres usuaris"/>
                    <ul class="desplegable" id="resultados"></ul>
                </li>
            </ul>
        </nav>
        </header>
    <body>
        <div class="containerMapa" id="map">
            <div class="containerText">
                <div class="inici">
                    <div class="nomEmpresa">
                     <h1>ANEM DE RUTA</h1><img src="../images/logo.png" alt="Logo de la página">
                    </div>
                    
                    <p>Anem de ruta és una plataforma en línia que t'ofereix l'oportunitat de crear, compartir i descobrir emocionants rutes a l'aire lliure, ja sigui caminant, en bicicleta o altres aventures fascinants, mentre connectes amb altres amants de la natura i la aventura.</p>
                    
                    <div class="cotxets">
                        <ul>
                            <li><img src="../images/tipo1.png" alt=""></li>
                            <li><img src="../images/tipo2.png" alt=""></li>
                            <li><img src="../images/tipo3.png" alt=""></li>
                            <li><img src="../images/tipo4.png" alt=""></li>
                        </ul>
                    </div>
                    <a class="veureRutes"href="#">
                        <div>
                            <p syle="text-align: center;">Veure les rutes més populars</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="descargaApp">
            <div class="container1">
                <p>Des de la nostra app, podràs crear totes les rutes que t'imaginis, escollint el tipus de transport, localització de la ruta, comentant sobre la mateixa...</p>
                <a class="enlaceApp" href="https://www.youtube.com/watch?v=b8FUR5Z2MDI">Descarrega la app</a>
            </div>
        </div>
        <article>
            <div class="consultaMejores">
                <div class="container2">
                    <div class="box">
                        <h3>CONSULTA LES MILLORS RUTES DELS USUARIS</h3>
                        <img src="../images/box1.png" alt="">
                        <p>Descarrega ja la nostra app i comprova-ho</p>
                    </div>
                    <div class="box">
                        <h3>COMPARTEIX <br>LES TEVES OPINIONS</h3>
                        <img src="../images/box2.png" alt="">
                        <p>Fes ressenya i crítica constructiva per millorar!</p>
                    </div>
                    <div class="box">
                        <h3>XATEJA AMB LA NOSTRA <br>COMUNITAT</h3>
                        <img src="../images/box3.png" alt="">
                        <p>Parla amb altres usuaris amb el nostre nou xat!</p>
                    </div>
                </div>
            </div>
        </article>
        <nav class="registrate">
            <div class="container3">
                <div class="avion">
                    <h3>REGISTRA'T JA I COMENÇA AL <br>NOU MÓN DE RUTES</h3>
                    <a class="enlaceApp" href="registre.php">Registra't ja!</a>
                </div>
                <div class="avioneta">
                    <h3>TARIFA PREMIUM!</h3>
                    <p>Descobreix molt més subscrivint-te a la nostra tarifa premium, i accedeix a més contingut i xat il·limitat!</p>
                </div>
            </div>
        </nav>
    </body>
    <footer>
        <div class="footer">
            <div class="redes sect">
                <p>SEGUEIX-NOS A:</p>
                <div class="logo">
                    <a href="https://www.instagram.com"><i class='bx bxl-instagram'></i></a>
                    <a href="https://www.twitter.com"><i class='bx bxl-twitter'></i></a>
                    <a href="https://www.facebook.com"><i class='bx bxl-facebook-circle'></i></a>
                </div>
            </div>
            <div class="allright sect">
                <p>&copy; AnemDeRuta. All rights reserved.</p>
                <a href="#">Condicions d'ús</a> | <a href="#">Privadesa</a> | <a href="#">Política de cookies</a>
            </div>
            <div class="politica sect">
                <a href="#">Política de privadesa</a>
                <a href="#">Sobre nosaltres</a>
                <a href="#">Les nostres tarifes</a>
            </div>
        </div>
    </footer>
</html>
<script>
         $('#cerca').on('input', function() {
              let paraula = $(this).val();
              if(paraula.length >= 2) {
                  $.ajax({
                      method: 'post',
                      url: 'Admin/buscador.php',
                      data: { paraula: paraula },
                      success: function(response) {
                          $('#resultados').html(response);
                      }
                  });
              } else {
                  $('#resultados').html('');
              }
            });
</script>