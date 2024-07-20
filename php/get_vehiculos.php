<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('localhost:3307', 'root', '', 'ubinet');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los vehículos
$sql = "SELECT id, nombre, latitud, longitud, ultima_actualizacion FROM vehiculos";
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
