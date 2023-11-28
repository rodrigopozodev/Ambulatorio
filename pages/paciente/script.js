function cambiarPaciente() {
  // Implementa la lógica para cambiar de paciente (si es necesario)
  // Por ejemplo, podrías redirigir a la misma página con el nuevo ID de paciente
  var idPacienteSeleccionado = document.getElementById('select-paciente').value;
  window.location.href = 'index.php?id_paciente=' + idPacienteSeleccionado;
}

function cambiarPacienteConsultasPasadas() {
  // Implementa la lógica para cambiar de paciente en consultas pasadas (si es necesario)
  // Por ejemplo, podrías redirigir a la misma página con el nuevo ID de paciente
  var idPacienteSeleccionado = document.getElementById('selectPacientePasadas').value;
  window.location.href = 'index.php?id_paciente=' + idPacienteSeleccionado;
}

function mostrarConsulta(idConsulta) {
  // Puedes implementar la lógica para mostrar la información de la consulta seleccionada
  // Puedes hacer una petición AJAX para obtener más detalles de la consulta si es necesario
  // y mostrarlos dentro del div con id "info-consulta"
  // Ejemplo: $('#info-consulta').load('detalle_consulta.php?id=' + idConsulta);

  // Agregamos un enlace para descargar el PDF (puedes ajustar la ruta del archivo PDF)
  var enlacePDF = '<p><a href="pdf/consulta_' + idConsulta + '.pdf" target="_blank">Descargar PDF</a></p>';
  $('#info-consulta').html('Información de la consulta seleccionada: ' + enlacePDF);
}

function pedirCita() {
  var idMedico = document.getElementById('selectMedico').value;
  var fechaCita = document.getElementById('fecha').value;
  var sintomas = document.getElementById('sintomas').value;

  // Realiza una verificación de la fecha para determinar si es futura o pasada
  var fechaActual = new Date();
  var fechaSeleccionada = new Date(fechaCita);

  if (fechaSeleccionada < fechaActual) {
      // La fecha seleccionada es pasada, guarda en consultas pasadas
      insertarConsultaPasada(idMedico, fechaCita, sintomas);
  } else {
      // La fecha seleccionada es futura, guarda en próximas citas
      insertarProximaCita(idMedico, fechaCita, sintomas);
  }
}

function insertarProximaCita(idMedico, fechaCita, sintomas) {
  // Implementa la lógica para insertar la cita en próximas citas
  // Usa AJAX, fetch o cualquier otra técnica para enviar la información al servidor
  // Realiza la inserción en la tabla "citas" con el estado de "próxima cita"
}

function insertarConsultaPasada(idMedico, fechaCita, sintomas) {
  // Implementa la lógica para insertar la consulta pasada
  // Usa AJAX, fetch o cualquier otra técnica para enviar la información al servidor
  // Realiza la inserción en la tabla "consultas" con el estado de "consulta pasada"
}
