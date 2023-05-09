<?php    
    include("conexio/conexio.php");
	
  if ($conn->connect_error) {
      echo "Error al connectar amb la base de dades!";
  }
  
  if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$contrassenya = $_POST["contrassenya"];

		$sql="SELECT * FROM usuaris";
		$r = mysqli_query($conn, $sql);
		$bool = false;
		while($fila=mysqli_fetch_assoc($r)){
			if($username == $fila["usuari"] && $contrassenya == $fila["contrassenya"]){
				$bool = true;
				$usuari = $fila["usuari"];
				$password = $fila["contrassenya"];
			}
		}
		if($bool == true){
			session_start();
			$_SESSION['username'] = $usuari;
			$_SESSION["password"] = $password;
			header('Location: home.php');
		}
		else{
			echo "Contrassenya incorrecte!";
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
        <link rel="shortcut icon" href="../../images/logo.png">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="../css/login.css" rel="stylesheet">
        <title>Login</title>
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
		<h1>Iniciar Sesión</h1>
		<form method="POST" action="login.php" enctype="multipart/form-data">
			<label for="username">Nombre de Usuario: </label>
			<input type="text" id="username" name="username" required>
			<label for="password">Contrassenya</label>
			<input type="password" id="contrassenya" name="contrassenya" required>
			<input class="button" name="login" id="login" type="submit" value="Iniciar Sessió">
		</form>
		<p>¿No tienes una cuenta? <a href="registre.php">Regístrate aquí</a></p>
	</div>
</body>

</html>