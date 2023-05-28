<?php
include("conexio/conexio.php");
    session_start();
	if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $usuari = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Jaldi&display=swap');

    html,body{
      font-family: 'Jaldi';
    }

    


</style>

  
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet-src.min.js" integrity="sha512-nRcCZolw4mA+OKrTG/baePuVcG7PHhjFhl6pxkLYl2T+3pKEf+vXw0uR1/X3YtlPLXoWiaLjBnuUzpDuB1yXNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      <link rel="stylesheet" href="../leaflet/leaflet.css" />
      <script src="../leaflet/leaflet.js"></script>
      <link rel="shortcut icon" href="../images/logo.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
      <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
      <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
      
</head>

<body>

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
  <main class="allRutes">
      <div class="containerRutes">
          <div class="dadesRuta">
            <form id="form-ruta" method="POST" onsubmit="return false;">
              <div class="pasos" style="text-align: center;">
                <h2>Pas 1:</h2>
              </div>
                  <label>Nom de la ruta:</label>
                  <input type="text" id="nombreRuta" name="nombreRuta" required>
                  <label>Descripció:</label>
                  <textarea type="text" id="descripcio" name="descripcio" required></textarea>
                  <label>Dificultat de la ruta:</label>
                  <div class="rating">
                      <input type="radio" id="dificultad1" name="dificultad" value="5">
                      <label for="dificultad1">5</label>
                      <input type="radio" id="dificultad2" name="dificultad" value="4">
                      <label for="dificultad2">4</label>
                      <input type="radio" id="dificultad3" name="dificultad" value="3">
                      <label for="dificultad3">3</label>
                      <input type="radio" id="dificultad4" name="dificultad" value="2">
                      <label for="dificultad4">2</label>
                      <input type="radio" id="dificultad5" name="dificultad" value="1">
                      <label for="dificultad5">1</label>
                  </div>
                  <label>Tipus de ruta:</label>
                  <select name="tipo_ruta" id="tipo_ruta" required>
                    <option value="bici">Bicicleta</option>
                    <option value="coche">Coche</option>
                    <option value="moto">Moto</option>
                    <option value="caminar">Caminar</option>
                  </select>
            </form>
          </div>
          <br>
          <div class="pasos" style="text-align: center;">
            <h2>Pas 2:</h2><br>
            <div id="mapid" style="height: 80%; width: 100%; margin: 0 auto; border: 5px solid black;"></div>
            <br>
          </div>
      </div>
      <div class="botoSeguir botoEditar botoEnviar llarguet">
        <form class="editar" method="POST" action="editor.php" enctype="multipart/form-data"> 
          <input class="buttons" type="submit" id="guardar-ruta" name="guardar-ruta">
        </form>
      </div> 
  </main>
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
    </body>

  <script>
   var map = L.map('mapid').setView([51.505, -0.09], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);

if (localStorage.getItem("coordenadas")) {
  var coordenadas = JSON.parse(localStorage.getItem("coordenadas"));
  
}

const geocoderControl = L.Control.geocoder({
  defaultMarkGeocode: false
});

function onGeolocationSuccess(position) {
      var lat = position.coords.latitude;
      var lon = position.coords.longitude;

      var marker = L.marker([lat, lon]).addTo(map);

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

  map.on('markgeocode', function (e) {
    const location = e.geocode.center;
    const address = e.geocode.name;

    console.log('Coordenadas:', location);
    console.log('Dirección:', address);

    
  });

  geocoderControl.on('markgeocode', function(event) {
      var result = event.geocode;
      map.setView(result.center, 13);
    });

geocoderControl.addTo(map);




var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);
var drawControl = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems
    },
  draw: {
    polyline: {
      shapeOptions: {
        color: 'green',
        weight: 15
      }
    },
    polygon: false,
    circle: false,
    rectangle: false,
    marker: false
  }
});
map.addControl(drawControl);
var coordenadas = [];


function layerType(layer) {
  if (layer instanceof L.Marker) {
    return 'marker';
  } else if (layer instanceof L.Polyline) {
    return 'polyline';
  }
}


map.on('draw:created', function (event) {
  var layer = event.layer;
  var type = layerType(layer);

  if (type === 'marker') {
    var latlng = layer.getLatLng();
    var lat = latlng.lat;
    var lng = latlng.lng;
  }
    else if (type === 'polyline') {
    var latlngs = layer.getLatLngs();
    var coordinadas = [];
    var startLatLng = latlngs[0];
    var endLatLng = latlngs[latlngs.length - 1];
    var startLat = startLatLng.lat;
    var startLng = startLatLng.lng;
    var endLat = endLatLng.lat;
    var endLng = endLatLng.lng;
    
    console.log('Punto de inicio - Latitud:', startLat, 'Longitud:', startLng);
    localStorage.setItem('latitud_inicial', startLat);
    localStorage.setItem('latitud_final', endLat);

    localStorage.setItem('longitud_inicial', startLng);
    localStorage.setItem('longitud_final', endLng);
    console.log('Punto final - Latitud:', endLat, 'Longitud:', endLng);

    map.addLayer(layer);
  }
  
    
});


function obtenerDificultadSeleccionada() {
    const radios = document.getElementsByName('dificultad');
    let valorSeleccionado = '';

    for (let i = 0; i < radios.length; i++) {
      if (radios[i].checked) {
        valorSeleccionado = radios[i].value;
        break;
      }
    }

    return valorSeleccionado;
  }
  var usuari = "<?php echo $usuari; ?>";


$('#guardar-ruta').click(function() {
    var latitud_inicial = localStorage.getItem('latitud_inicial');
    var latitud_final= localStorage.getItem('latitud_final');
    var longitud_inicial = localStorage.getItem('longitud_inicial');
    var longitud_final= localStorage.getItem('longitud_final');
    var nombreRuta = $('#nombreRuta').val();
    var descripcio = $('#descripcio').val();
    const dificultad = obtenerDificultadSeleccionada();
    var tipus = $('#tipo_ruta').val();
    var user_id = "<?php echo $usuari; ?>";
    console.log(tipus);
    console.log(dificultad);
        var dades = {
            nombreRuta: nombreRuta,
            dificultad : dificultad,
            descripcio : descripcio,
            latitud_inicial : latitud_inicial,
            latitud_final : latitud_final,
            longitud_inicial : longitud_inicial,
            longitud_final : longitud_final,
            tipus: tipus,
            user_id: user_id,
        };

    
    $.ajax({
        url: 'guarda_rutes.php',
        method: 'POST',
        data: dades,
        success: function(data, response) {
            alert(JSON.stringify(dades));
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
$('#veure-rutes').on('click', function() {
      window.location.replace('rutes.html');
    })
  </script>




</html>
