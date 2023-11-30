document.addEventListener("DOMContentLoaded", function () {
    // Obtener el último paciente seleccionado almacenado en el almacenamiento local
    var ultimoPacienteSeleccionado = localStorage.getItem('ultimoPacienteSeleccionado');

    console.log("Último paciente seleccionado:", ultimoPacienteSeleccionado);

    // Si hay un último paciente seleccionado, establecerlo en el formulario
    if (ultimoPacienteSeleccionado) {
        $("#id_paciente").val(ultimoPacienteSeleccionado);
        // Trigger change event para que se activen las acciones relacionadas
        $("#id_paciente").trigger('change');
    }

    // Manejar el evento de cambio en el selector de pacientes
    $("#id_paciente").change(function () {
        // Almacenar el último paciente seleccionado en el almacenamiento local
        localStorage.setItem('ultimoPacienteSeleccionado', $(this).val());
        console.log("Paciente seleccionado actualizado:", $(this).val());
    });

    // Obtener información adicional del paciente al cargar la página
    obtenerInformacionPaciente($("#id_paciente").val());

    // Obtener información adicional del paciente al cambiar la selección
    $("#id_paciente").change(function () {
        obtenerInformacionPaciente($(this).val());
    });

    // Obtener información adicional del paciente
    function obtenerInformacionPaciente(idPaciente) {
        // Realizar una solicitud AJAX para obtener y actualizar la información del paciente
        $.ajax({
            type: "POST",
            url: "../php/consultas.php", // Asegúrate de que la URL sea correcta
            data: { id_paciente: idPaciente },
            success: function (response) {
                // Manejar la respuesta y actualizar la interfaz de usuario según sea necesario
                console.log("Información del paciente actualizada:", response);
                // Resto del código para actualizar la interfaz de usuario...
            },
            error: function (error) {
                console.error("Error al obtener información del paciente:", error);
            }
        });
    }
});
