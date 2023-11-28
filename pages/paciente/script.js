// Función para pedir una cita
function pedirCita() {
    const fechaCita = document.getElementById("fechaCita").value;
    const sintomatologia = document.getElementById("sintomatologia").value;
    const mensajeError = document.getElementById("mensajeError");

    // Validaciones de fecha
    const hoy = new Date();
    const fechaSeleccionada = new Date(fechaCita);
    const diasEnMilisegundos = 24 * 60 * 60 * 1000;
    const diasDiferencia = Math.floor((fechaSeleccionada - hoy) / diasEnMilisegundos);

    if (fechaSeleccionada < hoy) {
        mensajeError.innerText = "Fecha no válida.";
    } else if (fechaSeleccionada.getDay() === 0 || fechaSeleccionada.getDay() === 6) {
        mensajeError.innerText = "Por favor, elija un día laborable.";
    } else if (diasDiferencia > 30) {
        mensajeError.innerText = "Tan malo no estarás. Pide una fecha como máximo 30 días en el futuro.";
    } else {
        // Aquí puedes realizar una solicitud AJAX para registrar la cita en el sistema
        // y manejar la lógica en el servidor (PHP).
        // También puedes enviar la sintomatología si el paciente la proporciona.

        // Limpia el mensaje de error
        mensajeError.innerText = "";

        // Opcional: Puedes mostrar un mensaje de éxito o realizar otras acciones después de la solicitud.
    }
}
