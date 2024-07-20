<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Ahora puedes acceder a las variables de entorno
$googleMapsApiKey = $_ENV['GOOGLE_MAPS_API_KEY'];
?>
