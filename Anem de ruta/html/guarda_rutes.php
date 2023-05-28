<?php


// Conectarse a la base de datos
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'anemderuta';
$conn = new mysqli($servername, $username, $password, $dbname);
  $nombre = $_POST['nombreRuta'];
  $dificultad = $_POST['dificultad'];
  $descripcio = $_POST['descripcio'];
  $latitud_inicial = $_POST['latitud_inicial'];
  $latitud_final = $_POST['latitud_final'];
  $longitud_inicial = $_POST['longitud_inicial'];
  $longitud_final = $_POST['longitud_final'];
  $tipus = $_POST['tipus'];
  $user_id = $_POST['user_id'];
  $sql = "INSERT INTO rutas (latitud_inicial, latitud_final, longitud_inicial, longitud_final, nombre, dificultad, descripcio, tipus, user_id) VALUES ( '$latitud_inicial', '$latitud_final', '$longitud_inicial', '$longitud_final', '$nombre', '$dificultad','$descripcio', '$tipus', '$user_id')";
  $resultado = $conn->query($sql);
  echo 'bien hecho';
  

if (!$resultado) {
  echo "Error en la consulta: " . $conn->error;
}

$conn->close();







?>