<?php
include "conexion.php";

if (isset($_GET['nombre'])) {
    $nombreProducto = $_GET['nombre'];

    // Consulta SQL para obtener el precio del producto
    $sql = $conexion->query("SELECT precio FROM productos WHERE nombre = '$nombreProducto'");

    // Verificar si se encontró el producto y devolver el precio
    if ($sql->num_rows > 0) {
        $datos = $sql->fetch_object();
        echo $datos->precio;
    } else {
        echo 'Producto no encontrado';
    }
} else {
    echo 'Parámetro de nombre de producto no proporcionado';
}
?>
