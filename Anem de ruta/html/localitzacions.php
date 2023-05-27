<?php

$conn = new mysqli('localhost', 'root', '', 'anemderuta');

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Realiza una consulta para obtener las coordenadas
$sql = "SELECT latitud_inicial, latitud_final, longitud_inicial, longitud_final, nombre, tipus FROM rutas";
$result = $conn->query($sql);

// Verifica si ocurrió un error en la ejecución de la consulta
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

// Verifica si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Recorre los resultados y almacena las coordenadas en un arreglo
    $coordenadas = array();
    while ($row = $result->fetch_assoc()) {
        $coordenadas[] = array(
            'latitud_inicial' => $row['latitud_inicial'],
            'latitud_final' => $row['latitud_final'],
            'longitud_inicial' => $row['longitud_inicial'],
            'longitud_final' => $row['longitud_final'],
            'nombre' => $row['nombre'],
            'tipus' => $row['tipus'],
        );
    }

    // Imprime el resultado como JSON
    header('Content-Type: application/json');
    ob_clean(); // Limpia cualquier salida en búfer
    echo json_encode($coordenadas);
} else {
    echo "No se encontraron resultados.";
}

// Cierra la conexión a la base de datos
$conn->close();

?>
