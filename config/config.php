<?php
require __DIR__ . '/../vendor/autoload.php';

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Ahora puedes acceder a las variables de entorno
$googleMapsApiKey = $_ENV['GOOGLE_MAPS_API_KEY'];

// Configuración de la conexión a la base de datos
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "ubinet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

