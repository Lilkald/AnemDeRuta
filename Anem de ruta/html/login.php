<?php    
    include("conexio/conexio.php");
	
  if ($conn->connect_error) {
      echo "Error al connectar amb la base de dades!";
  }
  
  if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$contrassenya = $_POST["contrassenya"];
		$boolClient = false;
		$boolAdmin = false;
		$sql="SELECT * FROM usuaris";
		$r = mysqli_query($conn, $sql);
		
		while($fila=mysqli_fetch_assoc($r)){
			if($username == $fila["usuari"] && $contrassenya == $fila["contrassenya"] && $fila["tipus"] == "usuari"){
				$boolClient = true;
				$id = $fila["ID"];
				$usuari = $fila["usuari"];
				$password = $fila["contrassenya"];
				$tipus = $fila["tipus"];
				$seguidors = $fila["seguidors"];
				$seguits = $fila["seguits"];
				$numRutes = $fila["numRutes"];
				
			}
			else if($username == $fila["usuari"] && $contrassenya == $fila["contrassenya"] && $fila["tipus"] == "admin"){
				$boolAdmin = true;
				$usuari = $fila["usuari"];
				$password = $fila["contrassenya"];
				$tipus = $fila["tipus"];
				
			}
		}

		if($boolClient == true){
			session_start();
			$_SESSION["id"] = $id;
			$_SESSION['username'] = $usuari;
			$_SESSION["password"] = $password;
			$_SESSION["tipus"] = $tipus;
			$_SESSION["seguidors"] = $seguidors;
			$_SESSION["seguits"] = $seguits;
			$_SESSION["numRutes"] = $numRutes;
			header('Location: home.php');
		}
		else if($boolAdmin == true){
			session_start();
			$_SESSION['username'] = $usuari;
			$_SESSION["password"] = $password;
			$_SESSION["tipus"] = $tipus;
			header('Location: admin/admin.php');
		}
		else{
			echo '<script language="javascript">alert("Usuari o contrassenya incorrectes!");</script>';
			$_SESSION['logged_in'] = false;
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
        <title>Login</title>
        <script src="../js/code.js"></script>
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
		<h1>Iniciar Sesión</h1>
		<form method="POST" action="login.php" enctype="multipart/form-data">
			<label for="username">Nom del Usuari: </label>
			<input type="text" id="username" name="username" required>
			<label for="password">Contrassenya</label>
			<input type="password" id="contrassenya" name="contrassenya" required>
			<input class="button" name="login" id="login" type="submit" value="Iniciar Sessió">
		</form>
		<p>No tens un compte? <a href="registre.php">Registra't</a></p>
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