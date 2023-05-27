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
        <div class="containerUsuari">
            <div class="crearUsuari">
                <h2>Crear Usuari</h2>
                    <form action="usuaris.php" method="POST" enctype="multipart/form-data">
                        <label for="nickname">Nickname: </label><br>
                        <input type="text" name="nickname" required><br>
                        <label for="nom">Nom: </label><br>
                        <input type="text" name="nom" required><br>
                        <label for="cognom">Cognom: </label><br>
                        <input type="text" name="cognom" required><br>
                        <label for="tipus">Tipus:</label><br>
                        <select name="tipus" required>
                            <option value="admin">Admin</option>
                            <option value="usuari">Usuari</option>
                        </select><br>
                        <label for="email">Gmail: </label><br>
                        <input type="email" name="email" required><br>
                        <label for="contrassenya">Contrassenya: </label><br>
                        <input type="password" name="contrassenya" required><br><br>
                        <input type="submit" name="submit_crear" id="submit" class="mt-2" value="Crear Usuari"/>
                    </form>
                    <?php
                    if (isset($_POST['submit_crear'])) {
                        $nickname = $_POST['nickname'];
                        $nom = $_POST['nom'];
                        $cognom = $_POST['cognom'];
                        $tipus = $_POST['tipus'];
                        $email = $_POST['email'];
                        $contrassenya = $_POST['contrassenya'];
                        $sql = "INSERT INTO usuaris(usuari, nom, cognom, tipus, gmail, contrassenya) VALUES ('$nickname', '$nom','$cognom', '$tipus', '$email', '$contrassenya')";
                        mysqli_query($conn, $sql);

                        if (mysqli_affected_rows($conn)==1) {
                            echo "Usuari Creat: " .mysqli_affected_rows($conn);
                        }else{
                            echo "Error al crear l'usuari";
                        }
                    }
                    ?>
            </div>
            <div class="taulaUsuaris">
                <h2>Taula dels usuaris</h2>
                <form action="usuaris.php" method="POST" enctype="multipart/form-data">
                    <label for="buscador">Buscador: </label>
                    <input type="text" name="buscador" placeholder="Usuari">
                    <input type="submit" name="submit_buscar" id="submit" class="mt-2" value="Buscar"/>
                    <br>
                </form>
                <?php
                    if(!isset($_POST['submit_buscar'])){
                        $sql = "SELECT * FROM usuaris";
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $cuentas[] = $fila;
                        }
                        echo "
                        <table class='taula'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nickname</th>
                                    <th>Nom</th>
                                    <th>Cognom</th>
                                    <th>Tipus</th>
                                    <th>Gmail</th>
                                    <th>Contrassenya</th>
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
                                        <td>' . $cuentas[$i]["ID"] . '</td>
                                        <td>' . $cuentas[$i]["usuari"] . '</td>
                                        <td>' . $cuentas[$i]["nom"] . '</td>
                                        <td>' . $cuentas[$i]["cognom"] . '</td>
                                        <td>' . $cuentas[$i]["tipus"] . '</td>
                                        <td>' . $cuentas[$i]["gmail"] . '</td>
                                        <td>' . $cuentas[$i]["contrassenya"] . '</td>
                                    </tr>
                            </tbody>';
                                }
                            }
                            echo '</table>';
                    }

                    if(isset($_POST['submit_buscar'])){
                        $buscador = $_POST['buscador']; 
                        $sql = "SELECT * FROM usuaris WHERE usuari LIKE '%$buscador%' OR nom LIKE '%$buscador%' OR cognom LIKE '%$buscador%' OR gmail LIKE '%$buscador' OR tipus LIKE '%$buscador'";    
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $cuentas[] = $fila;
                        }
                        echo '
                            <table class="taula">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nickname</th>
                                        <th>Nom</th>
                                        <th>Cognom</th>
                                        <th>Tipus</th>
                                        <th>Gmail</th>
                                        <th>Contrassenya</th>
                                    </tr>
                                </thead>
                            <tbody>';

                            if (mysqli_num_rows($resultado) == 0) {
                                echo "<td colspan='4' class='text-center'>Sin resultados</td>";
                            } else {
                                for ($i = 0; $i < sizeOf($cuentas); $i++) {
                                    echo '
                                    <tr>
                                        <td>' . $cuentas[$i]["ID"] . '</td>
                                        <td>' . $cuentas[$i]["usuari"] . '</td>
                                        <td>' . $cuentas[$i]["nom"] . '</td>
                                        <td>' . $cuentas[$i]["cognom"] . '</td>
                                        <td>' . $cuentas[$i]["tipus"] . '</td>
                                        <td>' . $cuentas[$i]["gmail"] . '</td>
                                        <td>' . $cuentas[$i]["contrassenya"] . '</td>
                                    </tr>
                                </tbody>';
                                }
                            echo '</table>';
                            }
                    }
                ?>
            </div>
        </div>
    </body>
</html>