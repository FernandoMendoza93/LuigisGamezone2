<?php

if (!empty($_POST["btnregistrar"])) {
if (!empty($_POST["clientName"]) and !empty($_POST["clientAge"]) and !empty($_POST["clientNumber"]) and !empty($_POST["clientEmail"]) ) {
    $id= $_POST["id"];
    $nombre= $_POST["clientName"];
    $edad= $_POST["clientAge"];
    $numero= $_POST["clientNumber"];
    $email= $_POST["clientEmail"];
    $sql=$conexion->query(" update clientes set nombre='$nombre',edad= $edad, numero='$numero', email='$email' where id_cliente= $id ");  
    if ($sql==1) {
        header("location:clientes.php");
    } else {
            echo "<div> vlass='alert alert_danger'> ERROR AL MODIFICAR CLIENTE </div>";
    }
} else {
echo "campos vacíos";
}
}

?>
