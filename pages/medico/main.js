// pages/paginas/medico/main.js

document.addEventListener('DOMContentLoaded', function () {
    // Lógica de la página del médico

    // Ejemplo de función para cargar la información del médico
    function cargarInfoMedico() {
        // Supongamos que obtienes la información del médico en un formato JSON
        const infoMedico = {
            nombre: 'Dr. Médico',
            especialidad: 'Especialidad Médica',
            citasProximas: 5, // Número de citas en los próximos 7 días
            consultasHoy: [
                { idCita: 1, paciente: 'Nombre Paciente', sintomatologia: 'Síntomas del paciente...' },
                // Otras consultas...
            ],
        };

        // Ahora, actualizamos la interfaz con la información del médico
        document.getElementById('nombreMedico').innerText = infoMedico.nombre;
        document.getElementById('especialidadMedico').innerText = infoMedico.especialidad;
        document.getElementById('citasProximas').innerText = `Citas próximas (próximos 7 días): ${infoMedico.citasProximas}`;
        cargarConsultasHoy(infoMedico.consultasHoy);
    }

    // Ejemplo de función para cargar las consultas del día
    function cargarConsultasHoy(consultasHoy) {
        const listaConsultas = document.getElementById('consultasHoy');
        listaConsultas.innerHTML = '<h2>Consultas de Hoy</h2>';

        if (consultasHoy.length === 0) {
            listaConsultas.innerHTML += '<p>No hay consultas para hoy.</p>';
        } else {
            consultasHoy.forEach(consulta => {
                // Mostrar solo los primeros 100 caracteres de la sintomatología
                const extractoSintomatologia = consulta.sintomatologia.slice(0, 100);
                listaConsultas.innerHTML += `<p>ID: ${consulta.idCita}, Paciente: ${consulta.paciente}, Sintomatología: ${extractoSintomatologia}</p>`;
            });
        }
    }

    // Cargar información del médico al cargar la página
    cargarInfoMedico();
});
