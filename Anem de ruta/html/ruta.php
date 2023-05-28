<?php
    $conn = new mysqli('localhost', 'root', '', 'anemderuta');

    session_start();
	if (!isset($_SESSION['username'])) {
        // No hay sesión activa, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit();
    }

    if(isset($_GET['ruta'])){
        $valor = $_GET['ruta'];
        $sql = "SELECT * FROM rutas WHERE id LIKE '$valor'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $idRuta = $row["id"]; 
            $user_id = $row["user_id"];
            $nom = $row["nombre"];
            $dificultat = $row["dificultad"];
            $descripcio = $row["descripcio"];
            $dataCreacio = $row["created_date"];
            $tipus = $row["tipus"];
            }
        } 
        else {
            echo "Usuari inexistent!";
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
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <link href="../css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet-src.min.js" integrity="sha512-nRcCZolw4mA+OKrTG/baePuVcG7PHhjFhl6pxkLYl2T+3pKEf+vXw0uR1/X3YtlPLXoWiaLjBnuUzpDuB1yXNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      <link rel="stylesheet" href="../leaflet/leaflet.css" />
        <script src="../leaflet/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
        <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    <body>
        <div class="containerMapardo">
            <div class="mapet">
                <div class="containerMap" id="map" style="height: 500px; width:90%; margin:auto; border: 5px solid black; margin: 50px 0px;"></div>                         
            </div>
            <div class="textMap">
                <h2><?php echo $nom?></h2><br>
                <p><?php echo $descripcio?></p>
                <p>Nivell de dificultat: <?php echo $dificultat ?>/5</p>
                <?php
                    if($tipus == "coche"){
                        echo "Tipus de ruta: Cotxe";
                    }
                    else if($tipus == "moto"){
                        echo "Tipus de ruta: Moto";
                    }
                    else if($tipus == "bici"){
                        echo "Tipus de ruta: Bicicleta";
                    }
                    else if($tipus == "caminar"){
                        echo "Tipus de ruta: Caminant";
                    }
                ?>
                <p></p>
                <p>Creat el: <?php echo $dataCreacio ?> </p>
            </div>
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

    
<script>
    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);

    const geocoderControl = L.Control.geocoder({
    defaultMarkGeocode: false
    });

    function onGeolocationSuccess(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        map.setView([lat, lon], 13);
    }


    function onGeolocationError(error) {
        console.error(error.message);
        }

        if ('geolocation' in navigator) {

        navigator.geolocation.getCurrentPosition(onGeolocationSuccess, onGeolocationError);
        } else {
        console.error('No hem trobat la teva localització.');
        }

        var polylineLayer = L.polyline([], { color: 'green' }).addTo(map);
        var markerClusterGroup = L.markerClusterGroup();


        map.addLayer(markerClusterGroup);
        var ruta_id = "<?php echo $idRuta; ?>";
        var dades = {
            ruta_id: ruta_id,
            };
        $.ajax({
    
        url: 'localitzacio_ruta.php',
        type: 'POST',
        dataType: 'json',
        data: dades,
        success: function(data) {
            data.forEach(function(coordenada) {
                var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
                var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
                var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'green' }).addTo(map);

                var marker;


                map.fitBounds(rutaLayer.getBounds());
                    
                    if(markerClusterGroup.addLayer(marker)){
                        
                    }else{
                        marker.addTo(map);
                    }
                    markerClusterGroup.addLayer(marker);
            });
        },

        error: function(xhr, status, error) {
            console.log(error);
        }
        });
</script>