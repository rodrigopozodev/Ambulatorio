// pages/paginas/paciente/main.js

document.addEventListener('DOMContentLoaded', function () {
    // Lógica de la página del paciente

    // Ejemplo de función para cargar la información del paciente
    function cargarInfoPaciente() {
        // Supongamos que obtienes la información del paciente en un formato JSON
        const infoPaciente = {
            nombre: 'Nombre Paciente',
            proximasCitas: [
                { idCita: 1, medico: 'Dr. Médico', fecha: '2023-11-21' },
                // Otras citas...
            ],
            medicacionActual: [
                { medicamento: 'Aspirina', posologia: '1 pastilla cada 8 horas', fechaFin: '2023-11-25' },
                // Otra medicación...
            ],
            consultasPasadas: [
                { idConsulta: 1, fecha: '2023-11-15' },
                // Otras consultas...
            ],
        };

        // Ahora, actualizamos la interfaz con la información del paciente
        document.getElementById('nombrePaciente').innerText = infoPaciente.nombre;
        cargarProximasCitas(infoPaciente.proximasCitas);
        cargarMedicacionActual(infoPaciente.medicacionActual);
        cargarConsultasPasadas(infoPaciente.consultasPasadas);
    }

    // Ejemplo de función para cargar las próximas citas del paciente
    function cargarProximasCitas(proximasCitas) {
        const listaProximasCitas = document.getElementById('proximasCitas');
        listaProximasCitas.innerHTML = '<h2>Próximas Citas</h2>';
        
        if (proximasCitas.length === 0) {
            listaProximasCitas.innerHTML += '<p>No hay citas próximas.</p>';
        } else {
            proximasCitas.forEach(cita => {
                listaProximasCitas.innerHTML += `<p>ID: ${cita.idCita}, Médico: ${cita.medico}, Fecha: ${cita.fecha}</p>`;
            });
        }
    }

    // Ejemplo de función para cargar la medicación actual del paciente
    function cargarMedicacionActual(medicacionActual) {
        const listaMedicacionActual = document.getElementById('medicacionActual');
        listaMedicacionActual.innerHTML = '<h2>Medicación Actual</h2>';
        
        if (medicacionActual.length === 0) {
            listaMedicacionActual.innerHTML += '<p>No hay medicación actual.</p>';
        } else {
            medicacionActual.forEach(medicamento => {
                listaMedicacionActual.innerHTML += `<p>${medicamento.medicamento}, Posología: ${medicamento.posologia}, Fecha de Fin: ${medicamento.fechaFin}</p>`;
            });
        }
    }

    // Ejemplo de función para cargar las consultas pasadas del paciente
    function cargarConsultasPasadas(consultasPasadas) {
        const listaConsultasPasadas = document.getElementById('consultasPasadas');
        listaConsultasPasadas.innerHTML = '<h2>Consultas Pasadas</h2>';
        
        if (consultasPasadas.length === 0) {
            listaConsultasPasadas.innerHTML += '<p>No hay consultas pasadas.</p>';
        } else {
            consultasPasadas.forEach(consulta => {
                listaConsultasPasadas.innerHTML += `<p>ID: ${consulta.idConsulta}, Fecha: ${consulta.fecha}</p>`;
            });
        }
    }

    // Ejemplo de función para ver detalles de una consulta pasada
    function verDetallesConsulta(idConsulta) {
        // Aquí puedes implementar la lógica para cargar los detalles de una consulta pasada
        // Puedes redirigir a una nueva página o mostrar los detalles en un modal, por ejemplo
        alert(`Detalles de la consulta ${idConsulta}`);
    }

    // Ejemplo de función para pedir una cita con el médico de cabecera
    function pedirCitaMedicoCabecera() {
        // Aquí puedes implementar la lógica para pedir una cita con el médico de cabecera
        // Puedes mostrar mensajes de error o éxito según el resultado de la operación
        alert('Cita con médico de cabecera solicitada.');
    }

    // Cargar información del paciente al cargar la página
    cargarInfoPaciente();

    // Asociar funciones a eventos
    document.getElementById('consultasPasadas').addEventListener('click', function (event) {
        // Supongamos que los detalles de la consulta están en el atributo "data-idconsulta" del elemento clicado
        const idConsulta = event.target.dataset.idconsulta;
        if (idConsulta) {
            verDetallesConsulta(idConsulta);
        }
    });

    document.getElementById('btnPedirCita').addEventListener('click', pedirCitaMedicoCabecera);
});
