<?php
include("../conexio/conexio.php");

$paraula = $_POST['paraula'];
$query = "SELECT * FROM usuaris WHERE usuari LIKE '%$paraula%'";
$result = $conn->query($query);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<a href='usuari.php?usuari=".$row['usuari']."' class='buscaUsuaris'><li>" .$row['usuari'] ."</li></a>";
    }
} else {
    echo "Sense resultats";
}
$conn->close();
?>