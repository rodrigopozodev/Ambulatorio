document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.consulta-button').forEach(item => {
        item.addEventListener('mouseover', function () {
            const diagnostico = this.getAttribute('data-diagnostico') || 'No disponible';
            const sintomatologia = this.getAttribute('data-sintomatologia') || 'No disponible';

            document.getElementById('detalle-diagnostico').innerText = diagnostico;
            document.getElementById('detalle-sintomatologia').innerText = sintomatologia;

            document.getElementById('detalles-consulta').style.display = 'block';
        });

        item.addEventListener('mouseout', function () {
            document.getElementById('detalles-consulta').style.display = 'none';
        });
    });
});
