<?php
include("conexio/conexio.php");
    session_start();
	if (!isset($_SESSION['username'])) {
        // No hay sesión activa, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit();
    }

    $usuari = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet-src.min.js" integrity="sha512-nRcCZolw4mA+OKrTG/baePuVcG7PHhjFhl6pxkLYl2T+3pKEf+vXw0uR1/X3YtlPLXoWiaLjBnuUzpDuB1yXNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      <link rel="stylesheet" href="../leaflet/leaflet.css" />
    <script src="../leaflet/leaflet.js"></script>
    
    <link href="../css/style.css" rel="stylesheet">
   <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


<!-- Leaflet.markercluster CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

<!-- Leaflet.markercluster JavaScript -->
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>
<body>
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
    <br>
    <div id="mapid" class="col" style="height: 500px; border: 5px solid black;"></div>
    <div class="su"></div>
    <div>
      <form class="filtres" onsubmit="return false;">
      <label for="vehicle-select">Filtrar per tipus de ruta:</label><br>
      <select id="vehicles">
        <option value="coche">Cotxe</option>
        <option value="moto">Moto</option>
        <option value="bici">Bicicleta</option>
        <option value="caminar">Caminant</option>
      </select><br>
      <input type="submit" class="filtrar" id="filtrar" value="filtrar">
    </form>
    </div><br>
    <input type="submit" class="tornar" id="tornar" value="Tornar"></div>
    <br>
    <footer>
      <div class="footer">
          <div class="redes sect">
              <p>SIGUENOS EN:</p>
              <div class="logo">
                  <a href="https://www.instagram.com%22%3E/"<i class='bx bxl-instagram'></i></a>
                  <a href="https://www.twitter.com%22%3E/"<i class='bx bxl-twitter'></i></a>
                  <a href="https://www.facebook.com%22%3E/"<i class='bx bxl-facebook-circle'></i></a>
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
    
// Agrega el clúster de marcadores al mapa

// Realizar la solicitud AJAX para obtener las coordenadas
var usuari = "<?php echo $usuari; ?>";
    console.log(usuari);
$.ajax({

 url: 'localitzacions.php',
 type: 'GET',
 dataType: 'json',
 success: function(data) {
   // Recorrer las coordenadas y añadirlas a la capa de polilínea
   data.forEach(function(coordenada) {
     
       var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
       var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
       var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'green' }).addTo(map);
      
       var nombreRuta = coordenada.nombre; // Supongamos que el nombre de la ruta está en el campo "nombre" de la consulta
       var tipus = coordenada.tipus;

       var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + 'Tipus de ruta:' + tipus);

       if(tipus == 'coche'){
         var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP._kQs9G90A2XFKArTMH1SjAHaHa&pid=Api&P=0&h=180" width='50px'>`  );
       }
       else if(tipus == 'moto'){
         var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse2.mm.bing.net/th?id=OIP.GzB7SiVMJtmnqhwAujNJzgHaF_&pid=Api&P=0&h=180" width='50px'>`  );
       }
       else if(tipus == 'bici'){
         var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP.P1Htg_Cx-eaDwPdJ6o3oGwHaEw&pid=Api&P=0&h=180" width='50px'>`  );
       }
       else if(tipus == 'caminar'){
         var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP.OoNF_Weiw131JD7Q1rZSEQHaG6&pid=Api&P=0&h=180" width='50px'>`  );
       }

       

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



$('#tornar').on('click',function(){
    window.location.replace('index.html');

});


$('#filtrar').on('click', function() {
  var filtro = document.getElementById('vehicles').value;
  console.log(filtro);

  // Limpiar los marcadores anteriores
  markerClusterGroup.clearLayers();

  if (filtro == 'coche') {
    $.ajax({
      url: 'localitzacions_coche.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Recorrer las coordenadas y añadirlas a la capa de polilínea
        data.forEach(function(coordenada) {
          var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
          var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
          var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'blue' }).addTo(map);

          var nombreRuta = coordenada.nombre;
          var tipus = coordenada.tipus;
          var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP._kQs9G90A2XFKArTMH1SjAHaHa&pid=Api&P=0&h=180" width='50px'>`);
          marker.addTo(markerClusterGroup);
          map.fitBounds(rutaLayer.getBounds());
        });
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }else if(filtro == 'moto'){
    $.ajax({
      url: 'localitzacions_moto.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Recorrer las coordenadas y añadirlas a la capa de polilínea
        data.forEach(function(coordenada) {
          var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
          var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
          var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'red' }).addTo(map);
          var nombreRuta = coordenada.nombre;
          var tipus = coordenada.tipus;
          var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse2.mm.bing.net/th?id=OIP.GzB7SiVMJtmnqhwAujNJzgHaF_&pid=Api&P=0&h=180" width='50px'>`);
          marker.addTo(markerClusterGroup);
          map.fitBounds(rutaLayer.getBounds());
        });
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }else if(filtro == 'bici'){
    $.ajax({
      url: 'localitzacions_bici.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Recorrer las coordenadas y añadirlas a la capa de polilínea
        data.forEach(function(coordenada) {
          var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
          var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
          var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'purple' }).addTo(map);

          var nombreRuta = coordenada.nombre;
          var tipus = coordenada.tipus;
          var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP.P1Htg_Cx-eaDwPdJ6o3oGwHaEw&pid=Api&P=0&h=180" width='50px'>`);
          marker.addTo(markerClusterGroup);
          map.fitBounds(rutaLayer.getBounds());
        });
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
  else if(filtro == 'caminar'){
    $.ajax({
      url: 'localitzacions_caminar.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Recorrer las coordenadas y añadirlas a la capa de polilínea
        data.forEach(function(coordenada) {
          var inicioLatlng = L.latLng(coordenada.latitud_inicial, coordenada.longitud_inicial);
          var finLatlng = L.latLng(coordenada.latitud_final, coordenada.longitud_final);
          var rutaLayer = L.polyline([inicioLatlng, finLatlng], { color: 'yellow' }).addTo(map);

          var nombreRuta = coordenada.nombre;
          var tipus = coordenada.tipus;
          var marker = L.marker(inicioLatlng).bindPopup('Nom de la ruta:' + nombreRuta + '<br>' + '<br>' + 'Tipus de ruta:' + tipus + '<br><br>' + `<img src="https://tse1.mm.bing.net/th?id=OIP.OoNF_Weiw131JD7Q1rZSEQHaG6&pid=Api&P=0&h=180" width='50px'>`);
          marker.addTo(markerClusterGroup);
          map.fitBounds(rutaLayer.getBounds());
        });
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
});










</script>

</html>