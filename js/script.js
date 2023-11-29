// redireccion.js

var tiempoRestante = 3; // 3 segundos

function actualizarCuentaAtras() {
    document.getElementById('cuentaAtras').innerText = 'Redirigiendo en ' + tiempoRestante + ' segundos...';
    tiempoRestante--;

    if (tiempoRestante < 0) {
        window.location.href = 'http://localhost/Proyectos/AmbulatorioAPP/php/crea_tablas.php';
    } else {
        setTimeout(actualizarCuentaAtras, 1000); // Actualizar cada segundo
    }
}

setTimeout(actualizarCuentaAtras, 0); // Iniciar cuenta atrás
