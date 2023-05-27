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
            <h1>Missatges dels clients</h1>
        <?php
            if(!isset($_POST['submit_buscar'])){
                        $sql = "SELECT * FROM missatge";
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $cuentas[] = $fila;
                        }
                        echo "
                        <table class='taula'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Gmail</th>
                                    <th>Numero de telèfon</th>
                                    <th>Missatge</th>
                                </tr>
                            </thead>
                            ";
                            if (mysqli_num_rows($resultado) == 0) {
                                echo "<td colspan='4' class='text-center'>Sin resultados</td>";
                            } else {
                                for ($i = 0; $i < sizeOf($cuentas); $i++) {
                                    echo '
                                <tbody>
                                    <tr>
                                        <td>' . $cuentas[$i]["id"] . '</td>
                                        <td>' . $cuentas[$i]["nom"] . '</td>
                                        <td><a href="mailto:' . $cuentas[$i]['gmail'] . '">' . $cuentas[$i]["gmail"] . '</a></td>
                                        <td>' . $cuentas[$i]["numTelef"] . '</td>
                                        <td>' . $cuentas[$i]["missatge"] . '</td>
                                    </tr>
                            </tbody>';
                                }
                            }
                            echo '</table>';
                    }
                    ?>
        </div>
    </body>
</html>