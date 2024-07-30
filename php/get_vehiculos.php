<?php
// Incluir el archivo de configuración que contiene la conexión a la base de datos
require __DIR__ . '/../config/config.php';

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Consulta para obtener los vehículos
$sql = "SELECT * FROM vehiculos";
$result = $conn->query($sql);

$vehiculos = array();
while($row = $result->fetch_assoc()) {
    $vehiculos[] = $row;
}

// Devolver datos en formato JSON
echo json_encode($vehiculos);

// Cerrar conexión
$conn->close();
?>
