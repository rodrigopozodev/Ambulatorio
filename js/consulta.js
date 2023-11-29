// Archivo: js/consulta.js

// Función para cargar la información de la consulta desde el servidor
function cargarConsultaInfo(idConsulta) {
    // Realizar una solicitud al servidor para obtener la información de la consulta
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php?idConsulta=' + idConsulta)
        .then(response => response.json())
        .then(data => {
            // Actualizar la interfaz con la información de la consulta
            console.log("Información de la consulta cargada:", data);
        })
        .catch(error => console.error('Error al cargar la información de la consulta:', error));
}

// Función para agregar medicación a la consulta
function agregarMedicacion(idConsulta, medicacion) {
    // Realizar una solicitud al servidor para agregar medicación a la consulta
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            idConsulta: idConsulta,
            medicacion: medicacion,
        }),
    })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor
            console.log("Respuesta del servidor:", data);
        })
        .catch(error => console.error('Error al agregar medicación:', error));
}

// Función para registrar la consulta en el servidor
function registrarConsulta(idConsulta, diagnostico) {
    // Realizar una solicitud al servidor para registrar la consulta
    // Puedes usar Fetch API, XMLHttpRequest u otra biblioteca para hacer la solicitud
    // Aquí se proporciona un ejemplo simple usando Fetch API
    fetch('servidor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            idConsulta: idConsulta,
            diagnostico: diagnostico,
        }),
    })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor
            console.log("Respuesta del servidor:", data);
        })
        .catch(error => console.error('Error al registrar la consulta:', error));
}
