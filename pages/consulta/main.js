// pages/paginas/consulta/main.js

document.addEventListener('DOMContentLoaded', function () {
    // Lógica de la página de consulta

    // Ejemplo de función para cargar la información de la consulta
    function cargarInfoConsulta() {
        // Supongamos que obtienes la información de la consulta en un formato JSON
        const infoConsulta = {
            medico: 'Dr. Médico',
            paciente: 'Nombre Paciente',
            fecha: '2023-11-20',
            sintomatologia: 'Síntomas del paciente...',
            diagnostico: 'Diagnóstico del médico...',
            medicacion: [
                { medicamento: 'Aspirina', cantidad: '1 pastilla', frecuencia: 'cada 8 horas', dias: '5 días', cronica: false },
                // Otra medicación...
            ],
        };

        // Ahora, actualizamos la interfaz con la información de la consulta
        document.getElementById('infoMedicoConsulta').innerText = `Médico: ${infoConsulta.medico}`;
        document.getElementById('infoPacienteConsulta').innerText = `Paciente: ${infoConsulta.paciente}`;
        document.getElementById('infoFechaConsulta').innerText = `Fecha: ${infoConsulta.fecha}`;
        document.getElementById('sintomatologiaTextarea').value = infoConsulta.sintomatologia;
        document.getElementById('diagnosticoTextarea').value = infoConsulta.diagnostico;
        cargarMedicacionConsulta(infoConsulta.medicacion);
    }

    // Ejemplo de función para cargar la medicación de la consulta
    function cargarMedicacionConsulta(medicacion) {
        const listaMedicacion = document.getElementById('medicacionConsulta');
        listaMedicacion.innerHTML = '<h2>Medicación de la Consulta</h2>';
        
        if (medicacion.length === 0) {
            listaMedicacion.innerHTML += '<p>No hay medicación para esta consulta.</p>';
        } else {
            medicacion.forEach(medicamento => {
                listaMedicacion.innerHTML += `<p>${medicamento.medicamento}, Cantidad: ${medicamento.cantidad}, Frecuencia: ${medicamento.frecuencia}, Días: ${medicamento.dias}, Crónica: ${medicamento.cronica ? 'Sí' : 'No'}</p>`;
            });
        }
    }

    // Ejemplo de función para añadir medicación a la consulta
    function agregarMedicacionConsulta() {
        // Aquí puedes implementar la lógica para agregar medicación a la consulta
        // Puedes mostrar mensajes de error o éxito según el resultado de la operación
        alert('Medicación añadida a la consulta.');
    }

    // Ejemplo de función para derivar a especialista y pedir cita
    function derivarEspecialista() {
        // Aquí puedes implementar la lógica para derivar a un especialista y pedir cita
        // Puedes mostrar mensajes de error o éxito según el resultado de la operación
        alert('Derivación a especialista solicitada y cita pedida.');
    }

    // Ejemplo de función para registrar la consulta
    function registrarConsulta() {
        // Aquí puedes implementar la lógica para registrar la consulta
        // Puedes mostrar mensajes de error o éxito según el resultado de la operación
        alert('Consulta registrada correctamente.');
    }

    // Cargar información de la consulta al cargar la página
    cargarInfoConsulta();

    // Asociar funciones a eventos
    document.getElementById('btnAgregarMedicacion').addEventListener('click', agregarMedicacionConsulta);
    document.getElementById('btnDerivarEspecialista').addEventListener('click', derivarEspecialista);
    document.getElementById('btnRegistrarConsulta').addEventListener('click', registrarConsulta);
});
