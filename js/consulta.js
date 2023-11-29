// Lógica para añadir medicación a la lista y actualizar la interfaz
function anadirMedicacionALaLista(medicacion) {
    // Crear un elemento de lista para mostrar la medicación
    const listaMedicacion = document.getElementById("listaMedicacion");
    const nuevoElemento = document.createElement("li");

    // Crear una cadena con la información de la medicación
    let infoMedicacion = `${medicacion.medicamento} - Cantidad: ${medicacion.cantidad}, Frecuencia: ${medicacion.frecuencia}`;
    if (medicacion.esCronica) {
        infoMedicacion += ", Medicación crónica";
    } else {
        infoMedicacion += `, ${medicacion.numDias} días`;
    }

    // Asignar la cadena al nuevo elemento de lista
    nuevoElemento.textContent = infoMedicacion;

    // Añadir el nuevo elemento a la lista
    listaMedicacion.appendChild(nuevoElemento);

    // Limpiar los campos después de añadir la medicación
    limpiarCamposMedicacion();
}

// Función para derivar a un especialista y actualizar la interfaz
function derivarAEspecialista(idEspecialista, fechaCitaEspecialista) {
    // Simulación de la solicitud al servidor para registrar la derivación
    const solicitudExitosa = simularSolicitudAlServidor(idEspecialista, fechaCitaEspecialista);

    // Verificar si la solicitud fue exitosa
    if (solicitudExitosa) {
        // Actualizar la interfaz para reflejar la derivación
        mostrarMensaje("Derivación exitosa. Se ha programado una cita con el especialista.");
        limpiarCamposDerivacion();
    } else {
        // Mostrar un mensaje de error si la solicitud falla
        mostrarMensaje("Error al derivar a un especialista. Por favor, inténtelo de nuevo.");
    }
}

// Función para simular una solicitud al servidor
function simularSolicitudAlServidor(idEspecialista, fechaCitaEspecialista) {
    // Lógica para simular la solicitud al servidor
    // Aquí puedes realizar una solicitud AJAX o usar fetch para enviar datos al servidor

    // Simulamos que la solicitud siempre es exitosa
    return true;
}

// Función para mostrar mensajes en la interfaz
function mostrarMensaje(mensaje) {
    // Mostrar el mensaje donde prefieras en tu interfaz
    alert(mensaje); // Este es solo un ejemplo, puedes implementar tu propio sistema de mensajes
}

// Función para limpiar los campos de derivación después de realizar la acción
function limpiarCamposDerivacion() {
    // Puedes limpiar campos, reiniciar formularios, etc., según tus necesidades
}

// Función para limpiar los campos de medicación después de añadir a la lista
function limpiarCamposMedicacion() {
    document.getElementById("medicamento").value = "";
    document.getElementById("cantidad").value = "";
    document.getElementById("frecuencia").value = "";
    document.getElementById("numDias").value = "";
    document.getElementById("esCronica").checked = false;
}
