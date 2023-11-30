// Función para añadir medicación a la lista
function anadirMedicacion() {
    var medicamentoSeleccionado = document.getElementById("medicamento");
    var cantidad = document.getElementById("cantidad").value;
    var frecuencia = document.getElementById("frecuencia").value;
    var dias = document.getElementById("dias").value;
    var cronica = document.getElementById("cronica").checked;

    // Validar que se haya seleccionado un medicamento
    if (medicamentoSeleccionado.value === '') {
        alert("Por favor, selecciona un medicamento");
        return;
    }

    // Validar que los campos no estén vacíos
    if (cantidad === '' || frecuencia === '' || (dias === '' && !cronica)) {
        alert("Completa todos los campos");
        return;
    }

    // Construir el texto de la medicación
    var textoMedicacion = medicamentoSeleccionado.options[medicamentoSeleccionado.selectedIndex].text
        + " - Cantidad: " + cantidad
        + ", Frecuencia: " + frecuencia
        + (cronica ? ", Medicación crónica" : ", Número de días: " + dias);

    // Crear un nuevo elemento de lista y añadirlo a la lista
    var lista = document.getElementById("listaMedicacion");
    var nuevaMedicacion = document.createElement("li");
    nuevaMedicacion.textContent = textoMedicacion;
    lista.appendChild(nuevaMedicacion);

    // Limpiar los campos después de añadir la medicación
    document.getElementById("cantidad").value = '';
    document.getElementById("frecuencia").value = '';
    document.getElementById("dias").value = '';
    document.getElementById("cronica").checked = false;
}

// Función para registrar la consulta
function registrarConsulta() {
    // Aquí debes agregar la lógica para enviar los datos del formulario al servidor mediante AJAX
    // y manejar la respuesta del servidor (puede ser JSON)

    // Por ejemplo, utilizando fetch:
    var url = 'consulta.php';
    var datosFormulario = new FormData(document.forms[0]);

    fetch(url, {
        method: 'POST',
        body: datosFormulario
    })
    .then(response => response.json())
    .then(data => {
        // Manejar la respuesta del servidor, por ejemplo, mostrar un mensaje de éxito
        alert(data.mensaje);
    })
    .catch(error => {
        // Manejar errores, por ejemplo, mostrar un mensaje de error
        console.error('Error al enviar la solicitud:', error);
    });
}

// Función para registrar la consulta
function registrarConsulta() {
    // Recuperar datos del formulario (ajustar según tus campos)
    var sintomas = document.getElementById("sintomas").value;
    var diagnostico = document.getElementById("diagnostico").value;
    var medicacion = obtenerMedicacionAgregada(); // Necesitarás implementar esta función

    // Realizar la petición al servidor para registrar la consulta
    // Puedes usar fetch o AJAX para enviar estos datos al servidor
    fetch('tu_ruta_de_registro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            sintomas: sintomas,
            diagnostico: diagnostico,
            medicacion: medicacion,
        }),
    })
    .then(response => response.json())
    .then(data => {
        alert(data.mensaje); // Muestra el mensaje recibido del servidor
        // Puedes redirigir o hacer otras acciones después de registrar la consulta
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

// Función para obtener la medicación agregada
function obtenerMedicacionAgregada() {
    // Implementa lógica para obtener la medicación de la lista y retornarla
    // Puedes recorrer los elementos de la lista y construir un array con los datos
    // Retorna ese array
}
