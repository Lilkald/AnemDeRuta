<?php
include('../conexio/conexio.php');
    session_start();

	if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    if($_SESSION["tipus"] != "admin"){
        header("Location: ../home.php");
        exit();
    }
?>

<?php

    function tancarSess(){
        header("../login.php");
        
    }

    if (isset($_GET['funcion'])) {
    $nombreFuncion = $_GET['funcion'];
    
    // Verificar si la función existe y es llamable
    if (function_exists($nombreFuncion) && is_callable($nombreFuncion)) {
        // Ejecutar la función
        call_user_func($nombreFuncion);
    } else {
        echo "La función especificada no existe o no es llamable.";
    }
}

?>