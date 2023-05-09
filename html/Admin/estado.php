<?php
$nombre_servidor = $_SERVER['SERVER_NAME'];
$version_php = phpversion();
$total_registros = 0;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anemderuta";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT COUNT(*) AS total FROM usuaris");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_registros = $resultado['total'];

    $conn = null;
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Error de conexión a la base de datos: ' . $e->getMessage()
    ]);
    exit();
}

$estado_mysql = 'Desconocido';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmts = $conn->query("SELECT COUNT(*) AS total FROM usuaris");
if ($stmts) {
    $estado_mysql = 'Actiu';
} else {
    $estado_mysql = 'Inactiu';
}

$estado_curl = extension_loaded('curl') ? 'Habilitado' : 'Deshabilitado';

if (extension_loaded('curl')) {
    $estado_curl = "Habilitat";
} else {
    $estado_curl = "Deshabilitat";
}


$conn = null;
echo json_encode([
    'nombre_servidor' => $nombre_servidor,
    'version_php' => $version_php,
    'total_registros' => $total_registros,
    'estado_mysql' => $estado_mysql,
    'estado_curl' => $estado_curl
]);
?>