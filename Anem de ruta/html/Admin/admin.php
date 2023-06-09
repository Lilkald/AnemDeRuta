<?php
    include('../conexio/conexio.php');
    session_start();

	if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    if($_SESSION["tipus"] != "admin"){
        header("Location: ../home.php");
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
        <link href="../../css/admin.css" rel="stylesheet">
        <title>Anem de Ruta</title>
        <script src="../js/code.js"></script>
    </head>
    <body>
        <div class="menu">
            <div class="logo">
                <a href="admin.php">
                    <img src="../../images/anemderuta.png" alt="Logo de la página">
                </a>
                <a href="admin.php">
                    <p>ANEM DE RUTA</p>
                </a>
            </div>
            </a>
            <nav>
                <ul>
                    <li><a href="admin.php">Home</a></li>
                    <li><a href="usuaris.php">Usuaris</a></li>
                    <li><a href="monitoritzacio.php">Monitorització</a></li>
                    <li><a href="contingut.php">Contignut</a></li>
                    <li><a href="missatges.php">Missatges</a></li>
                    <li><a href="../login.php">Sortir</a></li>
                </ul>
            </nav>
        </div>
        <div class="container">
            <div class="box">
                <a href="usuaris.php">
                    <div class="usuaris">
                        <div class="fondo">
                            <h2>Usuaris</h2>
                            <p>Administracio dels usuaris</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="box">
                <a href="monitoritzacio.php">
                    <div class="mono">
                        <div class="fondo">
                            <h2>Monitorització</h2>
                            <p>Estat de la pàgina...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="box">
                <a href="contingut.php">
                    <div class="contingut">
                        <div class="fondo">
                            <h2>Contingut</h2>
                            <p>Administració de les rutes</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </body>
</html>