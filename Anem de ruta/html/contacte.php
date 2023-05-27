<?php

    session_start();
	if (!isset($_SESSION['username'])) {
        // No hay sesión activa, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit();
    }

?>


<?php    
    include("conexio/conexio.php");
	
  if ($conn->connect_error) {
      echo "Error al connectar amb la base de dades!";
  }
  
  if (isset($_POST["enviar"])) {	
		$nom = $_POST["nom"];
        $gmail = $_POST["gmail"];
        $numTelef = $_POST["telefon"];
        $missatge = $_POST["missatge"];

		$sql = "INSERT INTO missatge(nom, gmail, numTelef, missatge) VALUES('$nom', '$gmail', '$numTelef', '$missatge')";

		mysqli_query($conn, $sql);

		if (mysqli_affected_rows($conn)==1) {	
			echo '<script language="javascript">alert("Missatge enviat");</script>';
		}else{
			echo '<script language="javascript">alert("Error al enviar el missatge");</script>';
		}	
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
            <ul class="buscadorUL">
                <li class="buscador">
                    <input class="buscador" type="text" id="cerca" placeholder="Busca altres usuaris"/>
                    <ul class="desplegable" id="resultados"></ul>
                </li>
            </ul>
        </nav>
    </header>
    <body class="contacteBody">
        <div class="imatgeFons">
            <article class="container">
                <article class="contactinfo">
                    <h1>Com ens pots contactar?</h1>
                    <p>Som una companyia en línia sense instal·lacions físiques, disponibles per a ser contactats per telèfon o correu electrònic. Ens esforcem per millorar contínuament el nostre programa i estem oberts a crítiques. Si teniu alguna pregunta, no dubteu a posar-vos en contacte amb nosaltres i la resoldrem.</p>
                    <p>Anem de ruta Inc.</p>
            
                    <p>Telèfon +34 696 969 696</p>
        
                    <p>E-mail: info@anemderuta.com</p>
                </article>

                <article id="formulari">
                    <article class="contactform">
                        <h1>Parla amb nosaltres</h1>
                        <form method="POST" action="contacto.php" enctype="multipart/form-data">
                            <div class="formulariOrg">
                                <label for="nom">Nom:</label><br>
                                <input type="text" id="nom" name="nom" required><br>
                                <label for="gmail">Gmail:</label><br>
                                <input type="text" id="gmail" name="gmail" required><br>
                                <label for="telefon">Nº Telèfon:</label><br>
                                <input type="number" id="telefon" name="telefon" required>
                            </div>
                        <br><br>
                        <label for="missatge">Missatge: </label>
                        <textarea id="missatge" required name="missatge"></textarea><br>
                        <button class="enviar button1" type="submit" name="enviar" value="Enviar">Enviar</button>
                    </article>
                </article>
            </article>
        </div>
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