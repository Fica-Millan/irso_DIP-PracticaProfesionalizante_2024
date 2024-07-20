let map;
let markers = [];
let vehiculos = [];

// Función de inicialización del mapa
function initMap() {
    // Verificar que google está definido
    if (typeof google === 'undefined' || !google.maps) {
        console.error('Google Maps API no está disponible');
        return;
    }

    try {
        // Crear el mapa
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -34.6037, lng: -58.3816 },
            zoom: 13
        });

        // Cargar los vehículos desde el servidor
        fetch('php/get_vehiculos.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la red');
            }
            return response.json();
        })
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
                vehiculos = data;
                populateVehiculoSelect();
                updateMarkers('all'); // Mostrar todos los vehículos inicialmente
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aviso',
                    text: 'No hay datos de vehículos disponibles.',
                    confirmButtonText: 'Aceptar'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo cargar la información de los vehículos.',
                confirmButtonText: 'Aceptar'
            });
        });

        // Manejar el cambio en la selección de vehículos
         document.getElementById('vehiculoSelect').addEventListener('change', function() {
            updateMarkers(this.value);
        });
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al inicializar el mapa.',
            confirmButtonText: 'Aceptar'
        });
    }
}

// Función para llenar el select con opciones de vehículos
function populateVehiculoSelect() {
    const select = document.getElementById('vehiculoSelect');
    vehiculos.forEach(vehiculo => {
        const option = document.createElement('option');
        option.value = vehiculo.id;
        option.textContent = vehiculo.nombre;
        select.appendChild(option);
    });
}

// Función para traer los datos del vehículos
function createMarker(vehiculo) {
    const lat = parseFloat(vehiculo.latitud);
    const lng = parseFloat(vehiculo.longitud);

    if (!isNaN(lat) && !isNaN(lng)) {
        const marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            title: vehiculo.nombre
        });

        const contentString = `
            <div>
                <h3>${vehiculo.nombre}</h3>
                <p><strong>Última actualización:</strong> ${vehiculo.ultima_actualizacion}</p>
                <p><strong>Patente:</strong> ${vehiculo.patente}</p>
                <p><strong>Conductor:</strong> ${vehiculo.conductor}</p>
                <p><strong>Vencimiento VTV:</strong> ${vehiculo.vencimiento_vtv}</p>
                <p><strong>Marca:</strong> ${vehiculo.marca}</p>
                <p><strong>Modelo:</strong> ${vehiculo.modelo}</p>
                <p><strong>Kilómetros acumulados:</strong> ${vehiculo.kilometros_acumulados}</p>
                <p><strong>Estado:</strong> ${vehiculo.estado}</p>
            </div>
        `;

        const infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        marker.addListener('click', () => {
            infowindow.open(map, marker);
        });

        markers.push(marker);
    } else {
        console.error(`Coordenadas no válidas para el vehículo ${vehiculo.id}: ${vehiculo.latitud}, ${vehiculo.longitud}`);
    }
}

// Función para actualizar los marcadores en el mapa
function updateMarkers(selectedVehiculo) {
    // Eliminar todos los marcadores existentes
    markers.forEach(marker => marker.setMap(null));
    markers = [];

    // Filtrar vehículos según la selección
    let filteredVehiculos;
    if (selectedVehiculo === 'all') {
        filteredVehiculos = vehiculos;
    } else {
        const selectedId = selectedVehiculo; // ID como cadena
        filteredVehiculos = vehiculos.filter(v => v.id === selectedId);
    }

    // Agregar los marcadores al mapa
    if (filteredVehiculos.length === 0) {
        console.log('No se encontraron vehículos para mostrar.');
    } else {
        filteredVehiculos.forEach(vehiculo => {
            // Verificar que las coordenadas son válidas
            const lat = parseFloat(vehiculo.latitud);
            const lng = parseFloat(vehiculo.longitud);
            if (!isNaN(lat) && !isNaN(lng)) {
                const marker = new google.maps.Marker({
                    position: { lat: lat, lng: lng },
                    map: map,
                    title: `${vehiculo.nombre}\nÚltima actualización: ${vehiculo.ultima_actualizacion}`
                });
                markers.push(marker);
                createMarker(vehiculo);
            } else {
                console.error(`Coordenadas no válidas para el vehículo ${vehiculo.id}: ${vehiculo.latitud}, ${vehiculo.longitud}`);
            }
        });
    }
}

// Inicializar el mapa cuando el documento esté listo
document.addEventListener('DOMContentLoaded', () => {
    if (typeof initMap === 'function') {
        initMap();
    }
});
