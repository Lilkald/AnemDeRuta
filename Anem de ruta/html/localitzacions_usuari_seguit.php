<?php

$conn = new mysqli('localhost', 'root', '', 'anemderuta');

$id_seguidor = $_POST['id_seguidor'];


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$sql = "SELECT * FROM rutas WHERE user_id LIKE $id_seguidor";
$result = $conn->query($sql);


if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

if ($result->num_rows > 0) {

    $coordenadas = array();
    while ($row = $result->fetch_assoc()) {
        $coordenadas[] = array(
            'id_ruta' => $row['id'],
            'latitud_inicial' => $row['latitud_inicial'],
            'latitud_final' => $row['latitud_final'],
            'longitud_inicial' => $row['longitud_inicial'],
            'longitud_final' => $row['longitud_final'],
            'nombre' => $row['nombre'],
            'tipus' => $row['tipus'],
        );
    }

    header('Content-Type: application/json');
    ob_clean(); 
    echo json_encode($coordenadas);
} else {
    echo "No se encontraron resultados.";
}


$conn->close();

?>