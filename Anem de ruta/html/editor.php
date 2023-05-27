<?php
    include("conexio/conexio.php");
    
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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="../css/style.css" rel="stylesheet">
        <title>Anem de Ruta</title>
       
        <script src="../js/code.js"></script>
    </head>
    <!--Header-->
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
        <nav class="nav">
            <div class="usuaris">
                <div class="usuari">
                    <div class="fotoUsuari">
                        <img src="../images/usuari.svg" alt="">
                    </div>
                    <p>Usuari: <?php echo $nom; ?></p>
                    <p>Descripcio: <br><?php echo $descripcio; ?></p>
                    <div class="seguidors">
                        <div class="seg">
                            <p>Rutes <br> <?php echo $numRutes; ?></p>
                        </div>
                        <div class="seg">
                            <p>Seguidors <br> <?php echo $seguidors; ?></p>
                        </div>
                        <div class="seg">
                            <p>Segueix <br> <?php echo $seguits; ?></p>
                        </div>
                    </div>
                    <div class="botoSeguir">
                        <form class="registre" method="POST" action="usuari.php?usuari=<?php echo $valor?>" enctype="multipart/form-data"> 
                            <input class="buttons" type="submit" name="seguir" id="seguir" value="<?php echo $textBoto?>">
                        </form>
                    </div>  
                </div>
            </div>
        </nav>
    </body>
    <!--Footer-->
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