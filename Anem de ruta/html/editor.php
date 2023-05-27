<?php
    include("conexio/conexio.php");
    
    session_start();
	if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM usuaris WHERE usuari LIKE '$username'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $id = $row["ID"];
            $usuari = $row["usuari"];
            $nom = $row["nom"];
            $cognom = $row["cognom"];
            $contrassenya = $row["contrassenya"];
            $numRutes = $row["numRutes"];
            $seguidors = $row["seguidors"];
            $seguits = $row["seguits"];
            $descripcio = $row["descripcio"];
            }
        }
    if (isset($_POST["guardar"])) {
            $nouNom = $_POST["nom"];
            $nouCognom = $_POST["cognom"];
            $nouDesc = $_POST["descripcio"];
            $pass1 = $_POST["contrassenya"];
            $pass2 = $_POST["contrassenya2"];

            if($pass1 == $pass2){
                $sql = "UPDATE usuaris SET nom='$nouNom', cognom= '$nouCognom', descripcio='$nouDesc', contrassenya='$pass1' WHERE ID LIKE '$id'";
                mysqli_query($conn, $sql);
            
                if (mysqli_affected_rows($conn) == 1) {
                    echo '<script language="javascript">alert("Canvis guardats");</script>';
                    header('Location: client.php');
                } else {
                    echo '<script language="javascript">alert("Error al guardar els canvis");</script>';
                }
            }
            else{
                echo '<script language="javascript">alert("Error les contrassenyes no coincideixen");</script>';
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
        </nav>
    </header>
    <body>
        <nav class="nav">
            <div class="usuaris">
                <div class="usuari">
                    <div class="fotoUsuari">
                        <img src="../images/usuari.svg" alt="">
                    </div>
                    <div class="editorForm">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="edicio">
                                <label for="nom">Nom:</label>
                                <input type="text" id="nom" name="nom" required value="<?php echo $nom?>">
                                <label for="cognom">Cognom:</label>
                                <input type="text" id="cognom" name="cognom" required value="<?php echo $cognom?>">
                                <label for="descripcio">Descripció:</label>
                                <textarea type="text" id="descripcio" name="descripcio" required><?php echo $descripcio?></textarea>
                                <label for="contrassenya">Contrassenya:</label>
                                <input type="password" id="contrassenya" name="contrassenya" required value="<?php echo $contrassenya?>">
                                <label for="contrassenya2">Confirma contrassenya:</label>
                                <input type="password" id="contrassenya2" name="contrassenya2" required>
                            </div>
                            <br>
                            <div class="botoSeguir botoEditar">
                                <input class="buttons" type="submit" name="guardar" id="guardar" value="Guardar">
                            </div> 
                            <br>
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