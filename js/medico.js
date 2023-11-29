// Archivo: js/medico.js

// Función para cargar información del médico desde el servidor
function cargarInfoMedico(idMedico) {
    // Realizar una solicitud al servidor para obtener la información del médico
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php?idMedico=' + idMedico)
        .then(response => response.json())
        .then(data => {
            // Actualizar la interfaz con la información del médico
            console.log("Información del médico cargada:", data);
        })
        .catch(error => console.error('Error al cargar la información del médico:', error));
}

// Función para obtener consultas próximas del médico desde el servidor
function obtenerConsultasProximas(idMedico) {
    // Realizar una solicitud al servidor para obtener las consultas próximas del médico
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php?idMedico=' + idMedico + '&tipo=consultasProximas')
        .then(response => response.json())
        .then(data => {
            // Actualizar la interfaz con las consultas próximas del médico
            console.log("Consultas próximas del médico cargadas:", data);
        })
        .catch(error => console.error('Error al obtener las consultas próximas del médico:', error));
}

// Función para realizar una consulta desde el médico
function realizarConsulta(idConsulta) {
    // Redirigir a la página de consulta con el ID de la consulta
    window.location.href = 'consulta.html?idConsulta=' + idConsulta;
}
