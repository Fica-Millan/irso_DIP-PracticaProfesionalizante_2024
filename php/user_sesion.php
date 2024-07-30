<?php
require __DIR__ . '/../config/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicar - Seguimiento Vehicular</title>

    <!-- Integrar Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/menu-hamburguesa.css">

    <!--Sweet Alert-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Cargar el archivo de JavaScript-->
    <script src="../js/map.js" defer></script>

</head>

<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="../img/logo.jpg" alt="Ubicar Logo">
            </div>

            <div class="mobile-menu-toggle">
                <button class="hamburger" onclick="toggleMenu()">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>

            <nav id="navbar">
                <div class="menu">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">CONTACTO</a></li>
                        <li><span class="usuario">BIENVENIDO LISANDRO MARTINEZ!</span></li>
                    </ul>
                    <button id="logout" type="button" onclick="location.href='../index.php'">LOGOUT</button>  
                </div>
                      
            </nav>
        </div>
    </header>

    <main>
        <div class="map-container">
            <div class="controls">
                <label for="vehiculoSelect">Buscar vehículo:</label>
                <select id="vehiculoSelect" class="select">
                    <option value="all">Todos</option>
                    <!-- Las opciones se llenarán con JavaScript -->
                </select>
            </div>

            <div id="map"></div>

        </div>
    </main>

    <footer>
        <img class="footer-img" src="../img/footer.jpg" alt="footer">
    </footer>
    
    <!-- Cargar el script de Google Maps -->
    <script>
        async function loadMapScript() {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = "https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsApiKey; ?>&libraries=places&callback=initMap";
                script.async = true;
                script.defer = true;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }

        loadMapScript().catch(error => console.error('Error al cargar la API de Google Maps:', error));
    </script>

    <!-- Menu hamburguesa-->
    <script src="../js/menu-hamburguesa.js"></script>

</body>
</html>

