$(function () {
    // Configurar Moment.js para usar el idioma español
    moment.locale('es-mx');

    // Configurar datetimepicker en modo inline
    $('#calendar').datetimepicker({
        format: 'L',
        locale: 'es-mx',
        inline: true
    }).on('dp.change', function(e) {
        // Obtener la fecha seleccionada
        let fechaSeleccionada = e.date.format('YYYY-MM-DD');
        //console.log('Fecha seleccionada: ' + fechaSeleccionada);
        
        // Actualizar la tabla con los datos de la fecha seleccionada
        mostrarTablaHistoricosPorFecha(tablaHistoricosAlias, fechaSeleccionada);
    });
});

function crearDataTable(nombreTabla) {
    $.fn.dataTable.ext.errMode = 'none';
    tabla = $(nombreTabla).DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "ajax": {
            "url": "../controladores/ctrl_historicos.php?opcion=1",
            "dataSrc": function (json) {
                if (json.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: json.message,
                        text: 'Intente con una fecha diferente.',
                    });
                    return [];
                }
                return json;
            }
        },
        "columns": [
            {"data": "temperatura"},
            {"data": "humedad"},
            {"data": "peso"},
            {"data": "fecha_hora"}
        ],
        "dom": '<"row"<"col-md-6"l><"col-md-6"f>>' + 'Brtip',
        "buttons": [
            {
                extend: 'copy',
                title: function () {
                    return 'Registros_históricos_' + obtenerFechaActual();
                }
            },
            {
                extend: 'excel',
                title: function () {
                    return 'Registros_históricos_' + obtenerFechaActual();
                }
            },
            {
                extend: 'pdf',
                title: function () {
                    return 'Registros_históricos_' + obtenerFechaActual();
                }
            },
            {
                extend: 'print',
                title: function () {
                    return 'Registros_históricos_' + obtenerFechaActual();
                }
            }
        ],
        "language": {
            "decimal": "",
            "emptyTable": "No existe ningún registro en la tabla.",
            "info": "Registros del _START_ al _END_ (_TOTAL_ registros totales)",
            "infoEmpty": "Registros del 0 al 0 (0 registros totales)",
            "infoFiltered": "(Filtro de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontró ningún resultado.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "lengthChange": true,
        "lengthMenu": [5, 10, 15, 20, 25],
        "searching": true,
        "ordering": true,
        "order": [[3, 'asc']],
        "columnDefs": [{
            "targets": [2],
            "searchable": false,
            "orderable": false
        }],
        "pageLength": 5,
        "info": true,
        "pagingType": "simple_numbers"
    });

    // Renderizar los botones
    tabla.buttons().container().appendTo($(nombreTabla + '_wrapper .col-md-6:eq(0)'));

    return tabla;
}

function mostrarTablaHistoricos(tablaHistoricos) {
    tablaHistoricos.ajax.url("../controladores/ctrl_historicos.php?opcion=1");
    tablaHistoricos.ajax.reload();
}

function mostrarTablaHistoricosPorFecha(tablaHistoricos, fecha) {
    tablaHistoricos.ajax.url("../controladores/ctrl_historicos.php?opcion=2&fecha=" + fecha);
    tablaHistoricos.ajax.reload();
}

// Obtener la fecha actual en formato YYYY-MM-DD
function obtenerFechaActual() {
    const hoy = new Date();
    const dia = String(hoy.getDate()).padStart(2, '0');
    const mes = String(hoy.getMonth() + 1).padStart(2, '0');
    const anio = hoy.getFullYear();
    return anio + '-' + mes + '-' + dia;
}

// Alias para la dataTables tablaHistoricos, como variable global
let tablaHistoricosAlias;

// Método ready del objeto document. Se ejecuta cuando se carga completamente la página
$(document).ready(function() {
    let tablaHistoricos = crearDataTable("#tablaHistoricos");
    tablaHistoricosAlias = tablaHistoricos;

    // Referenciar el alias a la dataTable tablaHistoricos para que pueda
    // ser usado desde cualquier parte del código
    mostrarTablaHistoricos(tablaHistoricos);
});
