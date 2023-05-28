<?php
    include("conexio/conexio.php");
    
    session_start();
	if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $idSeguidor = $_SESSION['id'];
    $seguidorUsuari = $_SESSION['username'];
    if(isset($_GET['usuari'])){
        $valor = $_GET['usuari'];
        $sql = "SELECT * FROM usuaris WHERE usuari LIKE '$valor'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $idSeguit = $row["ID"];
            $usuari = $row["usuari"];
            $nom = $row["nom"];
            $cognom = $row["cognom"];
            $descripcio = $row["descripcio"];
            $gmail = $row["gmail"];
            $numRutes = $row["numRutes"];
            $seguidors = $row["seguidors"];
            $seguits = $row["seguits"];
            }
        } 

        else {
            echo "Usuari inexistent!";
        }
        $sql = "SELECT * FROM usuaris WHERE usuari LIKE '$seguidorUsuari'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $numSeguidets = $row["seguits"];
            }
        } 

        else {
            echo "Usuari inexistent!";
        }

        $sql = "SELECT * FROM seguidors";
        $result = $conn->query($sql);
        $seguint = false;
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($idSeguit == $row["id_seguit"] && $idSeguidor == $row["id_seguidor"]){
                    $seguint = true;
                }
            }
        }
        if($seguint == true){
            $textBoto = "Deixar de seguir";
            $valueBoto = "deixarSeguir";
        }
        else{
            $textBoto = "Seguir";
            $valueBoto = "seguir";
        }

    }
    $nousSeguits = $numSeguidets+1;
    if(isset($_POST["seguir"])){
        if($valueBoto == "seguir"){
            $sql = "INSERT INTO seguidors (id_seguidor, id_seguit) VALUES ('$idSeguidor', '$idSeguit')";
            $resultado = mysqli_query($conn, $sql);

            $nousSeguidors = $seguidors+1;
            $sql2 = "UPDATE usuaris SET seguidors = $nousSeguidors WHERE usuari LIKE '$usuari'";
            $resultado = mysqli_query($conn, $sql2);
            
            $sql3 = "UPDATE usuaris SET seguits = $nousSeguits WHERE usuari LIKE '$seguidorUsuari'";
            $resultado = mysqli_query($conn, $sql3);
            header('Location: ' . $_SERVER['REQUEST_URI']);
        }
        else{
            
            $sql4 = "DELETE FROM seguidors WHERE id_seguidor LIKE '$idSeguidor' AND id_seguit LIKE '$idSeguit'";
            $resultado = mysqli_query($conn, $sql4);

            $nousSeguidors = $seguidors-1;
            $sql2 = "UPDATE usuaris SET seguidors = $nousSeguidors WHERE usuari LIKE '$usuari'";
            $resultado = mysqli_query($conn, $sql2);
            $nousSeguidets = $numSeguidets-1;
            $sql3 = "UPDATE usuaris SET seguits = $nousSeguidets WHERE usuari LIKE '$seguidorUsuari'";
            $resultado = mysqli_query($conn, $sql3);
            header('Location: ' . $_SERVER['REQUEST_URI']);
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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                    <p>Usuari: <?php echo $nom;?></p>
                    <p>Descripcio: <br><?php echo $descripcio; ?></p>
                    <div class="seguidors">
                        <div class="seg">
                            <p>Rutes <br> <?php echo $numRutes; ?></p>
                        </div>
                        <div class="seg">
                            <p>Seguidors <br> <?php echo $seguidors; ?></p>
                        </div>
                        <div class="seg">
                            <p>Segueix <br> <?php echo $seguits; ?></p>
                        </div>
                    </div>
                    <div class="botoSeguir">
                        <form class="registre" method="POST" action="usuari.php?usuari=<?php echo $valor?>" enctype="multipart/form-data"> 
                            <input class="buttons" type="submit" name="seguir" id="seguir" value="<?php echo $textBoto?>">
                        </form>
                    </div>  
                </div>
            </div>
        </nav>
    </body>
    <div class="mapet">
        <div class="containerMap" id="map" style="height: 500px; width:90%; margin:auto; border: 5px solid black; margin: 50px 0px;"></div>                            
    </div>
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


      // Set the map view to the current location
      map.setView([lat, lon], 13);
}

// Function to handle geolocation error
function onGeolocationError(error) {
      console.error(error.message);
    }

    if ('geolocation' in navigator) {
      // Get the current position
      navigator.geolocation.getCurrentPosition(onGeolocationSuccess, onGeolocationError);
    } else {
      console.error('Geolocation is not supported by your browser.');
    }

    var polylineLayer = L.polyline([], { color: 'green' }).addTo(map);
    var markerClusterGroup = L.markerClusterGroup();

// Agrega el clúster de marcadores al mapa
    map.addLayer(markerClusterGroup);
    </script>
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

            var id_seguidor = "<?php echo $idSeguit; ?>";
    console.log(id_seguidor);
    var dades = {
        id_seguidor: id_seguidor,
        };
    $.ajax({
 

 url: 'localitzacions_usuari_seguit.php',
 type: 'POST',
 dataType: 'json',
 data: dades,
 success: function(data) {
   data.forEach(function(coordenada) {
    var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
  var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
  var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'green' }).addTo(map);

  var nombreRuta = coordenada.nombre;
  var tipus = coordenada.tipus;

  var marker;

  if (tipus == 'coche') {
    marker = L.marker(inicioLatlng).bindPopup('<h3>' + nombreRuta + '</h3>' + '<br>' + '<br>' + '<h5>Tipus de ruta:</h5><br>' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP._kQs9G90A2XFKArTMH1SjAHaHa&pid=Api&P=0&h=180" width='50px'>`);
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