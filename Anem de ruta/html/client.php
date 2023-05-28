<?php
    include("conexio/conexio.php");
    session_start();
	if (!isset($_SESSION['username'])) {
        // No hay sesión activa, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit();
    }

    $usuari = $_SESSION['username'];
    $usuari_id = $_SESSION['id'];
    $sql = "SELECT * FROM usuaris WHERE usuari LIKE '$usuari'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $id = $row["ID"];
            $username = $row["usuari"];
            $numRutes = $row["numRutes"];
            $seguidors = $row["seguidors"];
            $seguits = $row["seguits"];
            $descripcio = $row["descripcio"];
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
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet-src.min.js" integrity="sha512-nRcCZolw4mA+OKrTG/baePuVcG7PHhjFhl6pxkLYl2T+3pKEf+vXw0uR1/X3YtlPLXoWiaLjBnuUzpDuB1yXNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      <link rel="stylesheet" href="../leaflet/leaflet.css" />
        <script src="../leaflet/leaflet.js"></script>
        <link href="../css/style.css" rel="stylesheet">
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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="../css/style.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet-src.min.js" integrity="sha512-nRcCZolw4mA+OKrTG/baePuVcG7PHhjFhl6pxkLYl2T+3pKEf+vXw0uR1/X3YtlPLXoWiaLjBnuUzpDuB1yXNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      <link rel="stylesheet" href="../leaflet/leaflet.css" />
        <script src="../leaflet/leaflet.js"></script>
        <link href="../css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
                <!-- Leaflet.markercluster CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

        <!-- Leaflet.markercluster JavaScript -->
        <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js "></script>
        <title>Anem de Ruta</title>
       
        <script src="../js/code.js"></script>
    </head>

    <!--Header-->
    <header>
        <div class="logo">
            <a href="home.php">
                <img src="../images/anemderuta.png" alt="Logotip">
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
        <nav class="nav">
            <div class="usuaris">
                <div class="usuari">
                    <div class="fotoUsuari">
                        <img src="../images/usuari.svg" alt="">
                    </div>
                    <p>Usuari: <?php echo $username; ?></p>
                    <p>Descripcio: <br><?php echo $descripcio; ?></p>
                    <div class="seguidors">
                        <div class="seg">
                            <p>Rutes Creades: <br><?php echo $numRutes; ?></p>
                        </div>
                        <div class="seg">
                            <p><a href="#" class="segui" onclick="togglePopup()">Seguidors <br> <?php echo $seguidors; ?></a></p>
                        </div>
                        <div id="popup" class="popup">
                            <h2>Seguidors:</h2>
                            <?php
                                $sql = "SELECT * FROM seguidors WHERE id_seguit LIKE '$id'";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $idSeg = $row["id_seguidor"];
                                            $sql2 = "SELECT * FROM usuaris WHERE ID LIKE '$idSeg'";
                                            $result2 = $conn->query($sql2);
                                            if($result2->num_rows > 0) {
                                                while($row2 = $result2->fetch_assoc()) {
                                                    echo "<ul class='seguidorets'>";
                                                    echo "<a href='usuari.php?usuari=".$row2['usuari']."' class='seguidor'><li>" .$row2['usuari'] ."</li></a>";
                                                    echo "<br>";
                                                    echo "</ul>";
                                                    }
                                                }
                                        }
                                    }
                            ?>
                            <br>
                            <a href="#" class="tancar" onclick="togglePopup()">Cerrar</a>
                        </div>
                        <div class="seg">
                        <p><a href="#" class="segui" onclick="togglePopup2()">Segueixes <br> <?php echo $seguits; ?></a></p>
                        </div>
                        <div id="popup2" class="popup">
                            <h2>Segueixes:</h2>
                            <?php
                                $sql = "SELECT * FROM seguidors WHERE id_seguidor LIKE '$id'";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $idSeg = $row["id_seguit"];
                                            $sql2 = "SELECT * FROM usuaris WHERE ID LIKE '$idSeg'";
                                            $result2 = $conn->query($sql2);
                                            if($result2->num_rows > 0) {
                                                while($row2 = $result2->fetch_assoc()) {
                                                    echo "<ul class='seguidorets'>";
                                                    echo "<a href='usuari.php?usuari=".$row2['usuari']."' class='seguidor'><li>" .$row2['usuari'] ."</li></a>";
                                                    echo "<br>";
                                                    echo "</ul>";
                                                    }
                                                }
                                        }
                                    }
                            ?>
                            <br>
                            <a href="#" class="tancar" onclick="togglePopup2()">Cerrar</a>
                        </div>
                    </div>
                    <div class="botoSeguir botoEditar llarg">
                        <form class="editar" method="POST" action="editor.php" enctype="multipart/form-data"> 
                            <input class="buttons" type="submit" name="seguir" id="seguir" value="Editar perfil">
                        </form>
                    </div> 
                </div>
                <script src="../js/script.js"></script>
                <div class="crearRuta">
                    <h2>REGISTRE LA TEVA PRÒPIA RUTA, <?php echo $_SESSION['username']; ?></h2>
                    <div class="botoCrearRuta">
                        <p>Crea la teva ruta i<br> comparteix-la per que la puguin<br> veure altres usuaris!</p>
                        <a class="enlaceApp botoRuta" href="crear_rutes.php">Crear ruta</a>
                    </div>
                </div>
            </div>
        </nav>
    </body>
    <div class="containerMap" id="map" style="height: 500px; width:90%; margin:auto; border: 5px solid black; margin: 50px 0px;">
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
      console.error('Geolocation is not supported by your browser.');
    }

    var polylineLayer = L.polyline([], { color: 'green' }).addTo(map);
    var markerClusterGroup = L.markerClusterGroup();


    map.addLayer(markerClusterGroup);
    var user_id = "<?php echo $usuari_id; ?>";
    var dades = {
        user_id: user_id,
        };
    $.ajax({
 
 url: 'localitzacions_usuari.php',
 type: 'POST',
 dataType: 'json',
 data: dades,
 success: function(data) {
   // Recorrer las coordenadas y añadirlas a la capa de polilínea
   data.forEach(function(coordenada) {
    var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
  var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
  var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'green' }).addTo(map);

  var nombreRuta = coordenada.nombre;
  var tipus = coordenada.tipus;

  var marker;

  if (tipus == 'coche') {
    marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP._kQs9G90A2XFKArTMH1SjAHaHa&pid=Api&P=0&h=180" width='50px'>`);
  } else if (tipus == 'moto') {
    marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse2.mm.bing.net/th?id=OIP.GzB7SiVMJtmnqhwAujNJzgHaF_&pid=Api&P=0&h=180" width='50px'>`);
  } else if (tipus == 'bici') {
    marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP.P1Htg_Cx-eaDwPdJ6o3oGwHaEw&pid=Api&P=0&h=180" width='50px'>`);
  } else if (tipus == 'caminar') {
    marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP.OoNF_Weiw131JD7Q1rZSEQHaG6&pid=Api&P=0&h=180" width='50px'>`);
  }

  rutaLayer.bindPopup(marker);
  marker.addTo(markerClusterGroup);


markerClusterGroup.addTo(map);
       

   map.fitBounds(rutaLayer.getBounds());
       
       if(markerClusterGroup.addLayer(marker)){
         marker.removeFrom(map);
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
    </div>

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
         $('#cerca').on('input', function() {
              let paraula = $(this).val();
              if(paraula.length >= 2) {
                  $.ajax({
                      method: 'post',
                      url: 'Admin/buscador.php',
                      data: { paraula: paraula },
                      success: function(response) {
                          $('#resultados').html(response);
                      }
                  });
              } else {
                  $('#resultados').html('');
              }
            });
</script>