<?php
// Incluye el archivo de conexión a la base de datos
include "../controlador/conexion.php";

error_reporting(E_ALL);

$response = array();

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["clientName"]) and !empty($_POST["clientAge"]) and !empty($_POST["clientNumber"]) and !empty($_POST["clientEmail"])) {
        $nombre = $_POST["clientName"];
        $edad = $_POST["clientAge"];
        $numero = $_POST["clientNumber"];
        $email = $_POST["clientEmail"];

        // Usar consultas preparadas para prevenir la inyección de SQL
        $stmt = $conexion->prepare("INSERT INTO clientes (nombre, edad, numero, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $nombre, $edad, $numero, $email);

        if ($stmt->execute()) {
            $response["status"] = "success";
            $response["message"] = "Persona registrada correctamente";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error al registrar";
        }

        $stmt->close();
    } else {
        $response["status"] = "error";
        $response["message"] = "ALGUNO DE LOS CAMPOS ESTÁ VACÍO";
    }
}

// Devuelve la respuesta como JSON
echo json_encode($response);
?>
