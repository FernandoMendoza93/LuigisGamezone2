<?php
// Incluir el archivo de conexión
include "conexion.php";

// Inicializar el arreglo de respuesta
$response = array();

// Verificar si se ha enviado el formulario
if (isset($_POST['btnregistrar']) && $_POST['btnregistrar'] === 'ok') {
    // Obtener los datos del formulario
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    // Preparar la consulta SQL para insertar un nuevo producto
    $stmt = $conexion->prepare("INSERT INTO productos (Nombre, Precio) VALUES (?, ?)");
    $stmt->bind_param("sd", $productName, $productPrice);

    // Ejecutar la consulta y verificar si fue exitosa
    if ($stmt->execute()) {
        $response["status"] = "success";
        $response["message"] = "Producto registrado correctamente";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error al registrar el producto";
    }

    // Cerrar la consulta
    $stmt->close();
} else {
    // Si no se envió el formulario, retornar un mensaje de error
    $response["status"] = "error";
    $response["message"] = "El formulario no fue enviado correctamente";
}

// Devolver la respuesta como JSON
echo json_encode($response);
?>
