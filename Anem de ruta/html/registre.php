<?php    
    include("conexio/conexio.php");
	
  if ($conn->connect_error) {
      echo "Error al connectar amb la base de dades!";
  }
  
  if (isset($_POST["registre"])) {
		$username = $_POST["username"];
		$nom = $_POST["nom"];
		$cognoms = $_POST["cognoms"];
		$gmail = $_POST["gmail"];
		$contrassenya = $_POST["contrassenya"];

		$sql = "INSERT INTO usuaris(usuari, nom, cognom, descripcio, tipus, gmail, contrassenya, numRutes, seguidors, seguits) VALUES('$username', '$nom', '$cognoms', '', 'usuari', '$gmail', '$contrassenya', '0', '0', '0')";

		mysqli_query($conn, $sql);

		if (mysqli_affected_rows($conn)==1) {	
			header("location: login.php");
		}else{
			echo "Error al afeir la noticia";
		}	
  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="../images/logo.png">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="../css/login.css" rel="stylesheet">
        <title>Registra't</title>
        <script src="../../js/code.js"></script>
</head>
<!--Header-->
<header>
        
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
            <li><a href="index.php">Inici</a></li>
            <li><a href="contacto.php">Contacte</a></li>
            <li><a href="login.php">Log in</a></li>
            </ul>
        </nav>
    </header>
	
<body>
	<div class="login-container">
		<h1>Registra't</h1>
		<form method="POST" action="registre.php" enctype="multipart/form-data">
			<label for="username">Nom del Usuari: </label>
			<input type="text" id="username" name="username" required>
            <label for="nom">Nom: </label>
			<input type="text" id="nom" name="nom" required>
            <label for="username">Cognoms: </label>
			<input type="text" id="cognoms" name="cognoms" required>
            <label for="gmail">Correu electrònic: </label>
			<input type="email" id="gmail" name="gmail" required>
			<label for="password">Contrassenya</label>
			<input type="password" id="contrassenya" name="contrassenya" required>
			<input class="button" name="registre" id="registre" type="submit" value="Registra't">
		</form>
		<p>Ja tens un compte? <a href="login.php">Inicia Sessió</a></p>
	</div>
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