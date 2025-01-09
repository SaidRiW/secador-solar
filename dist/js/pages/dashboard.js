$(document).ready(function() {
    let ultimoFechaHora = "";

    function actualizarGraficas(datos) {
        var temperatureData = [];
        var humidityData = [];
        var weightData = [];
        for (var i = 0; i < datos.length; i++) {
            temperatureData.push([i, parseFloat(datos[i].temperatura)]);
            humidityData.push([i, parseFloat(datos[i].humedad)]);
            weightData.push([i, parseFloat(datos[i].peso)]);
        }

        var plotTemperatura = $.plot('#chartTemperatura', [
            {
                data: temperatureData,
                lines: {
                    lineWidth: 2,
                    show: true,
                    fill: true,
                }
            }
        ],
        {
            grid: {
                hoverable: true,
                borderColor: '#f3f3f3',
                borderWidth: 1,
                tickColor: '#f3f3f3'
            },
            series: {
                color: '#bc3c3c',
            },
            yaxis: {
                min: 0,
                max: 60,
                show: true
            },
            xaxis: {
                show: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "Temperatura: %y.2°C",
                shifts: {
                    x: 10,
                    y: 20
                }
            }
        });

        var plotHumedad = $.plot('#chartHumedad', [
            {
                data: humidityData,
                lines: {
                    lineWidth: 2,
                    show: true,
                    fill: true,
                }
            }
        ],
        {
            grid: {
                hoverable: true,
                borderColor: '#f3f3f3',
                borderWidth: 1,
                tickColor: '#f3f3f3'
            },
            series: {
                color: '#3c8dbc',
            },
            yaxis: {
                min: 0,
                max: 100,
                show: true
            },
            xaxis: {
                show: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "Humedad: %y.2%",
                shifts: {
                    x: 10,
                    y: 20
                }
            }
        });

        var plotHumedad = $.plot('#chartPeso', [
            {
                data: weightData,
                lines: {
                    lineWidth: 2,
                    show: true,
                    fill: true,
                }
            }
        ],
        {
            grid: {
                hoverable: true,
                borderColor: '#f3f3f3',
                borderWidth: 1,
                tickColor: '#f3f3f3'
            },
            series: {
                color: '#ffc107',
            },
            yaxis: {
                min: 0,
                max: 100,
                show: true
            },
            xaxis: {
                show: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "Peso: %y.2kg",
                shifts: {
                    x: 10,
                    y: 20
                }
            }
        });
    }

    function obtenerDatosIniciales() {
        $.ajax({
            type: "GET",
            url: "../controladores/ctrl_dashboard.php",
            data: {opcion: 3},
            success: function(respuesta) {
                var datos = JSON.parse(respuesta);
                actualizarGraficas(datos);

                if (datos.length > 0) {
                    ultimoFechaHora = datos[datos.length - 1].fecha_hora;
                    $('#cardTemperatura').text(datos[datos.length - 1].temperatura);
                    $('#cardHumedad').text(datos[datos.length - 1].humedad);
                    $('#cardPeso').text(datos[datos.length - 1].peso);
                }
            },
            error: function() {
                console.log("Error al obtener los datos.");
            }
        });
    }

    function longPolling() {
        $.ajax({
            type: "GET",
            url: "../controladores/ctrl_dashboard.php",
            data: {opcion: 2, ultimoFechaHora: ultimoFechaHora},
            success: function(respuesta) {
                var datos = JSON.parse(respuesta);
                if (datos[0]) {
                    $('#cardTemperatura').text(datos[0].temperatura);
                    $('#cardHumedad').text(datos[0].humedad);
                    $('#cardPeso').text(datos[0].peso);
                    ultimoFechaHora = datos[0].fecha_hora;

                    // Obtener todos los datos nuevamente para actualizar las gráficas
                    obtenerDatosIniciales();
                }

                // Volver a iniciar la solicitud long polling
                longPolling();
            },
            error: function() {
                console.log("Error al obtener los datos.");

                // En caso de error, intentar nuevamente después de un breve retraso
                setTimeout(longPolling, 5000);
            }
        });
    }

    // Obtener los datos iniciales y empezar long polling
    obtenerDatosIniciales();
    longPolling();
});
