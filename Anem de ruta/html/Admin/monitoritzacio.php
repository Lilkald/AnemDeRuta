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
        <link rel="shortcut icon" href="../../images/logo.png">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="../../css/admin.css" rel="stylesheet">
        <title>Anem de Ruta</title>
        <script src="../../js/code.js"></script>
    </head>
    <script>
    $(document).ready(function() {
        console.log("Hola");
            $.ajax({
                url: "estado.php",
                dataType: "json",
                success: function(data) {
                    $("#nombre_servidor").text(data.nombre_servidor);
                    $("#version_php").text(data.version_php);
                    $("#totalRegistros_php").text(data.total_registros);
                    $("#extension_mysql").text(data.estado_mysql);
                    $("#extension_curl").text(data.estado_curl);
                    
                }
            });
        });
    </script>
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
        <div class="monitor">
        <h1>Estado del Servidor</h1>
            <ul>
                <li>Nombre del servidor: <span id="nombre_servidor"></span></li>
                <li>Versión de PHP: <span id="version_php"></span></li>
                <li>Total registros: <span id="totalRegistros_php"></span></li>
                <li>Estado de MySQL: <span id="extension_mysql"></span></li>
                <li>Estado de cURL: <span id="extension_curl"></span></li>
            </ul>
        </div>
    </body>
</html>