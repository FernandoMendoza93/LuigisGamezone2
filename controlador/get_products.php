<?php
// Incluir el archivo de conexión
include "conexion.php";

// Inicializar el arreglo de nombres de productos
$productNames = array();

// Consulta SQL para obtener la lista de nombres de productos
$sql = $conexion->query("SELECT nombre FROM productos");

// Obtener los datos y agregar los nombres al arreglo
while ($row = $sql->fetch_assoc()) {
    $productNames[] = $row['nombre'];
}

// Devolver la lista de nombres de productos como JSON
echo json_encode($productNames);
?>

