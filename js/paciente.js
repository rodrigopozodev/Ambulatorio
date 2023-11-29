// Archivo: js/paciente.js

// Función para cargar información del paciente desde el servidor
function cargarInfoPaciente(idPaciente) {
    // Realizar una solicitud al servidor para obtener la información del paciente
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php?idPaciente=' + idPaciente)
        .then(response => response.json())
        .then(data => {
            // Actualizar la interfaz con la información del paciente
            console.log("Información del paciente cargada:", data);
        })
        .catch(error => console.error('Error al cargar la información del paciente:', error));
}

// Función para obtener consultas pasadas del paciente desde el servidor
function obtenerConsultasPasadas(idPaciente) {
    // Realizar una solicitud al servidor para obtener las consultas pasadas del paciente
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php?idPaciente=' + idPaciente + '&tipo=consultasPasadas')
        .then(response => response.json())
        .then(data => {
            // Actualizar la interfaz con las consultas pasadas del paciente
            console.log("Consultas pasadas del paciente cargadas:", data);
        })
        .catch(error => console.error('Error al obtener las consultas pasadas del paciente:', error));
}

// Función para solicitar una cita desde el paciente
function solicitarCita(idPaciente, idMedico, fecha, sintomas) {
    // Realizar una solicitud al servidor para solicitar una cita
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            idPaciente: idPaciente,
            idMedico: idMedico,
            fecha: fecha,
            sintomas: sintomas,
        }),
    })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor
            console.log("Respuesta del servidor:", data);
        })
        .catch(error => console.error('Error al solicitar cita:', error));
}
