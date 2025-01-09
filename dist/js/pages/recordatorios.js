$(document).ready(function() {
    function tiempoTranscurrido(fecha) {
        const now = new Date();
        const fechaRecordatorio = new Date(fecha);
        const diff = Math.abs(now - fechaRecordatorio);

        const seconds = Math.floor(diff / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);
        const months = Math.floor(days / 30);
        const years = Math.floor(months / 12);

        if (years > 0) {
            return `hace ${years} año${years > 1 ? 's' : ''}`;
        } else if (months > 0) {
            return `hace ${months} mes${months > 1 ? 'es' : ''}`;
        } else if (days > 0) {
            return `hace ${days} día${days > 1 ? 's' : ''}`;
        } else if (hours > 0) {
            return `hace ${hours} hora${hours > 1 ? 's' : ''}`;
        } else if (minutes > 0) {
            return `hace ${minutes} minuto${minutes > 1 ? 's' : ''}`;
        } else {
            return `hace ${seconds} segundo${seconds > 1 ? 's' : ''}`;
        }
    }

    function cargarRecordatorios() {
        $.ajax({
            url: '../controladores/ctrl_recordatorios.php?opcion=1',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let recordatoriosHTML = '';
                let badgeCount = 0;
                if (data.error !== 1) {
                    data.forEach(function(recordatorio) {
                        badgeCount++;
                        recordatoriosHTML += `
                            <a href="historicos.php" class="dropdown-item" data-id="${recordatorio.id}">
                                <div class="media">
                                    <img src="../dist/img/excel.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title mt-2">${recordatorio.mensaje}</h3>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${tiempoTranscurrido(recordatorio.fecha_hora)}</p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>`;
                    });
                } else {
                    recordatoriosHTML = '<a href="#" class="dropdown-item d-flex justify-content-center">No hay recordatorios</a>';
                }
                $('#recordatorios-lista').html(recordatoriosHTML);
                $('.navbar-badge').text(badgeCount);
            }
        });
    }

    function marcarLeido(id) {
        $.ajax({
            url: '../controladores/ctrl_recordatorios.php?opcion=3&id=' + id,
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    cargarRecordatorios();
                } else {
                    alert('Error al marcar el recordatorio como leído.');
                }
            }
        });
    }

    $('#recordatorios-lista').on('click', '.dropdown-item', function() {
        const id = $(this).data('id');
        marcarLeido(id);
    });

    $('#marcar-todos-leidos').click(function() {
        $.ajax({
            url: '../controladores/ctrl_recordatorios.php?opcion=2',
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    cargarRecordatorios();
                } else {
                    alert('Error al marcar todos como leídos.');
                }
            },
            error: function() {
                alert('Error al comunicarse con el servidor.');
            }
        });
    });

    // Cargar recordatorios al cargar la página
    cargarRecordatorios();
});
